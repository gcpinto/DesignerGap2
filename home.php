<?php
require_once 'base.php';
$externalpage = isset($_GET['share']) ? $_GET['share'] : null;
$face = gLogic::SetSocialTags($externalpage);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<html xml:lang="en" lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
	<link rel="stylesheet" type="text/css" href="css/<?php echo glogic::cssfile(); ?>" media="screen">
	<link type="text/css" href="css/jqModal.css" rel="stylesheet" media="all">
	<link type="text/css" href="css/teste.css" rel="stylesheet" media="all">
	<!-- styles needed by jScrollPane -->
	<link type="text/css" href="css/jquery.jscrollpane.css" rel="stylesheet" media="all">
	<link rel="stylesheet" type="text/css" href="css/jquery.jscrollpane.codrops1.css" rel="stylesheet" media="all">
	<!--link type="text/css" href="css/jquery.jscrollpane.codrops2.css" rel="stylesheet" media="all"-->
	<!-- html5.js for IE less than 9 -->
	<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!-- css3-mediaqueries.js for IE less than 9 -->
	<!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->
	
	<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
	<script type="text/javascript" src="js/jqModal.js"></script>
	<script type="text/javascript" src="js/scroll-startstop.events.jquery.js"></script>	
	<!-- the mousewheel plugin - optional to provide mousewheel support -->
	<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
	<!-- the jScrollPane script -->
	<script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>
	<!--script type="text/javascript" src="js/functions.js"></script-->
	<script type="text/javascript" src="js/mwheelIntent.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>
	
</head>
<body>
	<meta property="og:title" content="<?php echo $face->faceTitle;?>" />
	<meta property="og:url" content="<?php echo $face->faceUrl;?>" />
	<meta property="og:site_name" content="<?php echo $face->faceSiteName;?>" />
	
<center>
	<div id="pagewrap">
		
		<div id="head">
			<div id="logo">
				<div id="icon"></div>
				<div id="social">
					<div id="fb"><a href="http://www.facebook.com/loadinteractive" target="_blank"><img src="images/FB.png" /></a></div>
					<div id="tw"><a href="https://twitter.com/loadinteractive" 
									class="twitter-follow-button" data-show-count="false" target="_blank" onclick="twitter">
								<img src="images/TW.png" /></a>
					</div>
					<div id="rss">
						<a href="#" class="confirm"><img src="images/RSS.png" /></a>
					</div>
				</div>	
					
			</div>
			<!-- *************************************   -->	
					<!-- Confirm Dialog -->
					<div class="jqmConfirm" id="confirm">
						<div id="ex3b" class="jqmConfirmWindow">
						    <div class="jqmConfirmTitle clearfix">
						   	 <h1>Suscrition</h1>
						   	 <a href="#" class="jqmClose"><em>Close</em></a>
						  </div>
						  <div class="jqmConfirmContent">
						   	<form action="" method="post" id="subscriptions">
								<label id="subs">Email:</label>	 
								<input type="text" name="email" />
								<input type="submit" />
							</form>
						  </div>
						</div>
					</div>
					
			<!-- *************************************   -->
			<div id="top">
				<div id="topbar"><a href="#">About</a><a href="#">Advertise</a><a href="#">Contact</a></div>
				<div class="searchboxtop clear">
					<div class="search ">Search</div>
					<div class="clear bgOrange w100 fl h1px">&nbsp;</div>
					<div class="searchicon fr mtm22"></div>
				</div>
				<div class="advertiseblock dim1">
				<div id="adtext">Advertise here</div>
				</div>
			</div>
		</div>
		<div class="container clear">
			<div class="movebutton mt40">
				<ul>
				<li onclick="pageTabul('prev');"><img src="images/arrow_prev.png" /></li>
				<li onclick="pageTabul('next');"><img src="images/arrow_next.png" /></li>
				</ul>
			</div>
			<div class="selbutton">
				<ul>
				<li onclick="selTabul('lastest');" ><p>Lastest Topics</p></li> 
				<li onclick="selTabul('today');"><p>Popular Today</p></li>
				<li onclick="selTabul('week');"><p>Popular This Week</p></li> 
				<li onclick="selTabul('alltime');"><p>Popular All Time</p></li>
				</ul>
			</div>
			<div id="tabul">
			<ul class="tabul">
				<li> <?php 
						$list=glogic::GetAllContents(1);
						$i = 0;
						foreach ($list as $object)
					{
						if ($i==0)
							{
								echo '<h4>Lastest News</h4>';
								echo "<div class=\"clear bgOrange w100 h1px\">&nbsp;</div>";
								echo '<div id="jp-container-lnews" class="jp-container">';
							}
						$i++;
						echo '<div id="targetdiv" class="text mt40 clear"> <a href="'.$object->link.'" target="_blank" onclick="history('.$object->id.');">'.$object->title." </a></div>";
						echo "<div class=\"clear bgGray w90 h1px\">&nbsp;</div>";
						if ($i==3)
							{
								echo '<div class="advertiseblock dim2 mt40 mb40">
								<div id="adtext">Advertise Here </div>
								</div>';
							}
					}
					?> 
					</div>
					</li>
							<?php 
							if (isset($_GET['share_id']))
								{
								$obj = gLogic::GetContent($_GET['share_id']);
								}
							elseif (isset($_GET['share']))
								{
								//var_dump($_GET['share']);
								$obj = gLogic::GetContentbyTitle($_GET['share']);
								}
							if (isset($obj))
							{
							?>
								<div class="share">
									<div class="bgOrange w100 mt10 h1px"></div>
									<div class="click">
										<h6>Click the link below to view the original article</h6>
									</div>
									<div class="title">	
										<a href="<?php echo $obj->link; ?>" target="_blank" onclick="history(<?php echo $obj->id; ?>);"><?php echo $obj->title; ?></a>
									</div>
									<div class="share-social mtm21">
										<div class="fb mr5 fl">
											<a href="http://www.facebook.com/sharer.php?u=http://localhost/DesignerGap/home.php?share=Front-End%20Author%20Listing%20And%20User%20Search%20For&amp;t='Front-End Author Listing And User Search For'" target="_blank">
												<img src="images/FB.png" />
											</a>
										</div>
										<div class="tw mr10 fl">
											<a href="https://twitter.com/loadinteractive" 
												class="twitter-follow-button" data-show-count="false" target="_blank" onclick="twitter">
												<img src="images/TW.png" />
											</a>
										</div>
									</div>
									<div class="bgOrange w100 b0 mb10 h1px"></div>
								</div>
							<?php 
								}
							
							?>
					<li><?php 
						$now = new datetime();
						$today=glogic::TopToday($now);
						$i=0;
						//var_dump($top[0]);
						foreach ($today as $object)
					{
						if ($i==0)
							{
								echo '<h4>Popular Today</h4>';
								echo "<div class=\"clear bgOrange w100 h1px\">&nbsp;</div>";
								echo '<div id="jp-container-ptoday" class="jp-container">';
							}
						if (!isset($_GET['share_id']) or $i>3)
						{
							echo '<div id="targetdiv" class="text mt40 clear"> <a href="'.$object->link.'" target="_blank" onclick="history('.$object->id.');">'.$object->title." </a></div>";
							echo "<div class=\"clear bgGray w100 h1px\">&nbsp;</div>";
						}
						$i++;
						if ($i==3)
							{
								echo '<div class="advertiseblock dim2 mt40 mb40">
								<div id="adtext">Advertise Here</div>
								</div>';
							} 
					}
					?> 
					</div>
					</li>
				<li><?php 
						$now = new datetime();
						$week=glogic::TopWeek($now);
						$i=0;
						foreach ($week as $object)
					{
						if ($i==0)
							{
								echo '<h4>Popular This Week</h4>';
								echo "<div class=\"clear bgOrange w100 h1px\">&nbsp;</div>";
								echo '<div id="jp-container-pweek" class="jp-container">';
							}
						if (!isset($_GET['share_id']) or $i>3)
						{
						echo '<div id="targetdiv" class="text mt40 clear"> <a href="'.$object->link.'" target="_blank" onclick="history('.$object->id.');">'.$object->title." </a></div>";
						echo "<div class=\"clear bgGray w100 h1px\">&nbsp;</div>";
						}
						$i++;
						if ($i==3)
							{
								echo '<div class="advertiseblock dim2 mt40 mb40">
								<div id="adtext">Advertise Here</div>
								</div>';
							}
					}
					?> 
					</div>
					</li>
				<li> <?php 
						$list=glogic::TopAllTime();
						$i=0;
						foreach ($list as $object)
					{
						if ($i==0)
							{
								echo '<h4>All Time Favorites</h4>';
								echo "<div class=\"clear bgOrange w100 h1px\">&nbsp;</div>";
								echo '<div id="jp-container-alltime" class="jp-container">';
							}
						if (!isset($_GET['share_id']) or $i>3)
						{
						echo '<div id="targetdiv" class="text mt40 clear"> <a href="'.$object->link.'" target="_blank" onclick="history('.$object->id.');">'.$object->title." </a></div>";
						echo "<div class=\"clear bgGray w100 h1px\">&nbsp;</div>";
						}
						$i++;
						if ($i==3)
							{
								echo '<div class="advertiseblock dim2 mt40 mb40">
								<div id="adtext">Advertise Here</div>
								</div>';
							}
					}
					?> 
					</div>
					</li>
				</ul>
			</div>
			<div class="searchbox clear">
			<div class="search ">Search</div>
			<div class="clear bgOrange w100 fl h1px">&nbsp;</div>
			<div class="searchicon fr mtm22"></div>
			<div class="searchtext fr mtm22"></div>
			</div>
		</div>
		<div class="pagefooter clear">
			<div class="adcontainer clear">
					<ul class="adul clear">
			
						<li>
							<div class="advertiseblock1 dim3 mt40">
									<div id="adtext">Advertise Here</div>
							</div>
						</li>
						
						<li>
							<div class="advertiseblock2 dim3  mt40">
									<div id="adtext">Advertise Here</div>
							</div>
						</li>
						
					</ul>
			</div>
			<div class="footbox clear">
				<ul class="footul">
					<li> <?php 
							echo '<h4>What is this?</h4>';
							echo "<div class=\"clear bgOrange w100 h1px\">&nbsp;</div>";
							echo "<div class='mt40'><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
							Aliquam ante dui, tristique adipiscing suscipit at,
							elementum ut velit. Sed ultrices, lectus vel ornare pellentesque,
							sapien metus tincidunt lacus, ut hendrerit leo risus vitae velit. Suspendisse potenti.
							Maecenas interdum leo eget purus sagittis sagittis. Curabitur id viverra est. 
							Duis est lectus, vehicula ut auctor vitae, vulputate a sem.
							Proin quis massa id nunc condimentum vestibulum ac ac magna. 
							Praesent eget odio ac libero faucibus vulputate vel quis ipsum.</p></div>";
						?>				
					</li>
					<li><?php 
							echo '<h4>Who creat this?</h4>';
							echo "<div class=\"clear bgOrange w100 h1px\">&nbsp;</div>";
							//echo "<div class=\"text mt40\"><a href=".$object->link.">".$object->title.'</a></div>';
							//	echo "<div class=\"clear loadicon w100\">&nbsp;</div>";			
							?> 
							<div class="who"><a href="http://load-interactive.com/"><img src="images/load.png"/></a>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
								Aliquam ante dui, tristique adipiscing suscipit at,
								elementum ut velit. Sed ultrices, lectus vel ornare pellentesque,
								sapien metus tincidunt lacus, ut hendrerit leo risus vitae velit</div>
							<div id="fb"></div><div id="tw"></div>
					</li>
					<li> <?php 
									echo '<h4>Last Retweets</h4>';
									echo "<div class=\"clear bgOrange w100 h1px\">&nbsp;</div>";		
						?> 
						</li>
					<li> 
						<?php 
								echo '<h4>Follow us!</h4>';
								echo "<div class=\"clear bgOrange w100 h1px\">&nbsp;</div>";
					
						?>
						<div id="fb"></div><div id="tw"></div><div id="rss"></div> 
					</li>
				</ul>
			</div>
		</div>
		<div class="copyright clear mt40 mb20"> <br /><?php echo gLogic::GetCopyRight() ?></div>
		
	</div>
	</center>
</body>
</html>