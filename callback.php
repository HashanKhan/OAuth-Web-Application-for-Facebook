<?php

if(!session_id()) {
    session_start();
}
 
ini_set('display_errors', 1);
error_reporting(~0);

// Add the path to Facebook/autoload here.
// Please replace your own autoload.php path here.
require_once __DIR__ . '/vendor/facebook/graph-sdk/src/Facebook/autoload.php';

$fb_app = new Facebook\Facebook([
  'app_id' => '', // Replace your own app id here
  'app_secret' => '', // Replace your own secret here
  'default_graph_version' => 'v2.2',
  ]);

$hp = $fb_app->getRedirectLoginHelper();

$_SESSION['FBRLH_state']=$_GET['state'];

try {
  $accessToken = $hp->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
	
  // When Graph returns an error
  echo 'Error with the Graph: ' . $e->getMessage();
  
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
	
  // When validation fails or other local issues
  echo 'Facebook SDK Error: ' . $e->getMessage();
  
  exit;
}

// Checking the accessToken
if (! isset($accessToken)) {
  if ($hp->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $hp->getError() . "\n";
    echo "Error Code: " . $hp->getErrorCode() . "\n";
    echo "Error Reason: " . $hp->getErrorReason() . "\n";
    echo "Error Description: " . $hp->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}
 
$_SESSION['fb_access_token'] = (string) $accessToken;

 try {
  // Returns a `Facebook\FacebookResponse` object
  // You can add any field as you want in the object response.
  $response = $fb_app->get('me?fields=picture.width(300),name,email,id', $accessToken->getValue());
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Error with the Graph: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK Error: ' . $e->getMessage();
  exit;
}

$graphEdge = $response->getGraphNode();
$object = $response->getGraphObject();
$pic = $object->asArray('height');
$gen=uniqid();

// Download the Profile pic to given location
// Please give your own path where you want to save the profile picture.
copy($pic['picture']['url'], 'C:/wamp/www/fbapp/'.$gen.'.jpg');
  
// Create Image From Existing File
$jpg_image = imagecreatefromjpeg('frame.jpg');
$mypro=imagecreatefromjpeg($gen.'.jpg');

// Allocate A Color For The Text
$white = imagecolorallocate($jpg_image, 255, 255, 255);

// Set Path to Font File
$font_path = 'C:/wamp/www/fbapp/fonts.ttf';

// Print Text On Image
imagettftext($jpg_image, 22, 0, 230, 430, $white, $font_path, $object->getProperty('name'));
imagettftext($jpg_image, 22, 0, 235, 460, $white, $font_path, $object->getProperty('email'));
imagettftext($jpg_image, 18, 0, 240, 500, $white, $font_path, $object->getProperty('id'));

// Output and free memory
ob_start (); 

// Copy and merge
imagecopymerge($jpg_image, $mypro, 245, 75, 0, 0, 320, 320, 75);
imagejpeg ($jpg_image);

$image_data = ob_get_contents (); 
ob_end_clean (); 

$image_data_base64 = base64_encode ($image_data);

// Send Image to Browser
echo "<img src='data:image/jpeg;base64,$image_data_base64'>";

// Clear Memory
imagedestroy($jpg_image);

// Logout link.
echo '<a href="logout.php">Log out from Facebook</a>'; 

?>


 
