<script type="text/javascript">

    //Functions to load HubSpot forms asynchronously
    var hubspotLoopInitiated = false;
    var queuedForms = [];
    var hsScriptsLoading = false;

    function queueHubspotForm(form) {
        form.css = form.css || '';
        form.submitButtonClass = form.submitButtonClass || 'btn btn-primary';

        if (!form.redirectUrl) {
            form.inlineMessage = form.inlineMessage || 'Thank you!'
        }

        form.onBeforeFormInit= function(ctx) {
            var prevOnReady = ctx.onFormReady;
            var formContainer = ctx.formContainer;

            ctx.onFormReady = function(form) {
                if (typeof formContainer !== "undefined" && formContainer) {
                    form.parent().appendTo(formContainer);
                }

                form.find(".hs-form-field").addClass("form-group");
                form.find(".hs-form-checkbox, .hs-form-booleancheckbox").addClass("checkbox-control");
                form.find(".hs-form-radio").addClass("radio-control");
                form.find("label").addClass("control-label");
                form.find(".hs-input").addClass("form-control");

                form.find(".inputs-list").css({
                    listStyle: 'none',
                    padding: 0,
                    margin: 0
                });

                form.find(".hs-field-desc").css({
                    fontSize: '12px',
                    paddingLeft: '12px',
                    borderBottom: 'none',
                    marginBottom: '10px'
                });

                form.find("li.hs-form-radio span, li.hs-form-booleancheckbox span, .hs-form-checkbox-display span").addClass("control-label");
                form.find("li.hs-form-radio label, li.hs-form-booleancheckbox label, .hs-form-checkbox-display").removeClass("control-label");


                form.find(".hs-form-checkbox:not(li)").each(function() {
                    $(this).find(".form-control").prependTo($(this));
                });

                if (!form.hasClass("noPlaceholders")) {
                    form.find(".hs-input").each(function() {
                        if ($(this).attr("placeholder") === "") {
                            var fieldName = $(this).closest(".hs-form-field").find("label span:first").text();
                            $(this).attr("placeholder",fieldName);
                        }
                    });
                }

                form.find(".hs-input").blur(function() {
                    var $this = $(this);
                    setTimeout(function() {
                        if ($this.hasClass("error")) {
                            $this.attr("class","form-control error").closest(".hs-form-field").addClass("has-error").find(".hs-error-msgs").show();
                        } else {
                            $this.closest(".hs-form-field").removeClass("has-error");
                        }
                    },100);
                }).keyup(function() {
                    var $this = $(this);
                    if (!$this.hasClass("error")) {
                        $this.closest(".hs-form-field").removeClass("has-error").find(".hs-error-msgs").hide();
                    }
                });

                if (form.hasClass("hideLabels")) {
                    form.find("label").remove();
                }

                if (typeof prevOnReady === "function") {
                    prevOnReady(form);
                }

            };

            return ctx;
        };

        queuedForms.push(form);

        fireHubspotForms(true);
    }

    function fireHubspotForms(fromQueue) {
        if (!hsScriptsLoading) {
            hsScriptsLoading = true;

            var hsScripts = document.createElement('script');
            hsScripts.setAttribute('src','//js.hsforms.net/forms/v2.js');
            document.head.appendChild(hsScripts);
        }

        if (typeof hbspt !== "undefined" && hbspt) {

            //hubspot library is loaded, load the forms
            for (var i = queuedForms.length-1; i >= 0; i--) {
                hbspt.forms.create(queuedForms[i]); // create the form
                queuedForms.pop(); // remove it from the queue
            }

        } else {

            if (!hubspotLoopInitiated || !fromQueue) {
                hubspotLoopInitiated = true;
                setTimeout(fireHubspotForms, 250);
            }

        }
    }
</script>