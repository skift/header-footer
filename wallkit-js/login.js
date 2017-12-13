$(function() {

    if ($("#header-sign-in-with-popover").length) {

        // Header sign in popover

        if (!cookiesEnabled()) {
            addCookieWarning(".login-form .error-text");
        }

        var clearLoginState = function() {
            var $form = $("#header-sign-in-with-popover");
            var bannerText = $form.find(".error-text:not(.stay)");

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
            if ($(".shopping-cart").hasClass("isOpen")) {
                $(".shopping-cart").removeClass("isOpen");
            }

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

        $("#header-sign-in-with-popover .overlay").click(function() {
            $(".sign-in, .shopping-cart").removeClass("isOpen");
            clearLoginState();
        });

        $(".sign-in").click(function(e) {
           e.stopPropagation();
        });

        $(".has-floating-label").on("change keyup blur input", function() {
            if ($(this).val() !== "") {
                $(this).parent().addClass("has-text");
            } else {
                $(this).parent().removeClass("has-text");
            }
        });

    }

    $(".login-btn").click(function(e) {
        var $form = $(this).closest(".login-form");

        var goodToGo = true;

        $form.find("input").each(function() {
//                 $(this).parent().removeClass("has-error");

            if ($(this).val() === "") {
                goodToGo = false;

//                     $(this).parent().addClass("has-error");
            }
        });

        var shakeLen = 80;
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

        if (goodToGo) {
            $(this).html('<i class="fa fa-cog fa-spin"></i> Sign In');

            $form.find("input,button").attr("disabled", true);

            var loginData = {
                login_email: $form.find(".username-field").val(),
                login_password: $form.find(".password-field").val()
            };

            $.ajax({
                url: mySkiftAjaxPath + "login.php",
                method: "POST",
                dataType: "json",
                data: loginData,
                xhrFields: {
                    withCredentials: true
                },
                error: function(reason) {
                    $form.find("button").html("Sign In");
                    $form.find("input,button").attr("disabled", false);

                    showBannerMessage("An uexpected error occured.", $form)
                },
                success: function(response) {

                    $form.find("button").html("Sign In");
                    $form.find("input,button").attr("disabled", false);

                    if (response.success) {
                        showBannerMessage("You are now logged in", $form, function() {
                            var redirect = $form.find(".login-redirect").val();

                            if (!redirect || redirect === "") {

                                if ($form.hasClass("reload")) {
                                    var path = location.pathname;

                                    if (path.indexOf("/login") > -1 || path.indexOf("/create-account") > -1) {
                                        location.href = mySkiftPath;
                                    } else {
                                        location.reload();
                                    }
                                } else {
                                    location.href = mySkiftPath;
                                }
                            } else {
                                location.href = redirect;
                            }
                        }, true);
                    } else {
                        showBannerMessage(response.errorMessage, $form)
                        shake($form,1);
                    }
                }
            });

        } else {
            showBannerMessage("Please enter both your email address and password.", $form)
        }


        e.preventDefault();
        return false;
    });

});