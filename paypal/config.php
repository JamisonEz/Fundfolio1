<?php

  //start session in all pages
  if (session_status() == PHP_SESSION_NONE) { session_start(); } //PHP >= 5.4.0
  //if(session_id() == '') { session_start(); } //uncomment this line if PHP < 5.4.0 and comment out line above

	// sandbox or live
	define('PPL_MODE', 'sandbox');

	if(PPL_MODE=='sandbox'){
		
		define('PPL_API_USER', 'merchanthenal-facilitator-1_api2.gmail.com');
		define('PPL_API_PASSWORD', 'NDMB2BKBJN9G7RXT');
		define('PPL_API_SIGNATURE', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AnjtlaIA47ejnag.Vw99hWnHxWDz');
	}
	else{
		
		define('PPL_API_USER', '');
		define('PPL_API_PASSWORD', '');
		define('PPL_API_SIGNATURE', '');
	}
	
	define('PPL_LANG', 'EN');
	
	define('PPL_LOGO_IMG', 'images/logo.png');
	
        if($_SERVER['HTTP_HOST']!='localhost')
            $return_url = 'http://launchafolio.com/Fundfolio1-master/paypal/process.php';
        else
            $return_url = 'http://localhost/Fundfolio1/paypal/process.php';
	define('PPL_RETURN_URL', $return_url);
	define('PPL_CANCEL_URL', 'http://localhost/paypal/cancel_url.php');

	define('PPL_CURRENCY_CODE', 'USD');
