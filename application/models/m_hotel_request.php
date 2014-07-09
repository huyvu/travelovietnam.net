<?php
class M_Hotel_Request extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_hotel_request WHERE id = '{$id}' ";
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
	
	function getItems($info=NULL)
	{
		$sql   = "SELECT * FROM tv_hotel_request WHERE 1 = 1";
		$sql .= " ORDER BY created_date DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function add($data)
	{
		return $this->db->insert("tv_hotel_request", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_hotel_request", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_hotel_request", $where);
	}
}
?>