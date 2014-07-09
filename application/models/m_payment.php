<?php
class M_Payment extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT * FROM tv_payment WHERE id = '{$id}'";
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
	
	function getItem($info=NULL, $key=NULL)
	{
		$sql   = "SELECT * FROM tv_payment WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->id)) {
				$sql .= " AND id = '{$info->id}'";
			}
		}
		if (!empty($key)) {
			$sql .= " AND payment_key = '{$key}'";
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
	
	function getItems()
	{
		$sql   = "SELECT * FROM tv_payment WHERE 1 = 1";
		$sql .= " ORDER BY id DESC";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function add($data)
	{
		return $this->db->insert("tv_payment", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_payment", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_payment", $where);
	}
	
	function getPayments($fromdate=NULL, $todate=NULL, $payment_method=NULL, $limit=NULL, $offset=0)
	{
		$w1 = "";
		$w2 = "";
		
		if (!empty($fromdate))
		{
			$w1 .= " AND DATE(B.booking_date)>='{$fromdate}'";
			$w2 .= " AND DATE(P.payment_date)>='{$fromdate}'";
		}
		if (!empty($todate))
		{
			$w1 .= " AND DATE(B.booking_date)<='{$todate}'";
			$w2 .= " AND DATE(P.payment_date)<='{$todate}'";
		}
		if (!empty($payment_method))
		{
			$w1 .= " AND B.payment_method='{$payment_method}'";
			$w2 .= " AND P.payment_method='{$payment_method}'";
		}
		
		$sql = "(SELECT B.id AS 'order_id', B.booking_key AS 'key', 'Apply Visa' AS 'payment_type', U.id AS 'customer_id', U.fullname AS 'fullname', B.primary_email, B.secondary_email, B.total_fee AS 'amount', B.payment_method, B.status, B.booking_date AS 'payment_date' FROM tv_visa_booking AS B INNER JOIN tv_user AS U ON (U.id = B.user_id) WHERE 1=1 ".$w1." ORDER BY B.booking_date DESC)
				UNION
				(SELECT B.id AS 'order_id', B.booking_key AS 'key', 'Tour Booking' AS 'payment_type', U.id AS 'customer_id', U.fullname AS 'fullname', B.email, '-' AS secondary_email, B.total_fee AS 'amount', B.payment_method, B.status, B.booking_date AS 'payment_date' FROM tv_tour_booking AS B INNER JOIN tv_user AS U ON (U.id = B.user_id) WHERE 1=1 ".$w1." ORDER BY B.booking_date DESC)
				UNION
				(SELECT P.id AS 'order_id', P.payment_key AS 'key', 'Payment Online' AS 'payment_type', '' AS 'customer_id', P.fullname, P.primary_email, P.secondary_email, P.amount, P.payment_method, P.status, P.payment_date AS 'payment_date' FROM tv_payment AS P WHERE 1=1 ".$w2." ORDER BY P.payment_date DESC)
				ORDER BY payment_date DESC";
		
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
			$sql .= " OFFSET {$offset}";
		}
		
		$query = $this->db->query($sql);
		return $query->result();
	}
}
?>