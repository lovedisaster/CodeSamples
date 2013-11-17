<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
<div class="footer">
	<script type="text/javascript">

	startPartnerLogosCycle();

	</script>

		<div class="container">
			<div class="ourPartners">


<?php
query_posts('category_name=Our-Partners&posts_per_page=');
while(have_posts()): the_post();
?>


				<div class="op"><?php the_title(); ?></div>
				<div id="ourPartnersFader">
					
					<?php the_content(); ?>
                    
                </div>

<?php
endwhile;
wp_reset_query();
?>



			</div>
			
			<div class="footerNav">
				<div class="branding"><a href="<?php echo get_option('home'); ?>">home</a></div>
				<!--<ul>
					<li><a href="#" class="home">Home</a></li>
					<li><a href="#">Programs &amp; Events</a></li>
					<li><a href="#">Real Stories</a></li>
					<li><a href="#">You</a></li>
					<li><a href="#">News &amp; Media</a></li>
					<li><a href="#">Partners</a></li>
					<li><a href="#">Contact</a></li>
				</ul>-->
				<?php wp_nav_menu( array('menu' => 'footer-nav', 'menu_id' => '',  'menu_class' => '', 'container' => '' )); ?>
			</div>
			
			<div class="legal">
				<?php dynamic_sidebar('copyright'); ?>
			</div>
			
		</div>
			
			<div class="simple_overlay" id="overlay">

			  <div id="contentWrap"></div>

			</div>
			
		<!-- Content end -->
		<script type="text/javascript"> 
		  var _gaq = _gaq || []; 
		  _gaq.push(['_setAccount', 'UA-21003427-1']); 
		  _gaq.push(['_trackPageview']); 

		  (function() { 
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; 
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js'; 
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s); 
		  })(); 
		</script>
        
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.dropkick-1.0.0.js"></script>
		<script type="text/javascript">
			jQuery('select').dropkick({
				"startSpeed": 0,
				"width": false,
				change: function () {
					$(this).change();
				}
			});

		</script>
	
</div>
</div><!--wrapper-->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
