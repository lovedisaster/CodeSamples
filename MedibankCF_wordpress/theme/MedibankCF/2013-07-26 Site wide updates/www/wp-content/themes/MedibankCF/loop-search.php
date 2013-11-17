<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

require_once("wp-config.php");
?>

<?php
	/* Start the Loop.
	 *
	 * In Twenty Ten we use the same loop in multiple contexts.
	 * It is broken into three main parts: when we're displaying
	 * posts that are in the gallery category, when we're displaying
	 * posts in the asides category, and finally all other posts.
	 *
	 * Additionally, we sometimes check for whether we are on an
	 * archive page, a search page, etc., allowing for small differences
	 * in the loop on each template without actually duplicating
	 * the rest of the loop that is shared.
	 *
	 * Without further ado, the loop:
	 */ 
?>
<div class="searchResults">

<ul class="searchResult">
<?php if( is_search() )  :
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	query_posts("s=$s&paged=$paged&cat=31,26,6");
	$_SESSION['ArchiveType'] = ARCHIVE_INDICATOR_STOIRES;
	endif; 
?>
<?php while ( have_posts() ) : the_post(); ?>
<?php if(get_the_title()):?>
		<li>
		<span>
	<?php $categoryName = get_the_category();?>
	<a href="<?php bloginfo("home");echo "/";the_date('Y');echo "#";echo get_the_ID(); ?>"><?php the_title(); ?>
	<?php 
	/*
	$catParent = get_category_parents($categoryName[0]->cat_ID,false,'/',false);
	$cats = explode("/",$catParent);
	if(!empty($cats[0]))
	{
		if($cats[0] == "Ambassador Blogs" || $cats[0] == "Guest Blogs" || $cats[0] == "Real-Stories")
		{
			
		}elseif($cats[0] == "" )
		{
			
		}else{
		}
	}
	*/
	?>
</a>
</span>
</li>
<?php else:?>
<li>
<span>
	<?php $categoryName = get_the_category();?>
	<a href="<?php bloginfo("home");echo "/";the_date('Y');echo "#";echo get_the_ID(); ?>">No title
	<?php 
	/*
	$catParent = get_category_parents($categoryName[0]->cat_ID,false,'/',false);
	$cats = explode("/",$catParent);
	if(!empty($cats[0]))
	{
		if($cats[0] == "Ambassador Blogs" || $cats[0] == "Guest Blogs" || $cats[0] == "Real-Stories")
		{
			
		}elseif($cats[0] == "" )
		{
			
		}else{
		}
	}
	*/
	?>
</a>
</span>
</li>
<?php endif;?>
<?php endwhile; ?>
</ul>

</div>
<div class="newsletterReg right newsRegInSearchPage">
<form action="http://edm.nowmedia.com.au/t/r/s/jrihlkt/" method="post">
	<label for="getNewsletter">Get our newsletter</label>
	<input type="text" name="cm-jrihlkt-jrihlkt" id="jrihlkt-jrihlkt" class="txtBox" value="Email address" onfocus="if (this.value==&quot;Email address&quot;) this.value=&quot;&quot;;" onblur="if (this.value==&quot;&quot;) this.value=&quot;Email address&quot;;">
	<input type="image" value="" src="http://www.medibankcf.com.au/wp-content/themes/MedibankCF/images/btn_signUp.gif" class="button">
</form>
</div>
<div class="clearfix"></div>