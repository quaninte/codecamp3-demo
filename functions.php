<?php
  //require_once("facebook.php");
  
  $config = array(
  	'appId' => $appId,
  	'secret' => $appSecret,
  	'fileUpload' => true, // optional
  	'allowSignedRequest' => false, // optional, but should be set to false for non-canvas apps
  );
  
  //$facebook = new Facebook($config);


/**
 * Get current url
 * @return string
 */
function getCurrentUrl()
{
	$url = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	return $url;
}

/**
* Get content
*/
function getContent($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}