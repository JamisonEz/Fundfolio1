<?php
session_start();
// added in v4.0.0
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication('191869641282457','f9ca96e7b7630837a7ca779680359d31' );
// login helper with redirect_uri
    //$helper = new FacebookRedirectLoginHelper('http://demos.krizna.com/1353/fbconfig.php' );
	 
$helper = new FacebookRedirectLoginHelper('http://launchafolio.com/Fundfolio1-master/fb/fbconfig.php' );

		

try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
		$username = $graphObject->getProperty('username');
     	$fbid = $graphObject->getProperty('id');              // To Get Facebook ID
 	    $fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
	    $femail = $graphObject->getProperty('email');    // To Get Facebook email ID
	/* ---- Session Variables -----*/
	
	
	
	include("../functions.php");	
	$db = new DBController();
	$res = $db -> registerFbUser (  $fbid , $femail , $fbfullname , $fbid );

		
	
	$_SESSION['rana'] =  $response;           
	$_SESSION['GRAPH'] = $graphObject;           
	$_SESSION['USERNAME'] = $username;           

	$_SESSION['FBID'] = $fbid;           
	$_SESSION['FULLNAME'] = $fbfullname;
	$_SESSION['EMAIL'] =  $femail;
	
    /* ---- header location after session ----*/
  header("Location: ../index.php");
} else {
  $loginUrl = $helper->getLoginUrl();
 header("Location: ".$loginUrl);
}
?>