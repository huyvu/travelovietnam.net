<?php
class M_Tour_Destination extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_tour_destination WHERE id = '{$id}' OR alias = '{$id}' ";
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
	
	function getItems($active=NULL, $limit=NULL, $offset=0)
	{
		$sql   = "SELECT * FROM tv_tour_destination WHERE 1 = 1";
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		$sql .= " ORDER BY name ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getAndCountTourItems($active=NULL, $limit=NULL, $offset=0)
	{
		$sql   = "SELECT TD.*, (SELECT COUNT(*) FROM tv_tour AS T WHERE T.going_to = TD.id AND T.active = '{$active}') AS 'tour_num' FROM tv_tour_destination AS TD WHERE 1 = 1";
		if (!is_null($active)) {
			$sql .= " AND TD.active = '{$active}'";
		}
		$sql .= " ORDER BY TD.name ASC";
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
			$sql .= " OFFSET {$offset}";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function search($destination, $active=NULL)
	{
		$destinations[] = $destination;
		$destinations = array_merge(explode(" ", $destination), $destinations);
		
		$sql   = "SELECT * FROM tv_tour_destination WHERE 1 = 1";
		
		$arrcondition = array();
		foreach ($destinations as $destination) {
			$arrcondition[] = " name LIKE '%{$destination}%' ";
		}
		
		$sql .= " AND (".implode(" OR ", $arrcondition).") ";
		
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		
		$sql .= " ORDER BY name ASC";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function add($data)
	{
		return $this->db->insert("tv_tour_destination", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_tour_destination", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_tour_destination", $where);
	}
}
?>