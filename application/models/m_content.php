<?php
class M_Content extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_content WHERE 1 = 1";
		if (is_numeric($id)) {
			$sql .= " AND id = '{$id}'";
		}
		else {
			$sql .= " AND alias = '{$id}'";
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
	
	function getItemByAlias($alias=NULL, $active=NULL)
	{
		$info->alias = $alias;
		return $this->getItem($info, $active);
	}
	
	function getItem($info=NULL, $active=NULL)
	{
		$sql   = "SELECT * FROM tv_content WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->id)) {
				$sql .= " AND id = '{$info->id}'";
			}
			if (!empty($info->alias)) {
				$sql .= " AND alias = '{$info->alias}'";
			}
			if (!empty($info->catid)) {
				$sql .= " AND catid = '{$info->catid}'";
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
		$sql   = "SELECT * FROM tv_content WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->catid)) {
				$sql .= " AND catid = '{$info->catid}'";
			}
			if (!empty($info->lang)) {
				$sql .= " AND lang = '{$info->lang}'";
			}
		}
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		$sql .= " ORDER BY order_num ASC, created_date DESC";
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
		}
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getRelatedItems($excluded_id=0) {
		$sql_1   = "SELECT * FROM tv_content WHERE id = '{$excluded_id}'";
		$query_1 = $this->db->query($sql_1);
		$row_1   = $query_1->row();
		
		if (!empty($row_1)) {
			$sql  = "SELECT * FROM tv_content WHERE 1 = 1";
			$sql .= " AND id <> '{$excluded_id}'";
			$sql .= " AND catid = '{$row_1->catid}'";
			$sql .= " AND lang  = '{$row_1->lang}'";
			//$sql .= " AND created_date <= '{$row_1->created_date}'";
			$sql .= " AND active = '1'";
			$sql .= " ORDER BY order_num ASC";
			$query = $this->db->query($sql);
			return $query->result();
		}
		return null;
	}
	
	function orderUp($id)
	{
		$sql   = "UPDATE tv_content SET order_num = order_num-1 WHERE id = '{$id}'";
		$query = $this->db->query($sql);
	}
	
	function orderDown($id)
	{
		$sql   = "UPDATE tv_content SET order_num = order_num+1 WHERE id = '{$id}'";
		$query = $this->db->query($sql);
	}
	
	function add($data)
	{
		return $this->db->insert("tv_content", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_content", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_content", $where);
	}
}
?>