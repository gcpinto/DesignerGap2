<div class="Domain">

<?php
require_once '../base.php';
require_once 'validation.php';
$_SESSION['domain']=$_GET['id'];
header("Location: domain_management.php")
//echo gLogic::ShowManagement($_SESSION['domain']);
?>
	
</div>
<a href="domain_management.php"> Management </a>