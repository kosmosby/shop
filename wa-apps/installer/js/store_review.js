var InstallerStoreReview = ( function($) {

    InstallerStoreReview = function(options) {
        var that = this;

        // DOM
        that.$wrapper = options["$wrapper"];
        that.$header_column = that.$wrapper.find('.js-rate-head-column');
        that.$document = $(document);

        // VARS
        that.app_url = options["app_url"];
        that.widget_template = options["widget_template"];
        that.events = {
            // Outgoing events
            out: {
                review_submit: 'wa_product_review_submit'
            },
            // Incoming events
            in: {
                review_core_init: 'wa_product_review_core_init',
                review_init: 'wa_product_review_init',
                review_response: 'wa_product_review_submit_response'
            }
        };

        that.is_allowed = false;
        that.user_data = null;

        that.login_url = null;
        that.logout_url = null;

        that.templates = options["templates"];
        that.locale = options["locale"];

        // DYNAMIC VARS
        that.tokens_is_reissued = false;
        that.locale_code = null;
        that.store_review_core_url = options["store_review_core_url"];
        that.store_review_core_params = options["store_review_core_params"];

        // INIT
        that.initClass();
    };

    InstallerStoreReview.prototype.initClass = function() {
        var that = this;

        that.locale_code = (that.store_review_core_params.locale || '');

        //
        that.initEventListener();
        //
        that.initReviewCore();
    };

    InstallerStoreReview.prototype.initReviewCore = function() {
        var that = this,
            script = document.createElement("script"),
            url = that.buildCoreUrlWithParams(that.store_review_core_url);

        document.getElementsByTagName("head")[0].appendChild(script);

        $(script).attr('id', 'wa-store-review-core').attr('src', url);
    };

    InstallerStoreReview.prototype.sendEvent = function(event, data) {
        var that = this;

        that.$document.trigger(event, data);
    };

    InstallerStoreReview.prototype.initEventListener = function () {
        var that = this;

        that.$document.on(that.events.in.review_core_init, function (e, data) {
            that.initCore(data);
        });

        that.$document.on(that.events.in.review_init, function (e, data) {
            that.initRate(data);
        });
    };

    InstallerStoreReview.prototype.initCore = function(data) {
        var that = this,
            $script = that.$document.find('#wa-store-review-core');

        $script.remove();

        if (!data.review_core_url && !that.store_review_core_url) {
            return false;
        }

        if (data.locale) {
            that.locale_code = data.locale;
        }

        if (data.review_core_url) {
            that.store_review_core_url = data.review_core_url;
        }

        if (data.login_url) {
            that.login_url = data.login_url;
        }

        if (data.logout_url) {
            that.logout_url = data.logout_url;
        }

        var script = document.createElement("script"),
            url = that.buildCoreUrlWithParams(that.store_review_core_url);

        document.getElementsByTagName("head")[0].appendChild(script);
        $(script).attr('id', 'wa-store-review-core').attr('src', url);

    };

    InstallerStoreReview.prototype.initRate = function (data) {
        var that = this,
            $rows = that.$wrapper.find('.js-rate-row[data-slug]'),
            user_reviews = data.user_reviews;

        // Save init data
        that.is_allowed = data.is_allowed;
        that.user_data = data.user_data;

        // If tokens are outdated, they must be reissued once.
        if (!that.is_allowed && that.user_data) {
            if (!that.tokens_is_reissued) {
                that.tokens_is_reissued = true;
                that.reInitTokens();
            }
            return false;
        }

        // Init column
        that.$header_column.text(that.locale["your_rates"]);

        // Init widgets
        $rows.each(function (i, row) {
            var $row = $(row),
                is_disabled = $row.data('is-disabled'),
                parent_theme_slug = $row.data('parent-theme-slug'),
                slug = $row.data('slug'),
                review_data = (user_reviews[slug] || false);

            if (parent_theme_slug) {
                review_data = (user_reviews[parent_theme_slug] || false);
            }

            if (!review_data) {
                return true;
            }

            review_data.product_id = slug;
            review_data.header_locale = $row.data('review-header-locale');
            review_data.user_data = that.user_data;

            // For design themes - use review for the parent theme.
            if (parent_theme_slug) {
                review_data.product_id = parent_theme_slug;
            }

            if (!is_disabled) {
                that.initProductReview($row, review_data);
            }
        });
    };

    InstallerStoreReview.prototype.initProductReview = function ($wrapper, data) {
        var that = this,
            $widget = $(that.widget_template).clone(),
            rate = data.rate ? data.rate : null,
            before_rate = (rate || 0);


        $wrapper.find('.js-rate-column').html($widget);

        var widget = initRateWidget({
            $wrapper: $widget,
            rate: rate,
            onSet: function(rate) {
                if (that.is_allowed) {
                    initReviewDialog(rate);
                } else if (!that.user_data) {
                    initAuthDialog();
                }
            }
        });

        function initRateWidget(options) {
            var that = this;

            // DOM
            var $wrapper = options["$wrapper"],
                $rates = $wrapper.find(".js-set-rate");

            // CONST
            var active_rate = options["rate"];

            // EVENTS
            $wrapper.on("click", ".js-set-rate", function(event) {
                event.preventDefault();

                var $rate = $(this),
                    rate = $rate.index() + 1;

                var save = true;
                if (typeof options["onSet"] === "function") {
                    var callback = options["onSet"](rate);
                    if (callback === false) {
                        save = false;
                    }
                }

                setRate(rate, save);
            });

            $wrapper.on("mouseenter", ".js-set-rate", function(event) {
                event.preventDefault();
                var index = $(this).index() + 1;
                setRate(index, false);
            });

            $wrapper.on("mouseleave", function(event) {
                event.preventDefault();

                if (typeof options["onExit"] === "function") {
                    options["onExit"](active_rate);
                }

                setRate(active_rate, false);
            });

            if (active_rate) {
                setRate(active_rate, false);
            }

            return {
                getRate: function() {
                    return active_rate;
                },
                setRate: setRate
            };

            /**
             * @var {Number|Null} index
             * */
            function setRate(rate, save) {
                var active_class = "is-active";

                save = (typeof save === "boolean" ? save : true);

                $rates.each( function(i) {
                    var $rate = $(this);

                    if (i <= rate - 1) {
                        $rate.addClass(active_class);
                    } else {
                        $rate.removeClass(active_class);
                    }
                });

                if (save) {
                    active_rate = rate;
                }
            }
        }

        function initReviewDialog(rate) {
            var is_success = false,
                dialog = $.waDialog({
                    wrapper: $(that.templates["review_dialog"]),
                    onOpen: initRateDialogContent,
                    onClose: function() {
                        if (is_success) {
                            location.reload();
                        } else {
                            widget.setRate(before_rate, true);
                        }
                    }
                });

            function initRateDialogContent($wrapper, dialog) {
                // DOM
                var $user_name = $wrapper.find('.js-customer-center-user-name'),
                    $signup_user_info = $wrapper.find('.js-dialog-signup-user-info'),
                    $logout_link = $wrapper.find('.js-customer-center-logout-link'),
                    $content_title = $wrapper.find(".js-content-title"),
                    $comment_field = $wrapper.find(".js-comment-field"),
                    $errors_place = $wrapper.find('.js-errors-place'),
                    $button = $wrapper.find(".js-send-comment");
                    $user = $wrapper.find(".js-comment-user");

                if (data.user_data) {
                    $user.find('.user').text(data.user_data.name);
                    var userpic = (data.user_data.userpic_url) ? data.user_data.userpic_url : '/wa-content/img/userpic20.jpg';
                    $user.find('.userpic20').css('background-image', 'url(' + userpic + ')');

                    // If user signed up his email is not empty
                    if (data.user_data.email) {
                        $signup_user_info.show();
                        $user_name.text(data.user_data.name + ' (' + data.user_data.email + ')');
                    }
                }
                $logout_link.attr('href', that.logout_url);

                // CONST
                var is_edit = (data && (data.rate || data.message));

                // DYNAMIC VARS
                var is_locked = false;

                $content_title.append(' '+ data.header_locale);

                if (data.message) {
                    $comment_field.val(data.message);
                }

                var widget = initRateWidget({
                    $wrapper: $wrapper.find(".js-rates-list"),
                    rate: rate
                });

                $comment_field.on("keyup", function() {
                    var is_empty = !$.trim($comment_field.val()).length,
                        text = that.locale["button_default"];

                    if (is_empty) {
                        text = (is_edit ? that.locale["button_edit_default"] : that.locale["button_default"]);
                        $user.hide();
                    } else {
                        text = (is_edit ? that.locale["button_edit_active"] : that.locale["button_active"]);
                        $user.show();
                    }

                    $button.text(text);
                });

                $comment_field.trigger("keyup");

                // EVENTS
                $button.on("click", function(e) {
                    e.preventDefault();

                    if (!is_locked) {
                        $button.prop("disabled", true);
                        is_locked = true;
                        $errors_place.html('');
                        data.text = $comment_field.val();
                        data.rate = widget.getRate();

                        that.sendEvent(that.events.out.review_submit, data);
                    }
                });

                // Handle response from Store server
                that.$document.on(that.events.in.review_response, function (e, res) {
                    $button.prop("disabled", false);
                    is_locked = false;

                    if (res.status == 'ok') {
                        $wrapper.find(".i-comment-section").html(that.templates["confirm"]);
                        $button.remove();
                        dialog.resize();

                        is_success = true;
                    }

                    if (res.status == 'fail' && res.errors) {
                        var errors = res.errors;

                        if (!errors.length) {
                            return false;
                        }

                        $.each(errors, function (i, error) {

                            if (!error.text) {
                                return false;
                            }

                            var $error = $("<div />").addClass("i-error").text(error.text);
                            $errors_place.append($error);

                        });

                        $errors_place.show();
                        dialog.resize();
                    }
                });

            }
        }

        function initAuthDialog() {
            $.waDialog({
                wrapper: $(that.templates["login_dialog"]),
                onOpen: function ($wrapper, dialog) {
                    var $auth_link = $wrapper.find('.js-customer-center-login-link');

                    $auth_link.attr('href', that.login_url);
                },
                onClose: function () {
                    widget.setRate(before_rate, true);
                }
            });
        }
    };

    InstallerStoreReview.prototype.reInitTokens = function () {
        var that = this,
            href = that.app_url + "?module=store&action=newToken";

        $.get(href, function (res) {
            if (res.status == 'ok' && res.data) {
                that.store_review_core_params = res.data;
                that.initCore({});
            }
        });
    };

    InstallerStoreReview.prototype.buildCoreUrlWithParams = function (url) {
        var that = this,
            separator = (url.indexOf('?') === -1) ? '?' : '&';

        if (that.store_review_core_params) {
            url += separator; // ? or & in url
            url += 'inst_id=' + (that.store_review_core_params["inst_id"] || '');
            url += '&token_key=' + (that.store_review_core_params["token"] || '');
            url += '&token_sign=' + (that.store_review_core_params["sign"] || '');
            url += '&token_expire_datetime=' + (that.store_review_core_params["remote_expire_datetime"] || '');
            url += '&locale=' + (that.locale_code || '');
        }

        return url;
    };

    return InstallerStoreReview;

})(jQuery);
