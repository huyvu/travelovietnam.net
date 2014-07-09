<?php
class M_Requirement extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_requirement WHERE id = '{$id}' ";
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
	
	function getItemByAlias($alias=NULL, $active=NULL)
	{
		$info->alias = $alias;
		return $this->getItem($info, $active);
	}
	
	function getItem($info=NULL, $active=NULL)
	{
		$sql   = "SELECT * FROM tv_requirement WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->id)) {
				$sql .= " AND id = '{$info->id}'";
			}
			if (!empty($info->alias)) {
				$sql .= " AND alias = '{$info->alias}'";
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
		$sql   = "SELECT * FROM tv_requirement WHERE 1 = 1";
		if (!is_null($info)) {
		}
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		$sql .= " ORDER BY citizen ASC";
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
		}
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function add($data)
	{
		return $this->db->insert("tv_requirement", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_requirement", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_requirement", $where);
	}
}
?>