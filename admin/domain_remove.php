<?php
require_once '../base.php';
require_once 'validation.php';

echo gLogic::TryRemoveDomain($_GET['id']);
?><br/><br /> <a href="showdomain.php">Show Domain</a>  <?php
?>
