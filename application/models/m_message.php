<?php
class M_Message extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_message WHERE id = '{$id}' ";
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
		$sql   = "SELECT * FROM tv_message WHERE 1 = 1";
		$sql .= " ORDER BY created_date DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function add($data)
	{
		return $this->db->insert("tv_message", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_message", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_message", $where);
	}
}
?>