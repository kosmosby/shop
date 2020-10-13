(function (WA_THEME, $) {
    "use strict";
    WA_THEME.checkout = function () {
        var steps = $("#checkout .panel"),
            $config = $("#config");

        function activeStep(step) {
            steps.removeClass("active next done");
            step.addClass("active").next(".panel").addClass("next");
            step.prevAll(".panel").addClass("done");
        }

        function checkoutStep(step_id) {
            var checkoutUrl = $config.data("checkout") || window.location;
            $.get(checkoutUrl + step_id + "/", function (response) {
                var current = $(".panel.active"),
                    current_step_id = current.find(".checkout-content").data("step-id");

                if (current_step_id !== step_id) {
                    $(".panel.step-" + current_step_id + " .panel-collapse").collapse("hide");
                }

                activeStep($(".panel.step-" + step_id));
                $(".panel.step-" + step_id + " .panel-collapse").collapse("show");
                $(".panel.step-" + step_id + " .checkout-content").replaceWith(response);

                if ($(".panel.step-" + step_id + " .auth").length) {
                    $("input[name='user_type']").change();
                }
            });
        }

        return {
            init: function () {
                $(".panel-title").on("click", "a", function (event) {
                    event.preventDefault();
                    var step = $(this).closest(".panel"),
                        step_id = step.find(".checkout-content").data("step-id");

                    if (step.hasClass("active") || step.hasClass("next")) {
                        return false;
                    }
                    if (step.hasClass("done")) {
                        checkoutStep(step_id);
                        return true;
                    }
                    return false;
                });

                $(".checkout").on("submit", "form.checkout-form", function () {
                    var f = $(this),
                        step = f.find(".checkout-content").data("step-id");

                    if (step === "payment" || step === "shipping") {
                        if (!f.find("input[name='" + step + "_id']:checked").not(":disabled").length) {
                            if (!f.find("em.errormsg").length) {
                                $("<em class='errormsg'>" + (step === "payment" ? "[`Please select payment option`]" : "[`Please select shipping option`]") + "</em>").insertAfter(f.find("input:submit:last"));
                            }
                            return false;
                        } else {
                            f.find("em.errormsg").remove();
                        }
                    }

                    if (f.hasClass("last") || ($("#checkoutAuth").length && !$("#checkoutAuth input:submit").attr("disabled"))) {
                        $("<span class='loading'> <i class='icon16 loading'></i></span>").insertAfter(f.find("input:submit:last"));
                        return true;
                    }

                    $.post(f.attr("action") || window.location, f.serialize(), function (response) {
                        var content = $(response);
                        var step_id = content.data("step-id");
                        if (!step_id) {
                            step_id = content.filter(".checkout-content").data("step-id");
                        }
                        var current = $(".panel.active");
                        var current_step_id = current.find(".checkout-content").data("step-id");
                        if (current_step_id != step_id) {
                            $(".panel.step-" + current_step_id + " .panel-collapse").collapse("hide");
                        }
                        activeStep($(".panel.step-" + step_id));
                        $(".panel.step-" + step_id + " .panel-collapse").collapse("show");
                        $(".panel.step-" + step_id + " .checkout-content").replaceWith(content);
                        //$(".panel.step-" + step_id + " a.back").show();
                        $(".panel.step-" + step_id + " input[type=submit]:last").show();
                    }).always(function () {
                        f.find("span.loading").remove();
                        f.find("input:submit:last").removeAttr("disabled");
                    });
                    return false;
                });

                $(".panel-collapse").on("shown.bs.collapse", function () {
                    $(document).scrollTop($(this).closest(".panel").offset().top - 50);
                });
            }
        };
    }();

    WA_THEME.checkout.init();
}(window.WA_THEME = window.WA_THEME || {}, jQuery));