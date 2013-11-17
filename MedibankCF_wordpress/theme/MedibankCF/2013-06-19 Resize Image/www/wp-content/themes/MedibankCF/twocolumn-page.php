<?php
/**
 * Template Name: Two column sidebar
 *
 */

get_header(); ?>

<div class="content">
  <div class="container">
    <div class="section clearfix">
      <div class="primaryContent">
        <div class="realStoryHightlights">
          <?php while(have_posts()): the_post();?>
			<?php 
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			  the_post_thumbnail('FULL', array('class' => 'limage'));
			} 
			?>
          <h1 class="headingstory">
            <?php the_title(); ?>
          </h1>
          <?php 
            if( get_post_meta(get_the_ID(), 'Excerpt', true) ):
                echo '<p>' . get_post_meta(get_the_ID(), 'Excerpt', true) . '</p>';
            else:
                the_content(); 
            endif;
          ?>
          <?php endwhile; wp_reset_query();?>
        </div>

          <?php if( is_page(12) ) :?>
		  <!-- if get invlolved page, show get invlolved category post -->
      <!--loop1 -->
      <?php $page_num = $paged; if ($pagenum='') $pagenum =1;
		query_posts('cat=15&showposts=6&paged='.$page_num); ?>
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
		<h2 <?php post_class(); ?>><?php the_title(); ?></h2>
		<div <?php post_class(); ?>>
		  <h2 <?php post_class(); ?>><?php the_title(); ?></h2>
		  
			<?php 
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			  the_post_thumbnail('FULL', array('class' => 'featureimage'));
			} 
			?>
			
		  <?php if ( get_post_meta($post->ID, 'thumb-left', true) ) : ?>
		  <img src="<?php echo get_post_meta($post->ID, 'thumb-left', true); ?>" class="limage" />
		  <?php endif; ?>
		  <?php if ( get_post_meta($post->ID, 'thumb-right', true) ) : ?>
		  <img src="<?php echo get_post_meta($post->ID, 'thumb-right', true); ?>" class="rimage" />
		  <?php endif; ?>
		  <?php if ( get_post_meta($post->ID, 'thumb2-right', true) ) : ?>
		  <img src="<?php echo get_post_meta($post->ID, 'thumb2-right', true); ?>" class="rimage2 clearImg" />
		  <?php endif; ?>
		  
          <?php the_content(); ?>
			<iframe style="width: 58px; height: 20px;" title="Twitter Tweet Button" src="http://platform.twitter.com/widgets/tweet_button.1355514129.html#_=1357511176683&amp;count=none&amp;id=twitter-widget-0&amp;lang=en&amp;original_referer=http%3A%2F%2Fmedibankcf.com.au%2Fmedibank/get-involved/&amp;size=m&amp;text=Medibank%20Community%20Fund&amp;url=http%3A%2F%2Fmedibankcf.com.au%2Fmedibank/get-involved/&amp;via=MedibankCF" height="240" width="320" frameborder="0" scrolling="no" data-twttr-rendered="true"></iframe>
			<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		</div>
		<div style="clear:both; height:20px;"></div>
		<?php endwhile; ?>
		<?php else: ?>
		<h2>Not Found</h2>
		<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
		<?php endif; ?>
		<!--/post-->
      <!--/loop 1-->
          <?php endif; ?>
		  
          <?php if( is_page(268) ) :?>
		  <!-- if get invlolved page, show get food & drinks tips category post -->
      <!--loop2 -->
      <?php $page_num = $paged; if ($pagenum='') $pagenum =1;
		query_posts('cat=18&showposts=6&paged='.$page_num); ?>
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
		<div <?php post_class(); ?>>
			<?php 
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			  the_post_thumbnail('FULL', array('class' => 'featureimage'));
			} 
			?>
          <h2 style="clear:none;">
            <?php the_title(); ?>
          </h2>
          <?php the_content(); ?>

			<iframe style="width: 58px; height: 20px;" title="Twitter Tweet Button" src="http://platform.twitter.com/widgets/tweet_button.1355514129.html#_=1357511176683&amp;count=none&amp;id=twitter-widget-0&amp;lang=en&amp;original_referer=http%3A%2F%2Fmedibankcf.com.au%2F/medibank/get-involved/food-drink-tips/&amp;size=m&amp;text=Medibank%20Community%20Fund&amp;url=http%3A%2F%2Fmedibankcf.com.au%2F/medibank/get-involved/food-drink-tips/&amp;via=MedibankCF" height="240" width="320" frameborder="0" scrolling="no" data-twttr-rendered="true"></iframe>
			<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
			<?php if ( get_post_meta($post->ID, 'teaser', true) ) : ?>
			<br>
			<p class="postteaser">
			<?php echo get_post_meta($post->ID, 'teaser', true); ?>
			</p>
			<?php endif; ?>
			
		</div>
		<div style="clear:both; height:20px;"></div>
		<?php endwhile; ?>
		<?php else: ?>
		<h2>Not Found</h2>
		<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
		<?php endif; ?>
		<!--/post-->
      <!--/loop 2-->
		  
          <?php endif; ?>

          <?php if( is_page(334) ) :?>
		  <!-- if get invlolved page, show get food & drinks tips category post -->
      <!--loop3 -->
	  
      <?php $page_num = $paged; if ($pagenum='') $pagenum =1;
		query_posts('cat=19&showposts=6&paged='.$page_num); ?>
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
		<div <?php post_class(); ?>>
			<?php 
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			  the_post_thumbnail('FULL', array('class' => 'featureimage'));
			} 
			?>
          <h2 style="clear:none;">
            <?php the_title(); ?>
          </h2>
          <?php the_content(); ?>
			
			<iframe style="width: 58px; height: 20px;" title="Twitter Tweet Button" src="http://platform.twitter.com/widgets/tweet_button.1355514129.html#_=1357511176683&amp;count=none&amp;id=twitter-widget-0&amp;lang=en&amp;original_referer=http%3A%2F%2Fmedibankcf.com.au%2F/medibank/get-involved/exercise-activity-tips/&amp;size=m&amp;text=Medibank%20Community%20Fund&amp;url=http%3A%2F%2Fmedibankcf.com.au%2F/medibank/get-involved/exercise-activity-tips/&amp;via=MedibankCF" height="240" width="320" frameborder="0" scrolling="no" data-twttr-rendered="true"></iframe>
			<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
			<?php if ( get_post_meta($post->ID, 'teaser', true) ) : ?>
			<br>
			<p class="postteaser">
			<?php echo get_post_meta($post->ID, 'teaser', true); ?>
			</p>
			<?php endif; ?>
			
		</div>
		<div style="clear:both; height:20px;"></div>
		<?php endwhile; ?>
			<!-- pagination -->
			<?php next_posts_link(); ?>
			<?php previous_posts_link(); ?>
		<?php else: ?>
		<h2>Not Found</h2>
		<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
		<?php endif; ?>
		<!--/post-->
      <!--/loop 3-->
		  
          <?php endif; ?>

          <?php if( is_page(345) ) :?>
		  <!-- if get invlolved page, show get food & drinks tips category post -->
      <!--loop4 -->
      <?php $page_num = $paged; if ($pagenum='') $pagenum =1;
		query_posts('cat=20&showposts=6&paged='.$page_num); ?>
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
		<div <?php post_class(); ?>>
			<?php 
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			  the_post_thumbnail('FULL', array('class' => 'featureimage'));
			} 
			?>
          <h2 style="clear:none;">
            <?php the_title(); ?>
          </h2>
          <?php the_content(); ?>

<a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php the_title(); ?>" data-via="MedibankCF" data-count="none" data-dnt="true">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>    </p>
			<br>
			<?php if ( get_post_meta($post->ID, 'teaser', true) ) : ?>
			<p class="postteaser">
			<?php echo get_post_meta($post->ID, 'teaser', true); ?>
			</p>
			<?php endif; ?>
			
		</div>
		<div style="clear:both; height:20px;"></div>
		<?php endwhile; ?>
			<!-- pagination -->
			<?php next_posts_link(); ?>
			<?php previous_posts_link(); ?>
		<?php else: ?>
		<h2>Not Found</h2>
		<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
		<?php endif; ?>
		<!--/post-->
      <!--/loop 4-->
		  
          <?php endif; ?>

<!--loop 5 community page-->		  
<?php if( is_page(59) ) :?>

<div class="article">
    <div class="image-content-wrap clearfix">
        <div class="right">
            <img id="au-nz" src="<?php bloginfo('template_directory'); ?>/images/map-au-nz.gif" usemap="#ImageMap" border="0" alt="Map of Australia and New Zealand" />
            <map name="ImageMap">
            <area shape="poly" coords="106,44,95,37,82,49,77,55,69,60,66,72,48,85,37,87,20,99,19,98,15,114,22,130,15,128,24,147,37,173,35,185,55,188,69,179,84,179,92,164,109,161," href="<?php echo current_page_url(); ?>/grant-recipients?options=WA" alt="WA" title="WA"   />
            <area shape="poly" coords="110,44,118,27,130,25,128,18,141,22,159,25,150,40,166,53,162,117,110,118," href="<?php echo current_page_url(); ?>/grant-recipients?options=NT" alt="NT" title="NT"   />
            <area shape="poly" coords="110,121,111,157,134,161,147,181,160,167,155,182,162,178,160,185,168,183,170,197,175,202,180,120," href="<?php echo current_page_url(); ?>/grant-recipients?options=SA" alt="SA" title="SA"   />
            <area shape="poly" coords="179,176,188,180,200,191,216,192,225,203,212,206,205,213,197,208,198,203,189,209,177,204," href="<?php echo current_page_url(); ?>/grant-recipients?options=VIC" alt="VIC" title="VIC"   />
            <area shape="poly" coords="224,174,229,179,224,189,218,183," href="<?php echo current_page_url(); ?>/grant-recipients?options=ACT" alt="ACT" title="ACT"   />            
            <area shape="poly" coords="181,141,179,175,187,179,192,187,199,189,216,191,227,201,236,180,249,164,257,146,244,149,232,144,226,145," href="<?php echo current_page_url(); ?>/grant-recipients?options=NSW" alt="NSW" title="NSW"   />
            <area shape="poly" coords="168,53,181,62,191,45,192,27,198,15,206,40,212,42,215,52,219,58,222,71,232,81,240,98,245,99,256,124,257,142,250,142,243,147,235,141,225,143,181,138,183,117,166,117," href="<?php echo current_page_url(); ?>/grant-recipients?options=QLD" alt="QLD" title="QLD"   />
            <area shape="poly" coords="195,221,207,227,215,226,214,234,211,241,205,245,198,237," href="<?php echo current_page_url(); ?>/grant-recipients?options=TAS" alt="TAS" title="TAS"   />
            <area shape="poly" coords="266,271,276,255,283,247,301,234,312,217,324,199,335,181,344,168,344,151,328,121,337,125,343,129,347,140,352,151,355,145,360,157,371,162,381,157,379,168,377,179,370,178,367,184,353,210,339,214,325,232,325,240,317,243,310,254,304,272,288,282," href="<?php echo current_page_url(); ?>/grant-recipients?options=NZ" alt="NZ" title="NZ"   />
            </map>            
        </div>
        <?php the_content() ?>
    </div>
</div>

<?php endif; ?>  

<!--end loop 5-->		

<!--loop 6 Indigenous health and wellbeing page-->		  
<?php if( is_page(62) ) :?>

<div class="article">
<?php query_posts('category_name=indigenous-health-and-wellbeing&posts_per_page='); while(have_posts()): the_post(); ?>
<h2><?php the_title(); ?></h2>
<?php the_content(); ?>
<?php endwhile; wp_reset_query(); ?>
</div>

<?php endif; ?>  

<!--end loop 6-->		  
    
<!--loop 7 Donations page-->		  
<?php if( is_page(64) ) :?>

<div class="article">
<?php query_posts('category_name=Donation&posts_per_page='); while(have_posts()): the_post(); ?>
<h2><?php the_title(); ?></h2>
<?php the_content(); ?>
<?php endwhile; wp_reset_query(); ?>
</div>

<?php endif; ?>  

<!--end loop 7-->		  
	


	
	  </div><!-- end communityContentContainer --> 	  
	  
      <div class="secondaryContent">
	  
	<?php if( is_page(57) ) :?><!-- show flagship-partnerships page-->
        <div class="programsEventsNav">
			<?php wp_nav_menu( array('menu' => 'programsEventsNav', 'menu_id' => '',  'menu_class' => '', 'container' => '' )); ?>
		</div>
		
		  <?php query_posts('category_name=flagship-partneship&showposts=1');while(have_posts()): the_post();?>
		<div id="sakgfseasonalnews" class="resources">
		  <h2><?php the_title(); ?></h2>
		  
		  <?php if ( has_post_thumbnail()) : ?>
		  <?php the_post_thumbnail('full', array( 'class' => 'limagerelatednews' ) ); ?>
		  <?php endif; ?>
		  
		  <?php the_content(); ?>
		</div>
		<div style="clear:both;"></div>
		<?php endwhile; wp_reset_query(); ?>
		
		
		<div class="miniProfile">
		  <h2>Related news</h2>
     <?php $args=array( 'showposts'=>5, 'tag__in' => array('45') ); query_posts($args); while (have_posts()) : the_post(); ?>
		  <?php if ( has_post_thumbnail()) : ?>
		  <?php the_post_thumbnail('full', array( 'class' => 'limagerelatednews' ) ); ?>
		  <?php endif; ?>
		  <p class="cite">
			<?php the_time('j F Y') ?>
		  </p>
		  <h3>
			<?php the_title(); ?>
		  </h3>
		  <br>
		  <p>
			<?php the_excerpt_rss(); ?>
		  </p>
		  <p> <a href="<?php echo site_url(); ?>/news-media#<?php the_ID(); ?>" class="viewAll">Read more</a> </p>
		  <br>
	<?php endwhile; wp_reset_query(); ?>
		</div>
		<!-- endflagship-partnerships page-->

		<?php elseif( is_page('59') ) : ?><!-- Community page-->
        <div class="programsEventsNav">
			<?php wp_nav_menu( array('menu' => 'programsEventsNav', 'menu_id' => '',  'menu_class' => '', 'container' => '' )); ?>
		</div>
		
		  <?php query_posts('category_name=resources&showposts=1');while(have_posts()): the_post();?>
		<div id="sakgfseasonalnews" class="resources">
		  <h2><?php the_title(); ?></h2>
		  
		  <?php if ( has_post_thumbnail()) : ?>
		  <?php the_post_thumbnail('full', array( 'class' => 'limagerelatednews' ) ); ?>
		  <?php endif; ?>
		  
		  <?php the_content(); ?>
		</div>
		<div style="clear:both;"></div>
		<?php endwhile; wp_reset_query(); ?>

		<div class="miniProfile">
		  <h2>Related news</h2>
     <?php $args=array( 'showposts'=>5, 'tag__in' => array('46') ); query_posts($args); while (have_posts()) : the_post(); ?>
		  <?php if ( has_post_thumbnail()) : ?>
		  <?php the_post_thumbnail('full', array( 'class' => 'limagerelatednews' ) ); ?>
		  <?php endif; ?>
		  <p class="cite">
			<?php the_time('j F Y') ?>
		  </p>
		  <h3>
			<?php the_title(); ?>
		  </h3>
		  <br>
		  <p>
			<?php the_excerpt_rss(); ?>
		  </p>
		  <p> <a href="<?php echo site_url(); ?>/news-media#<?php the_ID(); ?>" class="viewAll">Read more</a> </p>
		  <br>
	<?php endwhile; wp_reset_query(); ?>
		</div>
		<!-- end Community page-->
		
		<?php elseif( is_page('60') ) : ?><!-- scholarship page-->
        <div class="programsEventsNav">
			<?php wp_nav_menu( array('menu' => 'programsEventsNav', 'menu_id' => '',  'menu_class' => '', 'container' => '' )); ?>
</div>

		<!-- Related news for sidebar of scholarship-grants page -->
		<!-- Nathan: If this post is still within in new&media page and not put in archieve yet Regarding $top33, in news-media.php only top 33 articles are displayed, for the ones out of 33 will have no anchor in the page.-->
		<?php $page_num = $paged;$top33 = null;$counter=0; if ($pagenum='') $pagenum =1;	query_posts('cat=4&showposts=33&offset=2&paged='.$page_num); ?>
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php $top33[$counter] = get_the_ID(); $counter++;?>
		<?php endwhile ?>
		<?php endif ?>
		<!-- End of Nathan's change -->
		
		<div class="miniProfile">
		  <h2>Related news</h2>
     <?php $args=array( 'showposts'=>5, 'tag__in' => array('48') ); query_posts($args); while (have_posts()) : the_post(); ?>
		  <?php if ( has_post_thumbnail()) : ?>
		  <?php the_post_thumbnail('full', array( 'class' => 'limagerelatednews' ) ); ?>
		  <?php endif; ?>
		  <p class="cite">
			<?php the_time('j F Y') ?>
		  </p>
		  <h3>
			<?php the_title(); ?>
		  </h3>
		  <br>
		  <p>
			<?php the_excerpt_rss(); ?>
		  </p>
		  <p> 
		
		<!-- Nathan: If the article is within top 33, locate the anchor in news-media page, otherwise, located it in archieve folder with the format like "siteroot/year/month#id" -->
		<?php if(in_array(get_the_ID(),$top33)): ?>
		<a href="<?php echo site_url(); ?>/news-media#<?php the_ID(); ?>" class="viewAll">Read more</a> </p>
		<?php else : ?>
			<?php $yearString = get_the_Date('Y');$monthString = get_the_Date('m')?>
			<a href="<?php echo site_url(); ?>/<?php echo $yearString;?>/<?php echo $monthString;?>#<?php the_ID(); ?>" class="viewAll">Read more</a> </p>
		<?php endif ?>
		<!-- End of Nathan's change -->
		
		  <br>
	<?php endwhile; wp_reset_query(); ?>
		</div>
		<!-- end scholarship page-->
		
		<?php elseif( is_page('62') ) : ?><!-- indigenous halth and wellbeing page-->
        <div class="programsEventsNav">
			<?php wp_nav_menu( array('menu' => 'programsEventsNav', 'menu_id' => '',  'menu_class' => '', 'container' => '' )); ?>
		</div>
		
		
		<div class="miniProfile">
		  <h2>Related news</h2>
     <?php $args=array( 'showposts'=>5, 'tag__in' => array('47') ); query_posts($args); while (have_posts()) : the_post(); ?>
		  <?php if ( has_post_thumbnail()) : ?>
		  <?php the_post_thumbnail('full', array( 'class' => 'limagerelatednews' ) ); ?>
		  <?php endif; ?>
		  <p class="cite">
			<?php the_time('j F Y') ?>
		  </p>
		  <h3>
			<?php the_title(); ?>
		  </h3>
		  <br>
		  <p>
			<?php the_excerpt_rss(); ?>
		  </p>
		  <p> <a href="<?php echo site_url(); ?>/news-media#<?php the_ID(); ?>" class="viewAll">Read more</a> </p>
		  <br>
	<?php endwhile; wp_reset_query(); ?>
		</div>
		<!-- end indigenous halth and wellbeing page-->
		
		
		<?php elseif( is_page('64') ) : ?><!-- donations page-->
        <div class="programsEventsNav">
			<?php wp_nav_menu( array('menu' => 'programsEventsNav', 'menu_id' => '',  'menu_class' => '', 'container' => '' )); ?>
		</div>
		
	<div class="resources">
	<?php query_posts('category_name=Related-information&posts_per_page='); while(have_posts()): the_post(); $thumb = get_post_custom_values('hyperlink'); ?>
		<h2><?php the_title(); ?></h2>
		<ul><?php foreach($thumb as $val){?>
		<li><?php echo $val; ?></li>
		<?php }?>
		</ul>
	<?php endwhile; wp_reset_query(); ?>
	</div>		
		<div style="clear:both;"></div>
		<div class="miniProfile">
		  <h2>Related news</h2>
     <?php $args=array( 'showposts'=>5, 'tag__in' => array('49') ); query_posts($args); while (have_posts()) : the_post(); ?>
		  <?php if ( has_post_thumbnail()) : ?>
		  <?php the_post_thumbnail('full', array( 'class' => 'limagerelatednews' ) ); ?>
		  <?php endif; ?>
		  <p class="cite">
			<?php the_time('j F Y') ?>
		  </p>
		  <h3>
			<?php the_title(); ?>
		  </h3>
		  <br>
		  <p>
			<?php the_excerpt_rss(); ?>
		  </p>
		  <p> <a href="<?php echo site_url(); ?>/news-media#<?php the_ID(); ?>" class="viewAll">Read more</a> </p>
		  <br>
	<?php endwhile; wp_reset_query(); ?>
		</div> <!-- end donations page-->
	
		<?php else: ?>
		<div class="programsEventsNav">
			<?php get_sidebar('getinvolved'); ?>
        </div>
		
			<?php get_sidebar('relatedLinks'); ?>
		
        </div>
    <?php endif; ?>
		
        <div class="relatedLinks">
		
		
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
