<?php
class M_Ticket extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM vs_ticket WHERE id = '{$id}'";
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
	
	function getItem($id=NULL)
	{
		$sql   = "SELECT * FROM vs_ticket WHERE 1 = 1";
		if (!empty($id)) {
			$sql .= " AND id = '{$id}'";
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
	
	function getItems($limit=NULL, $offset=0)
	{
		$sql   = "SELECT * FROM vs_ticket ORDER BY created_date DESC";
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
			$sql .= " OFFSET {$offset}";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function add($data)
	{
		return $this->db->insert("vs_ticket", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("vs_ticket", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("vs_ticket", $where);
	}
}
?>