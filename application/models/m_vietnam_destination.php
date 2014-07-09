<?php
class M_Vietnam_Destination extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_vietnam_destination WHERE id = '{$id}' OR alias = '{$id}' AND active = 1";
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
		$sql   = "SELECT * FROM tv_vietnam_destination WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->id)) {
				$sql .= " AND id = '{$info->id}'";
			}
			if (!empty($info->alias)) {
				$sql .= " AND alias = '{$info->alias}'";
			}
			if (!empty($info->destination_id)) {
				$sql .= " AND destination_id = '{$info->destination_id}'";
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
		$sql   = "SELECT tv_vietnam_destination.* FROM tv_vietnam_destination INNER JOIN tv_tour_destination ON (tv_vietnam_destination.destination_id = tv_tour_destination.id) WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->search)) {
				$sql .= " AND tv_vietnam_destination.title LIKE '%{$info->search}%'";
			}
			if (!empty($info->catid)) {
				$sql .= " AND tv_vietnam_destination.catid = '{$info->catid}'";
			}
			if (!empty($info->region)) {
				$sql .= " AND LOWER(tv_tour_destination.region) = '".strtolower($info->region)."'";
			}
			if (!empty($info->lang)) {
				$sql .= " AND tv_vietnam_destination.lang = '{$info->lang}'";
			}
		}
		if (!is_null($active)) {
			$sql .= " AND tv_vietnam_destination.active = '{$active}'";
		}
		$sql .= " ORDER BY tv_vietnam_destination.order_num ASC, tv_vietnam_destination.title ASC, tv_vietnam_destination.created_date DESC";
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
		}
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getRelatedItems($excluded_id=0) {
		$sql_1   = "SELECT * FROM tv_vietnam_destination WHERE id = '{$excluded_id}'";
		$query_1 = $this->db->query($sql_1);
		$row_1   = $query_1->row();
		
		if (!empty($row_1)) {
			$sql  = "SELECT * FROM tv_vietnam_destination WHERE 1 = 1";
			$sql .= " AND id <> '{$excluded_id}'";
			$sql .= " AND catid = '{$row_1->catid}'";
			$sql .= " AND lang  = '{$row_1->lang}'";
			$sql .= " AND active = '1'";
			$sql .= " ORDER BY order_num ASC";
			$query = $this->db->query($sql);
			return $query->result();
		}
		return null;
	}
	
	function orderUp($id)
	{
		$sql   = "UPDATE tv_vietnam_destination SET order_num = order_num-1 WHERE id = '{$id}'";
		$query = $this->db->query($sql);
	}
	
	function orderDown($id)
	{
		$sql   = "UPDATE tv_vietnam_destination SET order_num = order_num+1 WHERE id = '{$id}'";
		$query = $this->db->query($sql);
	}
	
	function add($data)
	{
		return $this->db->insert("tv_vietnam_destination", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_vietnam_destination", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_vietnam_destination", $where);
	}
}
?>