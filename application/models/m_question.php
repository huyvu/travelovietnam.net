<?php
class M_Question extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_question WHERE id = '{$id}'";
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
	
	function getItem($info=NULL, $active=NULL)
	{
		$sql   = "SELECT * FROM tv_question WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->id)) {
				$sql .= " AND id = '{$info->id}'";
			}
			if (!empty($info->alias)) {
				$sql .= " AND alias = '{$info->alias}'";
			}
		}
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
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
	
	function getItems($info=NULL, $approved=NULL, $limit=-1, $offset=0)
	{
		$sql   = "SELECT * FROM tv_question WHERE 1 = 1";
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
				$sql .= " AND parent_id IS NULL";
			}
			if (!empty($info->term)) {
				$arr = explode(" ", $info->term);
				$terms = "";
				foreach ($arr as $w) {
					$terms .= " OR title LIKE '%{$w}%' OR content LIKE '%{$w}%' ";
				}
				$sql .= " AND (title LIKE '%{$info->term}%' OR content LIKE '%{$info->term}%' {$terms})";
			}
		}
		if (!is_null($approved)) {
			$sql .= " AND active = '{$approved}'";
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
	
	function add($data)
	{
		return $this->db->insert("tv_question", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_question", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_question", $where);
	}
}
?>
