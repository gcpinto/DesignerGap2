<?php
require_once '../base.php';
require_once 'validation.php';
echo gLogic::TryRemoveCategory($_GET['id']);
?><br/><br /> <a href="category-management.php">Category Management</a>  
