<?php
session_start();

//Include Google client library 
include_once 'vendor/autoload.php';
include_once 'vendor/google/apiclient-services/src/Google/Service/Oauth2.php';

/*
 * Configuration and setup Google API
 */
$client_id = '354970537307-udhlo09sg5jmfd7f7o3u45pcm3j9iv3a.apps.googleusercontent.com'; //Google client ID
$client_secret = 'XYHL-3bCL2eg3uS9b6ccHQfM'; //Google client secret
$redirect_url = 'http://localhost/Fundfolio1/'; //Callback URL

//Call Google API
$google_client = new Google_Client();
$google_client->setApplicationName('Login to Fundfolio using Google');
$google_client->setClientId($client_id);
$google_client->setClientSecret($client_secret);
$google_client->setRedirectUri($redirect_url);
$google_client->setScopes(array('https://www.googleapis.com/auth/plus.login', 'https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/plus.me', 'https://www.googleapis.com/auth/userinfo.profile'));
$google_oauth_v2 = new Google_Service_Oauth2($google_client);
?>