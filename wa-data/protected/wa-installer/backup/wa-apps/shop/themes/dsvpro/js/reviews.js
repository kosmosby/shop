$(function () {
    $.fn.rateWidget = function(options, ext, value) {

        var settings;
        var self = this;
        if (!this || !this.length) {
            return;
        }

        if (typeof options == "string") {
            if (options == "getOption") {
                if (ext == "rate") {
                    return parseInt(this.attr("data-rate"), 10);
                }
            }
            if (options == "setOption") {
                if (ext == "rate") {
                    update.call(this, parseInt(value, 10));
                    ext = {
                        rate: value
                    };
                }
                if (typeof ext === "object" && ext) {
                    settings = this.data("rateWidgetSettings") || {};
                    $.extend(settings, ext);
                    if (typeof ext.hold !== "undefined" && typeof ext.hold !== "function") {
                        settings.hold = _scalarToFunc(settings.hold);
                    }
                }
            }
            return this;        // means that widget is installed already
        }

        this.data("rateWidgetSettings", $.extend({
            onUpdate: function() {},
            rate: null,
            hold: false,
            withClearAction: true
        }, options || {}));

        if (this.data("inited")) {  // has inited already. Don't init again
            return;
        }

        settings = this.data("rateWidgetSettings");
        if (typeof settings.hold !== "function") {
            settings.hold = _scalarToFunc(settings.hold);
        }
        init.call(this);

        function init() {
            if (!self.attr("id")) {
                self.attr("id", (""+Math.random()).substr(2));
            }
            if (settings.rate !== null) {
                self.attr("data-rate", settings.rate);
            }
            self.find("i:lt(" + self.attr("data-rate") + ")").removeClass("star-empty").addClass("star");
            self.mouseover(function(e) {
                if (settings.hold.call(self)) {
                    return;
                }
                var target = e.target;
                if (target.tagName == "I") {
                    target = $(target);
                    target.prevAll()
                        .removeClass("star star-empty").addClass("star-hover").end()
                        .removeClass("star star-empty").addClass("star-hover");
                    target.nextAll().removeClass("star star-hover").addClass("star-empty");
                }
            }).mouseleave(function() {
                if (settings.hold.call(self)) {
                    return;
                }
                update.call(self, self.attr("data-rate"));
            });
            self.click(function(e) {
                if (settings.hold.call(self)) {
                    return;
                }
                var item = e.target;
                var root = this;
                while (item.tagName != "I") {
                    if (item == root) {
                        return;
                    }
                }
                var prev_rate = self.attr("data-rate");
                var rate = 0;
                self.find("i")
                    .removeClass("star star-hover")
                    .addClass("star-empty")
                    .each(function() {
                        rate++;
                        $(this).removeClass("star-empty").addClass("star");
                        if (this == item) {
                            if (prev_rate != rate) {
                                self.attr("data-rate", rate);
                                settings.onUpdate(rate);
                            }
                            return false;
                        }
                    });
                return false;
            });
            // if withClearAction is setted to true make available near the stars link-area for clear all stars (set rate to zero)
            if (settings.withClearAction) {
                var clear_link_id = "clear-" + $(this).attr("id"),
                    clear_link = $("#" + clear_link_id);
                if (!clear_link.length) {
                    self.after('<a href="javascript:void(0);" class="inline-link rate-clear" id="'+clear_link_id+'" style="display:none;"><b><i>'+$_('clear')+'</b></i></a>');
                    clear_link = $("#" + clear_link_id);
                }
                clear_link.click(function() {
                    if (settings.hold.call(self)) {
                        return;
                    }
                    var prev_rate = self.attr("data-rate");
                    update.call(self, 0);
                    if (prev_rate !== 0) {
                        settings.onUpdate(0);
                    }
                });
                var timer_id;
                self.parent().mousemove(function() {
                    if (settings.hold.call(self)) {
                        return;
                    }
                    if (timer_id) {
                        clearTimeout(timer_id);
                    }
                    clear_link.show(0);
                }).mouseleave(function() {
                    timer_id = setTimeout(function() {
                        if (settings.hold.call(self)) {
                            return;
                        }
                        clear_link.hide(0);
                    }, 150);
                });
            }
            this.unbind("clear").bind("clear", function() {
                update.call(self, 0);
            });
            this.data("inited", true);
        }

        function update(new_rate) {
            var rate = 0;
            this.find("i")
                .removeClass("star star-hover")
                .addClass("star-empty").each(function() {
                if (rate == new_rate) {
                    return false;
                }
                rate++;
                $(this).removeClass("star-empty").addClass("star");
            });
            this.attr("data-rate", new_rate);
        }

        function _scalarToFunc(scalar) {
            return function() {
                return scalar;
            };
        }

        return this;

    };

    /**
     * Hotkey combinations
     * {Object}
     */
    var hotkeys = {
        "alt+enter": {
            ctrl:false, alt:true, shift:false, key:13
        },
        "ctrl+enter": {
            ctrl:true, alt:false, shift:false, key:13
        },
        "ctrl+s": {
            ctrl:true, alt:false, shift:false, key:17
        }
    };

    var form_wrapper = $("#product-review-form");
    var form = form_wrapper.find("form");
    var content = $("#page-content .reviews");

    var input_rate = form.find("input[name=rate]");
    if (!input_rate.length) {
        input_rate = $('<input name="rate" type="hidden" value=0>').appendTo(form);
    }
    $("#review-rate").rateWidget({
        onUpdate: function(rate) {
            input_rate.val(rate);
        }
    });

    content
        .off("click", ".review__reply, .write-review")
        .on("click", ".review__reply, .write-review", function() {
            var self = $(this);
            var item = self.parents("li:first");
            var parent_id = parseInt(item.attr("data-id"), 10) || 0;
            prepareAddingForm.call(self, parent_id);
            $(".review").removeClass("in-reply-to");
            item.find(".review:first").addClass("in-reply-to");
            /*
            if (!$.fn.scrollTo) {
                $.getScript($.md.shop_theme_url+"js/jquery.scrollTo.min.js", function() {
                    $.scrollTo("#product-review-form",800);
                });
            } else {
                $.scrollTo("#product-review-form",800);
            }
            */
            return false;
        });

    var captcha = $(".wa-captcha");
    var provider_list = $("#user-auth-provider li");
    var current_provider = provider_list.filter(".selected").attr("data-provider");
    if (current_provider == "guest" || !current_provider) {
        captcha.show();
    } else {
        captcha.hide();
    }

    provider_list.find("a").click(function () {
        var self = $(this);
        var li = self.parents("li:first");
        if (li.hasClass("selected")) {
            return false;
        }
        li.siblings(".selected").removeClass("selected");
        li.addClass("selected");

        var provider = li.attr("data-provider");
        form.find("input[name=auth_provider]").val(provider);
        if (provider == "guest") {
            $("div.provider-fields").hide();
            $("div.provider-fields[data-provider=guest]").show();
            captcha.show();
            return false;
        }
        if (provider == current_provider) {
            $("div.provider-fields").hide();
            $("div.provider-fields[data-provider="+provider+"]").show();
            captcha.hide();
            return false;
        }

        var left = (screen.width - 600)/2;
        var top =  (screen.height- 400)/2;
        window.open(
            $(this).attr("href"), "oauth", "width=600,height=400,left="+left+",top="+top+",status=no,toolbar=no,menubar=no"
        );
        return false;
    });

    addHotkeyHandler("textarea", "ctrl+enter", addReview);
    form.submit(function() {
        addReview();
        return false;
    });

    function addReview() {
        var addUrl;

        if($("#reviews").length){
            addUrl = location.href.replace("/reviews/", "").replace(/\/#\/[^#]*|\/#|\/$/g, "") + "/reviews/add/";
        }
        else {
            addUrl = location.href.replace(/\/#\/[^#]*|\/#|\/$/g, "") + "/add/";
        }
        $.post(
            addUrl,
            form.serialize(),
            function (r) {
                if (r.status == "fail") {
                    clear(form, false);
                    showErrors(form, r.errors);
                    return;
                }
                if (r.status != "ok" || !r.data.html) {
                    if (console) {
                        console.error("Error occured.");
                    }
                    return;
                }
                var html = r.data.html;
                var parent_id = parseInt(r.data.parent_id, 10) || 0;
                var parent_item = parent_id ? form.parents("li:first") : content;
                var ul = $("ul.reviews__branch:first", parent_item);

                if (parent_id) {
                    //reply to a review
                    ul.show().append(html);
                    ul.find("li:last .review").addClass("new");
                } else {
                    //top-level review
                    ul.show().prepend(html);
                    ul.find("li:first .review").addClass("new");
                }

                $(".reviews-count-text").text(r.data.review_count_str);
                $(".reviews-count").text(r.data.count);
                form.find("input[name=count]").val(r.data.count);
                clear(form, true);
                content.find(".write-review").click();

                form_wrapper.hide();
                if (typeof success === "function") {
                    success(r);
                }
            }, "json")
            .error(function(r) {
                if (console) {
                    console.error(r.responseText ? "Error occured: " + r.responseText : "Error occured.");
                }
            });
    };

    function showErrors(form, errors) {
        for (var name in errors) {
            $("[name="+name+"]", form).closest(".wa-field").after($('<span class="errormsg text-danger"></span>').text(errors[name])).addClass("has-error");
        }
    };

    function clear(form, clear_inputs) {
        clear_inputs = typeof clear_inputs === "undefined" ? true : clear_inputs;
        $(".errormsg", form).remove();
        $(".has-error", form).removeClass("has-error");
        $(".wa-captcha-refresh", form).click();
        if (clear_inputs) {
            $("input[name=captcha], textarea", form).val("");
            $("input[name=rate]", form).val(0);
            $("input[name=title]", form).val("");
            $(".rate", form).trigger("clear");
        }
    };

    function prepareAddingForm(review_id)
    {
        var self = this; // clicked link
        if (review_id) {
            self.closest(".review__action").after(form_wrapper);
            $(".rate", form).trigger("clear").parents(".review-field:first").hide();
            content.find(".write-review").show();
        } else {
            self.after(form_wrapper);
            form.find(".rate").parents(".review-field:first").show();
            self.hide();
        }
        clear(form, false);
        $("input[name=parent_id]", form).val(review_id);
        form_wrapper.show();
    };

    function addHotkeyHandler(item_selector, hotkey_name, handler) {
        var hotkey = hotkeys[hotkey_name];
        form.off("keydown", item_selector).on("keydown", item_selector,
            function(e) {
                if (e.keyCode == hotkey.key &&
                    e.altKey  == hotkey.alt &&
                    e.ctrlKey == hotkey.ctrl &&
                    e.shiftKey == hotkey.shift)
                {
                    return handler();
                }
            }
        );
    };
});