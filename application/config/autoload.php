<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| In order to keep the framework as light-weight as possible only the
| absolute minimal resources are loaded by default. For example,
| the database is not connected to automatically since no assumption
| is made regarding whether you intend to use it.  This file lets
| you globally define which systems you would like loaded with every
| request.
|
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------
|
| These are the things you can load automatically:
|
| 1. Packages
| 2. Libraries
| 3. Helper files
| 4. Custom config files
| 5. Language files
| 6. Models
|
*/

/*
| -------------------------------------------------------------------
|  Auto-load Packges
| -------------------------------------------------------------------
| Prototype:
|
|  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
|
*/

$autoload['packages'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
| These are the classes located in the system/libraries folder
| or in your application/libraries folder.
|
| Prototype:
|
|	$autoload['libraries'] = array('database', 'session', 'xmlrpc');
*/

$autoload['libraries'] = array('database', 'session', 'util', 'email', 'mail', 'mail_tpl', 'Pdf', 'invoice_tpl');


/*
| -------------------------------------------------------------------
|  Auto-load Helper Files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['helper'] = array('url', 'file');
*/

$autoload['helper'] = array('url', 'text');


/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['config'] = array('config1', 'config2');
|
| NOTE: This item is intended for use ONLY if you have created custom
| config files.  Otherwise, leave it blank.
|
*/

$autoload['config'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Language files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['language'] = array('lang1', 'lang2');
|
| NOTE: Do not include the "_lang" part of your file.  For example
| "codeigniter_lang.php" would be referenced as array('codeigniter');
|
*/

$autoload['language'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['model'] = array('model1', 'model2');
|
*/

$autoload['model'] = array(
	'm_user',
	'm_user_online',
	'm_content_category',
	'm_content',
	'm_nation',
	'm_mail',
	'm_message',
	'm_feedback',
	'm_photo',
	'm_tour',
	'm_tour_rate',
	'm_tour_departure',
	'm_tour_departure_rate',
	'm_tour_itinerary',
	'm_tour_category',
	'm_tour_activity',
	'm_tour_destination',
	'm_tour_tripnote',
	'm_tour_request',
	'm_visa',
	'm_visa_tips',
	'm_question',
	'm_hotel',
	'm_room',
	'm_room_rate',
	'm_hotel_category',
	'm_hotel_destination',
	'm_flight',
	'm_cuisine_category',
	'm_cuisine',
	'm_hotel_request',
	'm_review',
	'm_subscribe',
	'm_gallery',
	'm_embassy',
	'm_requirement',
	'm_testimonial',
	'm_meta',
	'm_redirect',
	'm_album_category',
	'm_album',
	'm_album_photo',
	'm_album_video',
	'm_vietnam_destination',
	'm_sight_category',
	'm_sight',
	'm_entertainment_category',
	'm_entertainment',
	'm_restaurant_category',
	'm_restaurant',
	'm_shopping_category',
	'm_shopping',
	'm_promotion_txt',
	'm_tooltip',
	'm_help_category',
	'm_help_content',
	'm_help_question',
	'm_team',
	'm_payment',
	'm_blog',
	'm_blog_comment',
	'm_blog_category',
	'm_vietnam_holiday',
	'm_tour_option',
	'm_tour_option_category'
);


/* End of file autoload.php */
/* Location: ./application/config/autoload.php */