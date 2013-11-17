<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

	<div id="container">
			<div id="content" role="main">
			<div class="wrapper">
	<div class="content">
	<div class="container">
		<?php if ( have_posts() ): ?>	
	<h1 class="page-title">
	Search Results				
	</h1>
	<p>
	<?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1&cat=31,26,6"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count;?>
				<?php printf( __( 'You searched for: %s with %s results.' , 'MedibankCF' ), '<span><b>' . get_search_query() . '</b></span>','<span><b>'.$count.'</b></span>' ); ?>
				<?php wp_reset_query();?>
				</p>
					<?php
					/* Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called loop-search.php and that will be used instead.
					 */					
					 get_template_part( 'loop', 'search' );					
					?>

				<?php else : ?>
						<div id="post-0" class="post no-results not-found">
						<h2 class="entry-title"><?php _e( 'Nothing Found', 'MedibankCF' ); ?></h2>
							<div class="entry-content">
							<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'MedibankCF' ); ?></p>
							</div><!-- .entry-content -->
					</div><!-- #post-0 -->
				<?php endif; ?>
				</div>
					</div>
					</div>
			</div><!-- #content -->
		</div><!-- #container -->


<?php get_footer(); ?>
