<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'libraries/openid.php';
class Auth extends CI_Controller
{

	public function index(){
		return $this->load->view('login');
	}
		
	public function oauth($providername)
	{
		
		/*$key    = $this->config->item($providername.'_key');
		$secret = $this->config->item($providername.'_secret');*/

		$key    = constant($providername.'_key');
		$secret = constant($providername.'_secret');

		$this->load->spark('oauth/0.3.1');

		// Create an consumer from the config
		$consumer = $this->oauth->consumer(array(
			'key' => $key,
			'secret' => $secret,
		));

		// Load the provider
		$provider = $this->oauth->provider($providername);

		if (!isset($_GET['denied'])) {
			$callback = site_url('auth/oauth/'.$provider->name);
		}else{
			$callback = site_url('member/login');
		}
		// Create the URL to return the user to
		
		if ( ! $this->input->get_post('oauth_token'))
		{
			// Add the callback URL to the consumer
			$consumer->callback($callback);

			// Get a request token for the consumer
			$token = $provider->request_token($consumer);

			// Store the token
			$this->session->set_userdata('oauth_token', base64_encode(serialize($token)));

			// Get the URL to the twitter login page
			$url = $provider->authorize($token, array(
				'oauth_callback' => $callback,
			));

			// Send the user off to login
			redirect($url);
		}
		else
		{
			if ($this->session->userdata('oauth_token'))
			{
				// Get the token from storage
				$token = unserialize(base64_decode($this->session->userdata('oauth_token')));
			}

			if ( ! empty($token) AND $token->access_token !== $this->input->get_post('oauth_token'))
			{
				// Delete the token, it is not valid
				$this->session->unset_userdata('oauth_token');

				// Send the user back to the beginning
				exit('invalid token after coming back to site');
			}

			// Get the verifier
			$verifier = $this->input->get_post('oauth_verifier');

			// Store the verifier in the token
			$token->verifier($verifier);

			// Exchange the request token for an access token
			$token = $provider->access_token($consumer, $token);

			// We got the token, let's get some user data
			$user = $provider->get_user_info($consumer, $token);


			// $this->saveData($providername,$token,$user);
			$this->saveData($providername,$user);
		}
	}


	public function oauth2($providername=NULL)
	{

		$key    = constant($providername.'_key');
		$secret = constant($providername.'_secret');

		$this->load->spark('oauth2/0.3.1');

		$provider = $this->oauth2->provider($providername, array(
			'id' => $key,
			'secret' => $secret,
		));

		if ( ! $this->input->get('code'))
		{
			// By sending no options it'll come back here
			$provider->authorize();
		}
		else
		{
			// Howzit?
			try
			{
				$token = $provider->access($_GET['code']);
				$user = $provider->get_user_info($token);
				// $this->saveData($providername,$token,$user);
				$this->saveData($providername,$user);

			}

			catch (OAuth2_Exception $e)
			{
				show_error('That didnt work: '.$e);
			}

		}

		
	}

	/**
	 * facebookLogin action will be call by Ajax using Facebook Javascript SDK
	 */
	public function facebookLogin(){

		$uid = $this->input->post('id');
		$providername = 'facebook';
		$userobj= array('uid'=>$uid,
						'username'=>$this->input->post('email'),
						'fullname'=>$this->input->post('fullname'),
						'email'=>$this->input->post('email'),
						'provider'=>$providername
		);
		$result=$this->m_user->getSocialUser($uid,$providername);
		
		$user_data = array();

		if($result != NULL){
			$user = $result;
			
		}else{
			$this->db->insert('tv_user',$userobj);
			$user = $this->m_user->getSocialUser($uid,$providername);
			//send email to user
				$tpl_data = "";
				$subject = "Welcome to Travelovietnam.com";
						
				$tpl_data["RECEIVER"] = $email;
				$tpl_data["FULLNAME"] = $user->fullname;
				$tpl_data["PROVIDER"] = $providername;
				$messageToClient = $this->mail_tpl->register_successful($tpl_data);

				// Send confirmation to user
				$mail = array(
		                            "subject"		=> $subject,
									"from_sender"	=> MAIL_INFO,
		                            "name_sender"	=> SITE_NAME,
									"to_receiver"	=> $email,
		                            "message"		=> $messageToClient
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
		}

		foreach($user as $key => $val){
			$user_data[$key] = $val;
		}

		$user_data["login"] = TRUE;
		$this->session->set_userdata('user', $user_data);
		$this->session->set_userdata('logged_in', TRUE);
		//redirect to the link user had entered before
		if($this->session->userdata('comeback_link')) {
			$redirect_url = $this->session->userdata('comeback_link');
			$this->session->unset_userdata('comeback_link');
			echo $redirect_url;					
		}else{
			echo site_url('member/myaccount');	
		}
	}

	public function openIDLogin(){
		$openid = new Openid('www.travelovietnam.com');

		if ($openid->mode == 'cancel') {
			echo "User has canceled authentication !";
		} elseif($openid->validate()) {
			$data = $openid->getAttributes();
			$fullname 	= $data['namePerson'];
			$email 		= $data['contact/email'];
			$gender 	= $data['person/gender'];

			if(strpos($email, 'yahoo.com') !== FALSE){
				$providername = 'yahoo';	
			}elseif (strpos($email, 'gmail.com') !== FALSE) {
				$providername = 'google';
			}

			$userobj = array('fullname' => $fullname ,
							'email' => $email,
							'provider' => $providername,
							'username' => $email 
			);

			$result=$this->m_user->getSocialUser('',$providername,$email);
		
			$user_data = array();

			if($result != NULL){
				$user = $result;
				
			}else{
				$this->db->insert('tv_user',$userobj);
				$user = $this->m_user->getSocialUser('',$providername,$email);
				//send email to user
				$tpl_data = "";
				$subject = "Welcome to Travelovietnam.com";
						
				$tpl_data["RECEIVER"] = $email;
				$tpl_data["FULLNAME"] = $fullname;
				$tpl_data["PROVIDER"] = $providername;
				$messageToClient = $this->mail_tpl->register_successful($tpl_data);

				// Send confirmation to user
				$mail = array(
		                            "subject"		=> $subject,
									"from_sender"	=> MAIL_INFO,
		                            "name_sender"	=> SITE_NAME,
									"to_receiver"	=> $email,
		                            "message"		=> $messageToClient
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
			}

			foreach($user as $key => $val){
				$user_data[$key] = $val;
			}

			$user_data["login"] = TRUE;
			$this->session->set_userdata('user', $user_data);
			$this->session->set_userdata('logged_in', TRUE);

			if($this->session->userdata('comeback_link')) {
				$redirect_url = $this->session->userdata('comeback_link');
				$this->session->unset_userdata('comeback_link');					
			}else{
				$redirect_url = site_url('member/myaccount');	
			}
			
			echo "<script>window.close();
				window.opener.location.href = '{$redirect_url}';
				</script>";
		} else {
			echo "<script>window.close();
				</script>";
		}
	}

	/**
	 * Add user to database if user login for first time
	 * Otherwise, login and redirect to myaccount page
	 */
	private function saveData($providername,$usr)
	{
		$uid = array_key_exists('uid',$usr)?$usr['uid']:$usr['id'];

		$name =array_key_exists('name',$usr)? $usr['name']:$usr['first_name'].' '.$usr['last_name'];
		$email=array_key_exists('email',$usr)? $usr['email']:'';

		$userobj= array('username'=>$email,
						'uid'=>$uid,
						'fullname'=>$name,
						'email'=>$email,
						'provider'=>$providername,
		);

		$result=$this->m_user->getSocialUser($uid,$providername);
		
		$user_data = array();

		if($result != NULL){
			$user = $result;
			
		}else{
			$this->db->insert('tv_user',$userobj);
			$user = $this->m_user->getSocialUser($uid,$providername);
			//send email to user
				$tpl_data = "";
				$subject = "Welcome to Travelovietnam.com";
						
				$tpl_data["RECEIVER"] = $email;
				$tpl_data["FULLNAME"] = $name;
				$tpl_data["PROVIDER"] = $providername;
				$messageToClient = $this->mail_tpl->register_successful($tpl_data);

				// Send confirmation to user
				$mail = array(
		                            "subject"		=> $subject,
									"from_sender"	=> MAIL_INFO,
		                            "name_sender"	=> SITE_NAME,
									"to_receiver"	=> $email,
		                            "message"		=> $messageToClient
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
		}

		foreach($user as $key => $val){
			$user_data[$key] = $val;
		}

		$user_data["login"] = TRUE;
		$this->session->set_userdata('user', $user_data);
		$this->session->set_userdata('logged_in', TRUE);
		if($this->session->userdata('comeback_link')) {
			$redirect_url = $this->session->userdata('comeback_link');
			$this->session->unset_userdata('comeback_link');
			redirect($redirect_url);					
		}else{
			redirect("member/myaccount", "location");	
		}
		
	}
} 