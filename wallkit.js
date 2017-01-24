$(function() {
    if ($("#header-sign-in-with-popover").length) {

        // Header sign in popover

        var clearLoginState = function() {
            var $form = $("#header-sign-in-with-popover");
            var bannerText = $form.find(".error-text");

            bannerText.fadeOut(function() {
                $form.find(".form-group").removeClass("has-error");
            });
        };

        $("body").keyup(function(e) {
           if (e.keyCode === 27 && $(".sign-in").hasClass("isOpen")) {
               $(".sign-in").removeClass("isOpen");
               clearLoginState();
           }
        });

        $(".sign-in-btn").click(function() {
            $(".sign-in").toggleClass("isOpen");
            clearLoginState();

            $("#sign-in-popover input").each(function() {
                if ($(this).val() !== "") {
                    $(this).parent().addClass("has-text");
                }
            });
        });

        $("#my-account-menu li:first-child a").hover(function() {
           $("#sign-in-popover").addClass("green-arrow");
        }, function() {
           $("#sign-in-popover").removeClass("green-arrow");
        });

        $("#header-sign-in-with-popover #overlay").click(function() {
            $(".sign-in").removeClass("isOpen");
            clearLoginState();
        });

        $(".sign-in").click(function(e) {
           e.stopPropagation();
        });

        var hideBannerTimer;

        var setBannerFadeoutTimer = function(bannerText) {
            hideBannerTimer = setTimeout(function() {
                bannerText.fadeOut(function() {
                    $(this).removeClass("show");
                });
            }, 6000);
        };

        if ($(".error-text").is(":visible")) {
            setBannerFadeoutTimer($(".error-text"));
        }

        var showBannerMessage = function(message, $form, callback, success) {
            clearTimeout(hideBannerTimer);

            var bannerText = $form.find(".error-text");

            bannerText.fadeOut(function() {
                bannerText.text(message).fadeIn(function() {
                    if (typeof callback === "function") {
                        callback();
                    }
                });

                if (success) {
                    bannerText.addClass("success");
                } else {
                    bannerText.removeClass("success");
                }

                setBannerFadeoutTimer(bannerText);
            });
        };

        $(".has-floating-label").keyup(function() {
            if ($(this).val() !== "") {
                $(this).parent().addClass("has-text");
            } else {
                $(this).parent().removeClass("has-text");
            }
        });

        $(".login-btn").click(function(e) {

            var $form = $(this).closest(".login-form");

            console.log("click", $form);
            var goodToGo = true;

            $form.find("input").each(function() {
//                 $(this).parent().removeClass("has-error");

                if ($(this).val() === "") {
                    goodToGo = false;

//                     $(this).parent().addClass("has-error");
                }
            });

            var shakeLen = 65;
            var travelDist = 15;

            var shake = function(c, times) {
                c.css("position","relative");

                c.animate({
                    left: "-"  + travelDist + "px"
                }, shakeLen, function() {
                    c.animate({
                        left: travelDist + "px"
                    }, shakeLen, function() {
                        if (times === 0) {
                            c.animate({
                                left: 0
                            }, shakeLen);
                        } else {
                            shake(c, --times);
                        }
                    });
                });
            };

            //a397868864c1ff5b5271927d2dff4b482e8cb121

            if (goodToGo) {
                $(this).html('<i class="fa fa-cog fa-spin"></i> Sign In');

                $form.find("input,button").attr("disabled", true);

                var loginData = {
                    login_email: $form.find(".username-field").val(),
                    login_password: $form.find(".password-field").val()
                };

                $.post(homeUrl + "/wp-content/themes/products/inc/ajax/wallkit/login_user.php", loginData, function(response) {
                    response = $.parseJSON(response);
                    console.log("response", response);

                    $form.find("button").html("Sign In");
                    $form.find("input,button").attr("disabled", false);

                    if (response.success) {
                        showBannerMessage("You are now logged in", $form, function() {
                            location.href = homeUrl;
                        }, true);
                    } else {
                        showBannerMessage(response.errorMessage, $form)
                    }
                });

            } else {
                showBannerMessage("Please enter both your email address and password.", $form)
            }


            e.preventDefault();
            return false;
        });


        $(".create-account-btn").click(function(e) {

            var $form = $(this).closest(".create-account-form");

            var goodToGo = true;

            $form.find("input.required").each(function() {
//                 $(this).parent().removeClass("has-error");

                if ($(this).val() === "") {
                    goodToGo = false;

                    $(this).parent().addClass("has-error");
                }
            });

            if (goodToGo) {
                $(this).html('<i class="fa fa-cog fa-spin"></i> Create Account');

                $form.find("input,button").attr("disabled", true);

                var accountData = {
                    first_name: $form.find(".first-name-field").val(),
                    last_name: $form.find(".last-name-field").val(),
                    company: $form.find(".company-field").val(),
                    job: $form.find(".position-field").val(),
                    email: $form.find(".email-field").val(),
                    password: $form.find(".password-field").val()
                };

                console.log("data",accountData);

                $.post(homeUrl + "/wp-content/themes/products/inc/ajax/wallkit/create_account.php", accountData, function(response) {
                    response = $.parseJSON(response);

                    $form.find("button").html("Create Account");
                    $form.find("input,button").attr("disabled", false);

                    console.log("response",response);

                    if (response.success) {
                        showBannerMessage("Your account has been created!", $form, function() {
                            location.href = homeUrl;
                        }, true);
                    } else {
                        showBannerMessage(response.errorMessage, $form)
                    }
                });
            } else {
                showBannerMessage("Please correct the fields in red", $form)
            }


            e.preventDefault();
            return false;
        });
    }
});
