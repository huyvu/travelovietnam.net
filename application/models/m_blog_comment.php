<?php
class M_Blog_Comment extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_blog_comment WHERE 1 = 1";
		if (is_numeric($id)) {
			$sql .= " AND id = '{$id}'";
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
	
	function getItemByAlias($alias=NULL, $active=NULL)
	{
		$info->alias = $alias;
		return $this->getItem($info, $active);
	}
	
	function getItem($info=NULL, $active=NULL)
	{
		$sql   = "SELECT * FROM tv_blog_comment WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->id)) {
				$sql .= " AND id = '{$info->id}'";
			}
			if (!empty($info->alias)) {
				$sql .= " AND alias = '{$info->alias}'";
			}
			if (!empty($info->catid)) {
				$sql .= " AND catid = '{$info->catid}'";
			}
		}
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		$sql .= " LIMIT 1";
		
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
	
	function getItems($info=NULL, $active=NULL, $limit=NULL)
	{
		$sql   = "SELECT * FROM tv_blog_comment WHERE 1 = 1";
		if (!empty($info)) {
			if (!empty($info->id)) {
				$sql .= " AND blog_id = '{$info->id}'";
			}
		}
		if (!empty($active)) {
			$sql .= " AND tv_blog_comment.active = '{$active}'";
		}
		$sql .= " ORDER BY created_date DESC";
		if (!empty($limit)) {
			$sql .= " LIMIT {$limit}";
		}
		
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getsubItems($parent_id=0, $active=NULL, $limit=NULL)
	{
		$sql   = "SELECT * FROM tv_blog_comment WHERE 1 = 1";
		if (!empty($parent_id)) {
			$sql .= " AND parent_id = '{$parent_id}'";
		}
		if (!is_null($active)) {
			$sql .= " AND tv_blog_comment.active = '{$active}'";
		}
		$sql .= " ORDER BY created_date DESC";
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
		}
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getRelatedItems($excluded_id=0) {
		$sql_1   = "SELECT * FROM tv_blog_comment WHERE id = '{$excluded_id}'";
		$query_1 = $this->db->query($sql_1);
		$row_1   = $query_1->row();
		
		if (!empty($row_1)) {
			$sql  = "SELECT * FROM tv_blog_comment WHERE 1 = 1";
			$sql .= " AND id <> '{$excluded_id}'";
			$sql .= " AND catid = '{$row_1->catid}'";
			$sql .= " AND lang  = '{$row_1->lang}'";
			//$sql .= " AND created_date <= '{$row_1->created_date}'";
			$sql .= " AND active = '1'";
			$sql .= " ORDER BY order_num ASC";
			$query = $this->db->query($sql);
			return $query->result();
		}
		return null;
	}
	

	function orderUp($id)
	{
		$sql   = "UPDATE tv_blog_comment SET order_num = order_num-1 WHERE id = '{$id}'";
		$query = $this->db->query($sql);
	}
	
	function orderDown($id)
	{
		$sql   = "UPDATE tv_blog_comment SET order_num = order_num+1 WHERE id = '{$id}'";
		$query = $this->db->query($sql);
	}
	
	function add($data)
	{
		return $this->db->insert("tv_blog_comment", $data);
	}
	
	function update($data, $where)
	{
			return $this->db->update("tv_blog_comment", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_blog_comment", $where);
	}

	function count($id){
		$where = "blog_id = $id AND parent_id=0";
		$this->db->where('blog_id',$id);
		$this->db->where('active',1);
		$this->db->from('tv_blog_comment');
		return $this->db->count_all_results();
	}
}
?>