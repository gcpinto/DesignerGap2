<?php
require_once '../base.php';
require_once 'validation.php';

echo gLogic::TryRemoveContent($_GET['id']);
?><br/><br /> <a href="content-management.php">Content Management</a>  
