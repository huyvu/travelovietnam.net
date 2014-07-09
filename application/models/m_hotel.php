<?php
class M_Hotel extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT tv_hotel.*, tv_hotel_destination.name AS 'city_name', tv_hotel_destination.alias AS 'city_alias' FROM tv_hotel INNER JOIN tv_hotel_destination ON (tv_hotel.city = tv_hotel_destination.id) WHERE tv_hotel.id = '{$id}' OR tv_hotel.alias = '{$id}' ";
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
	
	function getItems($info = NULL, $active = NULL, $limit = -1, $offset = 0)
	{
		$sql   = "SELECT tv_hotel.*, tv_hotel_destination.name AS 'city_name', tv_hotel_destination.alias AS 'city_alias' FROM tv_hotel INNER JOIN tv_hotel_destination ON (tv_hotel.city = tv_hotel_destination.id) WHERE 1=1";
		if (!is_null($info))
		{
			if (!empty($info->name))
			{
				$sql .= " AND tv_hotel.name LIKE '%{$info->name}%'";
			}
			if (!empty($info->star))
			{
				$sql .= " AND tv_hotel.star = '{$info->star}'";
			}
			if (!empty($info->city))
			{
				$sql .= " AND tv_hotel.city = '{$info->city}'";
			}
			if (!empty($info->cities))
			{
				$sql .= " AND tv_hotel.city IN (".implode(",", $info->cities).")";
			}
			if (!empty($info->featured))
			{
				$sql .= " AND tv_hotel.featured = '{$info->featured}'";
			}
			if (!empty($info->promotion))
			{
				$sql .= " AND tv_hotel.original_price <> price";
			}
		}
		if (!is_null($active))
		{
			$sql .= " AND tv_hotel.active='{$active}'";
		}
		
		//$sql .= " AND tv_hotel.original_price >= tv_hotel.price";
		//$sql .= " AND tv_hotel.price > '0'";
		//$sql .= " AND tv_hotel.thumbnail IS NOT NULL";
		
		if (!is_null($info) && !empty($info->sortby))
		{
			switch($info->sortby) {
				case 'rating':
						$sql .= " ORDER BY tv_hotel.price ASC ";
						break;
				case 'price':
						$sql .= " ORDER BY tv_hotel.price ASC ";
						break;
				case 'star':
						$sql .= " ORDER BY tv_hotel.star ASC ";
						break;
				case 'name':
						$sql .= " ORDER BY tv_hotel.name ASC ";
						break;
			}
		} else {
			$sql .= " ORDER BY tv_hotel.created_date DESC ";
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
	
	function getSumItems($info = NULL, $active = NULL)
	{
		$sql   = "SELECT COUNT(*) AS total FROM tv_hotel WHERE 1=1";
		if (!is_null($info))
		{
			if (!empty($info->city))
			{
				$sql .= " AND city = '{$info->city}'";
			}
			if (!empty($info->cities))
			{
				$sql .= " AND city IN (".implode(",", $info->cities).")";
			}
		}
		if (!is_null($active))
		{
			$sql .= " AND active='{$active}'";
		}
		
		$row = $this->db->query($sql)->row_array();
		return $row['total'];
	}
	
	function add($data)
	{
		return $this->db->insert("tv_hotel", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_hotel", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_hotel", $where);
	}
	
	function add_booking($data)
	{
		return $this->db->insert("tv_hotel_booking", $data);
	}
	
	function update_booking($data, $where)
	{
		return $this->db->update("tv_hotel_booking", $data, $where);
	}
	
	function delete_booking($where)
	{
		return $this->db->delete("tv_hotel_booking", $where);
	}
	
	function add_class($data)
	{
		return $this->db->insert("tv_hotel_room", $data);
	}
	
	function update_class($data, $where)
	{
		return $this->db->update("tv_hotel_room", $data, $where);
	}
	
	function delete_class($where)
	{
		return $this->db->delete("tv_hotel_room", $where);
	}
	
	function add_pax($data)
	{
		return $this->db->insert("tv_hotel_pax", $data);
	}
	
	function update_pax($data, $where)
	{
		return $this->db->update("tv_hotel_pax", $data, $where);
	}
	
	function delete_pax($where)
	{
		return $this->db->delete("tv_hotel_pax", $where);
	}
	
	function getBookings($limit=NULL, $offset=0)
	{
		$sql  = "SELECT * FROM tv_hotel_booking ORDER BY tv_hotel_booking.booking_date DESC";
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
			$sql .= " OFFSET {$offset}";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function bookByUser($user_id=NULL)
	{
		$sql   = "SELECT *, tv_hotel_booking.id AS 'book_id' FROM tv_hotel_booking, tv_user WHERE tv_user.id = tv_hotel_booking.user_id";
		if (!is_null($user_id))
		{
			$sql .= " AND tv_user.id='{$user_id}'";
		}
		$sql .= " ORDER BY tv_hotel_booking.booking_date";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getBooking($book_id=NULL, $key=NULL)
	{
		$sql   = "SELECT * FROM tv_hotel_booking WHERE 1 = 1";
		if (!is_null($book_id))
		{
			$sql .= " AND id='{$book_id}'";
		}
		if (!is_null($key))
		{
			$sql .= " AND booking_key='{$key}'";
		}
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return null;
	}
	
	function getClasses($book_id=NULL)
	{
		$sql   = "SELECT * FROM tv_hotel_room WHERE 1 = 1";
		if (!is_null($book_id))
		{
			$sql .= " AND book_id='{$book_id}'";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getPaxs($book_id=NULL)
	{
		$sql   = "SELECT * FROM tv_hotel_pax WHERE 1 = 1";
		if (!is_null($book_id))
		{
			$sql .= " AND book_id='{$book_id}'";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
}
?>
