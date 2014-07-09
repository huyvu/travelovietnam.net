<?php
class M_Tour_Category extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_tour_category WHERE id = '{$id}' OR alias = '{$id}' ";
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
		$sql   = "SELECT * FROM tv_tour_category WHERE 1 = 1";
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		$sql .= " ORDER BY name ASC";
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
			$sql .= " OFFSET {$offset}";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getAndCountTourItems($active=NULL, $limit=NULL, $offset=0)
	{
		$sql   = "SELECT TC.*, (SELECT COUNT(*) FROM tv_tour AS T WHERE T.category_id = TC.id AND T.active = '{$active}') AS 'tour_num' FROM tv_tour_category AS TC WHERE 1 = 1";
		if (!is_null($active)) {
			$sql .= " AND TC.active = '{$active}'";
		}
		$sql .= " ORDER BY TC.name ASC";
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
			$sql .= " OFFSET {$offset}";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function add($data)
	{
		return $this->db->insert("tv_tour_category", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_tour_category", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_tour_category", $where);
	}
}
?>