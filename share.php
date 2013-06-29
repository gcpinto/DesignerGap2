<?php
require_once 'base.php';

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/<?php echo glogic::cssfile(); ?>">
	<link type="text/css" href="css/jquery.jscrollpane.css" rel="stylesheet" media="all">
	<link rel="stylesheet" type="text/css" href="css/jquery.jscrollpane.codrops1.css" rel="stylesheet" media="all">
	<!-- html5.js for IE less than 9 -->
	<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!-- css3-mediaqueries.js for IE less than 9 -->
	<!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->
	<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
	<script type="text/javascript" src="js/scroll-startstop.events.jquery.js"></script>
	<!-- the mousewheel plugin - optional to provide mousewheel support -->
	<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
	<!-- the jScrollPane script -->
	<script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>
	<!--script type="text/javascript" src="js/functions.js"></script-->
	<script type="text/javascript" src="js/mwheelIntent.js"></script>
	<script type="text/javascript" src="js/scrollpane.js"></script>
</head>
<body>
<center>
	<div id="pagewrap">
		
		<div id="head">
			<div id="logo">
				<div id="icon"></div>
				<div id="social"><div id="fb"></div><div id="tw"></div><div id="rss"></div></div>	
			</div>
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
			<div class="mt40">
			<div class="movebutton">
			<a onclick="pageTabul('prev');">prev</a> | <a onclick="pageTabul('next');">next</a>
			</div>
			<div class="selbutton">
			<a onclick="selTabul('lastest');">Lastest Topics</a> | <a onclick="selTabul('today');">Popular Today</a> |
			<a onclick="selTabul('week');">Popular This Week</a> | <a onclick="selTabul('alltime');">Popular All Time</a>
			</div></div>
			<div id="tabul">
			<ul class="tabul">
				<li> <?php 
						$list=glogic::GetAllContents(1);
						$i = 0;
						$obj = array();
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
						//$obj = $object;	
					}
					
					?> 
					</div>
					</li>
					<?php 
						if (isset($_GET['share_id']))
						{
							$obj = gLogic::GetContent($_GET['share_id'])
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
								<div class="fb mr5 fl"></div><div class="tw mr10 fl"></div>
							</div>
							<div class="bgOrange w100 b0 mb10 h1px"></div>
						</div>
					<?php 
						}
					?>
					<li><?php 
						$top=glogic::top();
						$i=0;
						//var_dump($top[0]);
						foreach ($top[0] as $object)
					{
						if ($i==0)
							{
								echo '<h4>Popular Today</h4>';
								echo "<div class=\"clear bgOrange w100 h1px\">&nbsp;</div>";
								echo '<div id="jp-container-ptoday" class="jp-container">';
							}
							echo '<div id="targetdiv" class="text mt40 clear"> <a href="'.$object->link.'" target="_blank" onclick="history('.$object->id.');">'.$object->title." </a></div>";
							echo "<div class=\"clear bgGray w100 h1px\">&nbsp;</div>";
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
						//$list=glogic::GetAllContents(1);
						$i=0;
						foreach ($top[1] as $object)
					{
						if ($i==0)
							{
								echo '<h4>Popular This Week</h4>';
								echo "<div class=\"clear bgOrange w100 h1px\">&nbsp;</div>";
								echo '<div id="jp-container-pweek" class="jp-container">';
							}
						echo '<div id="targetdiv" class="text mt40 clear"> <a href="'.$object->link.'" target="_blank" onclick="history('.$object->id.');">'.$object->title." </a></div>";
						echo "<div class=\"clear bgGray w100 h1px\">&nbsp;</div>";
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
						//$list=glogic::GetAllContents(1);
						$i=0;
						foreach ($top[2] as $object)
					{
						if ($i==0)
							{
								echo '<h4>All Time Favorites</h4>';
								echo "<div class=\"clear bgOrange w100 h1px\">&nbsp;</div>";
								echo '<div id="jp-container-alltime" class="jp-container">';
							}
						echo '<div id="targetdiv" class="text mt40 clear"> <a href="'.$object->link.'" target="_blank" onclick="history('.$object->id.');">'.$object->title." </a></div>";
						echo "<div class=\"clear bgGray w100 h1px\">&nbsp;</div>";
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
					$i = 0;
					if ($i==0)
						{
							echo '<h4>What is this?</h4>';
							echo "<div class=\"clear bgOrange w100 h1px\">&nbsp;</div>";
							$i++;
						}
					
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
						$list="TEXT";
						$i=0;
						if ($i==0)
							{
								echo '<h4>Who creat this?</h4>';
								echo "<div class=\"clear bgOrange w100 h1px\">&nbsp;</div>";
								$i++;
							}
						//echo "<div class=\"text mt40\"><a href=".$object->link.">".$object->title.'</a></div>';
					//	echo "<div class=\"clear loadicon w100\">&nbsp;</div>";			
					?> 
					<div class="who"><img src="images/load.png"/>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
						Aliquam ante dui, tristique adipiscing suscipit at,
						elementum ut velit. Sed ultrices, lectus vel ornare pellentesque,
						sapien metus tincidunt lacus, ut hendrerit leo risus vitae velit</div>
					<div id="fb"></div><div id="tw"></div>
					</li>
				<li> <?php 
						$list=glogic::GetAllContents(2);
						$i=0;
						foreach ($list as $object)
					{
						if ($i==0)
							{
								echo '<h4>Last Retweets</h4>';
								echo "<div class=\"clear bgOrange w100 h1px\">&nbsp;</div>";
							}
						echo "<div class=\"text mt40\"><a href=".$object->link.">".$object->title."</a></div>";
						$i++;
					}				
					?> 
					</li>
				<li> <?php 
					$list=glogic::GetAllContents(2);
					$i=0;
					foreach ($list as $object)
				{
					if ($i==0)
						{
							echo '<h4>Follow us!</h4>';
							echo "<div class=\"clear bgOrange w100 h1px\">&nbsp;</div>";
						}
					echo "<div class='text mt40'><a href=".$object->link.">".$object->title."</a></div>";
					$i++;
				}
				?>
				<div id="fb"></div><div id="tw"></div><div id="rss"></div> 
				</li>
			</ul>
			</div>
		</div>
		<div class="copyright clear mt40"> <br /><?php echo gLogic::GetCopyRight() ?></div>
		
	</div>
	</center>
</body>
</html>