<?php
class M_Tooltip extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_tooltip WHERE 1 = 1";
		if (is_numeric($id)) {
			$sql .= " AND id = '{$id}'";
		}
		else {
			$sql .= " AND name = '{$id}'";
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
	
	function getItem($info=NULL, $active=NULL)
	{
		$sql   = "SELECT * FROM tv_tooltip WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->id)) {
				$sql .= " AND id = '{$info->id}'";
			}
			if (!empty($info->name)) {
				$sql .= " AND name = '{$info->name}'";
			}
		}
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
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
	
	function getItems($active=NULL, $limit=-1, $offset=0)
	{
		$sql   = "SELECT * FROM tv_tooltip WHERE 1 = 1";
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
	
	function add($data)
	{
		return $this->db->insert("tv_tooltip", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_tooltip", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_tooltip", $where);
	}
}
?>