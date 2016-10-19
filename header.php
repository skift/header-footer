<?php
$hasSubNav = !empty($sub_nav);  

$url_paths = array(
    "main"      => "https://www.skift.com",
    "trends"    => "https://trends.skift.com",
    "edu"       => "http://edu.skift.com",
    "forum"     => "http://forum.skift.com",
    "skiftx"    => "http://www.skiftx.com" 
);

if ($_SERVER['HTTP_HOST'] === "localhost") {
    $url_paths = array(
        "main"      => "http://localhost/skift",
        "trends"    => "http://localhost/trends",
        "edu"       => "http://localhost/edu",
        "forum"     => "http://localhost/forum",
        "skiftx"    => "http://localhost/skiftx" 
    );
}
?>

<div id="header-container"<?php if ($hasSubNav) { echo ' class="has-sub-nav"'; } ?>>
    
    <?php if (!$dontShowBannerAd) { ?>
    <div id="top-banner">
        <!-- header banner loads into this -->
    </div><!-- #top-banner -->
    <?php } ?>
    
    <?php
    $header_classes = '';
    
    if ($dontShowBannerAd) {
        $header_classes = 'fixed no-banner';
    }
    
    if ($dontFix) {
        $header_classes = 'no-fix';
    }
    
    if ($dontShowBannerAd && $dontFix) {
        $header_classes = 'no-banner no-fix';
    }
    ?>
    
    <header id="header" class="<?php echo $header_classes; ?>">
        <div id="header-left">
            <div id="logo">
                <a href="<?php echo $url_paths["main"]; ?>">
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
                    <li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/2016"<?php if ($select_tab === "news") { echo ' class="selected"'; } ?>>News<div class="ddCarrot"><i class="fa fa-chevron-down"></i></div></a>
                        <ul class="sub-menu">
                        	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/2016">Latest News</a></li>
                        	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/rooms/hotels/">Hotels</a></li>
                        	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/destinations/">Destinations</a></li>
                        	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/digital/">Digital</a></li>
                        	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/digital/startups/">Startups</a></li>
                        	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/transport/airlines/">Airlines</a></li>
                        	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/travel-services/meetings-and-events/">Meetings</a></li>
                        	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/travel-services/travel-agents/">Travel Agents</a></li>
                        	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/transport/cruises/">Cruises</a></li>
                        	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/travel-services/corporate-travel/">Corporate Travel</a></li>
                        	<li class="all-sectors menu-item"><a href="<?php echo $url_paths["main"]; ?>/all-categories/">All Sectors</a></li>
                        </ul>
                    </li>
                    <li class="menu-item"><a href="<?php echo $url_paths["trends"]; ?>"<?php if ($select_tab === "research") { echo ' class="selected"'; } ?>>Research</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["forum"]; ?>"<?php if ($select_tab === "conferences") { echo ' class="selected"'; } ?>>Conferences</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/newsletters"<?php if ($select_tab === "newsletters") { echo ' class="selected"'; } ?>>Newsletters<div class="ddCarrot"><i class="fa fa-chevron-down"></i></div></a>
                        <ul class="sub-menu">
                        	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/daily/">Daily</a></li>
                        	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/weekly-review/">Weekly</a></li>
                        	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/business-traveler/">Business Traveler</a></li>
                        	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/corporate-travel/">Corporate Travel</a></li>
                        	<li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/meetings/">Meetings</a></li>
                        	<li class="menu-item"><a href="http://chefstech.co/subscribe">Chefs+Tech</a></li>
                        </ul>
                    </li>
<!--                     <li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/advertise"<?php if ($select_tab === "advertising") { echo ' class="selected"'; } ?>>Advertising</a></li> -->
                    <li class="menu-item"><a href="<?php echo $url_paths["edu"]; ?>"<?php if ($select_tab === "education") { echo ' class="selected"'; } ?>>Education</a></li>
                </ul>
            </nav>
            
            <div class="clearfix"></div>
        </div><!-- #header-menus -->
        
        <div id="header-right">
            <?php if ($showSignIn) { ?>
            <div id="header-sign-in">
                <?php
				$whitelistCheck = skp_ip_whitelist();
									
				// var_dump($whitelistCheck);
				if(!empty($whitelistCheck)) {
					echo '<div class="header-text">Welcome, '.$whitelistCheck.'</div>';
				} elseif (!empty($_COOKIE['__ut'])) {
				?>
<!-- 				  <a href="<?php echo home_url(); ?>/my-account">My Account</a> -->
				  <a href="#" onclick="tp.user.logout(function(){document.cookie = '__ut' + '=; Path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;';location.reload();});">Sign Out</a>
    
				<?php
				} else {
				?>
						<a href="#" onclick="tp.user.showLogin({loginSuccess:function(){location.reload();}});">Sign In</a>
				<?php
				}
				?>
            
            </div>
            <?php } else { ?>
            <div id="header-social">
                <div class="social-btn" title="Facebook"><a href="https://www.facebook.com/Skiftnews/" target="_blank"><i class="fa fa-facebook"></i></a></div>
                <div class="social-btn" title="Twitter"><a href="https://twitter.com/skift" target="_blank"><i class="fa fa-twitter"></i></a></div>
                <div class="social-btn" title="LinkedIn"><a href="https://www.linkedin.com/company/2641998" target="_blank"><i class="fa fa-linkedin"></i></a></div>
<!--                 <div class="header-social-btn email" title="Email"><a href="javascript:"><i class="fa fa-envelope"></i></a></div> -->
            </div>
            <?php } ?>
            
            <div id="search">
                <div id="search-container">
                    <div id="search-trigger"><i class="fa fa-search"></i></div>
                    
                    <div id="search-form">
                        <form method="get" action="<?php echo $url_paths["main"]; ?>">
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
                echo '<li class="menu-item"><a href="' . $url_paths["main"] . '">Home</a></li>';
                
                if (!$hasSubNav || $useMainMobileMenu) {
                ?>
                    <li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/2016">News</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["trends"]; ?>">Research</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["forum"]; ?>">Conferences</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["main"]; ?>/newsletters">Newsletters</a></li>
                    <li class="menu-item"><a href="<?php echo $url_paths["edu"]; ?>">Education</a></li>
                <?
                } else {
                    wp_nav_menu(array(
                        'theme_location' => $sub_nav,
                        'container' => false,
                        'items_wrap' => '%3$s'
                    ));
                
                    if ($showSignIn) {
        									
        				// var_dump($whitelistCheck);
        				if (!empty($_COOKIE['__ut'])) {
        				?>
                            <li class="menu-item"><a href="#" onclick="tp.user.logout(function(){document.cookie = '__ut' + '=; Path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;';location.reload();});">Sign Out</a></li>            
        				<?php
        				} else {
        				?>
						    <li class="menu-item"><a href="#" onclick="tp.user.showLogin({loginSuccess:function(){location.reload();}});">Sign In</a></li>
                        <?php
                        }
    				}
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