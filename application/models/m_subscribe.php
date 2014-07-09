<?php
class M_Subscribe extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_subscribe WHERE id = '{$id}' ";
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
	
	function getEmail($info = NULL, $active = NULL, $limit = -1, $offset = 0)
	{
		$sql   = "SELECT * FROM tv_subscribe WHERE 1=1";
		if (!is_null($info))
		{
			if (!empty($info->email))
			{
				$sql .= " AND email = '{$info->email}'";
			}
		}
		if (!is_null($active))
		{	
			$sql .= " AND active='{$active}'";
		}
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
		return $this->db->insert("tv_subscribe", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_subscribe", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_subscribe", $where);
	}	
}
?>
