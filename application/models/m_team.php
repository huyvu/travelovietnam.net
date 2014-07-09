<?php
class M_Team extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_team WHERE id = '{$id}' OR alias = '{$id}' ";
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
	
	function getItems($info=NULL)
	{
		$sql   = "SELECT * FROM tv_team WHERE 1 = 1";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function add($data)
	{
		return $this->db->insert("tv_team", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_team", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_team", $where);
	}
}
?>