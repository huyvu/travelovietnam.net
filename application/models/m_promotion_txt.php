<?php
class M_Promotion_Txt extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_promotion_txt WHERE id = '{$id}' ";
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
		$sql   = "SELECT * FROM tv_promotion_txt WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->code)) {
				$sql .= " AND id = '{$info->id}'";
			}
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
		$sql   = "SELECT * FROM tv_promotion_txt";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function add($data)
	{
		return $this->db->insert("tv_promotion_txt", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_promotion_txt", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_promotion_txt", $where);
	}
}
?>