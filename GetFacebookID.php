<?php
  // Remember to copy files from the SDK's src/ directory to a
  // directory in your application on the server, such as php-sdk/
  require_once('base.php');

  $config = array(
    'appId' => '334240503307795',
    'secret' => 'd0a9429be98e540d4de5718402a92f86',
  );

  $facebook = new Facebook($config);
  $user_id = $facebook->getAccessToken();
 
  
	echo "Hello World";
	echo "Current logged in as <fb:name uid=\"$user_id\" />";