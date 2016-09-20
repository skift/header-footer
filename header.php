<?php
$hasSubNav = !empty($sub_nav);  

$skiftHomeUrl = home_url();

?>
<div id="header-container"<?php if ($hasSubNav) { echo ' class="has-sub-nav"'; } ?>>
    
    <?php if (!$dontShowBannerAd) { ?>
    <div id="top-banner">
        <!-- header banner loads into this -->
    </div><!-- #top-banner -->
    <?php } ?>
    
    <header id="header" class="<?php if ($dontShowBannerAd) { echo 'fixed no-banner'; } if ($dontFix) { echo 'no-fix'; } ?>">
        <div id="header-left">
            <div id="logo">
                <a href="<?php echo $skiftHomeUrl; ?>">
                    <img src="<?php bloginfo('template_directory') ?>/header-footer/img/logo.svg" class="svg" alt="Skift Logo" />
                </a>
            </div><!-- #logo -->
                        
            <nav id="primary-nav">
                <?php if ($hasSubNav) { ?>
                    <ul class="sub-menu">
                        <?php 
                        wp_nav_menu(array(
                            'theme_location' => $sub_nav,
                            'container' => false,
                            'items_wrap' => '%3$s'
                        ));
                        ?>
                    </ul>
                <?php } ?>
                <ul id="navigation-menu">
                    <li class="menu-item"><a href="<?php echo $skiftHomeUrl; ?>/2016"<?php if ($select_tab === "news") { echo ' class="selected"'; } ?>>News<div class="ddCarrot"><i class="fa fa-chevron-down"></i></div></a>
                        <ul class="sub-menu">
                        	<li class="menu-item"><a href="<?php echo $skiftHomeUrl; ?>/2016">Latest News</a></li>
                        	<li class="menu-item"><a href="<?php echo $skiftHomeUrl; ?>/rooms/hotels/">Hotels</a></li>
                        	<li class="menu-item"><a href="<?php echo $skiftHomeUrl; ?>/destinations/">Destinations</a></li>
                        	<li class="menu-item"><a href="<?php echo $skiftHomeUrl; ?>/digital/">Digital</a></li>
                        	<li class="menu-item"><a href="<?php echo $skiftHomeUrl; ?>/digital/startups/">Startups</a></li>
                        	<li class="menu-item"><a href="<?php echo $skiftHomeUrl; ?>/transport/airlines/">Airlines</a></li>
                        	<li class="menu-item"><a href="<?php echo $skiftHomeUrl; ?>/travel-services/meetings-conventions/">Meetings</a></li>
                        	<li class="menu-item"><a href="<?php echo $skiftHomeUrl; ?>/travel-services/travel-agents/">Travel Agents</a></li>
                        	<li class="menu-item"><a href="<?php echo $skiftHomeUrl; ?>/transport/cruises/">Cruises</a></li>
                        	<li class="menu-item"><a href="<?php echo $skiftHomeUrl; ?>/travel-services/corporate-travel/">Corporate Travel</a></li>
                        	<li class="all-sectors menu-item"><a href="<?php echo $skiftHomeUrl; ?>/all-categories/">All Sectors</a></li>
                        </ul>
                    </li>
                    <li class="menu-item"><a href="http://trends.skift.com/"<?php if ($select_tab === "research") { echo ' class="selected"'; } ?>>Research</a></li>
                    <li class="menu-item"><a href="http://forum.skift.com/"<?php if ($select_tab === "conferences") { echo ' class="selected"'; } ?>>Conferences</a></li>
                    <li class="menu-item"><a href="<?php echo $skiftHomeUrl; ?>/newsletters"<?php if ($select_tab === "newsletters") { echo ' class="selected"'; } ?>>Newsletters<div class="ddCarrot"><i class="fa fa-chevron-down"></i></div></a>
                        <ul class="sub-menu">
                        	<li class="menu-item"><a href="<?php echo $skiftHomeUrl; ?>/daily/">Daily</a></li>
                        	<li class="menu-item"><a href="<?php echo $skiftHomeUrl; ?>/business-traveler/">Business Traveler</a></li>
                        	<li class="menu-item"><a href="<?php echo $skiftHomeUrl; ?>/corporate-travel/">Corporate Travel</a></li>
                        	<li class="menu-item"><a href="<?php echo $skiftHomeUrl; ?>/meetings/">Meetings</a></li>
                        	<li class="menu-item"><a href="http://chefstech.co/subscribe">Chefs+Tech</a></li>
                        </ul>
                    </li>
<!--                     <li class="menu-item"><a href="<?php echo $skiftHomeUrl; ?>/advertise"<?php if ($select_tab === "advertising") { echo ' class="selected"'; } ?>>Advertising</a></li> -->
                    <li class="menu-item"><a href="https://edu.skift.com/"<?php if ($select_tab === "education") { echo ' class="selected"'; } ?>>Education</a></li>
                </ul>
            </nav>
            
            <div class="clearfix"></div>
        </div><!-- #header-menus -->
        
        <div id="header-right">
            <?php if ($showSignIn) { ?>
            <div id="header-sign-in"><a href="#">Sign In</a></div>
            
            <?php } else { ?>
            <div id="header-social">
                <div class="header-social-btn facebook" title="Facebook"><a href="javascript:"><i class="fa fa-facebook"></i></a></div>
                <div class="header-social-btn twitter" title="Twitter"><a href="javascript:"><i class="fa fa-twitter"></i></a></div>
                <div class="header-social-btn linkedIn" title="LinkedIn"><a href="javascript:"><i class="fa fa-linkedin"></i></a></div>
                <div class="header-social-btn email" title="Email"><a href="javascript:"><i class="fa fa-envelope"></i></a></div>
            </div>
            <?php } ?>
            
            <div id="search">
                <div id="search-container">
                    <div id="search-trigger"><i class="fa fa-search"></i></div>
                    
                    <div id="search-form">
                        <form method="get" action="<?php echo $skiftHomeUrl; ?>">
                            <input type="search" name="s" id="search-box" class="text" />
                            <input type="button" value="&times;" id="search-clear" name="clear" />
                        </form>
                    </div>
                </div>
            </div><!-- #search -->
        </div><!-- #header-right -->
        
        <div class="clearfix"></div>
        
        
        <div id="mobileMenuBtn">
            <div class="top-line"></div>
            <div class="middle">
                <div class="middle-line"></div>
                <div class="middle-dot"></div>
            </div>
            <div class="bottom-line"></div>
        </div>
        
        <nav id="mobile-menu">
            <ul>
                <?php
                echo '<li class="menu-item"><a href="' . $skiftHomeUrl . '">Home</a></li>';
                
                if (!$hasSubNav || $useMainMobileMenu) {
                ?>
                    <li class="menu-item"><a href="<?php echo $skiftHomeUrl; ?>/2016">News</a></li>
                    <li class="menu-item"><a href="http://trends.skift.com/">Research</a></li>
                    <li class="menu-item"><a href="http://forum.skift.com/">Conferences</a></li>
                    <li class="menu-item"><a href="<?php echo $skiftHomeUrl; ?>/newsletters">Newsletters</a></li>
                    <li class="menu-item"><a href="https://edu.skift.com/">Education</a></li>
                <?
                } else {
                    wp_nav_menu(array(
                        'theme_location' => $sub_nav,
                        'container' => false,
                        'items_wrap' => '%3$s'
                    ));
                } ?>
            </ul>
        </nav>
    </header>
    
	<div id="header-pad"></div>
</div>

<script type="text/javascript">
  
  //Functions to load HubSpot forms asynchronously
  var hubspotLoopInitiated = false;
  var queuedForms = [];
  
  function queueHubspotForm(form) {
    form.css = form.css || '';
    form.submitButtonClass = form.submitButtonClass || 'btn btn-primary';
    form.inlineMessage = form.inlineMessage || 'Thank you!'
    
    form.onBeforeFormInit= function(ctx) {
      var prevOnReady = ctx.onFormReady;
      var formContainer = ctx.formContainer;
      
      ctx.onFormReady = function(form) {
        if (typeof formContainer !== "undefined" && formContainer) {
            form.parent().appendTo(formContainer);
        }
        
        form.find(".hs-form-field").addClass("form-group");
        form.find(".hs-form-checkbox").addClass("checkbox-control");
        form.find(".hs-form-radio").addClass("radio-control");
        form.find("label").addClass("control-label");
        form.find(".hs-input").addClass("form-control");
        
        form.find(".hs-form-checkbox").each(function() {
            $(this).find(".form-control").prependTo($(this));
        });
        
        if (!form.hasClass("noPlaceholders")) {
          form.find(".hs-input").each(function() {
            var fieldName = $(this).closest(".hs-form-field").find("label span:first").text();
            $(this).attr("placeholder",fieldName); 
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