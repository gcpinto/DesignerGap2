<?php
  // Remember to copy files from the SDK's src/ directory to a
  // directory in your application on the server, such as php-sdk/
  require_once('base.php');

 //$op = $_POST['op'];
	 $op = $_REQUEST['op'];
	 //echo $domain;
	 //echo $op."--".$id;
 switch ($op)
 {
 	case 'GetData':
		{
			$domain = 1;//$_SESSIONS['Domain'];
			//echo "GetData";
			//echo glogic::GetContents($_POST['id'], $_POST['domain']);
			echo glogic::GetContents($domain, $_POST['id']);
			//echo "<div class=\"clear bgGray w90 h1px\">&nbsp;</div>";
			//echo "<script>refreshPane();</script>";
			//echo "TESTE";
			break;
		}
		case 'Getpweek':
		{
			$domain = 1;//$_SESSIONS['Domain'];
			//echo "GetData";
			//echo glogic::GetContents($_POST['id'], $_POST['domain']);
			echo glogic::GetContents($domain, $_POST['id']);
			//echo "<div class=\"clear bgGray w90 h1px\">&nbsp;</div>";
			//echo "<script>refreshPane();</script>";
			//echo "TESTE";
			break;
		}
		case 'Getptoday':
		{
			$domain = 1;//$_SESSIONS['Domain'];
			//echo "GetData";
			//echo glogic::GetContents($_POST['id'], $_POST['domain']);
			echo glogic::GetContents($domain, $_POST['id']);
			//echo "<div class=\"clear bgGray w90 h1px\">&nbsp;</div>";
			//echo "<script>refreshPane();</script>";
			//echo "TESTE";
			break;
		}
		case 'Getalltime':
		{
			$domain = 1;//$_SESSIONS['Domain'];
			//echo "GetData";
			//echo glogic::GetContents($_POST['id'], $_POST['domain']);
			echo glogic::GetContents($domain, $_POST['id']);
			//echo "<div class=\"clear bgGray w90 h1px\">&nbsp;</div>";
			//echo "<script>refreshPane();</script>";
			//echo "TESTE";
			break;
		}
		case 'UpdateHistory':
		{
			glogic::UpdateContentHistory($_POST['id']);
			break;
		}
		case 'subscriptions':
		{
			glogic::SaveSubscription($_POST['email']);
			break;
		}
		
 }
