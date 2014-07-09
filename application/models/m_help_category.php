<?php
class M_Help_Category extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_help_category WHERE id = '{$id}' OR alias = '{$id}'";
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
		$sql   = "SELECT * FROM tv_help_category WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->id)) {
				$sql .= " AND id = '{$info->id}'";
			}
			if (!empty($info->alias)) {
				$sql .= " AND alias = '{$info->alias}'";
			}
		}
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return null;
	}
	
	function getItemByAlias($alias=NULL, $active=NULL)
	{
		$info->alias = $alias;
		return $this->getItem($info, $active);
	}
	
	function getItems($active=NULL, $limit=NULL, $offset=0)
	{
		$sql   = "SELECT * FROM tv_help_category WHERE 1 = 1";
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		$sql .= " ORDER BY name ASC";
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
			$sql .= " OFFSET {$offset}";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getAndCountItems($active=NULL, $limit=NULL, $offset=0)
	{
		$csql = "";
		if (!is_null($active)) {
			$csql .= " AND CON.active = '{$active}'";
		}
		$sql = "SELECT CAT.*, (SELECT COUNT(*) FROM tv_help_content AS CON WHERE CON.catid = CAT.id {$csql}) AS 'total_num' FROM tv_help_category AS CAT WHERE 1 = 1";
		if (!is_null($active)) {
			$sql .= " AND CAT.active = '{$active}'";
		}
		$sql .= " ORDER BY CAT.name ASC";
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
			$sql .= " OFFSET {$offset}";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function orderUp($id)
	{
		$sql   = "UPDATE tv_help_category SET order_num = order_num-1 WHERE id = '{$id}'";
		$query = $this->db->query($sql);
	}
	
	function orderDown($id)
	{
		$sql   = "UPDATE tv_help_category SET order_num = order_num+1 WHERE id = '{$id}'";
		$query = $this->db->query($sql);
	}
	
	function add($data)
	{
		return $this->db->insert("tv_help_category", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_help_category", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_help_category", $where);
	}
}
?>