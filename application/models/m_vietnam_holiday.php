<?php
class M_Vietnam_Holiday extends CI_Model
{
	function load($id)
	{
		if ($id != NULL) {
			$sql   = "SELECT * FROM tv_vietnam_holiday WHERE id = {$id}";
		
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$row = $query->row();
				foreach ($row as $key => $val) {
					$this->$key = $val;
				}
				return $row;
			}
		}
		
		return null;
	}
	
	function getItems($info=NULL, $active=NULL, $limit=NULL)
	{
		$sql   = "SELECT * FROM tv_vietnam_holiday WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->name)) {
				$sql .= " AND name = '{$info->name}'";
			}
		}
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		$sql .= " ORDER BY created_date DESC";
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
		}
		
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getItemsByYear($year, $active = NULL, $limit = -1, $offset = 0)
	{
		$sql   = "SELECT * FROM tv_vietnam_holiday WHERE YEAR(tv_vietnam_holiday.from) = {$year}";
		
		if (!is_null($active))
		{
			$sql .= " AND tv_vietnam_holiday.active='{$active}'";
		}

		if ($limit != -1)
		{
			$sql .= " LIMIT {$limit}";
		}
		if ($offset != 0)
		{
			$sql .= " OFFSET {$offset}";
		}

		$query = $this->db->query($sql);
		return $query->result();
	}

	function getYears($active = NULL, $limit = -1, $offset = 0)
	{
		$sql   = "SELECT YEAR(tv_vietnam_holiday.to) as year FROM tv_vietnam_holiday WHERE 1=1";
		
		if (!is_null($active))
		{
			$sql .= " AND tv_vietnam_holiday.active='{$active}'";
		}

		if ($limit != -1)
		{
			$sql .= " LIMIT {$limit}";
		}
		if ($offset != 0)
		{
			$sql .= " OFFSET {$offset}";
		}
		$sql .= " GROUP BY YEAR(tv_vietnam_holiday.to)";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function add($data)
	{
		return $this->db->insert("tv_vietnam_holiday", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_vietnam_holiday", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_vietnam_holiday", $where);
	}
	
	
}
?>
