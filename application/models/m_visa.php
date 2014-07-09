<?php
class M_Visa extends CI_Model
{
	function add_booking($data)
	{
		return $this->db->insert("tv_visa_booking", $data);
	}
	
	function update_booking($data, $where)
	{
		return $this->db->update("tv_visa_booking", $data, $where);
	}
	
	function delete_booking($where)
	{
		return $this->db->delete("tv_visa_booking", $where);
	}
	
	function add_traveller($data)
	{
		return $this->db->insert("tv_visa_pax", $data);
	}
	
	function update_traveller($data, $where)
	{
		return $this->db->update("tv_visa_pax", $data, $where);
	}
	
	function delete_traveller($where)
	{
		return $this->db->delete("tv_visa_pax", $where);
	}
	
	function searchBookings($text="", $by="")
	{
		$sql  = "SELECT * FROM tv_visa_booking WHERE 1=1";
		if (!empty($text)) {
			if ($by == "name") {
				$sql  = "SELECT tv_visa_booking.* FROM tv_visa_booking INNER JOIN tv_visa_pax ON (tv_visa_pax.book_id = tv_visa_booking.id) WHERE 1=1";
				$sql .= " AND tv_visa_pax.fullname LIKE '%{$text}%'";
			}
			else if ($by == "passport") {
				$sql  = "SELECT tv_visa_booking.* FROM tv_visa_booking INNER JOIN tv_visa_pax ON (tv_visa_pax.book_id = tv_visa_booking.id) WHERE 1=1";
				$sql .= " AND tv_visa_pax.passport LIKE '%{$text}%'";
			}
			else {
				$sql .= " AND (primary_email LIKE '%{$text}%' OR secondary_email LIKE '%{$text}%')";
			}
		}
		$sql .= " ORDER BY tv_visa_booking.booking_date DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getBookings($limit=NULL, $offset=0)
	{
		$sql  = "SELECT * FROM tv_visa_booking ORDER BY tv_visa_booking.booking_date DESC";
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
			$sql .= " OFFSET {$offset}";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function bookByUser($user_id=NULL)
	{
		$sql   = "SELECT *, tv_visa_booking.id AS 'book_id' FROM tv_visa_booking, tv_user WHERE tv_user.id = tv_visa_booking.user_id";
		if (!is_null($user_id))
		{
			$sql .= " AND tv_user.id='{$user_id}'";
		}
		$sql .= " ORDER BY tv_visa_booking.booking_date";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function bookByDate($date=NULL)
	{
		$sql   = "SELECT * FROM tv_visa_booking WHERE 1 = 1";
		if (!is_null($date))
		{
			$sql .= " AND DATE(booking_date)='{$date}'";
		}
		$sql .= " ORDER BY tv_visa_booking.booking_date";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getBooking($book_id=NULL, $key=NULL)
	{
		$sql   = "SELECT * FROM tv_visa_booking WHERE 1 = 1";
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
	
	function getTravelers($book_id=NULL)
	{
		$sql   = "SELECT * FROM tv_visa_pax WHERE 1 = 1";
		if (!is_null($book_id))
		{
			$sql .= " AND book_id='{$book_id}'";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
}
?>
