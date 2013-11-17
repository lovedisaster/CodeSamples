<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
require_once('wp-config.php');
get_header(); ?>


<div class="content">
  <div class="container">
    <div class="section clearfix">
      <div class="primaryContent news">
		<?php 
		if($_SESSION['ArchiveType'] == ARCHIVE_INDICATOR_STOIRES):?>
			<h1>Real Story</h1>
		<?php else:?>
			<h1>News &amp; Media</h1>
		<?php endif;?>
        
        <div class="pastNews">
        <!--loop1 -->
        <?php
			if ( have_posts() )
				the_post();
		/*
        echo(get_the_ID());
        the_content();
        var_dump(get_the_category(get_the_ID()));
        die();*/

		?>
			<h2><?php single_month_title('&nbsp;'); ?></h2>
		
        <?php
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();
				
				
				/*query_posts(array(
				  'cat' => 4,
				  'posts_per_page' => 10,
				  'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1
				));*/
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				if($_SESSION['ArchiveType'] == ARCHIVE_INDICATOR_STOIRES)
        			query_posts($query_string . "&cat=31,26,6&posts_per_page=999&paged=$paged");
				else
        			query_posts($query_string . "&cat=4&posts_per_page=999&paged=$paged");
				
				/* Run the loop for the archives page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-archive.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'archive' );
			?>
        </div>
      </div>
      <!-- end communityContentContainer -->
	  
	
	
      <?php if($_SESSION['ArchiveType'] == ARCHIVE_INDICATOR_STOIRES):?>
	<div class="secondaryContent">
	<div class="relatedLinks">
		  <?php get_sidebar('AllBlogArchive'); ?>
		  </div>
		</div>
       <?php else:?>
		<div class="secondaryContent">
        <div class="resources">
          <?php query_posts('category_name=news-media-resources&showposts=1');while(have_posts()): the_post();?>
          <h2> Resources </h2>
          <?php endwhile; wp_reset_query(); ?>
          <?php query_posts('category_name=news-media-resources&showposts=3');while(have_posts()): the_post();?>
          <?php the_content(); ?>
          <?php endwhile; wp_reset_query(); ?>
        </div>
        <div class="resources">
          <?php query_posts('category_name=mcf-newsletters&showposts=1');while(have_posts()): the_post();?>
          <h2> MCF Newsletters </h2>
          <?php endwhile; wp_reset_query(); ?>
          <?php query_posts('category_name=mcf-newsletters&showposts=3');while(have_posts()): the_post();?>
          <?php the_content(); ?>
          <?php endwhile; wp_reset_query(); ?>
        </div>
        <div class="relatedLinks">
          <?php get_sidebar('newsmedia'); ?>
		</div>
		</div>
	<?php endif;?>

	
      

	
    </div>
  </div>
</div>
<?php get_footer(); ?>
