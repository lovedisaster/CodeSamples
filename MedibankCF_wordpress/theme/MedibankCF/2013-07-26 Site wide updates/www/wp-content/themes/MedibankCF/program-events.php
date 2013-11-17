<?php
/**
 * Template Name: Program Events
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
  <div class="container programsAndEvents clearfix">
    <div class="section">
      <div class="primaryContent">
        <div class="programsEvents">
          <?php
          $page1 = get_page_by_path('programs-events');
          query_posts('post_type=page&page_id='.$page1->ID);
          while(have_posts()): the_post();
          ?>
          <?php 
          if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
          	the_post_thumbnail('FULL', array('class' => 'limage'));
          } 
          ?>
          <?php if ( get_post_meta($post->ID, 'thumb', true) ) : ?>
          <img src="<?php echo get_post_meta($post->ID, 'thumb', true); ?>" alt="" width="225" height="233" class="limage">
          <?php endif; ?>
<h1>Programs &amp; Events</h1>
          <?php the_content(); ?>
          <?php
         endwhile;
         wp_reset_query();
         ?>
        </div>
      </div>
      <div class="secondaryContent">
        <div class="programsEventsNav">
          <!--<ul>
								<li><a href="#">Flagship partnerships</a></li>
								<li><a href="#">Community grants</a></li>
								<li><a href="#">Scholarship grants</a></li>
								<li class="doubleLine"><a href="#">Indigenous Health<br> and Wellbeing</a></li>
								<li><a href="#">Donations</a></li>
							</ul>-->
          <?php wp_nav_menu( array('menu' => 'programsEventsNav', 'menu_id' => '',  'menu_class' => '', 'container' => '' )); ?>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="programsEventsDetails">
        <div class="upcomingEvents nospace">
          <h2>Upcoming Events</h2>
          <ul>
            <?php
$i = 1;
query_posts('category_name=Upcoming-Events&posts_per_page=&showposts=9999&post_status=publish&order=ASC');
while(have_posts()): the_post();
?>
            <li class='<?php if($i%2==0){ echo "no-color"; }else { echo "even"; } ?>'> <span class="date"><?php echo get_post_meta($post->ID, 'Date', true); ?></span> <a href="<?php echo get_post_meta($post->ID, 'hyperlink', true); ?>"> <span class="eventInfo">
              <?php the_title(); ?>
              </span> </a> <span class="eventState"><?php echo get_post_meta($post->ID, 'location', true); ?></span> </li>
            <?php
$i++;
endwhile;
wp_reset_query();
?>
          </ul>
          <!-- <p><a href="" class="viewAll">View all events</a></p> -->
        </div>
        <?php
$i = 1;
query_posts('category_name=gallery=&showposts=1&post_status=publish&order=DSC&');
while(have_posts()): the_post();
$thumb = get_post_custom_values('thumb');

?>
        <div class="eventsGallery nospace">
          <h2 class="left">Gallery</h2>
          <a href="<?php the_permalink(); ?>" class="galleryLink">View gallery</a>
          <div class="photoView">
            <div class="items">
              <?php foreach($thumb as $val){
													?>
              <a href="<?php echo $val; ?>" rel="colorbox" title="" class="cboxElement"> <img src="<?php echo $val; ?>" alt="Image" width="121" height="88"> </a>
              <?php 
}?>
            </div>
            <a class="prev browse left disabled">Left</a> <a class="next browse right">Right</a></div>
          <h3>
            <?php the_title(); ?>
          </h3>
          <?php the_content(); ?>
          <!-- <p><a href="" class="viewAll">View all images</a></p> -->
        </div>
        <?php
$i++;
endwhile;
wp_reset_query();
?>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
