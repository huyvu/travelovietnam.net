<?php
class M_Blog_Category extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_blog_category WHERE id = '{$id}' OR alias = '{$id}'";
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
		$sql   = "SELECT * FROM tv_blog_category WHERE 1 = 1";
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
	
	function getItems($info=NULL, $active=NULL, $limit=NULL)
	{
		$sql   = "SELECT * FROM tv_blog_category WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->lang)) {
				$sql .= " AND lang = '{$info->lang}'";
			}
		}
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
		}
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function orderUp($id)
	{
		$sql   = "UPDATE tv_blog_category SET order_num = order_num-1 WHERE id = '{$id}'";
		$query = $this->db->query($sql);
	}
	
	function orderDown($id)
	{
		$sql   = "UPDATE tv_blog_category SET order_num = order_num+1 WHERE id = '{$id}'";
		$query = $this->db->query($sql);
	}
	
	function add($data)
	{
		return $this->db->insert("tv_blog_category", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_blog_category", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_blog_category", $where);
	}
}
?>