<?php
class M_Album extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT tv_album.*, tv_album_category.alias AS 'category_alias' FROM tv_album INNER JOIN tv_album_category ON (tv_album_category.id = tv_album.category_id) WHERE tv_album.id = '{$id}' OR tv_album.alias = '{$id}'";
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
		$sql   = "SELECT tv_album.*, tv_album_category.alias AS 'category_alias' FROM tv_album INNER JOIN tv_album_category ON (tv_album_category.id = tv_album.category_id) WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->category_id)) {
				$sql .= " AND tv_album.category_id = '{$info->category_id}'";
			}
			if (!is_null($info->media_type)) {
				$sql .= " AND tv_album.media_type = '{$info->media_type}'";
			}
		}
		if (!is_null($active)) {
			$sql .= " AND tv_album.active = '{$active}'";
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
		return $this->db->insert("tv_album", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_album", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_album", $where);
	}
}
?>