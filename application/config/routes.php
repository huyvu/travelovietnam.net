<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "tours";
$route['404_override'] = 'error404';

$route['tours/interactive-maps'] = 'tours/interactive_maps';
$route['tours/package-tours'] = 'tours/package_tours';
$route['tours/short-tours'] = 'tours/short_tours';
$route['tours/daily-tours'] = 'tours/daily_tours';
$route['tours/top-destination'] = 'tours/top_destination';
$route['tours/featured-tours'] = 'tours/featured_tours';
$route['tours/cal-fees'] = 'tours/cal_fees';
$route['tours/booking/planning'] = 'tours/booking_planning';
$route['tours/booking/passengers'] = 'tours/booking_passengers';
$route['tours/booking/review'] = 'tours/booking_review';
$route['tours/booking-conditions'] = 'tours/booking_conditions';
$route['tours/clear-filter'] = 'tours/clear_filter';

$route['vietnam/culture-geography-history'] = 'vietnam/culture_geography_history';
$route['vietnam/life-style'] = 'vietnam/life_style';
$route['vietnam/life-style/(:any)'] = 'vietnam/life_style/$1';
$route['vietnam/festivals-events'] = 'vietnam/festivals_events';
$route['vietnam/festivals-events/(:any)'] = 'vietnam/festivals_events/$1';
$route['vietnam/travel-guide-for-beginner'] = 'vietnam/travel_guide_for_beginner';
$route['vietnam/travel-guide-for-beginner/(:any)'] = 'vietnam/travel_guide_for_beginner/$1';
$route['vietnam/travel-tips'] = 'vietnam/travel_tips';
$route['vietnam/travel-tips/(:any)'] = 'vietnam/travel_tips/$1';
$route['vietnam/travel-insurances'] = 'vietnam/travel_insurances';
$route['vietnam/travel-insurances/(:any)'] = 'vietnam/travel_insurances/$1';
$route['vietnam/travel-visa'] = 'vietnam/travel_visa';
$route['vietnam/travel-visa/(:any)'] = 'vietnam/travel_visa/$1';
$route['vietnam/money-cost'] = 'vietnam/money_cost';
$route['vietnam/money-cost/(:any)'] = 'vietnam/money_cost/$1';
$route['vietnam/top-destinations'] = 'vietnam/top_destinations';
$route['vietnam/top-destinations/(:any)'] = 'vietnam/top_destinations/$1';

$route['vietnam/sights/(:any)'] = 'vietnam/sights/$1';

$route['visa/download-application-from'] = 'visa/download_application_form';
$route['visa/check-visa-fee'] = 'visa/check_visa_fee';
$route['visa/do-confirm-nationality'] = 'visa/do_confirm_nationality';
$route['visa/vietnam-embassies'] = 'visa/vietnam_embassies';
$route['visa/vietnam-embassies/(:any)'] = 'visa/vietnam_embassies/$1';

$route['terms-and-conditions'] = 'terms_and_conditions';
$route['privacy-policy'] = 'privacy_policy';
$route['cancel-and-refund'] = 'cancel_and_refund';
$route['money-back-guarantee'] = 'money_back_guarantee';
$route['safety-payment'] = 'safety_payment';
$route['customer-support'] = 'support';

$route['payment-online'] = "payment_online";
$route['payment-online/proceed'] = "payment_online/proceed";
$route['payment-online/success'] = "payment_online/success";
$route['payment-online/success/(:any)'] = "payment_online/success/$1";
$route['payment-online/failure'] = "payment_online/failure";
$route['payment-online/failure/(:any)'] = "payment_online/failure/$1";

$route['member/payment-failure'] = "member/payment_failure";
$route['member/payment-failure/(:any)'] = "member/payment_failure/$1";
$route['member/payment-success'] = "member/payment_success";
$route['member/payment-success/(:any)'] = "member/payment_success/$1";

$route['blog/tags/(:any)'] = "blog/tags/$1";
$route['blog/category/(:any)'] = "blog/category/$1";
$route['blog/comment'] = "blog/comment";
$route['blog/active_comment'] = "blog/active_comment";
$route['blog/(:any)'] = "blog/view/$1/$2";

$route['vietnam-holidays'] = "vietnam_holiday";
$route['vietnam-holidays/(:any)'] = "vietnam_holiday/index/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */