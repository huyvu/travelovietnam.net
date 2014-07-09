<?php
class M_Tour extends CI_Model
{
	function load($id)
	{
		$sql   = "SELECT tv_tour.*, tv_tour_destination.name AS 'city_name', tv_tour_destination.alias AS 'city_alias', tv_tour_category.name AS 'category_name', tv_tour_category.alias AS 'category_alias' FROM tv_tour INNER JOIN tv_tour_destination ON (tv_tour.depart_from = tv_tour_destination.id) INNER JOIN tv_tour_category ON (tv_tour.category_id = tv_tour_category.id) WHERE tv_tour.id = '{$id}' OR tv_tour.alias = '{$id}' ";
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
		$sql   = "SELECT tv_tour.*, tv_tour_destination.name AS 'city_name', tv_tour_destination.alias AS 'city_alias', tv_tour_category.name AS 'category_name', tv_tour_category.alias AS 'category_alias' FROM tv_tour INNER JOIN tv_tour_destination ON (tv_tour.depart_from = tv_tour_destination.id) INNER JOIN tv_tour_category ON (tv_tour.category_id = tv_tour_category.id) WHERE 1=1";
		
		if (!is_null($info))
		{
			if (!empty($info->search_text))
			{
				if (!empty($info->search_regular)) {
					$search_text = strtolower(trim($info->search_text));
					$arr_text = array_merge(array($search_text), explode(" ", $search_text));
					$arr_cond = array();
					foreach ($arr_text as $text) {
						$arr_cond[] = "LOWER(tv_tour.name) LIKE '%{$text}%'";
						$arr_cond[] = "LOWER(tv_tour.code) LIKE '%{$text}%'";
						$arr_cond[] = "LOWER(tv_tour_destination.name) LIKE '%{$text}%'";
						$arr_cond[] = "LOWER(tv_tour_category.name) LIKE '%{$text}%'";
					}
					
					if (sizeof($arr_cond)) {
						$sql .= " AND (".implode(" OR ", $arr_cond).")";
					}
				}
				else {
					$search_text = strtolower(trim($info->search_text));
					$arr_cond = array();
					$arr_cond[] = "LOWER(tv_tour.name) LIKE '%{$search_text}%'";
					$arr_cond[] = "LOWER(tv_tour.code) LIKE '%{$search_text}%'";
					$arr_cond[] = "LOWER(tv_tour_destination.name) LIKE '%{$search_text}%'";
					$arr_cond[] = "LOWER(tv_tour_category.name) LIKE '%{$search_text}%'";
					
					if (sizeof($arr_cond)) {
						$sql .= " AND (".implode(" OR ", $arr_cond).")";
					}
				}
			}
			if (!empty($info->promotion) || !empty($info->best_seller) || !empty($info->popular))
			{
				$arr_cond = array();
				if (!empty($info->promotion))
				{
					$arr_cond[] = "tv_tour.price < tv_tour.original_price";
				}
				if (!empty($info->best_seller))
				{
					$arr_cond[] = "tv_tour.best_deal = '{$info->best_seller}'";
				}
				if (!empty($info->popular))
				{
					$arr_cond[] = "tv_tour.popular = '{$info->popular}'";
				}
				$sql .= " AND (".implode(" OR ", $arr_cond).")";
			}
			if (!empty($info->destinations))
			{
				$sql .= " AND (tv_tour.depart_from IN (".implode(",", $info->destinations).") OR tv_tour.going_to IN (".implode(",", $info->destinations)."))";
			}
			if (!empty($info->categories))
			{
				$sql .= " AND tv_tour.category_id IN (".implode(",", $info->categories).")";
			}
			if (!empty($info->name))
			{
				$info->name = strtolower($info->name);
				$sql .= " AND LOWER(tv_tour.name) LIKE '%{$info->name}%'";
			}
			if (!empty($info->depart_from))
			{
				$sql .= " AND tv_tour.depart_from = '{$info->depart_from}'";
			}
			if (!empty($info->depart_froms))
			{
				$sql .= " AND tv_tour.depart_from IN (".implode(",", $info->depart_froms).")";
			}
			if (!empty($info->going_to))
			{
				// Search for all destinations of a tour if it has
				$sql .= " AND (tv_tour.going_to = '{$info->going_to}' OR LOCATE('-{$info->going_to}-', REPLACE(CONCAT('-', tv_tour.destinations, '-'), ';', '-')) <> 0)";
			}
			if (!empty($info->going_tos))
			{
				$sql .= " AND tv_tour.going_to IN (".implode(",", $info->going_tos).")";
			}
			if (!empty($info->duration))
			{
				$duration = explode("-", $info->duration);
				$sql .= " AND tv_tour.duration >= '{$duration[0]}'";
				$sql .= " AND tv_tour.duration <= '{$duration[1]}'";
			}
			if (!empty($info->price))
			{
				$price = explode("-", $info->price);
				$sql .= " AND tv_tour.price >= '{$price[0]}'";
				$sql .= " AND tv_tour.price <= '{$price[1]}'";
			}
			if (!empty($info->category_id))
			{
				$sql .= " AND tv_tour.category_id = '{$info->category_id}'";
			}
			if (!empty($info->category_alias))
			{
				$sql .= " AND tv_tour_category.alias = '{$info->category_alias}'";
			}
			if (!empty($info->featured))
			{
				$sql .= " AND tv_tour.featured = '{$info->featured}'";
			}
			if (!empty($info->package))
			{
				$sql .= " AND tv_tour.package = '{$info->package}'";
			}
			if (!empty($info->short_tour))
			{
				$sql .= " AND tv_tour.short_tour = '{$info->short_tour}'";
			}
			if (isset($info->daily))
			{
				$sql .= " AND tv_tour.daily = '{$info->daily}'";
			}
			if (!empty($info->throughout))
			{
				$sql .= " AND tv_tour.throughout = '{$info->throughout}'";
			}
			if (!empty($info->best_deal))
			{
				$sql .= " AND tv_tour.best_deal = '{$info->best_deal}'";
			}
			if (!empty($info->exclude_id))
			{
				$sql .= " AND tv_tour.id <> '{$info->exclude_id}'";
			}
			if (!empty($info->types)) {
				$info->types = array_unique($info->types);
				if (sizeof($info->types) == 1) {
					if ($info->types[0] == 'daily') {
						$sql .= " AND tv_tour.daily = '1'";
					}
					if ($info->types[0] == 'throughout') {
						$sql .= " AND tv_tour.throughout = '1'";
					}
				}
			}
			if (!empty($info->regions)) {
				if (sizeof($info->regions) && !in_array("Throughout", $info->regions)) {
					$sql .= " AND tv_tour_destination.region IN ('".implode('\',\'', $info->regions)."')";
				}
				if (in_array("Throughout", $info->regions)) {
					$sql .= " AND tv_tour.throughout = 1";
				}
			}
		}
		if (!is_null($active))
		{
			$sql .= " AND tv_tour.active='{$active}'";
		}
		
		if (!is_null($info) && !empty($info->sortby))
		{
			$orderby = (!empty($info->orderby)) ? $info->orderby : "ASC";
			
			switch($info->sortby) {
				case 'price':
						$sql .= " ORDER BY tv_tour.price $orderby ";
						break;
				case 'rating':
						$sql .= " ORDER BY tv_tour.price $orderby ";
						break;
				case 'duration':
						$sql .= " ORDER BY tv_tour.duration $orderby ";
						break;
				case 'name':
						$sql .= " ORDER BY tv_tour.name $orderby ";
						break;
				case 'newest':
						$sql .= " ORDER BY tv_tour.created_date $orderby ";
						break;
			}
		} else {
			$sql .= " ORDER BY tv_tour.created_date DESC ";
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
	
	function getItemsByTags($tags, $info = NULL, $active = NULL, $limit = -1, $offset = 0)
	{
		$sql   = "SELECT tv_tour.*, tv_tour_destination.name AS 'city_name', tv_tour_destination.alias AS 'city_alias', tv_tour_category.name AS 'category_name', tv_tour_category.alias AS 'category_alias' FROM tv_tour INNER JOIN tv_tour_destination ON (tv_tour.depart_from = tv_tour_destination.id) INNER JOIN tv_tour_category ON (tv_tour.category_id = tv_tour_category.id) WHERE";
		$i = 1;
		if(!empty($tags)){
			foreach ($tags as $tag) {
				if ($i == 1) {
					$sql .= " tv_tour.tags LIKE '%{$tag}%'";
				}else{
					$sql .= " OR tv_tour.tags LIKE '%{$tag}%'";	
				}
				$i++;
			}
		}else{
			$sql .= " 1=1";
			if (!empty($info->going_to))
			{
				// Search for all destinations of a tour if it has
				$sql .= " AND (tv_tour.going_to = '{$info->going_to}' OR LOCATE('-{$info->going_to}-', REPLACE(CONCAT('-', tv_tour.destinations, '-'), ';', '-')) <> 0)";
			}
		}
		
		if (!is_null($active))
		{
			$sql .= " AND tv_tour.active='{$active}'";
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
		return $this->db->insert("tv_tour", $data);
	}
	
	function update($data, $where)
	{
		return $this->db->update("tv_tour", $data, $where);
	}
	
	function delete($where)
	{
		return $this->db->delete("tv_tour", $where);
	}
	
	function add_booking($data)
	{
		return $this->db->insert("tv_tour_booking", $data);
	}
	
	function update_booking($data, $where)
	{
		return $this->db->update("tv_tour_booking", $data, $where);
	}
	
	function delete_booking($where)
	{
		return $this->db->delete("tv_tour_booking", $where);
	}
	
	function add_pax($data)
	{
		return $this->db->insert("tv_tour_pax", $data);
	}
	
	function update_pax($data, $where)
	{
		return $this->db->update("tv_tour_pax", $data, $where);
	}
	
	function delete_pax($where)
	{
		return $this->db->delete("tv_tour_pax", $where);
	}
	
	function getBookings($limit=NULL, $offset=0, $sortby=NULL, $orderby=NULL, $text="", $by="")
	{
		$sql  = "SELECT DISTINCT tv_tour_booking.*, tv_tour.name AS 'name' FROM tv_tour_booking INNER JOIN tv_tour ON (tv_tour.id = tv_tour_booking.tour_id) INNER JOIN tv_tour_pax ON (tv_tour_pax.book_id = tv_tour_booking.id) WHERE 1=1";
		if (!empty($text)) {
			if ($by == "id") {
				$ID = str_replace("T","",strtoupper($text));
				$sql .= " AND tv_tour_booking.id = '{$ID}'";
			}
			else if ($by == "name") {
				$sql .= " AND tv_tour_pax.fullname LIKE '%{$text}%'";
			}
			else if ($by == "email") {
				$sql .= " AND tv_tour_booking.email LIKE '%{$text}%'";
			}
			else {
				$ID = str_replace("T","",strtoupper($text));
				$sql .= " AND (tv_tour_pax.fullname LIKE '%{$text}%' OR tv_tour_booking.email LIKE '%{$text}%' OR tv_tour_booking.id = '{$ID}')";
			}
		}
		if (!is_null($sortby)) {
			$sql .= " ORDER BY {$sortby} {$orderby}";
		} else {
			$sql .= " ORDER BY tv_tour_booking.booking_date DESC";
		}
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
			$sql .= " OFFSET {$offset}";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function bookByUser($user_id=NULL)
	{
		$sql   = "SELECT tv_tour_booking.*, tv_tour_booking.id AS 'book_id' FROM tv_tour_booking, tv_user WHERE tv_user.id = tv_tour_booking.user_id";
		if (!is_null($user_id))
		{
			$sql .= " AND tv_user.id='{$user_id}'";
		}
		$sql .= " ORDER BY tv_tour_booking.booking_date";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getBooking($book_id=NULL, $key=NULL)
	{
		$sql   = "SELECT * FROM tv_tour_booking WHERE 1 = 1";
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
	
	function getPaxs($book_id=NULL)
	{
		$sql   = "SELECT * FROM tv_tour_pax WHERE 1 = 1";
		if (!is_null($book_id))
		{
			$sql .= " AND book_id='{$book_id}'";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
}
?>
