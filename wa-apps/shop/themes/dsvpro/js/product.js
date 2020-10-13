function Product(form, options) {
    this.form = $(form);
    this.button = this.form.find("button[type=submit]");
    for (var k in options) {
        this[k] = options[k];
    }
    var self = this,
        config = $("#config").data();
    // add to cart block: services
    this.form.find(".services input[type=checkbox]").click(function () {
        var obj = $('select[name="service_variant[' + $(this).val() + ']"]');
        if (obj.length) {
            if ($(this).is(":checked")) {
                obj.removeAttr("disabled");
            } else {
                obj.attr("disabled", "disabled");
            }
        }
        self.cartButtonVisibility(true);
        self.updatePrice();
    });

    this.form.find(".services .service-variants").on("change", function () {
        self.cartButtonVisibility(true);
        self.updatePrice();
    });

    this.form.find(".options__item a").click(function () {
        var d = $(this).closest(".options__values");
        d.find("a.active").removeClass("active");
        $(this).addClass("active");
        d.find(".sku-feature").val($(this).data("value")).change();
        return false;
    });

    this.form.find(".skus input[type=radio]").click(function () {
        if ($(this).data("image-id")) {
            $("#product-image-" + $(this).data("image-id")).click();
        }
        if ($(this).data("disabled")) {
            self.button.attr("disabled", "disabled");
        } else {
            self.button.removeAttr("disabled");
        }
        var sku_id = $(this).val();
        self.updateSkuServices(sku_id);
        self.cartButtonVisibility(true);
        self.updatePrice();
    });
    var $initial_cb = this.form.find(".skus input[type=radio]:checked:not(:disabled)");
    if (!$initial_cb.length) {
        $initial_cb = this.form.find(".skus input[type=radio]:not(:disabled):first").prop("checked", true).click();
    }
    $initial_cb.click();

    this.form.find(".sku-feature").change(function () {
        var key = "";
        self.form.find(".sku-feature").each(function () {
            key += $(this).data("feature-id") + ":" + $(this).val() + ";";
        });
        var sku = self.features[key];
        if (sku) {
            if (sku.image_id) {
                $("#product-image-" + sku.image_id).click();
            }
            self.updateSkuServices(sku.id);
            if (sku.available) {
                self.button.removeAttr("disabled");
            } else {
                self.form.find("div.stocks > div").hide();
                self.form.find(".sku-no-stock").show();
                self.button.attr("disabled", "disabled");
            }
            self.form.find(".product__price").data("price", sku.price);
            self.updatePrice(sku.price, sku.compare_price);
        } else {
            self.form.find("div.stocks > div").hide();
            self.form.find(".sku-no-stock").show();
            self.button.attr("disabled", "disabled");
            self.form.find(".product__comparePrice").hide();
            self.form.find(".product__price").empty();
        }
        self.cartButtonVisibility(true);
    });
    this.form.find(".sku-feature:first").change();

    if (!this.form.find(".skus input:radio:checked").length) {
        this.form.find(".skus input:radio:enabled:first").attr("checked", "checked");
    }

    this.form.submit(function () {
        var f = $(this);

        $.post(f.attr("action") + "?html=1", f.serialize(), function (response) {
            if (response.status == "ok") {
                // обновленяем индикаторы
                $(window).trigger("updateCart", response.data);

                $(window).trigger("messageAdd", {
                    id: response.data.item_id,
                    action: config.locale.addto || "",
                    target: config.locale.cart || "",
                    class: "js-cart-remove",
                    url: config.cart
                });

                // Вызываем модальное окно "Добавлен в корзину"
                // WA_THEME.Modal - productAdded
                $(window).trigger("productAdded", {id: response.data.item_id, qty: f.find(".qty__input").val() || 1});

                // fCart - fCart_process
                $(window).trigger("fCart_process", { product_id: f.find("[name='product_id']").val(), sku_id: response.data.item_id });

                if (response.data.error) {
                    alert(response.data.error);
                }
            } else if (response.status == "fail") {
                alert(response.errors);
            }
        }, "json");

        return false;
    });
    var id = this.form.find("[name='product_id']").val();

    $(window).trigger("productView", parseInt(id, 10));
};

Product.prototype.currencyFormat = function (number, no_html) {
    // Format a number with grouped thousands
    //
    // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfix by: Michael White (http://crestidg.com)

    var i, j, kw, kd, km;
    var decimals = this.currency.frac_digits;
    var dec_point = this.currency.decimal_point;
    var thousands_sep = this.currency.thousands_sep;

    // input sanitation & defaults
    if( isNaN(decimals = Math.abs(decimals)) ){
        decimals = 2;
    }
    if( dec_point == undefined ){
        dec_point = ",";
    }
    if( thousands_sep == undefined ){
        thousands_sep = ".";
    }

    i = parseInt(number = (+number || 0).toFixed(decimals)) + "";

    if( (j = i.length) > 3 ){
        j = j % 3;
    } else{
        j = 0;
    }

    km = (j ? i.substr(0, j) + thousands_sep : "");
    kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
    //kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).slice(2) : "");
    kd = (decimals && (number - i) ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");


    var number = km + kw + kd;
    var s = no_html ? this.currency.sign : this.currency.sign_html;
    if (!this.currency.sign_position) {
        return s + this.currency.sign_delim + number;
    } else {
        return number + this.currency.sign_delim + s;
    }
};


Product.prototype.serviceVariantHtml= function (id, name, price) {
    return $('<option data-price="' + price + '" value="' + id + '"></option>').text(name + ' (+' + this.currencyFormat(price, 1) + ')');
};

Product.prototype.updateSkuServices = function (sku_id) {
    this.form.find("div.stocks > div").hide();
    this.form.find(".sku-" + sku_id + "-stock").show();
    for (var service_id in this.services[sku_id]) {
        var v = this.services[sku_id][service_id];
        if (v === false) {
            this.form.find(".service-" + service_id).hide().find("input,select").attr("disabled", "disabled").removeAttr("checked");
        } else {
            this.form.find(".service-" + service_id).show().find("input").removeAttr("disabled");
            if (typeof (v) == "string") {
                this.form.find(".service-" + service_id + " .service-price").html(this.currencyFormat(v));
                this.form.find(".service-" + service_id + " input").data("price", v);
            } else {
                var select = this.form.find(".service-" + service_id + " .service-variants");
                var selected_variant_id = select.val();
                for (var variant_id in v) {
                    var obj = select.find("option[value=" + variant_id + "]");
                    if (v[variant_id] === false) {
                        obj.hide();
                        if (obj.attr("value") == selected_variant_id) {
                            selected_variant_id = false;
                        }
                    } else {
                        if (!selected_variant_id) {
                            selected_variant_id = variant_id;
                        }
                        obj.replaceWith(this.serviceVariantHtml(variant_id, v[variant_id][0], v[variant_id][1]));
                    }
                }
                this.form.find(".service-" + service_id + " .service-variants").val(selected_variant_id);
            }
        }
    }
};

Product.prototype.updatePrice = function (price, compare_price) {
    if (price === undefined) {
        var input_checked = this.form.find(".skus input:radio:checked");
        if (input_checked.length) {
            var price = parseFloat(input_checked.data("price"));
            var compare_price = parseFloat(input_checked.data("compare-price"));
        } else {
            var price = parseFloat(this.form.find(".product__price").data("price"));
        }
    }
    if (compare_price) {
        if (!this.form.find(".product__comparePrice").length) {
            this.form.prepend("<span class='product__comparePrice nowrap'></span>");
        }
        this.form.find(".product__comparePrice").html(this.currencyFormat(compare_price)).show();
        if($("#productFormAffix").length) {
            $("#productFormAffix").find(".productAffix__compare").html(this.currencyFormat(compare_price)).show();
        }
    } else {
        this.form.find(".product__comparePrice").hide();
        if($("#productFormAffix").length) {
            $("#productFormAffix").find(".productAffix__compare").hide();
        }
    }
    var self = this;
    this.form.find(".services input:checked").each(function () {
        var s = $(this).val();
        if (self.form.find(".service-" + s + " .service-variants").length) {
            price += parseFloat(self.form.find(".service-" + s + " .service-variants :selected").data("price"));
        } else {
            price += parseFloat($(this).data("price"));
        }
    });
    this.form.find(".product__price").html(this.currencyFormat(price));

    if($("#productFormAffix").length) {
        $("#productFormAffix").find(".productAffix__price").html(this.currencyFormat(price))
    }
    //this.form.find(".product-data").data("price", price);
};

Product.prototype.cartButtonVisibility = function (visible) {
    //toggles "Add to cart" / "%s is now in your shopping cart" visibility status
    if (visible) {
        this.form.find(".product__comparePrice").show();
        this.form.find("button[type='submit']").show();
        this.form.find(".product__price").show();
        this.form.find(".qty__input").show();
    } else {
        this.form.find(".product__comparePrice").hide();
        this.form.find("button[type='submit']").hide();
        this.form.find(".product__price").hide();
        this.form.find(".qty__input").hide();
    }
};

(function (WA_THEME, $) {
    "use strict";

    var productConfig = $("#productData").data(),
        appConfig = $("#config").data();

    WA_THEME.productGallery = function () {
        return {
            init: function () {
                $(window).on("initProductGallery", function () {
                    /* слайдер фото */
                    $(".product__images").not(".slick-initialized").slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        fade: true,
                        arrows: false,
                        dots: true,
                        asNavFor: ".product__gallery"
                    });

                    /* навигация слайдера фото */
                    $(".product__mediaV .product__gallery").not(".slick-initialized").slick({
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        vertical: true,
                        arrows : true,
                        focusOnSelect: true,
                        centerMode: true,
                        centerPadding: "0px",
                        asNavFor: ".product__images",
                        responsive: [
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: 4,
                                    slidesToScroll: 4,
                                    vertical: false,
                                    dots: true,
                                    arrows: false
                                }
                            }
                        ]
                    });

                    $(".product__mediaH .product__gallery").not(".slick-initialized").slick({
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        arrows : true,
                        focusOnSelect: true,
                        asNavFor: ".product__images"
                    });

                    if ($("[data-fancybox]").length) {
                        $.getScript(appConfig.activeurl + "js/jquery.fancybox.min.js", function () {
                            $().fancybox({
                                selector: '.product__images .slick-slide:not(.slick-cloned)',
                                hash: false,
                                loop: true
                            });
                        });
                    }

                    /* зум фото */
                    if (!appConfig.mobile) {
                        if ($.fn.zoom) {
                            $(".product__images__item").zoom();
                        } else {
                            $.getScript(appConfig.activeurl + "js/jquery.zoom.min.js", function () {
                                $(".product__images__item").zoom();
                            });
                        }
                    }

                    $(document).on("click", ".product__video", function () {
                        $(this).closest(".product__media").find(".product__gallery__video").click();
                        return false;
                    });
                });
            }
        }
    }();

    WA_THEME.productPage = function () {
        return {
            init: function () {
                var productFormOffset = $(".productForm").offset().top + $(".productForm").outerHeight(),
                    productOffset = $(".product__row").offset().top + $(".product__row").outerHeight();

                $("#productNav").affix({
                    offset: { top: productOffset + 100 }
                });

                $("#productTabs").find("a[data-toggle='tab']").on("shown.bs.tab", function (e) {
                    if($("#productNav").hasClass("affix")) {
                        $("html, body").animate({
                            scrollTop: $(".tab-content").offset().top - 80
                        }, 400);
                    }
                });

                $("#productFormAffix").affix({
                    offset: { top: productFormOffset }
                });

                $(".productAffix__btn").on("click", function () {
                    $("form", ".productForm").submit();
                    return false;
                });

                $(document).on('click','div.wa-captcha .wa-captcha-refresh, div.wa-captcha .wa-captcha-img',function(){
                    var div = $(this).parents('div.wa-captcha'),
                        captcha = div.find('.wa-captcha-img');
                    if(captcha.length) {
                        captcha.attr('src', captcha.attr('src').replace(/\?.*$/,'?rid='+Math.random()));
                        captcha.one('load', function() {
                            div.find('.wa-captcha-input').focus();
                        });
                    };
                    div.find('input').val('');
                    return false;
                });
            }
        };
    }();

    WA_THEME.reviews = function () {
        var reviewTab = $("a[href='#reviews']");
        var loadReviews = function (){
            var e=$("<div class='loading'><i class='icon16 loading'></i> Loading...</div>");
            $(".reviews__wrapper").load(productConfig.producturl + "reviews/ .reviews",{ random:"1" },function(){
                $.getScript(appConfig.activeurl + "js/reviews.js");
            })
        }

        return {
            init: function () {
                if (!appConfig.mobile && productConfig.tab === "tabs" && productConfig.reviewsajax) {
                    // reviews tab active by default
                    if (reviewTab.closest("li").hasClass("active")) {
                        loadReviews();
                    } else {
                        reviewTab.on("show.bs.tab",function(){
                            loadReviews();
                        });
                    }
                };

                if ($("#collapse_reviews").length && productConfig.reviewsajax) {
                    $("#collapse_reviews").on("shown.bs.collapse", function () {
                        loadReviews();
                    });
                }
            }
        };
    }();
}(window.WA_THEME = window.WA_THEME || {}, jQuery));
