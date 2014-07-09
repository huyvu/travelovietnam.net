<?php
class M_Province extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM province WHERE id = '{$id}' ";
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
	
	function getProvinces($info = NULL, $active = NULL, $limit = -1, $offset = 0)
	{
		$sql   = "SELECT * from province WHERE 1=1";
		$query = $this->db->query($sql);
		return $query->result();
	}
}
?>
