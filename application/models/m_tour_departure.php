<?php
class M_Tour_Departure extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_tour_departure WHERE id = '{$id}' ";
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
	
	function getItems($info=NULL, $active=NULL, $limit = -1, $offset = 0)
	{
		$sql   = "SELECT * FROM tv_tour_departure WHERE 1 = 1";
		if (!empty($info->tour_id)) {
			$sql .= " AND tour_id = '{$info->tour_id}'";
		}
		if (!empty($info->start)) {
			$sql .= " AND start >= '{$info->start}'";
		}
		if (!empty($info->finish)) {
			$sql .= " AND finish <= '{$info->finish}'";
		}
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		$sql .= " ORDER BY start ASC";
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
	
	function add($data)
	{
		return $this->db->insert("tv_tour_departure", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_tour_departure", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_tour_departure", $where);
	}
}
?>
