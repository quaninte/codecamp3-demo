<?php
$appId = '1437075503178768';
$appSecret = 'b4c32c7e5dcce84a19570fdcca64f9b4';

require 'functions.php';
?>

<?php
if (isset($_GET['code']) && $code = $_GET['code']) {
	$token_url="https://graph.facebook.com/oauth/access_token?"
			   . "client_id=" . $appId 
			   . "&redirect_uri=" . urlencode( getCurrentUrl())
			   . "&client_secret=" . $appSecret
			   . "&code=" . $code;
	$response = file_get_contents($token_url);
	$params = null;
	parse_str($response, $params);
	$accessToken = $params['access_token'];
	
	// get pages list
	$url = 'https://graph.facebook.com/fql?q='
	  	. urlencode('SELECT page_id, pic_square, name
				FROM page
				WHERE page_id IN (
					SELECT page_id FROM page_admin WHERE uid = me()
				)')
		. '&access_token=' . $accessToken;		
		;
	$pages = json_decode(file_get_contents($url), true);
?>
Chose page:
<form action="https://graph.facebook.com/me/photos" method="post">
	<input name="url" type="text" value="http://i.imgur.com/LGzXgsib.jpg">
	<input name="access_token" type="text" value="<?php echo $accessToken; ?>">
	<input name="message" type="text">
	<input type="submit">
<ul>
	<?php
		foreach ($pages['data'] as $page) {
			echo '<li><input type="radio" name="page_id" value="' . $page['page_id'] . '" /><img src="' . $page['pic_square'] . '">' . $page['name'] . '</li>';
		}
	?>
</ul>
</form>

<?php	
} else {
?>
<a href="https://www.facebook.com/dialog/oauth?client_id=<?php echo $appId; ?>&redirect_uri=<?php echo urlencode( getCurrentUrl()) ?>&scope=manage_pages,publish_actions,photo_upload,publish_stream">Login with facebook</a>
<?php
}