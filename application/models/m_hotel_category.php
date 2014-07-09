<?php
class M_Hotel_Category extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_hotel_category WHERE id = '{$id}' ";
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
	
	function getItems($active=NULL, $limit=NULL, $offset=0)
	{
		$sql   = "SELECT * FROM tv_hotel_category WHERE 1 = 1";
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		$sql .= " ORDER BY name ASC";
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
			$sql .= " OFFSET {$offset}";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function add($data)
	{
		return $this->db->insert("tv_hotel_category", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_hotel_category", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_hotel_category", $where);
	}
}
?>