<?php
class M_Room_Rate extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_room_rate WHERE id = '{$id}' ";
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
	
	function getItems($room_id)
	{
		$sql   = "SELECT * FROM tv_room_rate WHERE room_id = '{$room_id}'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getSolarRateItems($room_id)
	{
		$sql   = "SELECT * FROM tv_room_rate_solar WHERE room_id = '{$room_id}'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getLunarRateItems($room_id)
	{
		$sql   = "SELECT * FROM tv_room_rate_lunar WHERE room_id = '{$room_id}'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function isExist($room_id, $rate_date)
	{
		$sql   = "SELECT * FROM tv_room_rate WHERE room_id = '{$room_id}' AND rate_date = '{$rate_date}'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return true;
		}
		return false;
	}
	
	function isSolarRateExist($room_id, $rate_day, $rate_month)
	{
		$sql   = "SELECT * FROM tv_room_rate_solar WHERE room_id = '{$room_id}' AND rate_day = '{$rate_day}' AND rate_month = '{$rate_month}'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return true;
		}
		return false;
	}
	
	function isLunarRateExist($room_id, $rate_day, $rate_month)
	{
		$sql   = "SELECT * FROM tv_room_rate_lunar WHERE room_id = '{$room_id}' AND rate_day = '{$rate_day}' AND rate_month = '{$rate_month}'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return true;
		}
		return false;
	}
	
	function getRate($room_id, $rate_date)
	{
		$sql = "SELECT * FROM tv_room_rate WHERE room_id = '{$room_id}' AND rate_date = '{$rate_date}'";
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
	
	function getSolarRate($room_id, $rate_day, $rate_month)
	{
		$sql = "SELECT * FROM tv_room_rate_solar WHERE room_id = '{$room_id}' AND rate_day = '{$rate_day}' AND rate_month = '{$rate_month}'";
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
	
	function getLunarRate($room_id, $rate_day, $rate_month)
	{
		$sql = "SELECT * FROM tv_room_rate_lunar WHERE room_id = '{$room_id}' AND rate_day = '{$rate_day}' AND rate_month = '{$rate_month}'";
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
	
	function add($data)
	{
		return $this->db->insert("tv_room_rate", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_room_rate", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_room_rate", $where);
	}
	
	function addSolarRate($data)
	{
		return $this->db->insert("tv_room_rate_solar", $data);
	}
	
	function updateSolarRate($data, $where)
	{
		return $this->db->update("tv_room_rate_solar", $data, $where);
	}
	
	function deleteSolarRate($where)
	{
		return $this->db->delete("tv_room_rate_solar", $where);
	}
	
	function addLunarRate($data)
	{
		return $this->db->insert("tv_room_rate_lunar", $data);
	}
	
	function updateLunarRate($data, $where)
	{
		return $this->db->update("tv_room_rate_lunar", $data, $where);
	}
	
	function deleteLunarRate($where)
	{
		return $this->db->delete("tv_room_rate_lunar", $where);
	}
}
?>
