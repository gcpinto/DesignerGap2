<?php  

If ((isset($_SESSION['GapID'])))
// && ( $_SESSION['GapID']==Null))
{
//	if ( $_SESSION['GapID']==Null) header("Location: login.php");
//	else {
		return;
//	}
	
}
else {
	
	echo "redirec";
	header("Location: login.php");
}

?>


