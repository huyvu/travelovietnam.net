<?php
class M_Review extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_review WHERE id = '{$id}' ";
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
	
	function getItems($info=NULL, $active=NULL, $limit=-1, $offset=0)
	{
		$sql   = "SELECT * FROM tv_review WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->category_id)) {
				$sql .= " AND category_id = '{$info->category_id}'";
			}
			if (!empty($info->ref_id)) {
				$sql .= " AND ref_id = '{$info->ref_id}'";
			}
			if (!empty($info->parent_id)) {
				$sql .= " AND parent_id = '{$info->parent_id}'";
			}
			else if (!empty($info->topLevel)) {
				$sql .= " AND (parent_id IS NULL OR parent_id = '0')";
			}
		}
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		$sql .= " ORDER BY created_date DESC";
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

	function getItemsCount($category_id, $ref_id, $active=NULL) {
		$sql   = "SELECT COUNT(*) as count FROM tv_review WHERE category_id={$category_id} AND ref_id={$ref_id}";
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function add($data)
	{
		return $this->db->insert("tv_review", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_review", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_review", $where);
	}
}
?>