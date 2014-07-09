<?php
class M_Embassy extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_embassy WHERE id = '{$id}' OR alias = '{$id}'";
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
		$sql   = "SELECT * FROM tv_embassy WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->id)) {
				$sql .= " AND id = '{$info->id}'";
			}
			if (!empty($info->nation)) {
				$sql .= " AND (nation = '{$info->nation}' OR LCASE(nation) LIKE '%".str_ireplace("-"," ",$info->nation)."%')";
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
	
	function getItems($info=NULL, $active=NULL, $limit=NULL)
	{
		$sql   = "SELECT * FROM tv_embassy WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->nation)) {
				$sql .= " AND (nation = '{$info->nation}' OR LCASE(nation) LIKE '%".str_ireplace("-"," ",$info->nation)."%')";
			}
			if (!empty($info->alias)) {
				$sql .= " AND alias = '{$info->alias}'";
			}
			if (!empty($info->lang)) {
				$sql .= " AND lang = '{$info->lang}'";
			}
		}
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function add($data)
	{
		return $this->db->insert("tv_embassy", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_embassy", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_embassy", $where);
	}
}
?>