<?php
require_once '../base.php';
require_once 'validation.php';
echo gLogic::TryRemoveSource($_GET['id']);
?><br/><br /> <a href="source-management.php">Source Management</a>  
