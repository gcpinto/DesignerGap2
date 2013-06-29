<?php
  // Remember to copy files from the SDK's src/ directory to a
  // directory in your application on the server, such as php-sdk/
  require_once('base.php');

  // Username: gpinto
  // Bitly App Key :R_9d95e406485f87c56532206a2c4c7256
  $longUrl=($_GET['url']);
  $result = bitly_v3_shorten($longUrl);
  var_dump($result);
  echo "<a href=".$result['url'].">Short URL</a>";