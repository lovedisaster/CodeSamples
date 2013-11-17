<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div class="content no-min-height">
		<div class="flashContainer" style="height: 305px; width: 100%; margin-bottom: 20px;">
		  <div id="flash"  style="background-image: url(<?php bloginfo('template_url'); ?>/images/temp/homeFlashAlt.jpg); background-repeat: no-repeat; background-position: center top; height: 305px; "></div>
		</div>

		  </div>
			 
			 <div class="siteHighlights">


      <?php $page_num = $paged; if ($pagenum='') $pagenum =1;
      query_posts('cat=4, 6&showposts=2'); ?>
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

				<div class="panel">
                	<h2 class="right"><a href="<?php $category = get_the_category(); echo $category[0]->cat_name;?>#<?php the_ID(); ?>"><?php the_title(); ?></a></h2>

					<?php if ( has_post_thumbnail()) : ?>
					<?php the_post_thumbnail('FULL'); ?>				
					<?php endif; ?>	
		  
					<div class="teaser left">
                        <p style="margin-bottom:0;"><?php the_excerpt_rss(); ?></p>
					</div>
                    <div class="teaserLink left">
						<p>
							<a href="<?php $category = get_the_category(); echo $category[0]->cat_name;?>#<?php the_ID(); ?>" class="viewAll">Read more</a>
						</p>
                    </div>
				</div>
		<?php endwhile; ?>
		<?php else: ?>
		<?php endif; ?>


				<div class="panel">
      <?php $page_num = $paged; if ($pagenum='') $pagenum =1;
      query_posts('cat=26,31&showposts=1&paged='.$page_num); ?>
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
  <div class="latestTeaser">
    <div class="textwidget">
					<?php if ( has_post_thumbnail()) : ?>
						<?php the_post_thumbnail( 'FULL', array('class' => 'latestblogthumbnail') ); ?>
					<?php else:?>
						<img width="81" height="61" src="<?php bloginfo('template_directory');?>/images/logo-square.jpg" class="latestblogthumbnail"/>				
					<?php endif; ?>	
					<?php if(in_category(26)):?>
      <h2 style="padding-top: 5px;">Latest blog : <br><a href="<?php echo site_url(); ?>/real-stories/guest-blogs#<?php the_ID(); ?>"><?php the_title(); ?></a></h2>
					<?php else:?>
	  <h2 style="padding-top: 5px;">Latest blog : <br><a href="<?php echo site_url(); ?>/real-stories/ambassador-blogs#<?php the_ID(); ?>"><?php the_title(); ?></a></h2>
					<?php endif;?>
    </div>
  </div>
		<?php endwhile; ?>
		<?php else: ?>
		<?php endif; ?>
		<br>
		
<div class="latestTeaser2">
		  <div class="textwidget">
<?php query_posts('cat=22&showposts=1');while(have_posts()): the_post();?>
		  <?php if ( get_post_meta($post->ID, 'thumb', true) ) : ?>
		<a href="<?php echo site_url(); ?>/programs-events/community-grants">
		  <img src="<?php echo get_post_meta($post->ID, 'thumb', true); ?>" class="limage" id="latestTeaserImg1" />
		  <h2>Community Grants</h2>
		  <h3 class="Teaser1"><?php echo get_post_meta($post->ID, 'teaser', true); ?></h3>
		</a>
		  <?php endif; ?>
 <?php endwhile; wp_reset_query(); ?>				
		  </div>	
</div>	
<br>

<div class="latestTeaser2">
		  <div class="textwidget">
			<?php query_posts('category_name=Annual Review&showposts=1');while(have_posts()): the_post();?>
		  <?php if ( get_post_meta($post->ID, 'thumb', true) ) : ?>
		<a href="<?php echo site_url(); ?>/annual-review">
		  <img src="<?php echo get_post_meta($post->ID, 'thumb', true); ?>" class="limage" id="latestTeaserImg2" />
		  <h3 class="Teaser2"><?php echo get_post_meta($post->ID, 'teaser', true); ?></h3>
		</a>
		  <?php endif; ?>
			<?php endwhile; wp_reset_query(); ?>
		  </div>	
		</div>

		<div class="newsletterReg">
			<?php dynamic_sidebar('Newsletter'); ?>
		</div>	
</div><!-- end panel 1-->
				

	 <div class="clearleft"></div>
	</div>
	 <div class="ticker">
      		<a href="http://www.twitter.com/medibankcf" target="_blank" class="twitterLink"></a>
			<div class="tickerText twitters" id="medibankFeed">
				<ul>
    <?php  
	require_once('TwitterAPIExchange.php');
    //Replace url in text with link.
	function makeHTTPLinks($text)
    {
    	return  preg_replace(
    		array(
    			'/(?(?=<a[^>]*>.+<\/a>)
         (?:<a[^>]*>.+<\/a>)
         |
         ([^="\']?)((?:https?|ftp|bf2|):\/\/[^<> \n\r]+)
     )/iex',
    			'/<a([^>]*)target="?[^"\']+"?/i',
    			'/<a([^>]+)>/i',
    			'/(^|\s)(www.[^<> \n\r]+)/iex',
    			'/(([_A-Za-z0-9-]+)(\\.[_A-Za-z0-9-]+)*@([A-Za-z0-9-]+)
   (\\.[A-Za-z0-9-]+)*)/iex'
    			),
    		array(
    			"stripslashes((strlen('\\2')>0?'\\1<a href=\"\\2\">\\2</a>\\3':'\\0'))",
    			'<a\\1',
    			'<a\\1 target="_blank">',
    			"stripslashes((strlen('\\2')>0?'\\1<a href=\"http://\\2\">\\2</a>\\3':'\\0'))",
    			"stripslashes((strlen('\\2')>0?'<a href=\"mailto:\\0\">\\0</a>':'\\0'))"
    			),
    		$text
    		);
    }
	
    function makeTwitterLinks($text)
	{
    	$text = preg_replace('/(?<=^|\s)@([a-z0-9_]+)/i',
    		'<a href="http://www.twitter.com/$1">@$1</a>',
    		$text);
		return $text;
	}
	
    $settings = array(
    	'oauth_access_token' => "240991449-9em6MW8ljYYurJdMYvy7mpSl3bWQE1OvO9Qjq8vg",
    	'oauth_access_token_secret' => "ZLQwbbiLUd17lq7kdQ30OgFFqo0FtsrM06Z94YlnvY",
    	'consumer_key' => "oteeWG0Nhrkqse9mdUw0hw",
    	'consumer_secret' => "LNLLZCTmKjWmD4lDrnQEBeuZKYfK5LsJCrPXn5lIsCw"
    	);
	
	$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
    $postfields = '?screen_name=MedibankCF&include_rts=true&count=5';
	$requestMethod = 'GET';
	
    $twitter = new TwitterAPIExchange($settings);
    $twitterResponse = $twitter->setGetfield($postfields)->buildOauth($url, $requestMethod)->performRequest();
    $twitterArray = json_decode($twitterResponse);
	

    foreach($twitterArray as $key=>$Value){
    	$str = makeHTTPLinks($Value->text);
    	$str = makeTwitterLinks($str);
    	echo "<li>$str</li>";

    }
	
	?>
                    
           		  </ul>               
			</div>
	  </div>

<?php get_footer(); ?>
