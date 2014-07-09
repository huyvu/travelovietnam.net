<?php
class M_Restaurant extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_restaurant WHERE id = '{$id}' OR alias = '{$id}'";
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
		$sql   = "SELECT * FROM tv_restaurant WHERE 1 = 1";
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
	
	function getItems($info=NULL, $active=NULL, $limit=NULL, $offset=0)
	{
		$sql   = "SELECT * FROM tv_restaurant WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->catid)) {
				$sql .= " AND catid = '{$info->catid}'";
			}
			if (!empty($info->lang)) {
				$sql .= " AND lang = '{$info->lang}'";
			}
			if (!empty($info->destinations))
			{
				$destination = $info->destinations;
				$sql .= " AND LOCATE('-{$destination[0]}-',REPLACE(CONCAT('-', tv_restaurant.city, '-'), ';', '-'))<>0";
			}
			if (!empty($info->categories))
			{
				$sql .= " AND catid IN (".implode(",", $info->categories).")";
			}
		}
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		$sql .= " ORDER BY top_choice DESC, order_num ASC, created_date DESC";
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
			$sql .= " OFFSET {$offset}";
		}
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getAndCountCategories($active=NULL, $limit=NULL, $offset=0)
	{
		$sql   = "SELECT DISTINCT tv_restaurant_category.*, (SELECT COUNT(*) FROM tv_restaurant AS S WHERE S.catid = tv_restaurant_category.id AND S.active = '{$active}') AS 'total_num' FROM tv_restaurant_category INNER JOIN tv_restaurant ON (tv_restaurant.catid = tv_restaurant_category.id) WHERE 1 = 1";
		if (!is_null($active)) {
			$sql .= " AND tv_restaurant_category.active = '{$active}'";
		}
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
			$sql .= " OFFSET {$offset}";
		}
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getAndCountDestinations($active=NULL, $limit=NULL, $offset=0)
	{
		$sql   = "SELECT DISTINCT tv_tour_destination.*, (SELECT COUNT(*) FROM tv_restaurant AS S WHERE S.city = tv_tour_destination.id AND S.active = '{$active}') AS 'total_num' FROM tv_tour_destination INNER JOIN tv_restaurant ON (tv_restaurant.city = tv_tour_destination.id) WHERE 1 = 1";
		if (!is_null($active)) {
			$sql .= " AND tv_tour_destination.active = '{$active}'";
		}
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
			$sql .= " OFFSET {$offset}";
		}
		$sql .= " ORDER BY tv_tour_destination.name ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getRelatedItems($excluded_id=0) {
		$sql_1   = "SELECT * FROM tv_restaurant WHERE id = '{$excluded_id}'";
		$query_1 = $this->db->query($sql_1);
		$row_1   = $query_1->row();
		
		if (!empty($row_1)) {
			$sql  = "SELECT * FROM tv_restaurant WHERE 1 = 1";
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
	
	function getGmapAddress($destination=NULL, $active=NULL) {
		$sql = "SELECT meta_title,glat,glng,thumbnail,alias, title FROM tv_restaurant WHERE 1=1";
		if (!empty($destination)) {
			$sql .= " AND city={$destination}";
		}
		$query = $this->db->query($sql);

		$arr = array();
		foreach ($query->result_array() as $key => $value) {
			$arrayName = array();
			foreach ($value as $k => $v) {
				array_push($arrayName, $v);
			}
			array_push($arr, $arrayName);
		}

		return $arr;
	}

	function orderUp($id)
	{
		$sql   = "UPDATE tv_restaurant SET order_num = order_num-1 WHERE id = '{$id}'";
		$query = $this->db->query($sql);
	}
	
	function orderDown($id)
	{
		$sql   = "UPDATE tv_restaurant SET order_num = order_num+1 WHERE id = '{$id}'";
		$query = $this->db->query($sql);
	}
	
	function add($data)
	{
		return $this->db->insert("tv_restaurant", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_restaurant", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_restaurant", $where);
	}
}
?>