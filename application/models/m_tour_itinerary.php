<?php
class M_Tour_Itinerary extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_tour_itinerary WHERE id = '{$id}' ";
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
		$sql   = "SELECT * FROM tv_tour_itinerary WHERE 1 = 1";
		if (!empty($info->tour_id)) {
			$sql .= " AND tour_id = '{$info->tour_id}'";
		}
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
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
	
	function add($data)
	{
		return $this->db->insert("tv_tour_itinerary", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_tour_itinerary", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_tour_itinerary", $where);
	}
}
?>
