<?php session_start();?>
<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>


<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<!--<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />-->


<!-- saved from url=(0036)http://medibankcf.com.au/index.html -->
<html class="ie9 no-js cufon-active cufon-ready" lang="en" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-AU"><!--<![endif]--><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
		<link rel="icon" href="http://medibankcf.com.au/favicon.ico">
		<link rel="SHORTCUT ICON" href="http://medibankcf.com.au/favicon.ico">
		<link rel="schema.DC" href="http://purl.org/dc/elements/1.1/">
		<link href="<?php bloginfo('stylesheet_directory'); ?>/css/reset.css" rel="stylesheet" type="text/css" media="screen">
		<link href="<?php bloginfo('stylesheet_directory'); ?>/css/screen.css" rel="stylesheet" type="text/css" media="screen">
		<link href="<?php bloginfo('stylesheet_directory'); ?>/css/print.css" rel="stylesheet" type="text/css" media="print">
        <link href="<?php bloginfo('stylesheet_directory'); ?>/css/new.css" rel="stylesheet" type="text/css">
        <link href="<?php bloginfo('stylesheet_directory'); ?>/css/wp_style.css" rel="stylesheet" type="text/css">
		<link href="<?php bloginfo('stylesheet_directory'); ?>/css/dropkick.css" rel="stylesheet" type="text/css">
		
		<!--[if IE 6]><link href="<?php bloginfo('stylesheet_directory'); ?>/css/ie6.css" rel="stylesheet" type="text/css" /><![endif]-->
		<!--[if IE 7]><link href="<?php bloginfo('stylesheet_directory'); ?>/css/ie7.css" rel="stylesheet" type="text/css" /><![endif]-->

		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/vj-global.js"></script>

		<!--[if IE 6]>
			<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/ie7.js"></script>
		
		<![endif]--> 
		<!--[if lte IE 10]>
			<style type="text/css">
			.header { height: 117px; }
			#cboxLoadedContent{margin-bottom:30px;}
			</style>
		<![endif]-->

		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-1.7.1.min.js"></script>


		<!-- remember to condense javascript plugins on deployment! -->
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/cufon-yui-1.09.js"></script>		
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/swfobject.js"></script>		
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/fonts.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/dinot.font.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/BlackJack_400.font.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/Bree_Rg_400.font.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/faqAccordian.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.colorbox.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/bselector.js"></script>
		
		
        
         <!-- CUSTOM TWITTER FEED   -->     
        <script src="<?php bloginfo('template_url'); ?>/js/tweet.js"></script>
       <!--<script type="text/javascript" src="http://cloud.github.com/downloads/malsup/cycle/jquery.cycle.all.latest.js"></script>-->
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.cycle.all.latest.js"></script>
        <!-- Pagination for gallery   --> 
         <script src="<?php bloginfo('template_url'); ?>/js/pagination.js" type="text/javascript"></script>
         
         <!-- Colorbox -->
        
        
		<!-- ALL jQuery Tools. No jQuery library -->
		<script src="<?php bloginfo('template_url'); ?>/js/jquery.tools.min.js"></script>
		<script type="text/javascript">
		//Called @ Body onLoad	
		function startSlideshow(){	
			$('.loading').remove();
			$('#medibankFeed').cycle({
                fx: 'fade',
				timeout:  6000,
				next:   '.next', 
    			prev:   '.prev'
            });
		};

		function startPartnerLogosCycle(){	
			$('#ourPartnersFader').cycle({
                fx: 'fade',
				timeout:  6000,
				next:   '.next', 
    			prev:   '.prev'
	          });
		};
		// Validate Email Address
			// Returns true if valid
			function ValidateEmailAddress(email) {
				var reg = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i;
				return reg.test(email);
			}
			
			$(document).ready( function() {
				medibank.pages.homepage();	
				//$("a[rel='colorbox']").colorbox({slideshow:true, slideshowSpeed:5000, innerHeight:"53%", transition: "fade"});
				$("a[rel='colorbox']").colorbox({slideshow:true, slideshowSpeed:5000});
					//$(".ticker").fadeIn('slow');
					var newsletterInput = $("#getNewsletter");
					var newsletterSend = $("#btnNewsletter");
						
					var emailString = "Email address";

					newsletterInput.focus(function() {
						if (newsletterInput.val() == emailString) {
							newsletterInput.val('');
						}
					});

					newsletterInput.blur(function() {
						if (newsletterInput.val() == "") {
							newsletterInput.val(emailString);
						}

						if (newsletterInput.val() == emailString) {

						}
					});
					
					// Send Newsletter Click Event
					newsletterSend.click(function(e) {
						e.preventDefault();
						// Get the email address
						var email = newsletterInput.val();
						
						// Validate and send to email handler
						if(email !== '' && ValidateEmailAddress(email)) {			
							newsletterInput.css({"border":"1px solid #DEDEDE"});
							$.ajax({
								type: 'POST',
								url: 'services/email.aspx?email=' + email,
								data: {},
								success: function(response) {
									// we are not expecting a result, but clear out the email field anyway
									newsletterInput.val('');
									$('.newsletterReg').children().remove();
									$('.newsletterReg').html('<p>Thanks. You have been added to our newsletter list</p>');
								}
							});
						}
						else {
							// Either empty or invalid, show red border for user
							newsletterInput.css({"border":"1px solid red"});
						}
					});
				$(".relatedEvents li:even").addClass("even");
				$(".upcomingEvents li:even").addClass("even");
				hideShowFAQ();
				 $('.activateOverlay').overlay();
					$('.activateOverlay').click(function(e) {
						e.preventDefault();
						var image = new Image();
						image.src = $(this).attr('href');
						$("#contentWrap").html(image);
					});
					$("ul.tabs").tabs("div.panes > div.paneTab");
					$(".photoView").scrollable();
			});
				function bannerColourChange(theColor){
						var changeHex = theColor;
						
						$(".mainNav ul li a.home").css("background-color", theColor);
						}
					  
						/*$(document).bind('cbox_complete', function(){
  if($('#cboxTitle').height() > 20){
    $("#cboxTitle").hide();
    $("<div>"+$("#cboxTitle").html()+"</div>").css({color: $("#cboxTitle").css('color')}).insertAfter(".cboxPhoto");
    $.fn.colorbox.resize();
  }
  });*/
  
					  $(document).bind('cbox_complete', function(){
						if($('#cboxTitle').width() > 300){
							$("#cboxTitle").hide();
							$("<div class='newTitle'>"+$("#cboxTitle").html()+"</div>").css({color: $("#cboxTitle").css('color')}).insertAfter(".cboxPhoto");
							$.fn.colorbox.resize();
							//console.log("resized");
						}
					  });
					  		</script>
		<!--[if IE 6]>
			
			
			<script src="<?php bloginfo('template_url'); ?>/js/DD_belatedPNG.js"></script>
			<script>
			  /* EXAMPLE */
			  DD_belatedPNG.fix('*.*');
			  
			  /* string argument can be any CSS selector */
			  /* .png_bg example is unnecessary */
			  /* change it to what suits you! */
			</script>
			<![endif]--> 
		<script type="text/javascript">
			var flashVars = {
				xmlPath: "data.xml?v2"
			};
			
			var params = {
				allowScriptAccess: "always",
				allowFullScreen: "true",
				menu: "false",
				scale: "noscale",
				base: "<?php bloginfo('template_url'); ?>/flash/"
			};
			
			var attributes = {
				id: "flashObject",	
				name: "flashObject"
			};
			
			// Version numbers:
			//	Flash 8: 8.0.42.0
			//	Flash 9: 9.0.260.0
			// 	Flash 10: 10.0.45.2
			swfobject.embedSWF("<?php bloginfo('template_url'); ?>/flash/banner.swf?v2", "flash", "100%", "100%", "9.0.28", false, flashVars, params, attributes);
		</script>


<!--<script type="text/javascript">
$(document).ready(function() {
   $(".upcomingEvents li:last").addClass("no-color");
 });  
</script>-->


<!--<script type="text/javascript">
$(document).ready(function() {
  $(".photoView div a").attr('rel','colorbox');
 });  
</script>

<script type="text/javascript">
$(document).ready(function() {
   $(".photoView div a").addClass("cboxElement");
 });  
</script>-->

<script type="text/javascript">
$(document).ready( function(){
		var $children = $('.photoView .items a'); 
	    for(var i = 0, l = $children.length; i < l; i += 3) { 
		$children.slice(i, i+3).wrapAll('<div></div>'); 
	} 
});
</script>

<script type="text/javascript">
$(document).ready(function() {
   $(".mainNav ul li.current-menu-item a:first").addClass("home");
 });  
</script>

<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "04b50d33-0511-4f93-a190-a40b7e2ffb43"});</script>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comme뮰઒ form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

	<body onload="startSlideshow();" class="scriptable">
	<div class="wrapper">
		<script type="text/javascript">
			document.body.className += "scriptable";
		</script>
		
		
		<!-- needs to be positioned off the page - not "hidden", as in visibility: hidden -->
		<ul class="skipLinks" id="top">
			<li><a href="#">Skip to main navigation</a></li>
			<li><a href="#">Skip to site search</a></li>
			<li><a href="#">Skip to content</a></li>
			<li><a href="#">Skip to secondary navigation</a></li>
		</ul>

		<!-- Content start -->
		
		<div class="header">
			
			<div class="container">
			
				<div class="branding"><a href="<?php echo get_option('home'); ?>">Medibak Community Fund</a></div>
				
				<div class="mcfInfo">
					<!--<ul>
						<li><a href="http://www.medibank.com.au"><img src="<?php bloginfo('template_url'); ?>/images/framework/mpl_logo.gif" width="76" height="18" alt="Medibank Private" class="mpl"></a></li>
						<li><a href="http://www.twitter.com/MedibankCF"><img src="http://twitter-badges.s3.amazonaws.com/t_small-c.png" alt="Follow MedibankCF on Twitter" class="twitter"> MCF on Twitter</a></li>
						<li><a href="about.shtml">About MCF</a></li>
						<li class="last"><a href="faq.shtml">FAQ&#39;s</a></li>
					</ul>-->
					<?php wp_nav_menu( array('menu' => 'top', 'menu_id' => '',  'menu_class' => '', 'container' => '' )); ?>
				</div>
				
				<div class="headerSearchBox">
					<form method="get" class="searchForm" id="searchform" action="<?php bloginfo('home');?>">					
						<input type="text" id="searchBox" value="Keyword search..." name="s" onfocus="if (this.value==&quot;Email address&quot;) this.value=&quot;&quot;;" onblur="if (this.value==&quot;&quot;) this.value=&quot;Email address&quot;;"/>					
						


	
						<input type="image" src="<?php bloginfo('template_directory'); ?>/images/Search-Homepage.png" alt="Go!" />
					</form>				</div>		
				<div id="nav" class="mainNav">
					<!--<ul>
						<li><a href="#" class="home">Home</a></li>
						<li><a href="#">Programs &amp; Events</a></li>
						<li><a href="#">Real Stories</a></li>
						<li><a href="#">Get Involved</a></li>
						<li><a href="#">News &amp; Media</a></li>
						<li><a href="#">Partners</a></li>
						<li><a href="#">Contact</a></li>
					</ul>-->
					<?php wp_nav_menu( array('menu' => 'topnav', 'menu_id' => '',  'menu_class' => '', 'container' => '' )); ?>
				</div>

			</div>
				
		</div>