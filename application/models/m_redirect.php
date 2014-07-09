<?php
class M_Redirect extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_redirect WHERE id = '{$id}'";
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
	
	function getItem($info=NULL)
	{
		$sql   = "SELECT * FROM tv_redirect WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->id)) {
				$sql .= " AND id = '{$info->id}'";
			}
			if (!empty($info->from_url)) {
				$sql .= " AND from_url = '{$info->from_url}'";
			}
		}
		$sql .= " LIMIT 1";
		
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
	
	function getItems($info=NULL, $limit=NULL)
	{
		$sql   = "SELECT * FROM tv_redirect WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->from_url)) {
				$sql .= " AND from_url = '{$info->from_url}'";
			}
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function add($data)
	{
		return $this->db->insert("tv_redirect", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_redirect", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_redirect", $where);
	}
}
?>