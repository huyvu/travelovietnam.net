<?php
class M_Room extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_room WHERE id = '{$id}' ";
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
	
	function getItems($info = NULL, $active = NULL, $limit = -1, $offset = 0)
	{
		$sql   = "SELECT * FROM tv_room WHERE 1 = 1";
		if (!empty($info->hotel_id)) {
			$sql .= " AND hotel_id = '{$info->hotel_id}'";
		}
		if (!empty($info->price)) {
			$sql .= " AND price >= '{$info->price}'";
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
		return $this->db->insert("tv_room", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_room", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_room", $where);
	}
}
?>
