*********************************************************
UPDATE CONTENTS
*********************************************************
The old site had only footer links content editable in CMS, but hard coded the css(hardcoded every single partner background image) for each indvidual partner. 
Which brings the following issues:
	1. Partner images are not editable in CMS.
	2. The client can't add partners themselves. 
	3. If one partner is removed in CMS, the corresponding position is left blank rather than filled by the next 		   partner images.  
For future convinience and better code quality, footer partner link images are made editable in CMS now, and pagination are automated by program.



*********************************************************
INSTRUCTIONS
*********************************************************

1. Partner links images are editable in our_partner post. 
2. When inserting a new image, double check html code the image is not inserted in to a existing <a> tag! 
3. When deploy to live, all the partner images needs to be mannually added to our partner post. 
 
*********************************************************
KEY TESTING POINTS
*********************************************************

1. Count partner image number. 
2. Check paging and sliding effect. 
3. Test mannually adding image links in our partner page, whether effects to footer. 
4. Test when images are more than 6, whether pagination happens. 
5. Test when images are more than 12, whether pagination happens.

*********************************************************
By:Nathan Zhang
*********************************************************




