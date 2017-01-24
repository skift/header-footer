var hideBannerTimer;

function setBannerFadeoutTimer(bannerText) {
    hideBannerTimer = setTimeout(function() {
        bannerText.fadeOut(function() {
            $(this).removeClass("show");
        });
    }, 6000);
}

if ($(".error-text").is(":visible")) {
    setBannerFadeoutTimer($(".error-text"));
}

function showBannerMessage(message, $form, callback, success) {
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
}

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
        
    }
    
    
    //BILLING PAGE
    
    var jqBillingForm = $('#billing-form');
    
    if (jqBillingForm.length) {
        var billingForm = document.querySelector('#billing-form');
        var submit = document.querySelector('#billing-form button');
        
        braintree.client.create({
            authorization: authorization
        }, function (clientErr, clientInstance) {
            if (clientErr) {
                // TODO: Handle error in client creation
                showBannerMessage("An unexpected error occured",jqBillingForm);
                console.error("Client error", clientErr);
                return;
            }
        
            braintree.hostedFields.create({
                client: clientInstance,
                styles: {
                    'input': {
                        'font-size': '14px',
                    }
                },
                fields: {
                    number: {
                        selector: '#card-number',
                        placeholder: '4111 1111 1111 1111'
                    },
                    cvv: {
                        selector: '#cvv',
                        placeholder: '123'
                    },
                    expirationDate: {
                        selector: '#expiration-date',
                        placeholder: '10/2019'
                    }
                }
            }, function (hostedFieldsErr, hostedFieldsInstance) {
                if (hostedFieldsErr) {
                    // TODO: Handle error in Hosted Fields creation
                    showBannerMessage("An unexpected error occured",jqBillingForm);

                    console.error("Hosted Fields error", hostedFieldsErr);
                    return;
                }
        
                submit.removeAttribute('disabled');
                
                
                hostedFieldsInstance.on('validityChange', function(event) {
                    var field = event.fields[event.emittedBy];
                    
                    if (field.isValid) {
                        if (event.emittedBy === 'expirationMonth' || event.emittedBy === 'expirationYear') {
                            if (!event.fields.expirationMonth.isValid || !event.fields.expirationYear.isValid) {
                                return;
                            }
                        } else if (event.emittedBy === 'number') {
                            $('#card-number').next('span').text('');
                        }
                        
                        // Apply styling for a valid field
                        $(field.container).parents('.form-group').addClass('has-success');
                    } else if (field.isPotentiallyValid) {
                        // Remove styling  from potentially valid fields
                        $(field.container).parents('.form-group').removeClass('has-warning');
                        $(field.container).parents('.form-group').removeClass('has-success');
                        
                        if (event.emittedBy === 'number') {
                            $('#card-number').next('span').text('');
                        }
                    } else {
                        // Add styling to invalid fields
                        $(field.container).parents('.form-group').addClass('has-warning');
                        // Add helper text for an invalid card number
                        if (event.emittedBy === 'number') {
                            $('#card-number').next('span').text('Looks like this card number has an error.');
                        }
                    }
                });
                    
                hostedFieldsInstance.on('cardTypeChange', function (event) {
                    // Handle a field's change, such as a change in validity or credit card type
                    if (event.cards.length === 1) {
                        $('#card-type').text(event.cards[0].niceType);
                    } else {
                        $('#card-type').text('Card');
                    }
                });
        
                billingForm.addEventListener('submit', function (event) {
                    event.preventDefault();
                    
                    jqBillingForm.find(".submit-btn").html('<i class="fa fa-cog fa-spin"></i> Continue');
                    jqBillingForm.find("input,button").attr("disabled", true);
        
                    hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
                        jqBillingForm.find(".submit-btn").html('Continue');
                        jqBillingForm.find("input,button").attr("disabled", false);
                        
                        if (tokenizeErr) {
                            var message = "An unexpected error occured";
                            
                            if (tokenizeErr.code === "HOSTED_FIELDS_FIELDS_EMPTY") {
                                message = "Please complete all fields";
                            }
                            
                            // TODO: Handle error in Hosted Fields tokenization
                            showBannerMessage(message,jqBillingForm);

                            console.error("tokenize error", tokenizeErr);
                            return;
                        }
                
                        console.log("tokenize payload", payload);
                        
                        showBannerMessage("Token created successfully!", jqBillingForm, function() {}, true);
        
                        // Put `payload.nonce` into the `payment-method-nonce` input, and then
                        // submit the form. Alternatively, you could send the nonce to your server
                        // with AJAX.
                        
                        var nonce = payload.nonce;
                        
                        // TODO: send nonce to server
                    });
                }, false);
            });
        });
    }
    
});
