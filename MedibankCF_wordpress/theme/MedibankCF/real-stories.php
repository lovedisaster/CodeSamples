<?php
/**
 * Template Name: Real Stories
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
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
      <div class="primaryContent">
        <div class="realStoryHightlights">
          <?php while(have_posts()): the_post();?>
            <?php if( is_page(116) ) :?>
			        <?php 
			        if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			          the_post_thumbnail('FULL', array('class' => 'limagemcf'));
			        } 
			        ?>
		          <?php else : ?>
		          <?php 
			        if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			          the_post_thumbnail('FULL', array('class' => 'limage'));
			        } 
		          ?>
		          <?php endif; ?>		  
              <h1>
              <?php the_title(); ?>
              </h1>
              <?php the_content(); ?>
          <?php endwhile; wp_reset_query();?>
        </div>
        <div class="pastNews"> <br>
          <?php if( is_page(11) ) :?>		  
              <?php
			            $i = 1;
			            query_posts('category_name=Real-Stories&posts_per_page=15');
			            while(have_posts()): the_post();
              ?>
              <!-- Start Real-stories Page -->
              <div class="newsFeature split" id="Real-Stories<?php echo $i; ?>">
		          <a name="<?php the_ID(); ?>" id="<?php the_ID(); ?>" class="toHide"></a>		  
		          <?php if ( has_post_thumbnail()) : ?>
		          <?php the_post_thumbnail('FULL', array('class' => 'realstories')); ?>
		          <?php endif; ?>		
              <div class="wrap">
                  <h2>
                    <?php the_title(); ?>
                  </h2>
				      <?php the_excerpt(); ?>
                </div>
                <div class="wrap open"><a class="readMore" style="display: inline;margin-top:5px;">Read more</a></div>
                <div class="article story" style="display: none;">
                  <?php the_content(); ?>
                  <a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php the_title(); ?>" data-via="MedibankCF" data-count="none" data-dnt="true">Tweet</a>
                  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                  </p>
                  <a class="close" style="display: inline;">Close</a></div>
              </div>
              <!-- end real-stories -->		  
              <?php $i++; endwhile; wp_reset_query();?>
		      <?php endif; ?>
		      <!-- Archive real stories-->
          <?php if( is_page(2847) ) :?>		  
              <?php $i = 1; query_posts('category_name=Real-Stories&showpost=9999&offset=15'); while(have_posts()): the_post(); ?>	
              <div class="newsFeature split" id="Real-Stories<?php echo $i; ?>">
		          <a name="<?php the_ID(); ?>" id="<?php the_ID(); ?>" class="toHide"></a>		  
		          <?php if ( has_post_thumbnail()) : ?>
		          <?php the_post_thumbnail('FULL', array( 'class' => 'realstories')); ?>
		          <?php endif; ?>			
              <div class="wrap">
              <h2>
                <?php the_title(); ?>
              </h2>
				      <?php the_excerpt(); ?>
              </div>
              <div class="wrap open"><a class="readMore" style="display: inline;margin-top:5px;">Read more</a></div>
              <div class="article story" style="display: none;">
              <?php the_content(); ?>
              <a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php the_title(); ?>" data-via="MedibankCF" data-count="none" data-dnt="true">Tweet</a>
              <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
              </p>
              <a class="close" style="display: inline;">Close</a> </div>
              </div>
              <?php $i++; endwhile; wp_reset_query();?>
		    <?php endif; ?>
        <!-- New Ambassador Blogs -->
            <?php if( is_page(119) ) :?>
                  <?php
                  $i = 1;
                  query_posts('category_name=ambassador-blogs&showpost=9999');
                  while(have_posts()): the_post();
                  ?>
		            <!-- start guest-blogs -->
		            <!-- Only put 5 month as archive cap -->
	            <?php if(strtotime($post->post_date) >= strtotime("-".ARCHIVE_CAP." months")):?>
	                <div class="newsFeature split">
		              <a name="<?php the_ID(); ?>" id="<?php the_ID(); ?>" class="toHide"></a>
		              <?php if ( has_post_thumbnail()) : ?>
		              <?php the_post_thumbnail('FULL', array( 'class' => 'realstoriesguestblog2' ) ); ?>
		              <?php else:?>
			            <img src="<?php bloginfo('template_directory');?>/images/logo-square.jpg" class="realstoriesguestblog2"/>
		          <?php endif; ?>
	            <div class="wrap">
	            <h2>
		            <?php the_title(); ?>
	            </h2>
	              <p class="date"><?php the_time('j F Y') ?> </p>
	              <?php the_excerpt(); ?>
	            </div>
              <div class="wrap open bloglistreadmore"><a class="readMore" style="display: inline;margin-top:5px;">Read more</a></div>
	              <div class="article story2" style="display: none;">
				           <?php the_content(); ?>
				              <a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php the_title(); ?>" data-via="MedibankCF" data-count="none" data-dnt="true">Tweet</a>
                      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                      <a class="close" style="display: inline;">Close</a> 
               </div>
	          <?php endif;?>           
            <?php
			          $i++;
		          endwhile;
		          wp_reset_query();
	          ?>
         <?php endif; ?>
		
	      <!-- Links on Real Story page which navigates to Real Story Archieve page. -->	
         <div class="relatedLinks">
           <?php if( is_page(11) || (is_page(2847) )) :?>	 
                <h2>Real stories archive</h2>
                <ul>
			            <?php query_posts('category_name=Real-Stories&showpost=9999&offset=15');while(have_posts()): the_post();?>
                  <li>
                    <a href="<?php echo site_url(); ?>/real-stories/archive#<?php the_ID(); ?>">
                    <?php the_title(); ?>
                    </a>
                  </li>
		          </ul>
	       <?php endif; ?>
         </div>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
