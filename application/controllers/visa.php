<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Visa extends CI_Controller {

	public function index()
	{
		redirect("http://www.vietnam-evisa.org/", "location");
		
		$view_data = "";
		$view_data['nations'] = $this->m_nation->getItems();
		
		$tmpl_content['content']   = $this->load->view("visa/index", $view_data, TRUE);
		$this->load->view('layout/visa', $tmpl_content);
	}
	
	public function processing()
	{
		$view_data = "";

		$tmpl_content['content']   = $this->load->view("visa/processing", $view_data, TRUE);
		$this->load->view('layout/visa', $tmpl_content);
	}
	
	public function fees()
	{
		$view_data = "";

		$tmpl_content['content']   = $this->load->view("visa/fees", $view_data, TRUE);
		$this->load->view('layout/visa', $tmpl_content);
	}
	
	public function services()
	{
		$view_data = "";

		$tmpl_content['content']   = $this->load->view("visa/services", $view_data, TRUE);
		$this->load->view('layout/visa', $tmpl_content);
	}
	
	public function faqs()
	{
		$view_data = "";

		$tmpl_content['content']   = $this->load->view("visa/faqs", $view_data, TRUE);
		$this->load->view('layout/visa', $tmpl_content);
	}
	
	public function news()
	{
		$cat = $this->m_content_category->load('visa-news');
		$info->catid = $cat->id;
		
		$view_data = "";
		$view_data['items'] = $this->m_content->getItems($info);

		$tmpl_content['content']   = $this->load->view("visa/news", $view_data, TRUE);
		$this->load->view('layout/visa', $tmpl_content);
	}
	
	public function download_application_form()
	{
		$view_data = "";

		$tmpl_content['content']   = $this->load->view("visa/faqs", $view_data, TRUE);
		$this->load->view('layout/visa', $tmpl_content);
	}
	
	public function extension()
	{
		$cat = $this->m_content_category->load('visa-extension');
		$info->catid = $cat->id;
		
		$view_data = "";
		$view_data['items'] = $this->m_content->getItems($info);

		$tmpl_content['content']   = $this->load->view("visa/extension", $view_data, TRUE);
		$this->load->view('layout/visa', $tmpl_content);
	}
	
	public function answers($offset=0)
	{
		// Questions
		$info->topLevel = 1;
		$info->term = (!empty($_POST["term"]) ? $_POST["term"] : "");
		$items = $this->m_question->getItems($info, 1);
        
		$view_data = "";
		$view_data['offset'] = $offset;
		$view_data['items']  = $items;
		
		$tmpl_content = "";
		$tmpl_content['meta']['title'] = "Ask and Answer about Vietnam Visa";
		$tmpl_content['content']   = $this->load->view("visa/questions", $view_data, TRUE);
		$this->load->view('layout/visa', $tmpl_content);
	}
	
	public function vietnam_embassies($nation=NULL)
	{
		if (!empty($nation)) {
			if (!empty($_GET["embassy"])) {
				$nation = $_GET["embassy"];
				redirect("visa/embassies/".$nation, "location");
				die();
			}
			$info->nation = $nation;
			
			$view_data = "";
			$view_data['nation']	= $this->m_nation->load($nation);
			$view_data['nations']	= $this->m_nation->getItems();
			$view_data['item']		= $this->m_embassy->getItem($info);
			
			$tmpl_content = "";
			$tmpl_content['content']   = $this->load->view("visa/vietnam_embassy", $view_data, TRUE);
			$this->load->view('layout/visa', $tmpl_content);
		} else {
			$view_data = "";
			$view_data['nations'] = $this->m_nation->getItems();
			
			$tmpl_content = "";
			$tmpl_content['content']   = $this->load->view("visa/vietnam_embassies", $view_data, TRUE);
			$this->load->view('layout/visa', $tmpl_content);
		}
	}
	
	public function tips()
	{
		$view_data = "";
		$view_data['items'] = $this->m_visa_tips->getItems(NULL, 1);
		
		$tmpl_content = "";
		$tmpl_content['content']   = $this->load->view("visa/vietnam_visa_tips", $view_data, TRUE);
		$this->load->view('layout/visa', $tmpl_content);
	}
	
	public function requirements()
	{
		$nations = $this->m_nation->getItems();
		$citizen = (!empty($_POST["citizen"]) ? $_POST["citizen"] : "Afghanistan");
		$item    = null;
		
		if (!empty($citizen)) {
			$info->alias = $citizen;
			$item = $this->m_requirement->getItem($info, 1);
		}
		
		$view_data = "";
		$view_data["nations"] = $nations;
		$view_data["citizen"] = $citizen;
		$view_data["item"]    = $item;
		
		$tmpl_content = "";
		$tmpl_content['meta']['title'] = "Vietnam visa for ".(($item != null) ? $item->citizen : "")." citizens, passport holders, residents";
		$tmpl_content['content']   = $this->load->view("visa/requirements", $view_data, TRUE);
		$this->load->view('layout/visa', $tmpl_content);
	}
	
	public function testimonials()
	{
		$this->load->view('visa/search');
	}
	
	public function check_status()
	{
		$this->load->view('visa/search');
	}
	
	public function view()
	{
		$this->load->view('visa/detail');
	}
	
	public function check_visa_fee()
	{
		$info->visa_type		= (!empty($_POST["visa_type"]) ? $_POST["visa_type"] : "1ms");
		$info->group_size		= (!empty($_POST["group_size"]) ? $_POST["group_size"] : 1);
		$info->processing_time	= (!empty($_POST["processtime"]) ? $_POST["processtime"] : "Normal");
		$visa_fee = $this->util->calVisaFee($info->visa_type, $info->group_size, $info->processing_time);
		echo $visa_fee->total_fee." USD";
	}
	
	public function prepare()
	{
		// Remove all sessions if user click on "Apply Online" menu
		$this->session->unset_userdata("step1");
		
		$step1->visa_type				= "1ms";
		$step1->embassies				= "";
		$step1->group_size				= 1;
		$step1->visit_purpose			= "";
		$step1->arrival_port			= "";
		$step1->processing_time			= "Normal";
		$step1->airport_fast_checkin	= 0;
		$step1->car_pickup				= 0;
		$step1->car_type				= "Private Car";
		$step1->num_seat				= 4;
		$step1->entry_page				= "apply-visa";
		$step1->promotion_type			= "1ms";
		$step1->promotion_code			= "";
		$step1->discount				= 0;
		$step1->fullname[1]				= "";
		$step1->gender[1]				= "Male";
		$step1->birthdate[1]			= "";
		$step1->birthmonth[1]			= "";
		$step1->birthyear[1]			= "";
		$step1->nationality[1]			= "";
		$step1->passportnumber[1]		= "";
		$step1->flightnumber			= "";
		$step1->arrivaltime				= "";
		$step1->arrivaldate				= "";
		$step1->arrivalmonth			= "";
		$step1->arrivalyear				= "";
		$step1->exitdate				= "";
		$step1->exitmonth				= "";
		$step1->exityear				= "";
		$step1->contact_email			= "";
		$step1->contact_email2			= "";
		$step1->comment					= "";
		$step1->payment					= "";
		$step1->nationalityConfirmed	= false;
		
		//Cal fees
		$visa_fee = $this->util->calVisaFee($step1->visa_type, $step1->group_size, $step1->processing_time);
		$step1->service_fee			= $visa_fee->service_fee;
		$step1->stamp_fee			= $visa_fee->stamp_fee;
		$step1->rush_fee			= $visa_fee->rush_fee;
		$step1->total_service_fee	= $visa_fee->total_fee;
		
		$step1->airport_fast_checkin_fee		= 0;
		$step1->airport_fast_checkin_total_fee	= 0;
		
		$step1->car_fee			= 0;
		$step1->car_total_fee	= 0;
		
		$step1->total_fee	= $step1->total_service_fee + $step1->airport_fast_checkin_total_fee + $step1->car_total_fee;
		
		$this->session->set_userdata("step1", $step1);
	}
	
	public function apply()
	{
		$this->prepare();
		
		$step1 = $this->session->userdata("step1");
		
		if (!empty($_POST))
		{
			$step1->visa_type		= (!empty($_POST["visa_type"]) ? $_POST["visa_type"] : "1ms");
			$step1->group_size		= (!empty($_POST["group_size"]) ? $_POST["group_size"] : 1);
			$step1->visit_purpose	= (!empty($_POST["visit_purpose"]) ? $_POST["visit_purpose"] : "");
			$step1->processing_time	= (!empty($_POST["processing"]) ? $_POST["processing"] : "Normal");
			
			for ($cnt=1; $cnt<=$step1->group_size; $cnt++)
			{
				$step1->fullname[$cnt]				= "";
				$step1->gender[$cnt]				= "Male";
				$step1->birthdate[$cnt]			= "";
				$step1->birthmonth[$cnt]			= "";
				$step1->birthyear[$cnt]			= "";
				$step1->nationality[$cnt]			= "";
				$step1->passportnumber[$cnt]		= "";
			}
			
			$this->session->set_userdata("step1", $step1);
		}
		
		$this->step1();
	}
	
	public function rush()
	{
		$this->prepare();
		
		$step1 = $this->session->userdata("step1");
		
		$step1->processing_time			= "Emergency";
		
		$this->session->set_userdata("step1", $step1);
		
		$this->step1();
	}
	
	function step1()
	{
		$step1 = $this->session->userdata("step1");
		
		if ($step1 == null) {
			$this->prepare();
		}

		$view_data = "";
		$view_data["step1"] = $step1;
		$view_data["nationalityConfirm"] = $this->checkNationality();
		
		$tmpl_content['content']   = $this->load->view("visa/apply_visa_step1", $view_data, TRUE);
		$this->load->view('layout/visa', $tmpl_content);
	}
	
	function step2()
	{
		$step1 = $this->session->userdata("step1");
		
		if ($step1 == null) {
			redirect(BASE_URL_HTTPS."/visa/step1", "location");
		}
		
		if (!empty($_POST)) {
			$step1->visa_type				= (!empty($_POST["visa_type"]) ? $_POST["visa_type"] : "1ms");
			$step1->embassies				= (!empty($_POST["embassies"]) ? $_POST["embassies"] : "");
			$step1->group_size				= (!empty($_POST["group_size"]) ? $_POST["group_size"] : 1);
			$step1->visit_purpose			= (!empty($_POST["visit_purpose"]) ? $_POST["visit_purpose"] : "");
			$step1->arrival_port			= (!empty($_POST["arrival_port"]) ? $_POST["arrival_port"] : "");
			$step1->processing_time			= (!empty($_POST["processtime"]) ? $_POST["processtime"] : "Normal");
			$step1->airport_fast_checkin	= (!empty($_POST["airport_fast_checkin"]) ? $_POST["airport_fast_checkin"] : (!empty($_POST["vip_fast_checkin"]) ? $_POST["vip_fast_checkin"] : 0));
			$step1->car_pickup				= (!empty($_POST["car_pickup"]) ? $_POST["car_pickup"] : 0);
			$step1->car_type				= (!empty($_POST["car_type"]) ? $_POST["car_type"] : "Private Car");
			$step1->num_seat				= (!empty($_POST["num_seat"]) ? $_POST["num_seat"] : 0);
			$step1->entry_page				= (!empty($_POST["entry_page"]) ? $_POST["entry_page"] : "apply-visa");
			
			for ($i=1; $i<=$step1->group_size; $i++) {
				$step1->fullname[$i]		= (!empty($_POST["fullname_{$i}"]) ? $_POST["fullname_{$i}"] : "");
				$step1->gender[$i]			= (!empty($_POST["gender_{$i}"]) ? $_POST["gender_{$i}"] : "Male");
				$step1->birthdate[$i]		= (!empty($_POST["birthdate_{$i}"]) ? $_POST["birthdate_{$i}"] : "");
				$step1->birthmonth[$i]		= (!empty($_POST["birthmonth_{$i}"]) ? $_POST["birthmonth_{$i}"] : "");
				$step1->birthyear[$i]		= (!empty($_POST["birthyear_{$i}"]) ? $_POST["birthyear_{$i}"] : "");
				$step1->nationality[$i]		= (!empty($_POST["nationality_{$i}"]) ? $_POST["nationality_{$i}"] : "");
				$step1->passportnumber[$i]	= (!empty($_POST["passportnumber_{$i}"]) ? $_POST["passportnumber_{$i}"] : "");
			}
			
			$step1->task				= (!empty($_POST["task"]) ? $_POST["task"] : "");
			$step1->arrivaldate			= (!empty($_POST["arrivaldate"]) ? $_POST["arrivaldate"] : "");
			$step1->arrivalmonth		= (!empty($_POST["arrivalmonth"]) ? $_POST["arrivalmonth"] : "");
			$step1->arrivalyear			= (!empty($_POST["arrivalyear"]) ? $_POST["arrivalyear"] : "");
			$step1->exitdate			= (!empty($_POST["exitdate"]) ? $_POST["exitdate"] : "");
			$step1->exitmonth			= (!empty($_POST["exitmonth"]) ? $_POST["exitmonth"] : "");
			$step1->exityear			= (!empty($_POST["exityear"]) ? $_POST["exityear"] : "");
			$step1->flightnumber		= (!empty($_POST["flightnumber"]) ? $_POST["flightnumber"] : "");
			$step1->arrivaltime			= (!empty($_POST["arrivaltime"]) ? $_POST["arrivaltime"] : "");
			$step1->contact_email		= (!empty($_POST["contact_email"]) ? $_POST["contact_email"] : "");
			$step1->contact_email2		= (!empty($_POST["contact_email2"]) ? $_POST["contact_email2"] : "");
			$step1->comment				= (!empty($_POST["comment"]) ? $_POST["comment"] : "");
			$step1->payment				= "";
			$step1->nationalityConfirmed= false;
			
			if ($step1->task == "Emergency") {
				$step1->processing_time	= "Emergency";
			}
			
			//Cal fees
			$visa_fee = $this->util->calVisaFee($step1->visa_type, $step1->group_size, $step1->processing_time);
			$step1->service_fee			= $visa_fee->service_fee;
			$step1->stamp_fee			= $visa_fee->stamp_fee;
			$step1->rush_fee			= $visa_fee->rush_fee;
			$step1->total_service_fee	= $visa_fee->total_fee;
			
			if ($step1->airport_fast_checkin) {
				// Normal
				if ($step1->airport_fast_checkin == 1) {
					$airport_fast_checkin_fee = $this->util->calAirportFastCheckinServiceFee($step1->group_size, $step1->arrival_port);
					$step1->airport_fast_checkin_fee		= $airport_fast_checkin_fee->service_fee;
					$step1->airport_fast_checkin_total_fee	= $airport_fast_checkin_fee->total_fee;
				} 
				// VIP
				else if ($step1->airport_fast_checkin == 2) {
					$step1->airport_fast_checkin_fee		= 40;
					$step1->airport_fast_checkin_total_fee	= 40 * $step1->group_size;
				}
			} else {
				$step1->airport_fast_checkin_fee		= 0;
				$step1->airport_fast_checkin_total_fee	= 0;
			}
			
			if ($step1->car_pickup) {
				$car_fee = $this->util->calCarServiceFee($step1->car_type, $step1->num_seat, $step1->arrival_port);
				$step1->car_fee			= $car_fee->service_fee;
				$step1->car_total_fee	= $car_fee->total_fee;
			} else {
				$step1->car_fee			= 0;
				$step1->car_total_fee	= 0;
			}
			
			$step1->total_fee	= $step1->total_service_fee + $step1->airport_fast_checkin_total_fee + $step1->car_total_fee;
			
			$this->session->set_userdata("step1", $step1);
		}
		
		// Check if user click on "Apply Online" menu and return without submited
		if ($step1 == null || empty($step1->arrival_port)) {
			if (empty($step1->arrival_port)) {
				$this->session->set_flashdata("error", "The Visa Application Form's session has been expired for some reasons! Please re-fill your information.");
			}
			redirect(BASE_URL_HTTPS."/visa/step1", "location");
		}
		
		// nationality confirm
		$this->checkNationalityConfirm();
		
		$view_data = "";
		$view_data["step1"] = $step1;

		$tmpl_content['content']   = $this->load->view("visa/apply_visa_step2", $view_data, TRUE);
		$this->load->view('layout/visa', $tmpl_content);
	}
	
	function checkNationality()
	{
		$needConfirm = false;
		$step1 = $this->session->userdata("step1");
		if ($step1 != null) {
			if (empty($step1->nationalityConfirmed) || $step1->nationalityConfirmed != true) {
				foreach ($step1->nationality as $nation) {
					if ($nation == "India") {
						$needConfirm = true;
						break;
					}
				}
			}
		}
		return $needConfirm;
	}
	
	function checkNationalityConfirm()
	{
		$needConfirm = $this->checkNationality();
		if ($needConfirm) {
			redirect(BASE_URL_HTTPS."/visa/step1", "location");
		}
	}
	
	function do_confirm_nationality()
	{
		$step1 = $this->session->userdata("step1");
		if ($step1 != null) {
			$step1->nationalityConfirmed = true;
			
			//Cal fees
			$total_fee  = 0;
			$indian_fee = $this->util->calIndianFee($step1->visa_type);
			foreach ($step1->nationality as $nation) {
				if ($nation == "India") {
					$total_fee += $indian_fee + $step1->rush_fee;
				} else {
					$total_fee += $step1->service_fee + $step1->rush_fee;
				}
			}
			$step1->total_service_fee = $total_fee;
			$step1->total_fee = $step1->total_service_fee + $step1->airport_fast_checkin_total_fee + $step1->car_total_fee;
			
			$this->session->set_userdata("step1", $step1);
			
			// Go to next step
			redirect(BASE_URL_HTTPS."/visa/step2", "location");
		}
	}

	function completed()
	{
		$step1 = $this->session->userdata("step1");
		
		if ($step1 == null) {
			redirect(BASE_URL_HTTPS."/visa/step1", "location");
		}
		
		if (!empty($_POST))
		{
			$step1->payment = (!empty($_POST["payment"]) ? $_POST["payment"] : "");
			if (empty($step1->payment)) {
				$this->session->set_flashdata("error", "Please select an method of Payment.");
				redirect(BASE_URL_HTTPS."/visa/step2", "back");
			}
			$this->session->set_userdata("step1", $step1);
		}
		
		/*
		 * Save
		 */
		
		// Create new account
		$is_new_account = false;
		$user = $this->m_user->getUserByEmail($step1->contact_email);
		$password = "";
		if (empty($user)) {
			$password = $this->m_user->uuid();
			$data = array(
				'user_fullname'		=> $step1->fullname[0],
				'user_login'		=> $step1->contact_email,
				'user_pass'			=> md5($password),
				'password_text'		=> $password,
				'user_email'		=> $step1->contact_email,
				'active'			=> 1,
				'user_registered'	=> date("Y-m-d")
			);
			$this->m_user->add($data);
			$is_new_account = true;
		}
		
		$user = $this->m_user->getUserByEmail($step1->contact_email);
		$user_id = 0;
		if ($user != null) {
			$user_id  = $user->id;
			$password = $user->password_text;
		}
		
		// Get book id
		$book_id = $this->util->GetNextValue("tv_visa_booking", "id");
		
		// Booking key
		$key = 'visa_'.md5(time());
		
		// Add to booking list
		$data = array(
				'id'				=> $book_id,
				'booking_key'		=> $key,
				'visa_type'			=> $this->util->getVisaType2String($step1->visa_type),
				'embassies'			=> $step1->embassies,
				'group_size'		=> $step1->group_size,
				'visit_purpose' 	=> $step1->visit_purpose,
				'arrival_date'		=> date("Y-m-d", strtotime($step1->arrivalyear."/".$step1->arrivalmonth."/".$step1->arrivaldate)),
				'exit_date'			=> date("Y-m-d", strtotime($step1->exityear."/".$step1->exitmonth."/".$step1->exitdate)),
				'arrival_port'		=> $step1->arrival_port,
				"flight_number"		=> $step1->flightnumber,
				"arrival_time"		=> $step1->arrivaltime,
				'visa_fee'			=> $step1->service_fee,
				'total_visa_fee'	=> $step1->total_service_fee,
				'stamp_fee'			=> $step1->stamp_fee,
				'rush_type'			=> ($step1->processing_time == "Urgent") ? 1 : (($step1->processing_time == "Emergency") ? 2 : 0),
				'rush_fee'			=> $step1->rush_fee,
				'total_fee'			=> $step1->total_fee,
				'primary_email'		=> $step1->contact_email,
				'secondary_email'	=> $step1->contact_email2,
				'special_request'	=> $step1->comment,
				'payment_method' 	=> $step1->payment,
				'booking_date' 		=> date("Y-m-d H:i:s"),
				'fast_checkin' 		=> $step1->airport_fast_checkin,
				'fast_checkin_fee'	=> $step1->airport_fast_checkin_total_fee,
				'car_pickup' 		=> $step1->car_pickup,
				'car_type' 			=> $step1->car_type,
				'seats' 			=> $step1->num_seat,
				'car_fee' 			=> $step1->car_total_fee,
				'promotion_code'	=> $step1->promotion_code,
				'discount'			=> $step1->discount,
				'user_id' 			=> $user_id,
				'status' 			=> 0,
		);
		
		$succed = true;
		$paxs   = "";
		
		if (!$this->m_visa->add_booking($data)) {
			$succed = false;
		} else {
			for ($i=1; $i<=$step1->group_size; $i++) {
				$pax["book_id"]		= $book_id;
				$pax["fullname"]	= $step1->fullname[$i];
				$pax["gender"]		= $step1->gender[$i];
				$pax["birthdate"]	= date("Y-m-d", strtotime($step1->birthmonth[$i]."/".$step1->birthdate[$i]."/".$step1->birthyear[$i]));
				$pax["nationality"]	= $step1->nationality[$i];
				$pax["passport"]	= $step1->passportnumber[$i];
				
				if (!$this->m_visa->add_traveller($pax)) {
					$succed = false;
				}
				else {
					$paxs[] = $pax;
				}
			}
		}

		if ($succed)
		{
			// Payment
			$payment = $step1->payment;
			
			$client_name = $step1->fullname[1];
			
			// Send mail to sales department
			$tpl_data = array(
					"FULLNAME"					=> $client_name,
					"VISA_TYPE"					=> $this->util->getVisaType2String($step1->visa_type),
					"EMBASSIES"					=> $step1->embassies,
					"ARRIVAL_DATE"				=> date("Y-m-d", strtotime($step1->arrivalmonth."/".$step1->arrivaldate."/".$step1->arrivalyear)),
					"EXIT_DATE"					=> date("Y-m-d", strtotime($step1->exitmonth."/".$step1->exitdate."/".$step1->exityear)),
					"ARRIVAL_PORT"				=> $step1->arrival_port,
					"FLIGHT_NUMBER"				=> $step1->flightnumber,
					"ARRIVAL_TIME"				=> $step1->arrivaltime,
					"PROCESSING_TIME"			=> $step1->processing_time,
					"RUSH_FEE"					=> $step1->rush_fee,
					"SERVICE_FEE"				=> $step1->service_fee,
					"INDIAN_SERVICE_FEE"		=> $this->util->calIndianFee($step1->visa_type),
					"PROMOTION"					=> (!empty($step1->promotion_code)?1:0),
					"DISCOUNT"					=> 0,
					"CAR_PICKUP"				=> $step1->car_pickup,
					"CAR_PICKUP_FEE"			=> $step1->car_total_fee,
					"AIRPORT_FAST_CHECKIN"		=> $step1->airport_fast_checkin,
					"AIRPORT_FAST_CHECKIN_FEE"	=> $step1->airport_fast_checkin_total_fee,
					"TOTAL_FEE"					=> $step1->total_fee,
					"TRAVELERS"					=> $paxs,
					"PRIMARY_EMAIL"				=> $step1->contact_email,
					"SECONDARY_EMAIL"			=> $step1->contact_email2,
					"SPECIAL_REQUEST"			=> $step1->comment,
					"PAYMENT_METHOD"			=> $step1->payment,
					"NEW_ACCOUNT"				=> $is_new_account,
					"USER_LOGIN"				=> $user->user_login,
					"PASSWORD"					=> $password,
			);
			
			$subject = "APPLICATION #V".$book_id.": Visa for Vietnam Remind PP";
			if ($payment == 'Western Union') {
				$subject = "APPLICATION #V".$book_id.": Confirm Visa for Vietnam Bank";
			}
			else if ($payment == 'Bank Transfer') {
				$subject = "APPLICATION #V".$book_id.": Confirm Visa for Vietnam Western Union";
			}
			else if ($payment == 'Credit Card') {
				$subject = "APPLICATION #V".$book_id.": Visa for Vietnam Remind G2S";
			}
			else if ($payment == 'OnePay') {
				$subject = "APPLICATION #V".$book_id.": Visa for Vietnam Remind OnePay";
			}
			
			$vendor_subject = $subject;
			if ($step1->processing_time != "Normal") {
				$vendor_subject = "[".$step1->processing_time."] ".$subject;
			}
			
			$tpl_data["RECEIVER"] = MAIL_INFO;
			$messageToAdmin  = $this->mail_tpl->visa_payment_remind($tpl_data);
			
			$tpl_data["RECEIVER"] = $step1->contact_email;
			$messageToClient = $this->mail_tpl->visa_payment_remind($tpl_data);
			
			// Send to SALE Department
			$mail = array(
	                            "subject"		=> $vendor_subject." - ".$client_name,
								"from_sender"	=> $step1->contact_email,
	                            "name_sender"	=> $client_name,
								"to_receiver"	=> MAIL_INFO,
	                            "message"		=> $messageToAdmin
			);
			$this->mail->config($mail);
			$this->mail->sendmail();
			
			// Send confirmation to SENDER
			$mail = array(
	                            "subject"		=> $subject,
								"from_sender"	=> MAIL_INFO,
	                            "name_sender"	=> SITE_NAME,
								"to_receiver"	=> $step1->contact_email,
	                            "message"		=> $messageToClient
			);
			$this->mail->config($mail);
			$this->mail->sendmail();
	
			if ($payment == 'OnePay')
			{
				//Redirect to OnePay
				$vpcURL = OP_PAYMENT_URL;
				
				$vpcOpt['Title']				= "Settle payment online at ".SITE_NAME;
				$vpcOpt['AgainLink']			= urlencode($_SERVER['HTTP_REFERER']);
				$vpcOpt['vpc_Merchant']			= OP_MERCHANT;
				$vpcOpt['vpc_AccessCode']		= OP_ACCESSCODE;
				$vpcOpt['vpc_MerchTxnRef']		= $key;
				$vpcOpt['vpc_OrderInfo']		= "V".$book_id;
				$vpcOpt['vpc_Amount']			= $step1->total_fee*100;
				$vpcOpt['vpc_ReturnURL']		= OP_RETURN_URL;
				$vpcOpt['vpc_Version']			= "2";
				$vpcOpt['vpc_Command']			= "pay";
				$vpcOpt['vpc_Locale']			= "en";
				$vpcOpt['vpc_TicketNo']			= $_SERVER['REMOTE_ADDR'];
				$vpcOpt['vpc_Customer_Email']	= $step1->contact_email;
				$vpcOpt['vpc_Customer_Id']		= $user_id;
				
				$md5HashData = "";
				
				ksort($vpcOpt);
				
				$appendAmp = 0;
				
				foreach($vpcOpt as $k => $v) {
					// create the md5 input and URL leaving out any fields that have no value
					if (strlen($v) > 0) {
						// this ensures the first paramter of the URL is preceded by the '?' char
						if ($appendAmp == 0) {
							$vpcURL .= urlencode($k) . '=' . urlencode($v);
							$appendAmp = 1;
						} else {
							$vpcURL .= '&' . urlencode($k) . "=" . urlencode($v);
						}
						if ((strlen($v) > 0) && ((substr($k, 0,4)=="vpc_") || (substr($k,0,5) =="user_"))) {
							$md5HashData .= $k . "=" . $v . "&";
						}
					}
				}
				
				$md5HashData = rtrim($md5HashData, "&");
				$md5HashData = strtoupper(hash_hmac('SHA256', $md5HashData, pack('H*',OP_SECURE_SECRET)));
				
				$vpcURL .= "&vpc_SecureHash=" . $md5HashData;
				
				header("Location: ".$vpcURL);
				die();
			}
			else if($payment == 'Credit Card') {
				//Redirect to gate2shop
				$numberofitems = 1;
				$totalAmount   = $step1->total_fee;
				$productName   = $this->util->getVisaType2String($step1->visa_type);
				$productPrice  = $totalAmount/$step1->group_size;
				$productNum    = $step1->group_size;
				$datetime      = gmdate("Y-m-d H:i:s");
				
				// Cal checksum
				$cs_rush = "";
				$cs_fast_checkin = "";
				$cs_car_pickup = "";
				
				$checksum = md5(G2S_SECRET_KEY.G2S_MERCHANT_ID.G2S_CURRENTCY.$totalAmount.$productName.$productPrice.$productNum.$cs_rush.$cs_fast_checkin.$cs_car_pickup.$datetime);
	
				$link = 'https://secure.Gate2Shop.com/ppp/purchase.do?';
				$link .= 'version='.G2S_VERSION;
				$link .= '&merchant_id='.G2S_MERCHANT_ID;
				$link .= '&merchant_site_id='.G2S_MERCHANT_SITE_ID;
				$link .= '&total_amount='.$totalAmount;
				$link .= '&numberofitems='.$numberofitems;
				$link .= '&currency='.G2S_CURRENTCY;
				$link .= '&item_name_1='.$productName;
				$link .= '&item_amount_1='.$productPrice;
				$link .= '&item_quantity_1='.$productNum;
				$link .= '&time_stamp='.$datetime;
				$link .= '&checksum='.$checksum;
				$link .= '&customField1='.$key;
				$link .= '&customField2='.$step1->contact_email;
				
				header('Location: '.$link);
				die();
			}
			else if($payment == 'Paypal')
			{
				$amount		= $step1->total_fee;
				$item_name	= $this->util->getVisaType2String($step1->visa_type);
				$quantity	= $step1->group_size;
				
				$link = 'https://www.paypal.com/cgi-bin/webscr?';
				$link .= 'cmd=_xclick';
				$link .= '&business='.PAYPAL_BUSINESS;
				$link .= '&item_name='.$item_name;
				$link .= '&quantity='.$quantity;
				$link .= '&amount='.$amount.' USD';
				$link .= '&no_shipping=1';
				$link .= '&no_note=1';
				$link .= '&currency_code=USD';
				$link .= '&return='.BASE_URL_HTTPS.'/payment/sucess/'.$key;
				$link .= '&cancel_return='.BASE_URL_HTTPS.'/payment/failure/'.$key;
				
				header('Location: '.$link);
				die();
			}
		}
		
		$view_data["client_name"] = $client_name;
		
		$tmpl_content['content']   = $this->load->view("visa/apply_visa_step3", $view_data, TRUE);
		$this->load->view('layout/visa', $tmpl_content);
	}
	
	function finish()
	{
		if (!empty($_POST))
		{
			$key	= (!empty($_POST["key"]) ? $_POST["key"] : "");
			$hotel  = (!empty($_POST["hotel"]) ? true : false);
			$tour   = (!empty($_POST["tour"]) ? true : false);
			$flight = (!empty($_POST["flight"]) ? true : false);
			
			if ($hotel || $tour || $flight)
			{
				$booking = $this->m_visa->getBooking(NULL, $key);
				if ($booking != null)
				{
					$paxs = $this->m_visa->getTravelers($booking->id);
					$client_name = $paxs[0]->fullname;
					
					$tpl_data = array(
							"FULLNAME"					=> $client_name,
							"PRIMARY_EMAIL"				=> $booking->primary_email,
							"SECONDARY_EMAIL"			=> $booking->secondary_email,
							"HOTEL_BOOKING"				=> ($hotel  ? "YES" : "NO"),
							"OPTIONAL_TOUR"				=> ($tour   ? "YES" : "NO"),
							"DOMESTIC_FLIGHT"			=> ($flight ? "YES" : "NO"),
					);
					
					$message = $this->mail_tpl->need_support($tpl_data);
				
					// Send to SALE Department
					$mail = array(
			                            "subject"		=> "Need support - ".$client_name,
										"from_sender"	=> $booking->primary_email,
			                            "name_sender"	=> $client_name,
										"to_receiver"	=> MAIL_INFO,
			                            "message"		=> $message
					);
					$this->mail->config($mail);
					$this->mail->sendmail();
				}
			}
		}
		redirect(BASE_URL, "location");
	}
	
	function paypal_sucess($key="")
	{
		$this->success($key);
	}
	
	function paypal_failure($key="")
	{
		$this->failure($key);
	}

	function success($key="")
	{
		if (empty($key)) {
			$key = !empty($_GET["key"]) ? $_GET["key"] : "";
		}
		
		if (!empty($key)) {
			$key = str_ireplace(".html", "", $key);
		}
		
		$client_name = "";
		$total_fee	= 0;
		
		$data  = array( 'status' => 1 );
		$where = array( 'booking_key' => $key );
		
		$this->m_visa->update_booking($data, $where);
		
		$booking = $this->m_visa->getBooking(NULL, $key);
		if ($booking != null)
		{
			$paxs = $this->m_visa->getTravelers($booking->id);
			$client_name = $paxs[0]->fullname;
			$total_fee = $booking->total_fee;
			
			$paxs2 = array();
			for ($i=0; $i<sizeof($paxs); $i++) {
				$pax["fullname"] = $paxs[$i]->fullname;
				$pax["gender"] = $paxs[$i]->gender;
				$pax["birthday"] = date("Y-m-d", strtotime($paxs[$i]->birthday));
				$pax["nationality"] = $paxs[$i]->nationality;
				$pax["passport"] = $paxs[$i]->passport;
				$paxs2[] = $pax;
			}
			
			// Create new account
			$is_new_account = false;
			$user = $this->m_user->getUserByEmail($booking->primary_email);
			$password = $user->password_text;
			
			// Send mail to sales department
			$tpl_data = array(
					"FULLNAME"					=> $client_name,
					"VISA_TYPE"					=> $booking->visa_type,
					"EMBASSIES"					=> $booking->embassies,
					"ARRIVAL_DATE"				=> date("Y-m-d", strtotime($booking->arrival_date)),
					"EXIT_DATE"					=> date("Y-m-d", strtotime($booking->exit_date)),
					"ARRIVAL_PORT"				=> $booking->arrival_port,
					"FLIGHT_NUMBER"				=> $booking->flight_number,
					"ARRIVAL_TIME"				=> $booking->arrival_time,
					"PROCESSING_TIME"			=> ($booking->rush_type == 1) ? "Urgent" : (($booking->rush_type == 2) ? "Emergency" : "Normal"),
					"RUSH_FEE"					=> $booking->rush_fee,
					"SERVICE_FEE"				=> $booking->visa_fee,
					"INDIAN_SERVICE_FEE"		=> $this->util->calIndianFee($booking->visa_type),
					"PROMOTION"					=> (($booking->discount > 0) ? 1 : 0),
					"DISCOUNT"					=> round($booking->total_visa_fee*$booking->discount/100),
					"CAR_PICKUP"				=> $booking->car_pickup,
					"CAR_PICKUP_FEE"			=> $booking->car_fee,
					"AIRPORT_FAST_CHECKIN"		=> $booking->fast_checkin,
					"AIRPORT_FAST_CHECKIN_FEE"	=> $booking->fast_checkin_fee,
					"TOTAL_FEE"					=> $booking->total_fee,
					"TRAVELERS"					=> $paxs2,
					"PRIMARY_EMAIL"				=> $booking->primary_email,
					"SECONDARY_EMAIL"			=> $booking->secondary_email,
					"SPECIAL_REQUEST"			=> $booking->special_request,
					"PAYMENT_METHOD"			=> $booking->payment_method,
					"NEW_ACCOUNT"				=> $is_new_account,
					"USER_LOGIN"				=> $user->user_login,
					"PASSWORD"					=> $password,
			);
			
			$subject = "APPLICATION #V".$booking->id.": Confirm Visa for Vietnam ".$booking->payment_method." Successful";
			$vendor_subject = $subject;
			if ($tpl_data['PROCESSING_TIME'] != "Normal") {
				$vendor_subject = "[".$tpl_data['PROCESSING_TIME']."] ".$subject;
			}
			
			$tpl_data["RECEIVER"] = MAIL_INFO;
			$messageToAdmin  = $this->mail_tpl->visa_payment_successful($tpl_data);
			
			$tpl_data["RECEIVER"] = $booking->primary_email;
			$messageToClient = $this->mail_tpl->visa_payment_successful($tpl_data);
				
			// Send to SALE Department
			$mail = array(
	                            "subject"		=> $vendor_subject." - ".$client_name,
								"from_sender"	=> $booking->primary_email,
	                            "name_sender"	=> $client_name,
								"to_receiver"	=> MAIL_INFO,
	                            "message"		=> $messageToAdmin
			);
			$this->mail->config($mail);
			$this->mail->sendmail();
			
			// Send confirmation to SENDER
			$mail = array(
	                            "subject"		=> $subject,
								"from_sender"	=> MAIL_INFO,
	                            "name_sender"	=> SITE_NAME,
								"to_receiver"	=> $booking->primary_email,
	                            "message"		=> $messageToClient
			);
			$this->mail->config($mail);
			$this->mail->sendmail();
		}
		
		$view_data["client_name"] = $client_name;
		$view_data["total_fee"]   = $total_fee;
		$view_data["key"]         = $key;
		
		$tmpl_content['content']  = $this->load->view("payment/success", $view_data, TRUE);
		$this->load->view('layout/visa', $tmpl_content);
	}
	
	function failure($key="")
	{
		if (empty($key)) {
			$key = !empty($_GET["key"]) ? $_GET["key"] : "";
		}
		
		$errMsg = "";
		
		if (!empty($key))
		{
			$key = str_ireplace(".html", "", $key);
			
			$booking = $this->m_visa->getBooking(NULL, $key);
			if ($booking != null) {
				$paxs = $this->m_visa->getTravelers($booking->id);
				$client_name = $paxs[0]->fullname;;
				
				$paxs2 = array();
				for ($i=0; $i<sizeof($paxs); $i++) {
					$pax["fullname"] = $paxs[$i]->fullname;
					$pax["gender"] = $paxs[$i]->gender;
					$pax["birthday"] = date("Y-m-d", strtotime($paxs[$i]->birthday));
					$pax["nationality"] = $paxs[$i]->nationality;
					$pax["passport"] = $paxs[$i]->passport;
					$paxs2[] = $pax;
				}
				
				// Create new account
				$is_new_account = false;
				$user = $this->m_user->getUserByEmail($booking->primary_email);
				$password = $user->password_text;
				
				// Send mail to sales department
				$tpl_data = array(
						"FULLNAME"					=> $client_name,
						"VISA_TYPE"					=> $booking->visa_type,
						"EMBASSIES"					=> $booking->embassies,
						"ARRIVAL_DATE"				=> date("Y-m-d", strtotime($booking->arrival_date)),
						"EXIT_DATE"					=> date("Y-m-d", strtotime($booking->exit_date)),
						"ARRIVAL_PORT"				=> $booking->arrival_port,
						"FLIGHT_NUMBER"				=> $booking->flight_number,
						"ARRIVAL_TIME"				=> $booking->arrival_time,
						"PROCESSING_TIME"			=> ($booking->rush_type == 1) ? "Urgent" : (($booking->rush_type == 2) ? "Emergency" : "Normal"),
						"RUSH_FEE"					=> $booking->rush_fee,
						"SERVICE_FEE"				=> $booking->visa_fee,
						"INDIAN_SERVICE_FEE"		=> $this->util->calIndianFee($booking->visa_type),
						"PROMOTION"					=> (($booking->discount > 0) ? 1 : 0),
						"DISCOUNT"					=> round($booking->total_visa_fee*$booking->discount/100),
						"CAR_PICKUP"				=> $booking->car_pickup,
						"CAR_PICKUP_FEE"			=> $booking->car_fee,
						"AIRPORT_FAST_CHECKIN"		=> $booking->fast_checkin,
						"AIRPORT_FAST_CHECKIN_FEE"	=> $booking->fast_checkin_fee,
						"TOTAL_FEE"					=> $booking->total_fee,
						"TRAVELERS"					=> $paxs2,
						"PRIMARY_EMAIL"				=> $booking->primary_email,
						"SECONDARY_EMAIL"			=> $booking->secondary_email,
						"SPECIAL_REQUEST"			=> $booking->special_request,
						"PAYMENT_METHOD"			=> $booking->payment_method,
						"NEW_ACCOUNT"				=> $is_new_account,
						"USER_LOGIN"				=> $user->user_login,
						"PASSWORD"					=> $password,
				);
				
				$subject = "APPLICATION #V".$booking->id.": Confirm Visa for Vietnam ".$booking->payment_method." Failure";
				$vendor_subject = $subject;
				if ($tpl_data['PROCESSING_TIME'] != "Normal") {
					$vendor_subject = "[".$tpl_data['PROCESSING_TIME']."] ".$subject;
				}
				
				$tpl_data["RECEIVER"] = MAIL_INFO;
				$messageToAdmin  = $this->mail_tpl->visa_payment_failure($tpl_data);
				
				$tpl_data["RECEIVER"] = $booking->primary_email;
				$messageToClient = $this->mail_tpl->visa_payment_failure($tpl_data);
				
				// Send to SALE Department
				$mail = array(
		                            "subject"		=> $vendor_subject." - ".$client_name,
									"from_sender"	=> $booking->primary_email,
		                            "name_sender"	=> $client_name,
									"to_receiver"	=> MAIL_INFO,
		                            "message"		=> $messageToAdmin
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
				
				// Send confirmation to SENDER
				$mail = array(
		                            "subject"		=> $subject,
									"from_sender"	=> MAIL_INFO,
		                            "name_sender"	=> SITE_NAME,
									"to_receiver"	=> $booking->primary_email,
		                            "message"		=> $messageToClient
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
			}
		}
		
		$view_data["errMsg"] = $this->session->flashdata('payment_error');
		$tmpl_content['content']   = $this->load->view("payment/failure", $view_data, TRUE);
		$this->load->view('layout/visa', $tmpl_content);
	}
}

?>