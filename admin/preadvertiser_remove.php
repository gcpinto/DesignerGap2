<?php
require_once '../base.php';
require_once 'validation.php';
echo gLogic::TryRemovePreadvertiser($_GET['id']);
?><br/><br /> <a href="pub-management.php">PUB Management</a>  
