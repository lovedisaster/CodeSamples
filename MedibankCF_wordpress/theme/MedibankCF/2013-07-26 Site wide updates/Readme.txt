*********************************************************
UPDATE CONTENTS
*********************************************************
1. Restrict Post number to 6 for news& real stroy pages.
2. Duplicate image size in 'News' template to 'Real Story' page.
3. Merge 'Real story','Guest Blogs', 'Ambassador Blog' posts in to the same archive page and enable monthly archive list till the latest date.
4. Add search functions for story blogs, and link search result to the corresponding anchor to archive page. 
5. Remove tittwer menu in right upper corner. 
6. Restrict related news to 3. 

*********************************************************
INSTRUCTIONS
*********************************************************

1. Remove menu items which links to Guest Blog and Ambassador Blog page. 
2. Add menu item which links to Real Story page CMS -> Appearance -> Menus -> realstoriesnav tab.. 
3. Remove twitter menu in CMS -> Appearance -> Menus -> top tab.  
4. By change configuration numbers you can reset post and related news cap. 
 
*********************************************************
KEY TESTING POINTS
*********************************************************
1. Test Post number limits in news & real story pages by changing 'BLOG_CAP' in wp-config.php. 
2. Check post list thumb size changed for real story page.
3. Test new Real story page. 
4. Test real story archive pages
  1> Should include 'Guest blogs','Ambassador Blogs', 'Real stroy' posts in one page.
  2> Should diplay till the latest month which has posts in any of the three above mentioned categories.  
  3> Should have anchor which is the post id for each post in list. 
5. Check whether search box is put in hearder and news letter box moved to the right bottom corner. 
6. Test search functions, pick keyword in a post title and see whether corresponding post is returned. 
7. Test click result link whether navigates to the anchor of the corresponding story post. 
8. Test no result page. 
9. Test listing style, bullet buttons, two lines title...
10. Test newsletter form in search result page. 
11. Double check twitter menu removed
12. Double check related news under 'Programe & Events' tab are restricted to 3.
13. By change 'RELATED_NEWS_CAP' in wp-config.php file,  

*********************************************************
By:Nathan Zhang
*********************************************************




