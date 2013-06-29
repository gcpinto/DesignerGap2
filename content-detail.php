
<?php
require_once 'base.php';
echo gLogic::GetContentDetail($_GET['id']);

?>
		<script>function fbs_click() 
		{u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='
			+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');
		return false;}
		</script>
		<style> html .fb_share_button 
		{ 
		display: -moz-inline-block; display:inline-block; padding:1px 20px 0 5px; height:15px; border:1px solid #d8dfea; 
		background:url(http://static.ak.facebook.com/images/share/facebook_share_icon.gif?6:26981) no-repeat top right; 
		} 
		html .fb_share_button:hover 
		{ color:#fff; border-color:#295582; 
		background:#3b5998 url(http://static.ak.facebook.com/images/share/facebook_share_icon.gif?6:26981) 
		no-repeat top right; text-decoration:none; }
		</style> 
<!-- Facebook Button -->
<a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" class="fb_share_button" onclick="return fbs_click()" target="_blank" style="text-decoration:none;">Share</a>
<!-- / Facebook Button -->
<!-- Tweet Button -->
<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="YOUR-TWITTER-USERNAME">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<!-- / Tweet Button -->  
<br /><a href="category.php"><h3>HOME - Category</h3></a>
<br /><a href="links.php"><h3>HOME - Links</h3></a>