<?php
require_once '../base.php';
require_once 'validation.php';
echo gLogic::RemoveSubscription($_GET['id']);
?><br/><br /> <a href="Subscription-management.php">Source Management</a>  
