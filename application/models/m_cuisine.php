<?php
class M_Cuisine extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT tv_cuisine.*, tv_cuisine_category.name AS 'category_name', tv_cuisine_category.alias AS 'category_alias' FROM tv_cuisine INNER JOIN tv_cuisine_category ON (tv_cuisine.catid = tv_cuisine_category.id) WHERE tv_cuisine.id = '{$id}' OR tv_cuisine.alias = '{$id}'";
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
		$sql   = "SELECT tv_cuisine.*, tv_cuisine_category.name AS 'category_name', tv_cuisine_category.alias AS 'category_alias' FROM tv_cuisine INNER JOIN tv_cuisine_category ON (tv_cuisine.catid = tv_cuisine_category.id) WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->catid)) {
				$sql .= " AND tv_cuisine.catid = '{$info->catid}'";
			}
			if (!empty($info->lang)) {
				$sql .= " AND tv_cuisine.lang = '{$info->lang}'";
			}
		}
		if (!is_null($active)) {
			$sql .= " AND tv_cuisine.active = '{$active}'";
		}
		$sql .= " ORDER BY tv_cuisine.order_num ASC, tv_cuisine.created_date DESC";
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
		}
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getRelatedItems($excluded_id=0) {
		$sql_1   = "SELECT * FROM tv_cuisine WHERE id = '{$excluded_id}'";
		$query_1 = $this->db->query($sql_1);
		$row_1   = $query_1->row();
		
		if (!empty($row_1)) {
			$sql  = "SELECT tv_cuisine.*, tv_cuisine_category.name AS 'category_name', tv_cuisine_category.alias AS 'category_alias' FROM tv_cuisine INNER JOIN tv_cuisine_category ON (tv_cuisine.catid = tv_cuisine_category.id) WHERE 1 = 1";
			$sql .= " AND tv_cuisine.id <> '{$excluded_id}'";
			$sql .= " AND tv_cuisine.catid = '{$row_1->catid}'";
			$sql .= " AND tv_cuisine.lang  = '{$row_1->lang}'";
			//$sql .= " AND created_date <= '{$row_1->created_date}'";
			$sql .= " AND tv_cuisine.active = '1'";
			$sql .= " ORDER BY tv_cuisine.order_num ASC";
			$query = $this->db->query($sql);
			return $query->result();
		}
		return null;
	}
	
	function orderUp($id)
	{
		$sql   = "UPDATE tv_cuisine SET order_num = order_num-1 WHERE id = '{$id}'";
		$query = $this->db->query($sql);
	}
	
	function orderDown($id)
	{
		$sql   = "UPDATE tv_cuisine SET order_num = order_num+1 WHERE id = '{$id}'";
		$query = $this->db->query($sql);
	}
	
	function add($data)
	{
		return $this->db->insert("tv_cuisine", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_cuisine", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_cuisine", $where);
	}
}
?>