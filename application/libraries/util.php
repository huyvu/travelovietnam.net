<?php
class Util {

	function Util() {
		$this->ci = &get_instance();
	}
	
	function createCaptcha()
	{
		$this->ci->load->helper('captcha');
		
		$code = substr(md5(date("Y-m-d H:i:s")."h-o-l-y-s-p-i-r-i-t"), 0, 6);
		$this->ci->session->set_userdata("security_code", $code);
		
		$vals = array(
		    'word' => $code,
		    'img_path' => './captcha/',
		    'img_url' => BASE_URL.'/captcha/',
		    'font_path' => './captcha/fonts/arial.ttf',
		    'img_width' => '120',
		    'img_height' => 30,
		    'expiration' => 7200
	    );
	    
	    $cap = create_captcha($vals);
		return $cap['image'];
	}
	
	function createSecurityCode()
	{
		if ($this->ci->session->userdata("security_code")) {
			return $this->ci->session->userdata("security_code");
		} else {
			$code = strtoupper(substr(md5(date("Y-m-d H:i:s")."h-o-l-y-s-p-i-r-i-t"), 0, 6));
			$this->ci->session->set_userdata("security_code", $code);
			return $code;
		}
	}
	
	function getSecurityCode()
	{
		if ($this->ci->session->userdata("security_code")) {
			return $this->ci->session->userdata("security_code");
		}
		return "";
	}
	
	function getValueOf($input, $default = null)
	{
		return !empty($input) ? $input : $default;
	}
	
	function getRealIpAddr()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	
	function genTopicAlias($str)
	{
	    $str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
	    $str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\\1', $str);
	    $str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
	    $str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
	    $str = strtolower( trim($str, '-') );
	    return $str;
	}
	
	function genItemCode($prefix="", $len=6)
	{
	    return strtoupper($prefix.substr(strtotime(date("Y-m-d H:i:s")), -($len - strlen($prefix))));
	}

	function GetMaxValue($table, $column="id") {
		$sql   = "SELECT MAX({$column}) AS val FROM {$table}";
		$query = $this->ci->db->query($sql);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->val;
		}
		return 0;
	}
	
	function GetNextValue($table, $column="id") {
		$sql   = "SELECT MAX({$column}) AS val FROM {$table}";
		$query = $this->ci->db->query($sql);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->val + 1;
		}
		return 1;
	}

	function isEmpty($input) {
		if(!isset($input) || empty($input) || is_null($input) || strlen($input)==0){
			return TRUE;
		}
		return FALSE;
	}

	function sessionStart() {
		$this->ci->session->sess_start();
	}

	function checkUserLogin() {
		if ($this->ci->session->userdata("logged_in")) {
			return $this->ci->session->userdata("logged_in");
		}
		return false;
	}

	function requireUserLogin($login_page=NULL) {
		if(!$this->checkUserLogin()){
		if (!is_null($login_page)) {
				// Add current url to redirect user to the page they were accessing
				$this->ci->session->set_userdata("comeback_link", current_url());
				redirect($login_page);
			} else {
				redirect(BASE_URL);
			}
			die();
		}
	}
	
	function requireRootAdminLogin($login_page=NULL) {
		if(!$this->checkRootAdminLogin()){
			if (!is_null($login_page)) {
				redirect($login_page);
			} else {
				redirect(BASE_URL);
			}
			die();
		}
	}

	function checkRootAdminLogin() {
		if ($this->ci->session->userdata("root_addmin_logged_in")) {
			return ($this->ci->session->userdata("root_addmin_logged_in"));
		}
		return false;
	}
	
	function requireAdminLogin() {
		if(!$this->checkAdminLogin()){
			redirect(ADMIN_URL);
			die();
		}
	}
	
	function checkAdminLogin() {
		if ($this->ci->session->userdata("addmin_logged_in")) {
			return ($this->ci->session->userdata("addmin_logged_in"));
		}
		return false;
	}
	
	function requireEditRightLogin($user_type, $edit_mode=0) {
		if(!$this->checkEditRightLogin($user_type, $edit_mode)){
			redirect(ADMIN_URL);
			die();
		}
	}
	
	function checkEditRightLogin($user_type, $edit_mode) {
		switch ($user_type) {
			case USR_ADMIN:
							$user_type = array(USR_ADMIN, USR_ROOT);
							break;
			case USR_MODERATOR:
							$user_type = array(USR_ADMIN, USR_ROOT, USR_MODERATOR);
							break;
			case USR_TOUR:
							$user_type = array(USR_ADMIN, USR_ROOT, USR_MODERATOR, USR_TOUR);
							break;
			case USR_HOTEL:
							$user_type = array(USR_ADMIN, USR_ROOT, USR_MODERATOR, USR_HOTEL);
							break;
			case USR_FLIGHT:
							$user_type = array(USR_ADMIN, USR_ROOT, USR_MODERATOR, USR_FLIGHT);
							break;
			case USR_VISA:
							$user_type = array(USR_ADMIN, USR_ROOT, USR_MODERATOR, USR_VISA);
							break;
			default:
							$user_type = array(USR_ROOT);
							break;
		}
		if ($this->ci->session->userdata("addmin_logged_in")) {
			return ($this->ci->session->userdata("addmin_logged_in"))
					&& in_array($this->ci->session->userdata('logged_user')->user_type, $user_type)
					&& ($this->ci->session->userdata('logged_user')->edit_mode >= $edit_mode);
		}
		return false;
	}
	
	function get_OP_PAYMENT_URL() {
		if (TEST_MODE && ($this->checkRootAdminLogin() || $this->checkAdminLogin())) {
			return TEST_OP_PAYMENT_URL;
		}
		return OP_PAYMENT_URL;
	}
	
	function get_OP_MERCHANT() {
		if (TEST_MODE && ($this->checkRootAdminLogin() || $this->checkAdminLogin())) {
			return TEST_OP_MERCHANT;
		}
		return OP_MERCHANT;
	}
	
	function get_OP_ACCESSCODE() {
		if (TEST_MODE && ($this->checkRootAdminLogin() || $this->checkAdminLogin())) {
			return TEST_OP_ACCESSCODE;
		}
		return OP_ACCESSCODE;
	}
	
	function get_OP_RETURN_URL() {
		if (TEST_MODE && ($this->checkRootAdminLogin() || $this->checkAdminLogin())) {
			return TEST_OP_RETURN_URL;
		}
		return OP_RETURN_URL;
	}
	
	function get_OP_SECURE_SECRET() {
		if (TEST_MODE && ($this->checkRootAdminLogin() || $this->checkAdminLogin())) {
			return TEST_OP_SECURE_SECRET;
		}
		return OP_SECURE_SECRET;
	}
	
	function currentDate(){
		return date('H:i \G\M\T\+\7, D, d M Y \V\N');
	}
	
	function dateInfo($timestamp) {
		return getdate(strtotime($timestamp));
	}
	
	/**
	 * Format date to string.Example : 01 January, 2014
	 */
	function dateLongFormat($timestamp){
		return strftime('%d %B, %Y',strtotime($timestamp));
	}

	/**
	 * Format date to string.Example : 01 Jan, 2014
	*/
	function dateShortFormat($timestamp){
		return strftime('%d %b, %Y',strtotime($timestamp));
	}

	function truncate($text, $numb, $link = null) {
		$text = strip_tags($text);
		if (strlen($text) > $numb) {
			$text = substr($text, 0, $numb);
			if ((substr($text, -1)) == ".") {
				$text = substr($text, 0, strrpos($text,"."));
			}
			$etc = "...";
			$text = $text.$etc;
		}
		if ($link && strlen($text) > $numb)
		$text .= "<a href='$link'> (more)</a>";
		return $text;
	}
	
	function pagination($base_url='#', $total_rows=1, $per_page=10) {
		$this->ci->load->library('pagination');

		$config['base_url']				= $base_url;
		$config['total_rows']			= $total_rows;
		$config['per_page']				= $per_page;
		$config['page_query_string']	= FALSE;
		$config['uri_segment']			= 3;
		$config['num_links']			= 5;
		$config['use_page_numbers']		= TRUE;
		$config['full_tag_open']		= '<div class="pagination">';
		$config['full_tag_close']		= '</div>';
		$config['first_link']			= '&laquo;';
		$config['last_link']			= '&raquo;';
		$config['next_link']			= '&gt;';
		$config['prev_link']			= '&lt;';
		$config['cur_tag_open']			= '<a class="current">';
		$config['cur_tag_close']		= '</a>';
		$config['query_string_segment'] = "page";

		$this->ci->pagination->initialize($config);

		echo $this->ci->pagination->create_links();
	}
	
	function timesince($tsmp) {
		$diffu = array('seconds' => 2, 'minutes' => 60, 'hours' => 3600, 'days' => 86400, 'months' => 2592000,  'years' =>  31104000);
		$diff = time() - strtotime($tsmp);
		$dt = '0 seconds ago';
		foreach($diffu as $u => $n){ if($diff>$n) {$dt = floor($diff/$n).' '.$u.' ago';} }
		return $dt;
	}
	
	function getVisaType2String($visa_type) {
		$str = "";
		switch ($visa_type."") {
			case "1mm": $str = "1 month multiple"; break;
			case "3ms": $str = "3 months single"; break;
			case "3mm": $str = "3 months multiple"; break;
			case "3mme": $str = "3 months at Embassy or Consulate"; break;
			default: $str = "1 month single"; break;
		}
		return $str;
	}
	
	function calIndianFee($typeofvisa="1ms")
	{
		$fee = 50;
		switch ($typeofvisa)
		{
			case "1ms":
			case "1 month single":
				$fee = 50; break;
			case "1mm":
			case "1 month multiple":
				$fee = 60; break;
			case "3ms":
			case "3 months single":
				$fee = 60; break;
			case "3mm":
			case "3 months multiple":
				$fee = 80; break;
			case "3mme":
			case "3 months at Embassy or Consulate":
				$fee = 80; break;
		}
		return $fee;
	}
	
	function calRushFee($proccesstype="Normal")
	{
		$fee = 0;
		switch ($proccesstype)
		{
			case "Normal": $fee = 0; break;
			case "Urgent": $fee = 20; break;
			case "Emergency": $fee = 50; break;
		}
		return $fee;
	}
	
	function calVisaFee($typeofvisa="1ms", $numofentry=1, $proccesstype="Normal")
	{
		$servicefee	= 0;
		$stampfee	= 0;
		$rushfee	= 0;
		
		switch ($typeofvisa)
		{
			case"1ms":$stampfee=25;
				switch($numofentry)
				{
					case 1:$servicefee=20;break;
					case 2:$servicefee=18;break;
					case 3:$servicefee=18;break;
					case 4:$servicefee=16;break;
					case 5:$servicefee=16;break;
					case 6:$servicefee=14;break;
					case 7:$servicefee=14;break;
					case 8:$servicefee=14;break;
					case 9:$servicefee=14;break;
					case 10:$servicefee=12;break;
					default:$servicefee=12;break;
				}
				break;
			case"1mm":$stampfee=50;
				switch($numofentry)
				{
					case 1:$servicefee=25;break;
					case 2:$servicefee=23;break;
					case 3:$servicefee=23;break;
					case 4:$servicefee=21;break;
					case 5:$servicefee=21;break;
					case 6:$servicefee=19;break;
					case 7:$servicefee=19;break;
					case 8:$servicefee=19;break;
					case 9:$servicefee=19;break;
					case 10:$servicefee=17;break;
					default:$servicefee=17;break;
				}
				break;
			case"3ms":$stampfee=25;
				switch($numofentry)
				{
					case 1:$servicefee=30;break;
					case 2:$servicefee=28;break;
					case 3:$servicefee=28;break;
					case 4:$servicefee=26;break;
					case 5:$servicefee=26;break;
					case 6:$servicefee=24;break;
					case 7:$servicefee=24;break;
					case 8:$servicefee=24;break;
					case 9:$servicefee=24;break;
					case 10:$servicefee=22;break;
					default:$servicefee=22;break;
				}
				break;
			case"3mm":$stampfee=50;
				switch($numofentry)
				{
					case 1:$servicefee=60;break;
					case 2:$servicefee=58;break;
					case 3:$servicefee=58;break;
					case 4:$servicefee=56;break;
					case 5:$servicefee=56;break;
					case 6:$servicefee=54;break;
					case 7:$servicefee=54;break;
					case 8:$servicefee=54;break;
					case 9:$servicefee=54;break;
					case 10:$servicefee=52;break;
					default:$servicefee=52;break;
				}
				break;
			case"3mme":$stampfee=50;
				switch($numofentry)
				{
					case 1:$servicefee=38;break;
					case 2:$servicefee=36;break;
					case 3:$servicefee=36;break;
					case 4:$servicefee=34;break;
					case 5:$servicefee=34;break;
					case 6:$servicefee=32;break;
					case 7:$servicefee=32;break;
					case 8:$servicefee=32;break;
					case 9:$servicefee=32;break;
					case 10:$servicefee=30;break;
					default:$servicefee=30;break;
				}
				break;
			case"6ms":$stampfee=25;
				switch($numofentry)
				{
					case 1:$servicefee=38;break;
					case 2:$servicefee=36;break;
					case 3:$servicefee=36;break;
					case 4:$servicefee=34;break;
					case 5:$servicefee=34;break;
					case 6:$servicefee=32;break;
					case 7:$servicefee=32;break;
					case 8:$servicefee=32;break;
					case 9:$servicefee=32;break;
					case 10:$servicefee=29;break;
					default:$servicefee=29;break;
				}
				break;
			case"6mm":$stampfee=50;
				switch(numofentry)
				{
					case 1:$servicefee=42;break;
					case 2:$servicefee=40;break;
					case 3:$servicefee=40;break;
					case 4:$servicefee=36;break;
					case 5:$servicefee=36;break;
					case 6:$servicefee=33;break;
					case 7:$servicefee=33;break;
					case 8:$servicefee=33;break;
					case 9:$servicefee=33;break;
					case 10:$servicefee=30;break;
					default:$servicefee=30;break;
				}
				break;
			case"1ym":$stampfee=100;
				switch($numofentry)
				{
					case 1:$servicefee=115;break;
					case 2:$servicefee=110;break;
					case 3:$servicefee=110;break;
					case 4:$servicefee=108;break;
					case 5:$servicefee=108;break;
					case 6:$servicefee=100;break;
					case 7:$servicefee=100;break;
					case 8:$servicefee=100;break;
					case 9:$servicefee=100;break;
					case 10:$servicefee=98;break;
					default:$servicefee=98;break;
				}
				break;
			default:break;
		}
		
		if ($proccesstype == "Urgent") {
			$rushfee = 20;
		}
		if ($proccesstype == "Emergency") {
			$rushfee = 50;
		}
		
		$price->service_fee	= $servicefee;
		$price->stamp_fee	= $stampfee;
		$price->rush_fee	= $rushfee;
		$price->total_fee	= ($servicefee + $rushfee)*$numofentry;
		
		return $price;
	}
	
	function calAirportFastCheckinServiceFee($numofentry, $arrivalport=NULL)
	{
		$servicefee = 0;
		
		switch ($arrivalport){
			case "Ha Noi":
				$servicefee = (($numofentry<5) ? 20 : 15); break;
			case "Da Nang":
				$servicefee = (($numofentry<5) ? 20 : 15); break;
			default:
				$servicefee = (($numofentry<5) ? 15 : 12); break;
		}
		
		$price->service_fee = $servicefee;
		$price->total_fee   = $servicefee*$numofentry;
		
		return $price;
	}
	
	function calCarServiceFee($cartype, $seats=0, $arrivalport=NULL)
	{
		$servicefee = 0;
		
		if ($arrivalport == "Ha Noi") {
			switch ($seats) {
				case 4:  $servicefee = 30; break;
				case 7:  $servicefee = 35; break;
				case 16: $servicefee = 60; break;
				case 24: $servicefee = 90; break;
				default: $servicefee = 30; break;
			}
		} else if ($arrivalport == "Da Nang") {
			switch ($seats) {
				case 4:  $servicefee = 25; break;
				case 7:  $servicefee = 30; break;
				case 16: $servicefee = 50; break;
				case 24: $servicefee = 85; break;
				default: $servicefee = 25; break;
			}
		} else {
			switch ($seats) {
				case 4:  $servicefee = 25; break;
				case 7:  $servicefee = 30; break;
				case 16: $servicefee = 50; break;
				case 24: $servicefee = 85; break;
				default: $servicefee = 25; break;
			}
		}
		
		$price->service_fee = $servicefee;
		$price->total_fee   = $servicefee;
		
		return $price;
	}
	
	function checkPageError($val) {
		if (empty($val)) {
			redirect("error404", "location");
		}
	}
	
	function getLang() {
		if ($this->ci->session->userdata("lang")) {
			return $this->ci->session->userdata("lang");
		}
		return "EN";
	}
	
	function setLang($lang) {
		$this->ci->session->set_userdata("lang", $lang);
	}
	
	function airportCity()
	{
		return array(
			'BMV' => "Buon Ma Thuot (BMV)",
			'CAH' => "Ca Mau (CAH)",
			'VCA' => "Can Tho (VCA)",
			'VCL' => "Chu Lai (VCL)",
			'VCS' => "Con Dao (VCS)",
			'DLI' => "Da Lat (DLI)",
			'DAD' => "Da Nang (DAD)",
			'DIN' => "Dien Bien (DIN)",
			'VDH' => "Dong Hoi (VDH)",
			'HAN' => "Ha Noi (HAN)",
			'HPH' => "Hai Phong (HPH)",
			'SGN' => "Ho Chi Minh City (SGN)",
			'HUI' => "Hue (HUI)",
			'NHA' => "Nha Trang (NHA)",
			'PQC' => "Phu Quoc (PQC)",
			'PXU' => "Pleiku (PXU)",
			'UIH' => "Quy Nhon (UIH)",
			'VKG' => "Rach Gia (VKG)",
			'THD' => "Thanh Hoa (THD)",
			'TBB' => "Tuy Hoa (TBB)",
			'VII' => "Vinh (VII)",
			'MEL' => "Melbourne (MEL)",
			'SYD' => "Sydney (SYD)",
			'AMS' => "Amsterdam (AMS)",
			'BCN' => "Barcelona (BCN)",
			'FRA' => "Frankfurt (FRA)",
			'LON' => "London (LON)",
			'MOW' => "Moscow (MOW)",
			'NCE' => "Nice (NCE)",
			'PAR' => "Paris (PAR)",
			'PRG' => "Prague (PRG)",
			'ROM' => "Rome (ROM) ",
			'LPQ' => "Luang Prabang (LPQ)",
			'PNH' => "Phnom Penh (PNH)",
			'REP' => "Siem Riep (REP)",
			'VTE' => "Vientiane (VTE)",
			'BJS' => "Beijing (BJS)",
			'PUS' => "Busan (PUS)",
			'CTU' => "Chengdu (CTU)",
			'FUK' => "Fukuoka (FUK)",
			'CAN' => "Guangzhou (CAN)",
			'HKG' => "Hong Kong (HKG)",
			'KHH' => "Kaohsiung (KHH)",
			'NGO' => "Nagoya (NGO)",
			'OSA' => "Osaka (OSA)",
			'SEL' => "Seoul (SEL)",
			'SHA' => "Shanghai (SHA)",
			'TPE' => "Taipei (TPE)",
			'TYO' => "Tokyo (TYO)",
			'BKK' => "Bangkok (BKK)",
			'JKT' => "Jakarta (JKT)",
			'KUL' => "Kuala Lumpur (KUL)",
			'MNL' => "Manila (MNL)",
			'SIN' => "Singapore (SIN)",
			'RGN' => "Yangon (RGN)",
			'ATL' => "Atlanta Hartsfield (ATL)",
			'AUS' => "Austin (AUS)",
			'BOS' => "Boston, Logan (BOS)",
			'CHI' => "Chicago IL (CHI)",
			'DFW' => "Dallas Fort Worth (DFW)",
			'DEN' => "Denver (DEN)",
			'HNL' => "Honolulu (HNL)",
			'LAX' => "Los Angeles (LAX)",
			'MIA' => "Miami (MIA)",
			'MSP' => "Minneapolis/St.Paul (MSP)",
			'PHL' => "Philadelphia (PHL)",
			'PDX' => "Portland (PDX)",
			'SFO' => "San Francisco (SFO)",
			'SEA' => "Seattle, Tacoma (SEA)",
			'STL' => "St Louis, Lambert (STL)",
			'WAS' => "Washington (WAS)"
		);
	}
	
	function getAirportCity($airport)
	{
		$cities = $this->airportCity();
		return $cities[$airport];
	}
	
	// Convert Solar2Lunar, Lunar2Solar 
	function jdFromDate($dd, $mm, $yy) {
		$a = floor((14 - $mm) / 12);
		$y = $yy + 4800 - $a;
		$m = $mm + 12 * $a - 3;
		$jd = $dd + floor((153 * $m + 2) / 5) + 365 * $y + floor($y / 4) - floor($y / 100) + floor($y / 400) - 32045;
		if ($jd < 2299161) {
			$jd = $dd + floor((153* $m + 2)/5) + 365 * $y + floor($y / 4) - 32083;
		}
		return $jd;
	}
	
	function jdToDate($jd) {
		if ($jd > 2299160) { // After 5/10/1582, Gregorian calendar
			$a = $jd + 32044;
			$b = floor((4*$a+3)/146097);
			$c = $a - floor(($b*146097)/4);
		} else {
			$b = 0;
			$c = $jd + 32082;
		}
		$d = floor((4*$c+3)/1461);
		$e = $c - floor((1461*$d)/4);
		$m = floor((5*$e+2)/153);
		$day = $e - floor((153*$m+2)/5) + 1;
		$month = $m + 3 - 12*floor($m/10);
		$year = $b*100 + $d - 4800 + floor($m/10);
		return array($day, $month, $year);
	}
	
	function getNewMoonDay($k, $timeZone) {
		$T = $k/1236.85; // Time in Julian centuries from 1900 January 0.5
		$T2 = $T * $T;
		$T3 = $T2 * $T;
		$dr = M_PI/180;
		$Jd1 = 2415020.75933 + 29.53058868*$k + 0.0001178*$T2 - 0.000000155*$T3;
		$Jd1 = $Jd1 + 0.00033*sin((166.56 + 132.87*$T - 0.009173*$T2)*$dr); // Mean new moon
		$M = 359.2242 + 29.10535608*$k - 0.0000333*$T2 - 0.00000347*$T3; // Sun's mean anomaly
		$Mpr = 306.0253 + 385.81691806*$k + 0.0107306*$T2 + 0.00001236*$T3; // Moon's mean anomaly
		$F = 21.2964 + 390.67050646*$k - 0.0016528*$T2 - 0.00000239*$T3; // Moon's argument of latitude
		$C1=(0.1734 - 0.000393*$T)*sin($M*$dr) + 0.0021*sin(2*$dr*$M);
		$C1 = $C1 - 0.4068*sin($Mpr*$dr) + 0.0161*sin($dr*2*$Mpr);
		$C1 = $C1 - 0.0004*sin($dr*3*$Mpr);
		$C1 = $C1 + 0.0104*sin($dr*2*$F) - 0.0051*sin($dr*($M+$Mpr));
		$C1 = $C1 - 0.0074*sin($dr*($M-$Mpr)) + 0.0004*sin($dr*(2*$F+$M));
		$C1 = $C1 - 0.0004*sin($dr*(2*$F-$M)) - 0.0006*sin($dr*(2*$F+$Mpr));
		$C1 = $C1 + 0.0010*sin($dr*(2*$F-$Mpr)) + 0.0005*sin($dr*(2*$Mpr+$M));
		if ($T < -11) {
			$deltat= 0.001 + 0.000839*$T + 0.0002261*$T2 - 0.00000845*$T3 - 0.000000081*$T*$T3;
		} else {
			$deltat= -0.000278 + 0.000265*$T + 0.000262*$T2;
		};
		$JdNew = $Jd1 + $C1 - $deltat;
		return floor($JdNew + 0.5 + $timeZone/24);
	}
	
	function getSunLongitude($jdn, $timeZone) {
		$T = ($jdn - 2451545.5 - $timeZone/24) / 36525; // Time in Julian centuries from 2000-01-01 12:00:00 GMT
		$T2 = $T * $T;
		$dr = M_PI/180; // degree to radian
		$M = 357.52910 + 35999.05030*$T - 0.0001559*$T2 - 0.00000048*$T*$T2; // mean anomaly, degree
		$L0 = 280.46645 + 36000.76983*$T + 0.0003032*$T2; // mean longitude, degree
		$DL = (1.914600 - 0.004817*$T - 0.000014*$T2)*sin($dr*$M);
		$DL = $DL + (0.019993 - 0.000101*$T)*sin($dr*2*$M) + 0.000290*sin($dr*3*$M);
		$L = $L0 + $DL; // true longitude, degree
	    // obtain apparent longitude by correcting for nutation and aberration
	    $omega = 125.04 - 1934.136 * $T;
	    $L = $L - 0.00569 - 0.00478 * sin($omega * $dr);
		$L = $L*$dr;
		$L = $L - M_PI*2*(floor($L/(M_PI*2))); // Normalize to (0, 2*PI)
		return floor($L/M_PI*6);
	}
	
	function getLunarMonth11($yy, $timeZone) {
		$off = $this->jdFromDate(31, 12, $yy) - 2415021;
		$k = floor($off / 29.530588853);
		$nm = $this->getNewMoonDay($k, $timeZone);
		$sunLong = $this->getSunLongitude($nm, $timeZone); // sun longitude at local midnight
		if ($sunLong >= 9) {
			$nm = $this->getNewMoonDay($k-1, $timeZone);
		}
		return $nm;
	}
	
	function getLeapMonthOffset($a11, $timeZone) {
		$k = floor(($a11 - 2415021.076998695) / 29.530588853 + 0.5);
		$last = 0;
		$i = 1; // We start with the month following lunar month 11
		$arc = $this->getSunLongitude($this->getNewMoonDay($k + $i, $timeZone), $timeZone);
		do {
			$last = $arc;
			$i = $i + 1;
			$arc = $this->getSunLongitude($this->getNewMoonDay($k + $i, $timeZone), $timeZone);
		} while ($arc != $last && $i < 14);
		return $i - 1;
	}
	
	/* Comvert solar date dd/mm/yyyy to the corresponding lunar date */
	function convertSolar2Lunar($dd, $mm, $yy, $timeZone) {
		$dayNumber = $this->jdFromDate($dd, $mm, $yy);
		$k = floor(($dayNumber - 2415021.076998695) / 29.530588853);
		$monthStart = $this->getNewMoonDay($k+1, $timeZone);
		if ($monthStart > $dayNumber) {
			$monthStart = $this->getNewMoonDay($k, $timeZone);
		}
		$a11 = $this->getLunarMonth11($yy, $timeZone);
		$b11 = $a11;
		if ($a11 >= $monthStart) {
			$lunarYear = $yy;
			$a11 = $this->getLunarMonth11($yy-1, $timeZone);
		} else {
			$lunarYear = $yy+1;
			$b11 = $this->getLunarMonth11($yy+1, $timeZone);
		}
		$lunarDay = $dayNumber - $monthStart + 1;
		$diff = floor(($monthStart - $a11)/29);
		$lunarLeap = 0;
		$lunarMonth = $diff + 11;
		if ($b11 - $a11 > 365) {
			$leapMonthDiff = $this->getLeapMonthOffset($a11, $timeZone);
			if ($diff >= $leapMonthDiff) {
				$lunarMonth = $diff + 10;
				if ($diff == $leapMonthDiff) {
					$lunarLeap = 1;
				}
			}
		}
		if ($lunarMonth > 12) {
			$lunarMonth = $lunarMonth - 12;
		}
		if ($lunarMonth >= 11 && $diff < 4) {
			$lunarYear -= 1;
		}
		return array($lunarDay, $lunarMonth, $lunarYear, $lunarLeap);
	}
	
	/* Convert a lunar date to the corresponding solar date */
	function convertLunar2Solar($lunarDay, $lunarMonth, $lunarYear, $lunarLeap, $timeZone) {
		if ($lunarMonth < 11) {
			$a11 = $this->getLunarMonth11($lunarYear-1, $timeZone);
			$b11 = $this->getLunarMonth11($lunarYear, $timeZone);
		} else {
			$a11 = $this->getLunarMonth11($lunarYear, $timeZone);
			$b11 = $this->getLunarMonth11($lunarYear+1, $timeZone);
		}
		$k = floor(0.5 + ($a11 - 2415021.076998695) / 29.530588853);
		$off = $lunarMonth - 11;
		if ($off < 0) {
			$off += 12;
		}
		if ($b11 - $a11 > 365) {
			$leapOff = $this->getLeapMonthOffset($a11, $timeZone);
			$leapMonth = $leapOff - 2;
			if ($leapMonth < 0) {
				$leapMonth += 12;
			}
			if ($lunarLeap != 0 && $lunarMonth != $leapMonth) {
				return array(0, 0, 0);
			} else if ($lunarLeap != 0 || $off >= $leapOff) {
				$off += 1;
			}
		}
		$monthStart = $this->getNewMoonDay($k + $off, $timeZone);
		return $this->jdToDate($monthStart + $lunarDay - 1);
	}
}
?>