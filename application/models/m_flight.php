<?php

class M_Flight extends CI_Model {

    function getAirport($id) {
        $sql = "SELECT * FROM tv_flight_airport WHERE id = '{$id}' OR alias = '{$id}' OR code = '{$id}' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return null;
    }

    function getAirports($info = NULL, $active = NULL) {
        $sql = "SELECT * FROM tv_flight_airport WHERE 1=1";
        if (!is_null($info)) {
            
        }
        if (!is_null($active)) {
            $sql .= " AND active='{$active}'";
        }

        $query = $this->db->query($sql);
        return $query->result();
    }

    function getFlight($id) {
        $sql = "SELECT * FROM tv_flight_route WHERE id = '{$id}'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return null;
    }

    function getFlights($info = NULL, $active = NULL) {
        $sql = "SELECT * FROM tv_flight_route WHERE 1=1";
        if (!is_null($info)) {
            if (!empty($info->airline)) {
                $sql .= " AND airline='{$info->airline}'";
            }
            if (!empty($info->leaving_from)) {
                $sql .= " AND leaving_from='{$info->leaving_from}'";
            }
            if (!empty($info->going_to)) {
                $sql .= " AND going_to='{$info->going_to}'";
            }
        }
        if (!is_null($active)) {
            $sql .= " AND active='{$active}'";
        }

        $query = $this->db->query($sql);
        return $query->result();
    }

    function getCheapFlights($info = NULL, $active = NULL) {
        $sql = "SELECT * FROM tv_flight_airport WHERE 1=1";
        if (!is_null($active)) {
            $sql .= " AND active='{$active}'";
        }
        $sql .= " ORDER BY name ASC";
        $query = $this->db->query($sql);
        $airports = $query->result();

        $flights = array();
        foreach ($airports as $airport) {
            $sql = "SELECT * FROM tv_flight_route WHERE 1=1";
            if (!empty($info->leaving_from)) {
                $sql .= " AND leaving_from='{$info->leaving_from}'";
            }
            $sql .= " AND going_to='{$airport->code}'";
            if (!is_null($active)) {
                $sql .= " AND active='{$active}'";
            }
            $sql .= " ORDER BY saverflex ASC";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                $flights[] = $query->row();
            }
        }
        return $flights;
    }

    function add($data) {
        return $this->db->insert("tv_flight_route", $data);
    }

    function update($data, $where) {
        return $this->db->update("tv_flight_route", $data, $where);
    }

    function delete($where) {
        return $this->db->delete("tv_flight_route", $where);
    }

    function add_booking($data) {
        return $this->db->insert("tv_flight_booking", $data);
    }

    function update_booking($data, $where) {
        return $this->db->update("tv_flight_booking", $data, $where);
    }

    function delete_booking($where) {
        return $this->db->delete("tv_flight_booking", $where);
    }

    function add_ticket($data) {
        return $this->db->insert("tv_flight_ticket", $data);
    }

    function update_ticket($data, $where) {
        return $this->db->update("tv_flight_ticket", $data, $where);
    }

    function delete_ticket($where) {
        return $this->db->delete("tv_flight_ticket", $where);
    }

    function add_pax($data) {
        return $this->db->insert("tv_flight_pax", $data);
    }

    function update_pax($data, $where) {
        return $this->db->update("tv_flight_pax", $data, $where);
    }

    function delete_pax($where) {
        return $this->db->delete("tv_flight_pax", $where);
    }

    function getBookings() {
        $sql = "SELECT * FROM tv_flight_booking WHERE 1 = 1";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getBooking($book_id = NULL) {
        $sql = "SELECT * FROM tv_flight_booking WHERE 1 = 1";
        if (!is_null($book_id)) {
            $sql .= " AND id='{$book_id}'";
        }
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return null;
    }

    function getTickets($book_id = NULL) {
        $sql = "SELECT *, (SELECT A.name FROM tv_flight_airport A WHERE A.code = T.leaving_from) AS source, ";
        $sql .= "(SELECT A.name FROM tv_flight_airport A WHERE A.code = T.going_to) AS dest ";
        $sql .= "FROM tv_flight_ticket T WHERE 1 = 1";
        if (!is_null($book_id)) {
            $sql .= " AND T.book_id='{$book_id}'";
        }
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return null;
    }

    function bookByUser($user_id=NULL)
    {
        $sql   = "SELECT *, tv_flight_booking.id AS 'book_id' FROM tv_flight_booking, tv_user WHERE tv_user.id = tv_flight_booking.user_id";
        if (!is_null($user_id))
        {
            $sql .= " AND tv_user.id='{$user_id}'";
        }
        $sql .= " ORDER BY tv_flight_booking.booking_date";
        
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getPaxs($book_id = NULL) {
        $sql = "SELECT * FROM tv_flight_pax WHERE 1 = 1";
        if (!is_null($book_id)) {
            $sql .= " AND book_id='{$book_id}'";
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getStop($route_id) {
        $sql = "SELECT * FROM tv_flight_stop WHERE route_id = '{$route_id}' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return null;
    }
    
    function getStops($info = NULL, $active = NULL) {
        $sql = "SELECT * FROM tv_flight_stop WHERE 1=1";
        if (!is_null($info)) {
            if (!empty($info->route_id)) {
                $sql .= " AND route_id='{$info->route_id}'";
            }
        }
        if (!is_null($active)) {
            $sql .= " AND active='{$active}'";
        }
        
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function delete_stop($where) {
        return $this->db->delete("tv_flight_stop", $where);
    }
 
    function add_stop($data) {
        return $this->db->insert("tv_flight_stop", $data);
    }
   
    function update_stop($data, $where) {
        return $this->db->update("tv_flight_stop", $data, $where);
    }
    
}

?>
