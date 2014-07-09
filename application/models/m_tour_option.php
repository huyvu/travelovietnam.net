<?php
class M_Tour_Option extends CI_Model
{
	function load($id)
	{
		if ($id != NULL) {
			$sql   = "SELECT * FROM tv_tour_option WHERE id = {$id}";
		
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
	
	function getItems($tour_id=NULL, $cat_id=NULL, $active=NULL, $limit=NULL)
	{
		$sql   = "SELECT * FROM tv_tour_option WHERE 1 = 1";

		if (!is_null($tour_id)) {
			$sql .= " AND tour_id = '{$tour_id}'";
		}

		if (!is_null($cat_id)) {
			$sql .= " AND cat_id = '{$cat_id}'";
		}

		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		$sql .= " ORDER BY created_date DESC";
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
		}
		
		$query = $this->db->query($sql);
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return null;
	}

	function getItemsByTour($tour_id, $active = NULL, $limit = -1, $offset = 0)
	{
		$sql   = "SELECT * FROM tv_tour_option WHERE tour_id = {$tour_id}";
		
		if (!is_null($active))
		{
			$sql .= " AND tv_tour_option.active='{$active}'";
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
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return null;
	}

	function add($data)
	{
		return $this->db->insert("tv_tour_option", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_tour_option", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_tour_option", $where);
	}
	
	
}
?>
