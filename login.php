<?php

if (!session_id()) {
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

$permissions = array("email"); // You can add any of your own special permissions here. If you have any.

// Please add your own url for callback.php here.
// This url should be saved in your fb app settings also.
$Url = $hp -> getLoginUrl('https://localhost/fbapp/callback.php', $permissions );

// Login link.
echo '<a href="' . htmlspecialchars($Url) . '">Log in with FaceBook</a>';

?>
