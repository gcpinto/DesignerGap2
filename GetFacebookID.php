<?php
  // Remember to copy files from the SDK's src/ directory to a
  // directory in your application on the server, such as php-sdk/
  require_once('base.php');

  $config = array(
    'appId' => '***',
    'secret' => '****',
  );

  $facebook = new Facebook($config);
  $user_id = $facebook->getAccessToken();
 
  
	echo "Hello World";
	echo "Current logged in as <fb:name uid=\"$user_id\" />";
