<?php
class M_User_Online extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_user_online WHERE id = '{$id}'";
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
	
	function getItems($active=NULL, $limit=-1, $offset=0)
	{
		$sql   = "SELECT * FROM tv_user_online WHERE 1 = 1";
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		if ($limit != -1) {
			$sql .= " LIMIT {$limit}";
		}
		if ($offset != 0) {
			$sql .= " OFFSET {$offset}";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getIPs($fromdate=NULL, $todate=NULL, $limit=NULL, $offset=0, $sortby=NULL, $orderby=NULL, $text="")
	{
		$sql   = "SELECT * FROM tv_user_online WHERE 1 = 1";
		
		if (!is_null($fromdate))
		{
			$sql .= " AND DATE(created_date)>='{$fromdate}'";
		}
		if (!is_null($todate))
		{
			$sql .= " AND DATE(created_date)<='{$todate}'";
		}
		if (!empty($text)) {
			$sql .= " AND (ip LIKE '%{$text}%' OR url LIKE '%{$text}%')";
		}
		if (!is_null($sortby)) {
			$sql .= " ORDER BY {$sortby} {$orderby}";
		} else {
			$sql .= " ORDER BY created_date DESC";
		}
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
			$sql .= " OFFSET {$offset}";
		}
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function trackIP()
	{
		$request_uri = $_SERVER['REQUEST_URI'];
		
		if (stripos($request_uri, "/template/") !== false
			|| stripos($request_uri, "/ajax_") !== false
			|| stripos($request_uri, "/ip_tracking") !== false) {
			return;
		}
		
		$usr_online = $this->session->userdata("user_online");
		
		// Close old page
		if (!empty($usr_online)) {
			
			$data = array(
				"open_time"		=> strtotime(date('Y-m-d H:i:s')) - strtotime($usr_online->created_date),
			);
			
			$where = array(
				"ip"			=> $usr_online->ip,
				"url"			=> $usr_online->url,
				"created_date"	=> $usr_online->created_date,
			);
			
			$this->update($data, $where);
		}
		
		$usr_online = new stdClass();
		
		$usr_online->ip 			= $this->util->getRealIpAddr();
		$usr_online->url 			= $request_uri;
		$usr_online->created_date 	= date('Y-m-d H:i:s');
		
		$this->session->set_userdata("user_online", $usr_online);
		
		// Open new page
		$data = array(
			"ip"			=> $usr_online->ip,
			"url"			=> $usr_online->url,
			"created_date"	=> $usr_online->created_date,
		);
		
		$this->add($data);
	}
	
	function deleteFreshIPs()
	{
		$where = array('active' => '1');
		$this->delete($where);
		
		// Restart auto increment value
		// $this->db->query("ALTER TABLE tv_user_online AUTO_INCREMENT = 1");
	}
	
	function add($data)
	{
		return $this->db->insert("tv_user_online", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_user_online", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_user_online", $where);
	}
}
?>