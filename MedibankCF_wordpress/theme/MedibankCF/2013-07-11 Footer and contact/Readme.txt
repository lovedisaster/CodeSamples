*********************************************************
UPDATE CONTENTS
*********************************************************
1> The old site had only footer links content editable in CMS, but hard coded the css(hardcoded every single partner background image) for each indvidual partner. 
Which brings the following issues:
	1. Partner images are not editable in CMS.
	2. The client can't add partners themselves. 
	3. If one partner is removed in CMS, the corresponding position is left blank rather than filled by the next 		   partner images.  
For future convinience and better code quality, footer partner link images are made editable in CMS now, and pagination are automated by program.

2> Other CMS change: Move "Australian Red Cross" in group with "Stephanie Alexander Kitchen Garden Foundation" in contact page. So as to fix Contact page styling issue. 
  

*********************************************************
INSTRUCTIONS
*********************************************************
1. When duplicating contact page changes to live, make sure copy "Australia Red Cross" div in "contactContainer". 
2. Partner links images are editable in our_partner post. 
3. When inserting a new image, double check html code the image is not inserted in to a existing <a> tag! 
4. When deploy to live, all the partner images needs to be mannually added to our partner post. 
 
*********************************************************
KEY TESTING POINTS
*********************************************************
1. Check contact page and footer.
2. Count partner image number. 
3. Check paging and sliding effect. 
4. Test mannually adding image links in our partner page, whether effects to footer. 
5. Test when images are more than 6, whether pagination happens. 
6. Test when images are more than 12, whether pagination happens.

*********************************************************
By:Nathan Zhang
*********************************************************


Backups:

POst content for Post "Our Partners":

<div class="scrollable">
<ul>
	<li class="hf"><a href="http://www.heartfoundation.org.au/" target="_blank">Heart Foundation</a></li>
	<li class="hp"><a href="http://www.hphpcentral.com" target="_blank">Healthy Parks Healthy People</a></li>
	<li class="ru"><a href="http://www.ruokday.com.au/content/home.aspx" target="_blank">R U OK?</a></li>
	<li class="sakg"><a href="http://www.kitchengardenfoundation.org.au/" target="_blank">Stephanie Alexander Kitchen Garden Program</a></li>
	<li class="sm"><a href="http://www.thesmithfamily.com.au/" target="_blank">The Smith Family - everyone's family</a></li>
	<li class="ya"><a href="http://www.yalari.org/" target="_blank">Yaliari</a></li>
</ul>
</div>
<div class="scrollable" style="display: none;">
<ul>
	<li class="rd"><a href="http://www.reddust.org.au/" target="_blank">Red Dust</a></li>
	<li class="pm"><a href="http://www.pacifichealth.org.nz" target="_blank">Pasifika Medical Association</a></li>
	<li class="trm"><a href="https://www.matatini.co.nz" target="_blank">TE RAU MATATINI</a></li>
	<li class="rc"><a href="http://www.redcross.org.au" target="_blank">Red Cross</a></li>
</ul>
</div>


