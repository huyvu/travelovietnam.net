<?
class M_User extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_user WHERE id = '{$id}' ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			foreach ($row as $key => $val) {
				$this->$key = $val;
			}
			return $row;
		}
		return null;
	}

	function getUser($info=NULL, $active=NULL)
	{
		$sql   = "SELECT * FROM tv_user WHERE 1 = 1 ";
		if (!is_null($info)) {
			if (empty($info->username) || empty($info->password)) {
				return null;
			}
			if (!empty($info->username)) {
				$sql .= " AND (username = '{$info->username}' OR email = '{$info->username}' OR id = '{$info->username}') ";
			}
			if (!empty($info->password)) {
				$sql .= " AND password = '".md5($info->password)."' ";
			}
		}
		
		if (!empty($active)) {
			$sql .= " AND active = '{$active}' ";
		}
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			foreach ($row as $key => $val) {
				$this->$key = $val;
			}
			return $row;
		}
		return null;
	}
	
	function getUsers($active=NULL)
	{
		$sql   = "SELECT * FROM tv_user WHERE 1 = 1";
		if (!empty($active)) {
			$sql .= " AND active = '{$active}'";
		}

		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function isUserExist($username=NULL, $active=NULL)
	{
		$sql = "SELECT * FROM tv_user WHERE 1 = 1 ";
		if (!empty($username)) {
			$sql .= " AND username = '{$username}' ";
		}
		
		if (!empty($active)) {
			$sql .= " AND active = '{$active}' ";
		}
		
		$query = $this->db->query($sql);
		return ($query->num_rows() > 0);
	}
	
	function getUserByEmail($email, $active=NULL)
	{
		if (empty($email)) {
			return null;
		}
		
		$sql = "SELECT * FROM tv_user WHERE email = '{$email}' ";
		
		if (!empty($active)) {
			$sql .= " AND active = '{$active}' ";
		}
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			foreach ($row as $key => $val) {
				$this->$key = $val;
			}
			return $row;
		}
		return null;
	}

	function getSocialUser($uid=NULL, $provider,$email=NULL, $active=NULL)
	{
		if (empty($provider)) {
			return null;
		}
		$sql = "SELECT * FROM tv_user WHERE 1 = 1 ";
		if (!empty($uid)) {
			$sql .= " AND uid = '{$uid}' ";
		}

		if (!empty($email)) {
			$sql .= " AND email = '{$email}' ";
		}
		
		$sql .= " AND provider='{$provider}'";
				
		if (!empty($active)) {
			$sql .= " AND active = '{$active}' ";
		}
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			foreach ($row as $key => $val) {
				$this->$key = $val;
			}
			return $row;
		}
		return null;
	}
	
	function uuid()
	{
		return strtoupper(substr(dechex(time()).dechex(mt_rand(1,65535)), 0, 6));
	}

	function add($data)
	{
		return $this->db->insert("tv_user", $data);
	}

	function update($data, $where)
	{
		return $this->db->update("tv_user", $data, $where);
	}

	function delete($where)
	{
		return $this->db->delete("tv_user", $where);
	}
	
	function login($username, $password)
	{
		if (empty($username) || empty($password)) {
			return FALSE;
		}
		
		$password = md5($password);
		$sql      = "SELECT * FROM tv_user WHERE username='{$username}' AND password='{$password}' AND active=1";
		$query    = $this->db->query($sql);
		
		if ($query->num_rows() > 0) {
						
			$user = $query->row();
			$user_data = array();
			
			foreach($user as $key => $val){
				$user_data[$key] = $val;
			}
			
			$user_data["login"] = TRUE;
			$this->session->set_userdata('user', $user_data);
			
			if ($user->user_type == USR_ROOT) {
				$this->session->set_userdata('root_addmin_logged_in', TRUE);
				$this->session->set_userdata('addmin_logged_in', TRUE);
			}
			else if (in_array($user->user_type, array(USR_ADMIN,USR_MODERATOR,USR_TOUR,USR_HOTEL,USR_FLIGHT,USR_VISA))) {
				$this->session->set_userdata('root_addmin_logged_in', FALSE);
				$this->session->set_userdata('addmin_logged_in', TRUE);
			}
			else {
				$this->session->set_userdata('root_addmin_logged_in', FALSE);
				$this->session->set_userdata('addmin_logged_in', FALSE);
			}
			$this->session->set_userdata('logged_in', TRUE);
			$this->session->set_userdata('logged_user', $user);
			
			return TRUE;
		}
		
		return FALSE;
	}
	
	function logout()
	{
		$this->session->sess_destroy();
	}

	function verify_reset_password_code($email, $code)
	{
		if (empty($email) || empty($code)) {
			return FALSE;
		}
		
		$sql = "SELECT * FROM tv_user WHERE email = '{$email}' ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return ($code == md5(SITE_NAME.$row->fullname))? TRUE : FALSE;
		} else {
			return FALSE;
		}
	}
}
?>
