<?php
/**
 * Template Name: News-Media
 *
 */
require_once('wp-config.php');
get_header(); ?>

<div class="content">
  <div class="container">
    <div class="section clearfix">
      <div class="primaryContent news">
        <div class="realStoryHightlights">
          <?php while(have_posts()): the_post();?>
			<?php 
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			  the_post_thumbnail('FULL', array('class' => 'limage'));
			} 
			?>
          <h1>
            <?php the_title(); ?>
          </h1>
          <?php the_content(); ?>
          <?php endwhile; wp_reset_query();?>
	    </div>

      <!--loop1 -->
      <?php $page_num = $paged; if ($pagenum='') $pagenum =1;
		query_posts('cat=4&showposts=1&paged='.$page_num); ?>
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
		  
<div class="newsFeature topnews">
<a name="<?php the_ID(); ?>" id="<?php the_ID(); ?>" class="toHide"></a>
			<?php 
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				the_post_thumbnail('FULL', array('class' => 'limagemediafeatured'));
			} 
			?>
  <div class="wrap topnewscontent">
    <p class="date"><?php the_time('j F Y') ?></p>
		  <h2 <?php post_class(); ?>><?php the_title(); ?></h2>
    <p><?php the_excerpt_rss(); ?> </p>
   </div>

<div class="wrap open topreadmore"><a style="display: none; margin-top:10px;" class="readMore">Read more</a></div>
  <div style="display: block;" class="article">
	<?php the_content(); ?>
<a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php the_title(); ?>" data-via="MedibankCF" data-count="none" data-dnt="true">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>    </p>
    <a style="display: inline;" class="close">Close</a> 
	
	</div>
   
   
</div>
		<?php endwhile; ?>
		<?php else: ?>
		<h2>Not Found</h2>
		<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
		<?php endif; ?>
		<!--/post-->
      <!--/loop 1-->

      <!--loop1b -->
      <?php $page_num = $paged; if ($pagenum='') $pagenum =1;
		query_posts('cat=4&showposts=1&offset=1&paged='.$page_num); ?>
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
		  
<div class="newsFeature">
<a name="<?php the_ID(); ?>" id="<?php the_ID(); ?>" class="toHide"></a>
			<?php 
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				the_post_thumbnail('full', array('class' => 'limagemedia2'));
			} 
			?>
  <div class="wrap">
    <p class="date"><?php the_time('j F Y') ?></p>
		  <h2 <?php post_class(); ?>><?php the_title(); ?></h2>
    <p><?php the_excerpt_rss(); ?> </p>
   </div>
<div class="wrap open newsreadmore"><a style="display: none; margin-top:10px;" class="readMore">Read more</a></div> 
  <div style="display: block;" class="article">
	<?php the_content(); ?>
<a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php the_title(); ?>" data-via="MedibankCF" data-count="none" data-dnt="true">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>    </p>
    <a style="display: inline;" class="close">Close</a>	
	</div> 
</div>
		<?php endwhile; ?>
		<?php else: ?>
		<h2>Not Found</h2>
		<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
		<?php endif; ?>
		<!--/post-->
      <!--/loop 1b-->

<h2>Past News</h2>
      <!--loop2 -->
      <?php $page_num = $paged; if ($pagenum='') $pagenum =1;
      query_posts('cat=4&showposts=30&offset=2&paged='.$page_num); ?>
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
		  <?php if(strtotime($post->post_date) >= strtotime("-".ARCHIVE_CAP." months")):?>
<div class="newsFeature">
<a name="<?php the_ID(); ?>" id="<?php the_ID(); ?>" class="toHide"></a>
			<?php 
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			  the_post_thumbnail('newsmedia-thumb', array('class' => 'limagemedia3'));
			} 
			?>
  <div class="wrap">
    <p class="date"><?php the_time('j F Y') ?></p>
		  <h2 <?php post_class(); ?>><?php the_title(); ?></h2>
    <p><?php the_excerpt_rss('', TRUE, '', 500); ?></p>
   </div>


<div class="wrap open newsreadmore"><a style="display: none; margin-top:10px;" class="readMore">Read more</a></div>


  <div style="display: block;" class="article">
	<?php the_content(); ?>
<a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php the_title(); ?>" data-via="MedibankCF" data-count="none" data-dnt="true">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>    </p>
<a style="display: inline;" class="close">Close</a> 

</div>


</div>
<?php endif;?>
		<?php endwhile; ?>
		<?php else: ?>
		<h2>Not Found</h2>
		<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
		<?php endif; ?>
		<!--/post-->
      <!--/loop 2-->
	  
	  
      </div><!-- end communityContentContainer --> 
	  
      <div class="secondaryContent">
        <div class="resources">
			 <?php query_posts('category_name=news-media-resources&showposts=1');while(have_posts()): the_post();?>
				  <h2>
					Resources
				  </h2>
			<?php endwhile; wp_reset_query(); ?>
			
			 <?php query_posts('category_name=news-media-resources&showposts=3');while(have_posts()): the_post();?>
				  <?php the_content(); ?>
				  
			<?php endwhile; wp_reset_query(); ?>
		
        </div>
		
        <div class="resources">
			 <?php query_posts('category_name=mcf-newsletters&showposts=1');while(have_posts()): the_post();?>
				  <h2>
					MCF Newsletters
				  </h2>
			<?php endwhile; wp_reset_query(); ?>
			
			 <?php query_posts('category_name=mcf-newsletters&showposts=3');while(have_posts()): the_post();?>
				  <?php the_content(); ?>
				  
			<?php endwhile; wp_reset_query(); ?>
		
        </div>
		
		<div class="relatedLinks">
		<?php get_sidebar('newsmedia'); ?>
		</div>

		
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
