<?php
class M_Tour_Option_Category extends CI_Model
{
	function load($id)
	{
		if ($id != NULL) {
			$sql   = "SELECT * FROM tv_tour_option_category WHERE id = {$id}";
		
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
		$sql   = "SELECT * FROM tv_tour_option_category WHERE 1 = 1";

		if (!is_null($active)) {
			$sql .= " AND tv_tour_option_category.active = '{$active}'";
		}
		$sql .= " ORDER BY created_date DESC";
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
		}
		
		$query = $this->db->query($sql);
		return $query->result();
	}


	function add($data)
	{
		return $this->db->insert("tv_tour_option_category", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_tour_option_category", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_tour_option_category", $where);
	}
	
	
}
?>
