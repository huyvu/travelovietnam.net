<?php
// WEB ROOT URI
define("PROTOCOL",		(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://");
define("BASE_URL",		"http://localhost/new-travelo");
define("BASE_URL_HTTPS","http://localhost/new-travelo");
define("ADMIN_URL",		BASE_URL."/administrator/logon.html");
define("TPL_URL",		"/new-travelo/template/");
define("IMG_URL",		TPL_URL."images/");
define("CSS_URL",		TPL_URL."css/");
define("JS_URL",		TPL_URL."js/");

// WEB DATABASE
define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "root");
define("DATABASE", "travel");
define("DRIVER",   "mysql");

// USER LEVEL
define("USR_ROOT",		-1);
define("USR_ADMIN",		0);
define("USR_MODERATOR",	1);
define("USR_GENERAL",	2);
define("USR_TOUR",		3);
define("USR_HOTEL",		4);
define("USR_FLIGHT",	5);
define("USR_VISA",		6);
define("MODE_READ",		0);
define("MODE_WRITE",	1);

// USER DEFINE
define("SITE_NAME", 			"TraveloVietnam.Com");
define("TOLL_FREE", 			"+1-800-605-3168");
define("TELL", 					"(848) 6686 4039");
define("LOCAL_PHONE",			"(+84) 8.6686.4039");
define("HOTLINE",				"(+84) 909.343.525");
define("FAX",					"");
define("ADDRESS",				"184/1A Le Van Sy, Phu Nhuan district, Ho Chi Minh city, Vietnam.");

// define("MAIL_ADMIN",			"admins@travelovietnam.com");
define("MAIL_ADMIN",			"huy@vietnam-media.vn");
define("MAIL_INFO",				"info@travelovietnam.com");
define("MAIL_SALES",			"sales@travelovietnam.com");
define("MAIL_SUPPORT",			"info@travelovietnam.com");
define("MAIL_TOUR",				"tours@travelovietnam.com");
define("MAIL_HOTEL",			"info@travelovietnam.com");
define("MAIL_VISA",				"info@travelovietnam.com");
define("MAIL_FLIGHT",			"info@travelovietnam.com");
define("MAIL_PAYMENT",			"paypal@travelovietnam.com");
define("MAIL_PAYPAL",			"paypal@travelovietnam.com");
define("MAIL_FEEDBACK",			"info@travelovietnam.com");
define("PAYPAL_BUSINESS",		"paypal@travelovietnam.com");

// EX
define("USD_VND", 20800);

// LIVE MODE
define('G2S_SECRET_KEY',		'OXdboh2JpHmGxdQbiq89Hi9JyG4pFuPiAZgGnC0TyWmngeFfNfxwnimj8K4yx6QM');
define('G2S_MERCHANT_ID',		'3486823679499290452');
define('G2S_MERCHANT_SITE_ID',	'58461');
define('G2S_CURRENTCY',			'USD');
define('G2S_VERSION',			'3.0.0');

// SET VAR FOR ONEPAY
define('OP_PAYMENT_URL',		'https://onepay.vn/vpcpay/vpcpay.op?');
define('OP_QUERY_URL',			'https://onepay.vn/vpcpay/Vpcdps.op');//https://migs.mastercard.com.au/vpcdps'
define('OP_RETURN_URL',			'http://www.travelovietnam.com/payment.html');
define('OP_SECURE_SECRET',		'61984838DD606BA194A253B9312086C1');
define('OP_MERCHANT',			'OP_VNEVISA02');
define('OP_ACCESSCODE',			'DD6634CF');

// SET VAR FOR ONEPAY - TEST MODE
define('TEST_MODE', TRUE);
define('TEST_OP_PAYMENT_URL',	'http://mtf.onepay.vn/vpcpay/vpcpay.op?');
define('TEST_OP_QUERY_URL',		'https://onepay.vn/vpcpay/Vpcdps.op');//https://migs.mastercard.com.au/vpcdps'
define('TEST_OP_RETURN_URL',	'http://www.travelovietnam.com/payment.html');
define('TEST_OP_SECURE_SECRET',	'18D7EC3F36DF842B42E1AA729E4AB010');
define('TEST_OP_MERCHANT',		'TESTONEPAYUSD');
define('TEST_OP_ACCESSCODE',	'614240F4');

// SOCIAL LINKS
define('FACEBOOK',		'https://www.facebook.com/travelovietnam.services');
define('GOOGLEPLUS',	'https://plus.google.com/+Travelovietnamcompany');
define('TWITTER',		'https://twitter.com/vietnamsights');

// SOCIAL MEDIA ACCOUNT KEY AND SECRET
define('twitter_key',			'yWGku2bAetiDYu0rnHiw');
define('twitter_secret',		'avhZYAdVbsblIGEgq4xPVTifbGungvkXz3nhvXHxO2Y');

define('google_key',			'397622945009-50kknq4pn0b3sjhv6qu20agmt3rk2jfr.apps.googleusercontent.com');
define('google_secret',			'_LQ0ARBZc1J1L93s0ugdLslX');

define('flickr_key',			'0eb4d2b7268018af3a0332ce9b1fff08');
define('flickr_secret',			'a572e5388440ad94');

define('linkedin_key',			'75ikas494hntt4');
define('linkedin_secret',		'nnI9YKRGwfcl64Of');

define('facebook_key',			'208630569323561');
define('facebook_secret',		'21a467dc69d7f0b57c9f2bcbbbec57d4');

?>