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
          <!-- start real-stories -->
          <div class="newsFeature split" id="Real-Stories<?php echo $i; ?>">
		  <a name="<?php the_ID(); ?>" id="<?php the_ID(); ?>" class="toHide"></a>
		  
		  <?php if ( has_post_thumbnail()) : ?>
		  <?php the_post_thumbnail( array(99,99), array( 'class' => 'realstories')); ?>
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
          <!-- end real-stories -->
		  
          <?php $i++; endwhile; wp_reset_query();?>

		  <?php endif; ?>
<!-- archive real stories-->
          <?php if( is_page(2847) ) :?>
		  
          <?php $i = 1; query_posts('category_name=Real-Stories&showpost=9999&offset=15'); while(have_posts()): the_post(); ?>
          <!-- start real-stories -->
          <div class="newsFeature split" id="Real-Stories<?php echo $i; ?>">
		  <a name="<?php the_ID(); ?>" id="<?php the_ID(); ?>" class="toHide"></a>
		  
		  <?php if ( has_post_thumbnail()) : ?>
		  <?php the_post_thumbnail( array(99,99), array( 'class' => 'realstories')); ?>
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
          <!-- end real-stories -->
		  
          <?php $i++; endwhile; wp_reset_query();?>

		  <?php endif; ?>

<!-- loop 2 guest blog -->

          <?php if( is_page(125) ) :?>
		  
          <?php
$i = 1;
query_posts('category_name=guest-blogs&showpost=9999');
while(have_posts()): the_post();
?>
          <!-- start guest-blogs -->
          <div class="newsFeature split">
		  <a name="<?php the_ID(); ?>" id="<?php the_ID(); ?>" class="toHide"></a>
		  
		  <?php if ( has_post_thumbnail()) : ?>
		  <?php the_post_thumbnail( array(69,61), array( 'class' => 'realstoriesguestblog2' ) ); ?>
		  <?php endif; ?>
		  
            <div class="wrap">
              <h2>
                <?php the_title(); ?>
              </h2>
			  <p class="date"><?php the_time('j F  Y') ?> </p>
              <?php the_excerpt(); ?>
            </div>
            <div class="wrap open" style="margin-left:99px;"><a class="readMore" style="display: inline;margin-top:5px;">Read more</a></div>
            <div class="article story2" style="display: none;">
              <?php the_content(); ?>
              <a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php the_title(); ?>" data-via="MedibankCF" data-count="none" data-dnt="true">Tweet</a>
              <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
              </p>
              <a class="close" style="display: inline;">Close</a> </div>
          </div>
          <!-- end rita real-stories -->
		  
		  
		  
<?php
$i++;
endwhile;
wp_reset_query();
?>
<?php endif; ?>

<!-- loop 3 MCF Ambassadors -->

          <?php if( is_page(116) ) :?>
		  
          <?php
$i = 1;
query_posts('category_name=mcf-ambassadors&posts_per_page=-1');
while(have_posts()): the_post();
?>
          <!-- start Ambassadors __ category -->
          <div class="communityContentContainer">
		  <a name="<?php the_ID(); ?>" id="<?php the_ID(); ?>" class="toHide"></a>
		  
              <h2>
                <?php the_title(); ?>
              </h2>

			<?php 
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			  the_post_thumbnail('FULL', array('class' => 'limage', 'style' => 'padding-top:3px;'));
			} 
			?>

		  <?php the_content(); ?>
          </div>
          <!-- end Ambassadors __ category -->
		  
		  
		  
          <?php
$i++;
endwhile;
wp_reset_query();
?>
<?php endif; ?>


<!-- loop 4 Ambassador blogs -->

<?php if( is_page(119) ) :?>
	

	<!-- remove -->
	<div class="clearfix" style="height:40px;"></div>
	
	<!-- Nathan: new embassador blog div, prints out header(tag in cms first), then regular blogs -->
	<div class="communityContentContainer mcf-blog">
		<?php 

		$categories = get_categories(array('child_of'=>31,'hide_empty' => 0));
		for($counter = 0;$counter < count($categories);$counter++){
			$catName = $categories[$counter]->cat_name;

			$catID = $categories[$counter]->term_id;

			$count_posts = wt_get_category_count($catID);
			if($count_posts > 0){
			$the_query = new WP_Query(array ('category_name' => $catName)); 
			if($the_query->have_posts()){
			$isAnchorPrinted = true;
					while($the_query->have_posts()): $the_query->the_post();
						$post_tag = wp_get_post_tags($post->ID);
		?>
					<?php if($isAnchorPrinted):?>
					<a name="<?php echo $catName?>" id="<?php echo $catName?>"></a>
					<?php 
					$isAnchorPrinted = false;
					endif;
					?>
					<a name="<?php echo $post->ID;?>" id="<?php echo $post->ID; ?>"></a>
					<?php if(strtolower(trim($post_tag[0]->name)) == "header"):$blogPostId=$post->ID;?>
					<div class="blogIntro">
						<!--h4><?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?>&#8217;s blog</h4-->
						<h4><?php the_title(); ?>'s blog</h4>
						<p><i><?php the_excerpt_rss(); ?></i></p>
						<p><?php the_content(); ?></p>
					</div>				
					<?php endif?>
					<?php endwhile;wp_reset_query();
					while($the_query->have_posts()): $the_query->the_post(); ?>
					<?php if(get_the_category() == $catName):?>

					<?php else: ?>
						<?php if($post->ID == $blogPostId):?>
	
						<?php else:?>

						<div class="clearfix" style="height:20px;"></div>
						<p class="date background-date"><?php the_time('F Y') ?></p>
						<?php the_content(); ?>
         				<a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php the_title(); ?>" data-via="MedibankCF" data-count="none" data-dnt="true">Tweet</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>    </p>
						<?php endif; ?>
					<?php endif?>
				<?php endwhile; 
				}
				//End if
				wp_reset_query();
				unset($the_query);			
				}}?> 
	</div>
	<!-- Nathan: End of div 'communityContentContainer'-->
			
			
			
			
			


			<?php endif; ?>

<?php if( is_page(3048) ) :?>
	

	<!-- remove -->
	<div class="clearfix" style="height:40px;"></div>
	
	<!-- Nathan: new embassador blog div, prints out header(tag in cms first), then regular blogs -->
	<div class="communityContentContainer mcf-blog">
		<?php 

		$categories = get_categories(array('child_of'=>63,'hide_empty' => 0));

		for($counter = 0;$counter < count($categories);$counter++){
			$catName = $categories[$counter]->cat_name;

			$catID = $categories[$counter]->term_id;

			$count_posts = wt_get_category_count($catID);
			if($count_posts > 0){
			$the_query = new WP_Query(array ('cat' => $catID)); 
			if($the_query->have_posts()){
			$isAnchorPrinted = true;
				while($the_query->have_posts()): $the_query->the_post();
				$post_tag = wp_get_post_tags($post->ID);
		?>
					<?php if($isAnchorPrinted):?>
					<a name="<?php echo $catName?>" id="<?php echo $catName?>"></a>
					<?php 
					$isAnchorPrinted = false;
					endif;
					?>
					<?php if(strtolower(trim($post_tag[0]->name)) == "header"):?>
						<div class="blogIntro">
						<!--h4><?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?>&#8217;s blog</h4-->
						<h4><?php the_title(); ?>'s blog</h4>
						<p><i><?php the_excerpt_rss(); ?></i></p>
						<p><?php the_content(); ?></p>
						</div>				
					<?php endif?>
					<?php endwhile;
					while($the_query->have_posts()): $the_query->the_post(); ?>
					<?php if(get_the_category() == $catName):?>
						
					<?php else: ?>
						
						<?php if(strtolower(trim($post_tag[0]->name)) == "header"):?>
						<?php else:?>
						
						<div class="clearfix" style="height:20px;"></div>
						<p class="date background-date"><?php the_time('F Y') ?></p>
						<?php the_content(); ?>
         				<a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php the_title(); ?>" data-via="MedibankCF" data-count="none" data-dnt="true">Tweet</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>    </p>
						<?php endif?>
				
					<?php endif?>
				<?php endwhile; 
				}
				//End if
				wp_reset_query();
				unset($the_query);			
				}}?> 
	</div>
<?php endif; ?>        
        
        </div>
      </div>
      <div class="secondaryContent">
        <div class="programsEventsNav">
          <!--<ul>
								<li><a href="#">MCF Ambassadors</a></li>
                                <li><a href="#">Ambassador blogs</a></li>
                                <li><a href="#">Guest blogs</a></li>
							</ul>-->
          <?php if( is_page(4242)) :
              wp_nav_menu(array('menu' => 'programsEventsNav', 'menu_id' => '', 'menu_class' => '', 'container' => ''));
          else :
              wp_nav_menu( array('menu' => 'realstoriesnav', 'menu_id' => '',  'menu_class' => '', 'container' => '' )); 
          endif; ?>
          
        </div>
        <div class="relatedLinks">
     <?php if( is_page(11) || (is_page(2847) )) :?>
	 
          <h2>Real stories archive</h2>
          <ul>
			 <?php query_posts('category_name=Real-Stories&showpost=9999&offset=15');while(have_posts()): the_post();?>
            <li><a href="<?php echo site_url(); ?>/real-stories/archive#<?php the_ID(); ?>">
              <?php the_title(); ?>
              </a></li>
			<?php endwhile; wp_reset_query(); ?>
          </ul>
	<?php endif; ?>
	
	
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
