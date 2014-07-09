<?php
class M_Mail extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_mail WHERE id = '{$id}'";
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
	
	function getItem($id=NULL)
	{
		$sql   = "SELECT * FROM tv_mail WHERE 1 = 1";
		if (!empty($id)) {
			$sql .= " AND id = '{$id}'";
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
	
	function getItems($limit=NULL, $offset=0)
	{
		$sql   = "SELECT * FROM tv_mail ORDER BY created_date DESC";
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
			$sql .= " OFFSET {$offset}";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function add($data)
	{
		return $this->db->insert("tv_mail", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_mail", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_mail", $where);
	}
}
?>