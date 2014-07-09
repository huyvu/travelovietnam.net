<?
class M_Feedback extends CI_Model
{
function load($id)
	{
		$sql   = "SELECT * FROM tv_feedback WHERE id = '{$id}' ";
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
		$sql   = "SELECT * FROM tv_feedback WHERE 1 = 1";
		$sql .= " ORDER BY created_date DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function add($data)
	{
		return $this->db->insert("tv_feedback", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_feedback", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_feedback", $where);
	}
}
?>
