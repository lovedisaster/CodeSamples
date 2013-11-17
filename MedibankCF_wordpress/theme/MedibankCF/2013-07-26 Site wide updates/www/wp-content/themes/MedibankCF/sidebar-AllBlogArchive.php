<?php
/**
 * @sidebar-AllBlogArchive
 */
require_once("wp-config.php");
?>

<div style="clear:both;"></div>
<h2>Real Story Archives</h2>
<?php 
unset($_SESSION['ArchiveType']);
$_SESSION['ArchiveType'] = ARCHIVE_INDICATOR_STOIRES;
//0 means search all categories including Ambassador Blogs,Guest Blogs and Real Story if that's removed in CMS, it has to be changed accordingly.
get_monthly_archives('0', ARCHIVE_CAP); ?>
