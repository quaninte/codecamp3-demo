<?php
$appId = '1437075503178768';
$appSecret = 'b4c32c7e5dcce84a19570fdcca64f9b4';

require 'functions.php';
?>

<a href="https://www.facebook.com/dialog/oauth?client_id=<?php echo $appId; ?>&redirect_uri=<?php echo urlencode( getCurrentUrl()) ?>">Login with facebook</a>