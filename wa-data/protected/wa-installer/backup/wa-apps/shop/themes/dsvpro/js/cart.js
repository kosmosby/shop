(function (WA_THEME, $) {
    "use strict";
    function library(module) {
        $(function () {
            if (module.init) {
                module.init();
            }
        });
        return module;
    }

    WA_THEME.cart = library(function () {
        var $wrapper = $(".cart");

        var cartItem = function ($item) {
            return $item.closest(".cartItem");
        };

        return {
            init: function () {
                $(window).on("updateCart", function (e, data) {
                    var $discount = $(".js-cart-discount");

                    if (data.discount_numeric) {
                        $discount.closest("div").removeClass("hidden");
                    }
                    $discount.html("&minus; " + data.discount);

                    if (data.add_affiliate_bonus) {
                        $(".affiliate").show().html(data.add_affiliate_bonus);
                    } else {
                        $(".affiliate").hide();
                    }

                    if (data.affiliate_discount) {
                        $(".affiliate-discount-available").html(data.affiliate_discount);
                        if ($(".affiliate-discount").data("use")) {
                            $(".affiliate-discount").html("&minus; " + data.affiliate_discount);
                        }
                    }

                    if (typeof $.flexdiscountFrontend !== 'undefined') {
                        $.flexdiscountFrontend.cartChange();
                    }
                });

                /* удаление */
                $wrapper.on("click", ".cartItem__delete", function () {
                    var $item = cartItem($(this));
                    $.post("delete/", {html: 1, id: $item.data("id")}, function (response) {
                        if (response.data.count === 0) {
                            location.reload();
                        }
                        $item.fadeOut();
                        $(window).trigger("updateCart", response.data);
                    }, "json");
                    return false;
                });

                /* изменение количества */
                $wrapper.on("change", ".qty__input", function () {
                    var that = $(this),
                        $item = cartItem($(this));

                    $.post("save/", {html: 1, id: $item.data("id"), quantity: that.val()}, function (response) {
                        $(".cartItem__total", $item).html(response.data.item_total);
                        if (response.data.q) {
                            that.val(response.data.q);
                        }
                        if (response.data.error) {
                            alert(response.data.error);
                        } else {
                            that.closest(".qty").removeClass("has-error");
                        }
                        $(window).trigger("updateCart", response.data);
                    }, "json");
                    return false;
                });

                $(".cartOrder-affix").affix({
                    offset: {
                        top: $(".cartOrder").offset().top + $(".cartOrder__block").outerHeight()
                    }
                }).on("affix.bs.affix", function () {
                    $(this).css({
                        "top": $(".header").outerHeight() + 20
                    });
                });

                $("#cancel-affiliate").click(function () {
                    $(this).closest("form").append("<input type='hidden' name='use_affiliate' value='0'>").submit();
                    return false;
                });

                $(".cartItem__services input:checkbox").change(function () {
                    var obj = $('select[name="service_variant[' + $(this).closest('div.row').data('id') + '][' + $(this).val() + ']"]');
                    if (obj.length) {
                        if ($(this).is(':checked')) {
                            obj.removeAttr('disabled');
                        } else {
                            obj.attr('disabled', 'disabled');
                        }
                    }

                    var div = $(this).closest('div');
                    var row = $(this).closest('div.row');
                    if ($(this).is(':checked')) {
                        var parent_id = row.data('id')
                        var data = {html: 1, parent_id: parent_id, service_id: $(this).val()};
                        var $variants = $('[name="service_variant[' + parent_id + '][' + $(this).val() + ']"]');
                        if ($variants.length) {
                            data['service_variant_id'] = $variants.val();
                        }
                        $.post('add/', data, function(response) {
                            div.data('id', response.data.id);
                            row.find('.cartItem__total').html(response.data.item_total);
                            $(window).trigger("updateCart", response.data);
                        }, "json");
                    } else {
                        $.post('delete/', {html: 1, id: div.data('id')}, function (response) {
                            div.data('id', null);
                            row.find('.cartItem__total').html(response.data.item_total);
                            $(window).trigger("updateCart", response.data);
                        }, "json");
                    }
                });

                $(".cartItem__services select").change(function () {
                    var row = $(this).closest('div.row');
                    $.post('save/', {html: 1, id: $(this).closest('div').data('id'), 'service_variant_id': $(this).val()}, function (response) {
                        row.find('.cartItem__total').html(response.data.item_total);
                        $(window).trigger("updateCart", response.data);
                    }, "json");
                });
            }
        };
    }());
}(window.WA_THEME = window.WA_THEME || {}, jQuery));