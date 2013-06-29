<?php
require_once 'base.php';

$browser = new Browser();

if ($browser->getPlatform()== Browser::PLATFORM_ANDROID)
{
	echo "IS AONDROID PLATAFORM";
	if ($browser->getBrowser()== Browser::BROWSER_ANDROID)
	{
		 echo "Browser Android";
	}
	elseif ($browser->getBrowser()== Browser::BROWSER_OPERA_MINI)
	{
		echo "Browser OPERA_MINI";
	}
}
elseif ($browser->getPlatform()== Browser::PLATFORM_IPAD) {
	echo "IS IPAD PLATAFORM";
}
elseif ($browser->getPlatform()== Browser::PLATFORM_IPOD) {
	echo "IS IPOD PLATAFORM";
}
elseif ($browser->getPlatform()== Browser::PLATFORM_WINDOWS) 
{
	echo "IS WIN PLATAFORM";
	if ($browser->getBrowser()== Browser::BROWSER_IE)
	{
		 echo "<br />Browser IE";
	}
	elseif ($browser->getBrowser()== Browser::BROWSER_FIREFOX)
	{
		echo "<br />Browser FIREFOX";
	}
	elseif ($browser->getBrowser()== Browser::BROWSER_OPERA)
	{
		echo "<br />Browser OPERA";
	}
	elseif ($browser->getBrowser()== Browser::BROWSER_CHROME)
	{
		echo "<br />Browser Chrome";
	}
}
elseif ($browser->getPlatform()== Browser::PLATFORM_APPLE) 
{
	echo "IS APPLE PLATAFORM";
}
elseif ($browser->getPlatform()== Browser::PLATFORM_LINUX) {
	echo "IS Linux PLATAFORM";
}	

?>