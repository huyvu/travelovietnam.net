<?php
class M_Nation extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_nation WHERE id = '{$id}' OR alias = '{$id}' ";
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
	
	function getItems()
	{
		$sql   = "SELECT * from tv_nation WHERE 1=1 ORDER BY name ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function add($data)
	{
		return $this->db->insert("tv_nation", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_nation", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_nation", $where);
	}
}
?>
