<?php
class M_Album_Photo extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_album_photo WHERE id = '{$id}' OR alias = '{$id}'";
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
		$sql   = "SELECT * FROM tv_album_photo WHERE 1 = 1";
		if (!empty($info->album_id)) {
			$sql .= " AND album_id = '{$info->album_id}'";
		}
		
		$sql .= " ORDER BY album_id, order_num ASC ";
		
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
	
	function orderUp($id)
	{
		$sql   = "UPDATE tv_album_photo SET order_num = order_num-1 WHERE id = '{$id}'";
		$query = $this->db->query($sql);
	}
	
	function orderDown($id)
	{
		$sql   = "UPDATE tv_album_photo SET order_num = order_num+1 WHERE id = '{$id}'";
		$query = $this->db->query($sql);
	}
	
	function add($data)
	{
		return $this->db->insert("tv_album_photo", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_album_photo", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_album_photo", $where);
	}
}
?>
