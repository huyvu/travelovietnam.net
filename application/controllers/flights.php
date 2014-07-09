<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once(APPPATH . "libraries/simple_html_dom.php");

class Flights extends CI_Controller {

    public function index() {
        $info = new stdClass();
        $info->leaving_from = 'SGN';
        $flights = $this->m_flight->getCheapFlights($info, 1);

        $airports = $this->m_flight->getAirports();
        $airports_tmp = array();
        foreach ($airports as $k => $airport) {
            $airports_tmp[$airport->code] = $airport;
        }

        $view_data = "";
        $view_data['flights'] = $flights;
        $view_data['airports'] = $airports_tmp;

        $this->session->unset_userdata("flight_search");

        $tmpl_content['content'] = $this->load->view("flight/index", $view_data, TRUE);
        $this->load->view('layout/flight', $tmpl_content);
    }

    public function ajax_get_city() {
        $cities = $this->util->airportCity();

        $citymap = array(
            'AMS' => array('(Vietnam)', 'HAN', 'SGN', '(Australia)', 'MEL', 'SYD', '(Indochina)', 'LPQ', 'VTE', 'PNH', 'REP', '(North East Asia)', 'TYO', 'OSA', 'FUK', 'NGO', 'CAN', 'TPE', 'KHH', 'PUS', 'HKG', '(South East Asia)', 'BKK', 'KUL', 'SIN', 'RGN', 'MNL'),
            'ATL' => array('(Vietnam)', 'HAN', 'SGN'),
            'AUS' => array('(Vietnam)', 'HAN', 'SGN'),
            'BJS' => array('(Vietnam)', 'HAN', 'SGN', '(Europe)', 'FRA', 'PAR'),
            'BKK' => array('(Vietnam)', 'HAN', 'SGN', '(Australia)', 'MEL', 'SYD', '(Europe)', 'FRA', 'LON', 'MOW', 'PAR', '(North East Asia)', 'FUK', 'NGO', 'OSA', 'PUS', 'SEL', 'SHA', 'TPE', 'TYO', 'KHH'),
            'BMV' => array('(Vietnam)', 'DAD', 'HAN', 'SGN', 'VII'),
            'BOS' => array('(Vietnam)', 'HAN', 'SGN'),
            'CAH' => array('(Vietnam)', 'SGN'),
            'CAN' => array('(Vietnam)', 'HAN', 'SGN', '(Europe)', 'FRA', 'LON', 'MOW', 'PAR', '(Indochina)', 'PNH', 'REP', 'VTE', '(South East Asia)', 'BKK', 'KUL', 'SIN'),
            'CHI' => array('(Vietnam)', 'HAN', 'SGN'),
            'DAD' => array('(Vietnam)', 'BMV', 'DLI', 'HAN', 'HPH', 'NHA', 'PXU', 'SGN', 'VII'),
            'DEN' => array('(Vietnam)', 'HAN', 'SGN'),
            'DFW' => array('(Vietnam)', 'HAN', 'SGN'),
            'DIN' => array('(Vietnam)', 'HAN'),
            'DLI' => array('(Vietnam)', 'DAD', 'HAN', 'SGN'),
            'FRA' => array('(Vietnam)', 'DAD', 'HAN', 'HUI', 'NHA', 'SGN', 'PQC', '(Australia)', 'MEL', 'SYD', '(Indochina)', 'PNH', 'REP', 'VTE', 'LPQ', '(North East Asia)', 'BJS', 'CAN', 'FUK', 'HKG', 'NGO', 'OSA', 'PUS', 'SEL', 'SHA', 'TPE', 'TYO', '(South East Asia)', 'BKK', 'JKT', 'KUL', 'SIN', 'RGN', 'MNL'),
            'FUK' => array('(Vietnam)', 'HAN', 'SGN', '(Australia)', 'MEL', 'SYD', '(Europe)', 'FRA', 'PAR', '(Indochina)', 'LPQ', 'PNH', 'REP', 'VTE', '(North East Asia)', 'CAN', '(South East Asia)', 'BKK', 'KUL', 'RGN', 'SIN'),
            'HAN' => array('(Vietnam)', 'BMV', 'DAD', 'DIN', 'DLI', 'HUI', 'NHA', 'PQC', 'PXU', 'SGN', 'TBB', 'UIH', 'VCA', 'VCL', 'VDH', 'VII', '(Australia)', 'MEL', 'SYD', '(Europe)', 'AMS', 'BCN', 'FRA', 'LON', 'MOW', 'NCE', 'PAR', 'PRG', 'ROM', '(Indochina)', 'LPQ', 'PNH', 'REP', 'VTE', '(North East Asia)', 'BJS', 'CAN', 'CTU', 'FUK', 'HKG', 'KHH', 'KMG', 'NGO', 'OSA', 'PUS', 'SEL', 'SHA', 'TPE', 'TYO', '(South East Asia)', 'BKK', 'KUL', 'RGN', 'SIN', '(United States of America)', 'ATL', 'AUS', 'BOS', 'CHI', 'DEN', 'DFW', 'HNL', 'LAX', 'MIA', 'MSP', 'PDX', 'PHL', 'SEA', 'SFO', 'STL', 'WAS'),
            'HKG' => array('(Vietnam)', 'HAN', 'SGN', '(Australia)', 'MEL', 'SYD', '(Europe)', 'FRA', 'LON', 'MOW', 'PAR', '(Indochina)', 'PNH', 'REP', '(South East Asia)', 'BKK', 'JKT', 'KUL', 'RGN', 'SIN'),
            'HNL' => array('(Vietnam)', 'HAN', 'SGN'),
            'HOU' => array(),
            'HPH' => array('(Vietnam)', 'DAD', 'SGN'),
            'HUI' => array('(Vietnam)', 'HAN', 'SGN'),
            'KHH' => array('(Vietnam)', 'HAN', 'SGN', '(Europe)', 'LON', '(Indochina)', 'PNH', 'REP'),
            'KMG' => array('(Vietnam)', 'HAN'),
            'KUL' => array('(Vietnam)', 'DAD', 'HAN', 'HUI', 'SGN', '(Australia)', 'MEL', 'SYD', '(Europe)', 'FRA', 'LON', 'MOW', 'PAR', '(Indochina)', 'PNH', 'REP', 'VTE', '(North East Asia)', 'CAN', 'FUK', 'HKG', 'NGO', 'OSA', 'PUS', 'SEL', 'SHA', 'TPE', 'TYO', 'KHH'),
            'LAX' => array('(Vietnam)', 'HAN', 'SGN'),
            'LPQ' => array('(Vietnam)', 'HAN', '(Indochina)', 'REP', '(Europe)', 'FRA', 'PAR'),
            'MEL' => array('(Vietnam)', 'HAN', 'SGN', '(Europe)', 'FRA', 'LON', 'MOW', 'PAR', '(Indochina)', 'PNH', 'REP', '(North East Asia)', 'CAN', 'FUK', 'HKG', 'NGO', 'OSA', 'PUS', 'SEL', 'SHA', 'TPE', 'TYO', 'KHH', '(South East Asia)', 'BKK', 'SIN'),
            'MIA' => array('(Vietnam)', 'HAN', 'SGN'),
            'MNL' => array('(Vietnam)', 'SGN'),
            'MOW' => array('(Vietnam)', 'HAN', 'NHA', 'SGN', '(Australia)', 'MEL', 'SYD', '(Indochina)', 'PNH', 'REP', 'VTE', 'LPQ', '(North East Asia)', 'BJS', 'CAN', 'HKG', 'KHH', 'SHA', 'TPE', '(South East Asia)', 'BKK', 'KUL', 'SIN', 'RGN', 'MNL'),
            'MSP' => array('(Vietnam)', 'HAN', 'SGN'),
            'NGO' => array('(Vietnam)', 'HAN', 'SGN', '(Australia)', 'MEL', 'SYD', '(Europe)', 'FRA', 'LON', 'PAR', '(Indochina)', 'PNH', 'REP', 'VTE', '(North East Asia)', 'CAN', '(South East Asia)', 'BKK', 'KUL', 'RGN', 'SIN'),
            'NHA' => array('(Vietnam)', 'DAD', 'HAN', 'SGN', '(Europe)', 'MOW'),
            'OSA' => array('(Vietnam)', 'HAN', 'SGN', '(Australia)', 'MEL', 'SYD', '(Europe)', 'FRA', 'LON', 'PAR', '(Indochina)', 'LPQ', 'PNH', 'REP', 'VTE', '(North East Asia)', 'CAN', '(South East Asia)', 'BKK', 'KUL', 'RGN', 'SIN'),
            'PAR' => array('(Vietnam)', 'HAN', 'SGN', '(Australia)', 'MEL', 'SYD', '(Indochina)', 'PNH', 'REP', 'VTE', 'LPQ', '(North East Asia)', 'BJS', 'CAN', 'FUK', 'HKG', 'KHH', 'NGO', 'OSA', 'PUS', 'SEL', 'SHA', 'TPE', 'TYO', '(South East Asia)', 'BKK', 'KUL', 'SIN', 'RGN', 'MNL'),
            'PDX' => array('(Vietnam)', 'HAN', 'SGN'),
            'PHL' => array('(Vietnam)', 'HAN', 'SGN'),
            'PNH' => array('(Vietnam)', 'HAN', 'SGN', '(Australia)', 'MEL', 'SYD', '(Europe)', 'FRA', 'MOW', 'PAR', '(Indochina)', 'VTE', '(North East Asia)', 'BJS', 'CAN', 'FUK', 'NGO', 'OSA', 'SHA', 'TYO', '(South East Asia)', 'KUL', 'SIN'),
            'PQC' => array('(Vietnam)', 'HAN', 'SGN', 'VCA', 'VKG'),
            'PUS' => array('(Vietnam)', 'HAN', 'SGN', '(Australia)', 'MEL', 'SYD', '(Europe)', 'FRA', 'LON', 'MOW', 'PAR', '(Indochina)', 'LPQ', 'REP', '(South East Asia)', 'BKK', 'KUL', 'SIN', 'RGN'),
            'PXU' => array('(Vietnam)', 'DAD', 'HAN', 'SGN'),
            'REP' => array('(Vietnam)', 'HAN', 'SGN', '(Australia)', 'MEL', 'SYD', '(Europe)', 'FRA', 'MOW', 'PAR', '(Indochina)', 'LPQ', '(North East Asia)', 'BJS', 'CAN', 'FUK', 'NGO', 'OSA', 'SHA', 'TYO', '(South East Asia)', 'KUL', 'SIN'),
            'RGN' => array('(Vietnam)', 'HAN', 'SGN'),
            'ROM' => array('(Vietnam)', 'HAN', 'SGN'),
            'SEA' => array('(Vietnam)', 'HAN', 'SGN'),
            'SEL' => array('(Vietnam)', 'HAN', 'SGN', '(Australia)', 'MEL', 'SYD', '(Europe)', 'FRA', 'LON', 'MOW', 'PAR', '(Indochina)', 'PNH', 'REP', 'VTE', '(South East Asia)', 'BKK', 'KUL', 'SIN', 'RGN'),
            'SFO' => array('(Vietnam)', 'HAN', 'SGN'),
            'SGN' => array('(Vietnam)', 'BMV', 'CAH', 'DAD', 'DLI', 'HAN', 'HPH', 'HUI', 'NHA', 'PQC', 'PXU', 'TBB', 'THD', 'UIH', 'VCL', 'VCS', 'VDH', 'VII', 'VKG', '(Australia)', 'MEL', 'SYD', '(Europe)', 'AMS', 'BCN', 'FRA', 'LON', 'MOW', 'NCE', 'PAR', 'PRG', 'ROM', '(Indochina)', 'PNH', 'REP', 'VTE', '(North East Asia)', 'BJS', 'CAN', 'FUK', 'HKG', 'KHH', 'NGO', 'OSA', 'PUS', 'SEL', 'SHA', 'TPE', 'TYO', '(South East Asia)', 'BKK', 'JKT', 'KUL', 'MNL', 'RGN', 'SIN', '(United States of America)', 'ATL', 'AUS', 'BOS', 'CHI', 'DEN', 'DFW', 'HNL', 'LAX', 'MIA', 'MSP', 'PDX', 'PHL', 'SEA', 'SFO', 'STL', 'WAS'),
            'SHA' => array('(Vietnam)', 'HAN', 'SGN', '(Australia)', 'MEL', 'SYD', '(Europe)', 'FRA', 'LON', 'PAR'),
            'SIN' => array('(Vietnam)', 'HAN', 'SGN', '(Europe)', 'FRA', 'LON', 'MOW', 'PAR', '(Indochina)', 'PNH', 'REP', '(North East Asia)', 'FUK', 'NGO', 'OSA', 'PUS', 'SEL', 'SHA', 'TPE', 'TYO', 'KHH'),
            'STL' => array('(Vietnam)', 'HAN', 'SGN'),
            'SYD' => array('(Vietnam)', 'HAN', 'SGN', '(Europe)', 'FRA', 'LON', 'MOW', 'PAR', '(Indochina)', 'PNH', 'REP', '(North East Asia)', 'CAN', 'FUK', 'HKG', 'NGO', 'OSA', 'PUS', 'SEL', 'SHA', 'TPE', 'TYO', 'KHH', '(South East Asia)', 'BKK', 'SIN'),
            'TBB' => array('(Vietnam)', 'HAN', 'SGN'),
            'TPE' => array('(Vietnam)', 'HAN', 'SGN', '(Europe)', 'LON', '(Indochina)', 'PNH', 'REP', '(South East Asia)', 'BKK', 'SIN'),
            'TYO' => array('(Vietnam)', 'HAN', 'SGN', '(Australia)', 'MEL', 'SYD', '(Europe)', 'FRA', 'LON', 'PAR', '(Indochina)', 'LPQ', 'PNH', 'REP', 'VTE', '(North East Asia)', 'CAN', '(South East Asia)', 'BKK', 'JKT', 'KUL', 'RGN', 'SIN'),
            'UIH' => array('(Vietnam)', 'HAN', 'SGN'),
            'VCA' => array('(Vietnam)', 'HAN', 'PQC', 'VCS'),
            'VCL' => array('(Vietnam)', 'HAN', 'SGN'),
            'VCS' => array('(Vietnam)', 'SGN', 'VCA'),
            'VDH' => array('(Vietnam)', 'HAN', 'SGN'),
            'VII' => array('(Vietnam)', 'BMV', 'DAD', 'HAN', 'SGN'),
            'VKG' => array('(Vietnam)', 'PQC', 'SGN'),
            'VTE' => array('(Vietnam)', 'HAN', 'SGN', '(Europe)', 'FRA', 'MOW', 'PAR', '(Indochina)', 'PNH', '(North East Asia)', 'BJS', 'CAN', 'FUK', 'NGO', 'OSA', 'SHA', 'TYO', '(South East Asia)', 'KUL', 'SIN'),
            'WAS' => array('(Vietnam)', 'HAN', 'SGN'),
            'LON' => array('(Vietnam)', 'HAN', 'SGN', '(Australia)', 'MEL', 'SYD', '(Indochina)', 'LPQ', 'PNH', 'REP', 'VTE', '(North East Asia)', 'TPE', 'KHH', 'CAN', 'SHA', 'HKG', 'OSA', 'TYO', 'NGO', 'PUS', 'SEL', '(South East Asia)', 'BKK', 'JKT', 'KUL', 'SIN'),
            'PRG' => array('(Vietnam)', 'HAN', 'SGN'),
            'BCN' => array('(Vietnam)', 'HAN', 'SGN'),
            'JKT' => array('(Vietnam)', 'SGN', '(Europe)', 'FRA', 'LON', '(North East Asia)', 'TYO'),
            'CTU' => array('(Vietnam)', 'HAN'),
            'NCE' => array('(Vietnam)', 'HAN', 'SGN'),
            'THD' => array('(Vietnam)', 'SGN')
        );

        $fromcity = $this->input->post('fromcity');

        $tocity = $citymap[$fromcity];

        $return = '<option value="">Select</option>';

        $tagclosed = TRUE;

        foreach ($tocity as $city) {
            if (!empty($city)) {
                if (strpos($city, "(") !== FALSE) {
                    if (!$tagclosed) {
                        $return .= '</optgroup>';
                        $tagclosed = TRUE;
                    }
                    $return .= '<optgroup label="' . substr($city, 1, strlen($city) - 2) . '">';
                    $tagclosed = FALSE;
                } else {
                    if (!empty($cities[$city])) {
                        $return .= '<option value="' . $city . '">' . $cities[$city] . '</option>';
                    }
                }
            }
        }

        if (!$tagclosed) {
            $return .= '</optgroup>';
        }

        echo $return;
    }

    public function depart() {
        $form = $this->m_flight->getAirport($_GET['from']);
        $to   = $this->m_flight->getAirport($_GET['to']);

        $search->airline		= "Vietnam Airlines";
        $search->direction		= 'return';
        $search->leavingFrom	= !empty($form->code) ? $form->code : 'HAN';
        $search->goingTo		= !empty($to->code) ? $to->code : 'SGN';
        $search->departDate 	= date("m/d/Y", strtotime("+1 days"));
        $search->returnDate 	= date("m/d/Y", strtotime("+4 days"));
        $search->adults   		= 1;
        $search->children 		= 0;
        $search->infants  		= 0;
		
        $flights = $this->search_schedules($search);
		
        $this->session->set_userdata("flight_search", $search);
        $this->session->set_userdata("flights", $flights);
		
        $view_data = "";
        $view_data['search'] = $search;
        $view_data['flights'] = $flights;

        $tmpl_content['content'] = $this->load->view("flight/search", $view_data, TRUE);
        $this->load->view('layout/flight', $tmpl_content);
    }

    public function search() {
        $search = new stdClass();
        $search->airline = "Vietnam Airlines";
        $search->direction = !empty($_POST['flight-direction']) ? $_POST['flight-direction'] : 'oneway';
        $search->leavingFrom = !empty($_POST['flight-fromcity']) ? $_POST['flight-fromcity'] : 'HAN';
        $search->goingTo = !empty($_POST['flight-tocity']) ? $_POST['flight-tocity'] : 'SGN';
        $search->departDate = !empty($_POST['flight-departuredate']) ? $_POST['flight-departuredate'] : date("m/d/Y", strtotime("+1 days"));
        $search->returnDate = !empty($_POST['flight-returndate']) ? $_POST['flight-returndate'] : date("m/d/Y", strtotime("+4 days"));
        $search->adults = !empty($_POST['flight-adults']) ? $_POST['flight-adults'] : 1;
        $search->children = !empty($_POST['flight-children']) ? $_POST['flight-children'] : 0;
        $search->infants = !empty($_POST['flight-infants']) ? $_POST['flight-infants'] : 0;
        $search->classtype = !empty($_POST['flight-classtype']) ? $_POST['flight-classtype'] : 'Economy';

        $flights = $this->search_schedules($search);

        $this->session->set_userdata("flight_search", $search);
        //$this->session->set_userdata("flights", $flights);

        $view_data = "";
        $view_data['search'] = $search;
        $view_data['flights'] = $flights;

        $tmpl_content['content'] = $this->load->view("flight/search", $view_data, TRUE);
        $this->load->view('layout/flight', $tmpl_content);
    }

    function search_schedules($search) {
        return $this->search_from_db($search);
        //return $this->search_from_VNAirline($search);
    }

    function search_from_db($search) {
        $result = array();

        list($month, $day, $year) = explode('/', $search->departDate);
        $departDate = !empty($search->departDate) ? getdate(mktime(0, 0, 0, $month, $day, $year)) : getdate();
        list($month, $day, $year) = explode('/', $search->returnDate);
        $returnDate = !empty($search->returnDate) ? getdate(mktime(0, 0, 0, $month, $day, $year)) : getdate();

        $from = $this->m_flight->getAirport($search->leavingFrom);
        $to = $this->m_flight->getAirport($search->goingTo);

        $info = new stdClass();
        $info->leaving_from = $search->leavingFrom;
        $info->going_to = $search->goingTo;

        $flights = $this->m_flight->getFlights($info, 1);

        foreach ($flights as $route) {
            $flight = new stdClass();
            $flight->id = $route->id;
            $flight->airline = $route->airline;
            $flight->inout = "out";
            $flight->leavingFrom = $route->leaving_from;
            $flight->goingTo = $route->going_to;
            $flight->departureDate = $departDate['mon'] . "/" . $departDate['mday'] . "/" . $departDate['year'];
            $flight->departTime = $route->departure_time;
            $flight->departLocation = $from->name;
            $flight->arrivalTime = $route->arrival_time;
            $flight->arrivalLocation = $to->name;
            $flight->flightNumber = $route->flight;
            $flight->airbus = "";
            $flight->duration = $route->duration;
            $flight->currency = "$";
            $flight->business = $route->business;
            $flight->economy = $route->economy;
            $flight->saverFlex = $route->saverflex;

            $flight->stops = $route->stops;
            $flight->stopDetail = $route->stop_detail;

            $result[] = $flight;
        }

        $info->leaving_from = $search->goingTo;
        $info->going_to = $search->leavingFrom;

        $flights = $this->m_flight->getFlights($info, 1);

        foreach ($flights as $route) {
            $flight = new stdClass();
            $flight->id = $route->id;
            $flight->airline = $route->airline;
            $flight->inout = "in";
            $flight->leavingFrom = $route->leaving_from;
            $flight->goingTo = $route->going_to;
            $flight->departureDate = $returnDate['mon'] . "/" . $returnDate['mday'] . "/" . $returnDate['year'];
            $flight->departTime = $route->departure_time;
            $flight->departLocation = $to->name;
            $flight->arrivalTime = $route->arrival_time;
            $flight->arrivalLocation = $from->name;
            $flight->flightNumber = $route->flight;
            $flight->airbus = "";
            $flight->duration = $route->duration;
            $flight->currency = "$";
            $flight->business = $route->business;
            $flight->economy = $route->economy;
            $flight->saverFlex = $route->saverflex;

            $flight->stops = $route->stops;
            $flight->stopDetail = $route->stop_detail;

            $result[] = $flight;
        }

        return $result;
    }

    function search_from_VNAirline($search = NULL) {
        $result = array();

        if (!is_null($search)) {
            $from = !empty($search->leavingFrom) ? $search->leavingFrom : "SGN";
            $to = !empty($search->goingTo) ? $search->goingTo : "HAN";

            list($month, $day, $year) = explode('/', $search->departDate);
            $departDate = !empty($search->departDate) ? getdate(mktime(0, 0, 0, $month, $day, $year)) : getdate();
            list($month, $day, $year) = explode('/', $search->returnDate);
            $returnDate = !empty($search->returnDate) ? getdate(mktime(0, 0, 0, $month, $day, $year)) : getdate();

            $depDay = $departDate["mday"];
            $depMonth = strtoupper(substr($departDate["month"], 0, 3));
            $depYear = $departDate["year"];

            $retDay = $returnDate["mday"];
            $retMonth = strtoupper(substr($returnDate["month"], 0, 3));

            $ADT = !empty($search->adults) ? $search->adults : 1;
            $CHD = !empty($search->children) ? $search->children : 0;
            $SEN = !empty($search->infants) ? $search->infants : 0;

            $direction = (!empty($search->direction) && ($search->direction == "return")) ? "returntravel" : "onewaytravel";

            $fields = array(
                "componentTypes" => "prbar",
                "componentTypes" => "flomes",
                "componentTypes" => "password",
                "journey" => "ROUND_TRIP",
                "itineraryParts[0].departureAirport" => "SGN",
                "origin[0]" => "Ho Chi Minh City (SGN)",
                "itineraryParts[0].disabled" => "false",
                "itineraryParts[0].arrivalAirport" => "HAN",
                "destination[0]" => "Hanoi (HAN)",
                "itineraryParts[0].date" => "2013/08/17 10:33",
                "dateDepartureText[0]" => "17/08/2013",
                "itineraryParts[1].date" => "2013/08/20 10:33",
                "dateReturnText[0]" => "20/08/2013",
                "cabin" => "ECONOMY",
                "passengers.hidden" => "",
                "passengers[ADT]" => "1",
                "passengers[CHD]" => "0",
                "passengers[INF]" => "0",
                "promo" => "",
                "travelOptionsHotelReservation" => "false",
                "travelOptionsNumberOfRooms" => "1",
                "travelOptionsCarRental" => "false",
                "submited" => "submited",
                "componentTypes" => "fsc",
                "_eventId_next" => "",
                "componentTypes" => "sbmt",
                "componentTypes" => "lay"
            );

            $url = "https://wl-prod.sabresonicweb.com/SSW2010/B3QE/webqtrip.html?execution=e1s1";

            // Post and get data from the target webpages
            $html = file_get_html($url);
            //echo $html; die();

            if (!empty($html)) {

                $id = time();
                $SOLD_OUT = "SOLD OUT";

                $bfm_tbl_outs = $html->find('#bfm_tbl_out');
                $bfm_tbl_ins = $html->find('#bfm_tbl_in');

                // Find all flights info
                foreach ($bfm_tbl_outs as $table) {

                    foreach ($table->find('tr[class=_out]') as $tr) {

                        if (strtolower($tr->children(0)->tag) == "td") { // Unexpected <TH> type
                            $flight = "";
                            $flight->id = $id++;
                            $flight->airline = "Vietnam Airlines";
                            $flight->inout = "out";
                            $flight->leavingFrom = $from;
                            $flight->goingTo = $to;
                            $flight->departureDate = $departDate['mon'] . "/" . $departDate['mday'] . "/" . $departDate['year'];
                            $flight->departTime = "";
                            $flight->departLocation = "";
                            $flight->arrivalTime = "";
                            $flight->arrivalLocation = "";
                            $flight->flightNumber = "";
                            $flight->airbus = "";
                            $flight->direct = "";
                            $flight->duration = "";

                            $businessFlex = $SOLD_OUT;
                            $economyFlex = $SOLD_OUT;
                            $saverFlex = $SOLD_OUT;

                            foreach ($tr->children as $td) {
                                if ($td->getAttribute('class') == "matrix_cal_body matrix_cal_body_dep") {
                                    $depTimeSR = $td->children(0);
                                    $flight->departLocation = trim($depTimeSR->children(1)->find('table tbody tr td', 0)->plaintext);
                                    $flight->departTime = trim($depTimeSR->children(3)->plaintext);
                                } else if ($td->getAttribute('class') == "matrix_cal_body matrix_cal_body_arr") {
                                    $arrTimeSR = $td->children(0);
                                    $flight->arrivalLocation = trim($arrTimeSR->children(1)->find('table tbody tr td', 0)->plaintext);
                                    $flight->arrivalTime = trim($arrTimeSR->children(3)->plaintext);
                                } else if ($td->getAttribute('class') == "matrix_cal_body matrix_cal_body_flifo") {
                                    $flightInfoDiv = $td->children(0);
                                    $flight->flightNumber = trim($flightInfoDiv->children(2)->children(0)->plaintext);
                                    $flight->airbus = trim($flightInfoDiv->children(3)->plaintext);
                                } else if ($td->getAttribute('class') == "matrix_cal_body matrix_cal_body_stops") {
                                    $flight->direct = trim($td->children(0)->plaintext);
                                } else if (strpos($td->getAttribute('class'), "matrix_cal_body matrix_cal_body_fare1") !== false) {
                                    $price = $td->find('span a', 0);
                                    if (!empty($price)) {
                                        $businessFlex = $price->plaintext;
                                    }
                                } else if (strpos($td->getAttribute('class'), "matrix_cal_body matrix_cal_body_fare2") !== false) {
                                    $price = $td->find('span a', 0);
                                    if (!empty($price)) {
                                        $economyFlex = $price->plaintext;
                                    }
                                } else if (strpos($td->getAttribute('class'), "matrix_cal_body matrix_cal_body_fare3") !== false) {
                                    $price = $td->find('span a', 0);
                                    if (!empty($price)) {
                                        $saverFlex = $price->plaintext;
                                    }
                                }
                            }

                            $flight->duration = floor((strtotime($flight->arrivalTime) - strtotime($flight->departTime)) / 3600) . ":" . (strtotime($flight->arrivalTime) - strtotime($flight->departTime) - (floor((strtotime($flight->arrivalTime) - strtotime($flight->departTime)) / 3600)) * 3600) / 60;
                            $flight->currency = "$";
                            $flight->business = (trim(strtoupper($businessFlex)) == $SOLD_OUT) ? $businessFlex : round(trim(str_replace(",", "", str_replace($flight->currency, "", $businessFlex))) * 1.2 / USD_VND);
                            $flight->economy = (trim(strtoupper($economyFlex)) == $SOLD_OUT) ? $economyFlex : round(trim(str_replace(",", "", str_replace($flight->currency, "", $economyFlex))) * 1.2 / USD_VND);
                            $flight->saverFlex = (trim(strtoupper($saverFlex)) == $SOLD_OUT) ? $saverFlex : round(trim(str_replace(",", "", str_replace($flight->currency, "", $saverFlex))) * 1.2 / USD_VND);

                            $flight->stop = array();

                            $result[] = $flight;
                        }
                    }
                }

                // Find all return flights info
                foreach ($bfm_tbl_ins as $table) {

                    foreach ($table->find('tr[class=_in]') as $tr) {

                        if (strtolower($tr->children(0)->tag) == "td") { // Unexpected <TH> type
                            $flight = "";
                            $flight->id = $id++;
                            $flight->airline = "Vietnam Airlines";
                            $flight->inout = "in";
                            $flight->leavingFrom = $to;
                            $flight->goingTo = $from;
                            $flight->departureDate = $returnDate['mon'] . "/" . $returnDate['mday'] . "/" . $returnDate['year'];
                            $flight->departTime = "";
                            $flight->departLocation = "";
                            $flight->arrivalTime = "";
                            $flight->arrivalLocation = "";
                            $flight->flightNumber = "";
                            $flight->airbus = "";
                            $flight->direct = "";
                            $flight->duration = "";

                            $businessFlex = $SOLD_OUT;
                            $economyFlex = $SOLD_OUT;
                            $saverFlex = $SOLD_OUT;

                            foreach ($tr->children as $td) {
                                if ($td->getAttribute('class') == "matrix_cal_body matrix_cal_body_dep") {
                                    $depTimeSR = $td->children(0);
                                    $flight->departLocation = trim($depTimeSR->children(1)->find('table tbody tr td', 0)->plaintext);
                                    $flight->departTime = trim($depTimeSR->children(3)->plaintext);
                                } else if ($td->getAttribute('class') == "matrix_cal_body matrix_cal_body_arr") {
                                    $arrTimeSR = $td->children(0);
                                    $flight->arrivalLocation = trim($arrTimeSR->children(1)->find('table tbody tr td', 0)->plaintext);
                                    $flight->arrivalTime = trim($arrTimeSR->children(3)->plaintext);
                                } else if ($td->getAttribute('class') == "matrix_cal_body matrix_cal_body_flifo") {
                                    $flightInfoDiv = $td->children(0);
                                    $flight->flightNumber = trim($flightInfoDiv->children(2)->children(0)->plaintext);
                                    $flight->airbus = trim($flightInfoDiv->children(3)->plaintext);
                                } else if ($td->getAttribute('class') == "matrix_cal_body matrix_cal_body_stops") {
                                    $flight->direct = trim($td->children(0)->plaintext);
                                } else if (strpos($td->getAttribute('class'), "matrix_cal_body matrix_cal_body_fare1") !== false) {
                                    $price = $td->find('span a', 0);
                                    if (!empty($price)) {
                                        $businessFlex = $price->plaintext;
                                    }
                                } else if (strpos($td->getAttribute('class'), "matrix_cal_body matrix_cal_body_fare2") !== false) {
                                    $price = $td->find('span a', 0);
                                    if (!empty($price)) {
                                        $economyFlex = $price->plaintext;
                                    }
                                } else if (strpos($td->getAttribute('class'), "matrix_cal_body matrix_cal_body_fare3") !== false) {
                                    $price = $td->find('span a', 0);
                                    if (!empty($price)) {
                                        $saverFlex = $price->plaintext;
                                    }
                                }
                            }

                            $flight->duration = floor((strtotime($flight->arrivalTime) - strtotime($flight->departTime)) / 3600) . ":" . (strtotime($flight->arrivalTime) - strtotime($flight->departTime) - (floor((strtotime($flight->arrivalTime) - strtotime($flight->departTime)) / 3600)) * 3600) / 60;
                            $flight->currency = "$";
                            $flight->business = (trim(strtoupper($businessFlex)) == $SOLD_OUT) ? $businessFlex : round(trim(str_replace(",", "", str_replace($flight->currency, "", $businessFlex))) * 1.2 / USD_VND);
                            $flight->economy = (trim(strtoupper($economyFlex)) == $SOLD_OUT) ? $economyFlex : round(trim(str_replace(",", "", str_replace($flight->currency, "", $economyFlex))) * 1.2 / USD_VND);
                            $flight->saverFlex = (trim(strtoupper($saverFlex)) == $SOLD_OUT) ? $saverFlex : round(trim(str_replace(",", "", str_replace($flight->currency, "", $saverFlex))) * 1.2 / USD_VND);

                            $flight->stop = array();

                            $result[] = $flight;
                        }
                    }
                }
            }
        }
        return $result;
    }

    function search_from_VNAirline_old($search = NULL) {
        $result = array();

        if (!is_null($search)) {
            $from = !empty($search->leavingFrom) ? $search->leavingFrom : "SGN";
            $to = !empty($search->goingTo) ? $search->goingTo : "HAN";

            list($month, $day, $year) = explode('/', $search->departDate);
            $departDate = !empty($search->departDate) ? getdate(mktime(0, 0, 0, $month, $day, $year)) : getdate();
            list($month, $day, $year) = explode('/', $search->returnDate);
            $returnDate = !empty($search->returnDate) ? getdate(mktime(0, 0, 0, $month, $day, $year)) : getdate();

            $depDay = $departDate["mday"];
            $depMonth = strtoupper(substr($departDate["month"], 0, 3));
            $depYear = $departDate["year"];

            $retDay = $returnDate["mday"];
            $retMonth = strtoupper(substr($returnDate["month"], 0, 3));

            $ADT = !empty($search->adults) ? $search->adults : 1;
            $CHD = !empty($search->children) ? $search->children : 0;
            $SEN = !empty($search->infants) ? $search->infants : 0;

            $direction = (!empty($search->direction) && ($search->direction == "return")) ? "returntravel" : "onewaytravel";

            $fields = array(
                "posid" => "B3QE",
                "MATRIX" => "ENABLE",
                "localeChanged" => "false",
                "CityKeyToGetTimeZoneOffset" => "To",
                "currency" => "VND",
                "vtoDestlang" => "en",
                "directionInd" => $direction,
                "departDay" => $depDay,
                "DelegateHostName" => "dtVN_SABRE",
                "retTime" => "anytimeFromHost",
                "retDateMonth" => $retDay . $retMonth,
                "retDay" => $retDay,
                "showAirlines" => "FALSE",
                "Display_only_PV_Fares" => "true",
                "requestid" => "airRequest",
                "actionType" => "nonFlex",
                "locale" => "en",
                "loginPage" => "nonFlex",
                "MinutesOffset" => "0",
                "vtolang" => "0",
                "ADT" => $ADT,
                "CHD" => $CHD,
                "flexlevel" => "non",
                "depTime" => "anytimeFromHost",
                "path" => "nonFlex",
                "ShoppingCartCount" => "0",
                "actionPage" => "fareMatrixResult",
                "SSL" => "false",
                "language" => "en",
                "CurrencyCode" => "VND",
                "errorsExist" => "FALSE",
                "action" => "airRequest",
                "biasHosted" => "",
                "airline1" => "VN",
                "returnTime" => "anytimeFromHost",
                "page" => "nonFlexairRequestMessage_air",
                "Fare_Quote" => "true",
                "From" => $from,
                "PricingOptions" => "FalseFalse[ManualDiscount]PFalseTrueVNDFalseTrue",
                "depMonth" => $depMonth,
                "PageNumber" => "0",
                "depDateMonth" => $depDay . $depMonth,
                "multi" => "false",
                "returnMonth" => $retMonth,
                "departTimeZoneOffset" => "12",
                "returnYear" => $returnDate["year"],
                "departTime" => "anytimeFromHost",
                "direction" => $direction,
                "fareled" => "false",
                "To" => $to,
                "Departure_Date" => $depDay . $depMonth,
                "Return_Date" => $retDay . $retMonth,
                "retMonth" => $retMonth,
                "showfares" => "false",
                "RequestForItin" => "Air",
                "departYear" => $depYear,
                "MCO_FLAG" => "DISABLE",
                "biasHostedCarrier" => "VN",
                "SEARCHPATH" => "Nonflexible",
                "departMonth" => $depMonth,
                "depDay" => $depDay,
                "forceMatch" => "false",
                "returnDay" => $retDay,
                "LeftAirSearch" => "true",
            );

            $url = "https://cat.sabresonicweb.com/SSWVN/meridia?" . http_build_query($fields);

            // Post and get data from the target webpages
            $html = file_get_html($url);

            if (!empty($html)) {

                $id = time();
                $SOLD_OUT = "SOLD OUT";

                $bfm_tbl_outs = $html->find('#bfm_tbl_out');
                $bfm_tbl_ins = $html->find('#bfm_tbl_in');

                // Find all flights info
                foreach ($bfm_tbl_outs as $table) {

                    foreach ($table->find('tr[class=_out]') as $tr) {

                        if (strtolower($tr->children(0)->tag) == "td") { // Unexpected <TH> type
                            $flight = "";
                            $flight->id = $id++;
                            $flight->airline = "Vietnam Airlines";
                            $flight->inout = "out";
                            $flight->leavingFrom = $from;
                            $flight->goingTo = $to;
                            $flight->departureDate = $departDate['mon'] . "/" . $departDate['mday'] . "/" . $departDate['year'];
                            $flight->departTime = "";
                            $flight->departLocation = "";
                            $flight->arrivalTime = "";
                            $flight->arrivalLocation = "";
                            $flight->flightNumber = "";
                            $flight->airbus = "";
                            $flight->direct = "";
                            $flight->duration = "";

                            $businessFlex = $SOLD_OUT;
                            $economyFlex = $SOLD_OUT;
                            $saverFlex = $SOLD_OUT;

                            foreach ($tr->children as $td) {
                                if ($td->getAttribute('class') == "matrix_cal_body matrix_cal_body_dep") {
                                    $depTimeSR = $td->children(0);
                                    $flight->departLocation = trim($depTimeSR->children(1)->find('table tbody tr td', 0)->plaintext);
                                    $flight->departTime = trim($depTimeSR->children(3)->plaintext);
                                } else if ($td->getAttribute('class') == "matrix_cal_body matrix_cal_body_arr") {
                                    $arrTimeSR = $td->children(0);
                                    $flight->arrivalLocation = trim($arrTimeSR->children(1)->find('table tbody tr td', 0)->plaintext);
                                    $flight->arrivalTime = trim($arrTimeSR->children(3)->plaintext);
                                } else if ($td->getAttribute('class') == "matrix_cal_body matrix_cal_body_flifo") {
                                    $flightInfoDiv = $td->children(0);
                                    $flight->flightNumber = trim($flightInfoDiv->children(2)->children(0)->plaintext);
                                    $flight->airbus = trim($flightInfoDiv->children(3)->plaintext);
                                } else if ($td->getAttribute('class') == "matrix_cal_body matrix_cal_body_stops") {
                                    $flight->direct = trim($td->children(0)->plaintext);
                                } else if (strpos($td->getAttribute('class'), "matrix_cal_body matrix_cal_body_fare1") !== false) {
                                    $price = $td->find('span a', 0);
                                    if (!empty($price)) {
                                        $businessFlex = $price->plaintext;
                                    }
                                } else if (strpos($td->getAttribute('class'), "matrix_cal_body matrix_cal_body_fare2") !== false) {
                                    $price = $td->find('span a', 0);
                                    if (!empty($price)) {
                                        $economyFlex = $price->plaintext;
                                    }
                                } else if (strpos($td->getAttribute('class'), "matrix_cal_body matrix_cal_body_fare3") !== false) {
                                    $price = $td->find('span a', 0);
                                    if (!empty($price)) {
                                        $saverFlex = $price->plaintext;
                                    }
                                }
                            }

                            $flight->duration = floor((strtotime($flight->arrivalTime) - strtotime($flight->departTime)) / 3600) . ":" . (strtotime($flight->arrivalTime) - strtotime($flight->departTime) - (floor((strtotime($flight->arrivalTime) - strtotime($flight->departTime)) / 3600)) * 3600) / 60;
                            $flight->currency = "$";
                            $flight->business = (trim(strtoupper($businessFlex)) == $SOLD_OUT) ? $businessFlex : round(trim(str_replace(",", "", str_replace($flight->currency, "", $businessFlex))) * 1.2 / USD_VND);
                            $flight->economy = (trim(strtoupper($economyFlex)) == $SOLD_OUT) ? $economyFlex : round(trim(str_replace(",", "", str_replace($flight->currency, "", $economyFlex))) * 1.2 / USD_VND);
                            $flight->saverFlex = (trim(strtoupper($saverFlex)) == $SOLD_OUT) ? $saverFlex : round(trim(str_replace(",", "", str_replace($flight->currency, "", $saverFlex))) * 1.2 / USD_VND);

                            $flight->stop = array();

                            $result[] = $flight;
                        }
                    }
                }

                // Find all return flights info
                foreach ($bfm_tbl_ins as $table) {

                    foreach ($table->find('tr[class=_in]') as $tr) {

                        if (strtolower($tr->children(0)->tag) == "td") { // Unexpected <TH> type
                            $flight = "";
                            $flight->id = $id++;
                            $flight->airline = "Vietnam Airlines";
                            $flight->inout = "in";
                            $flight->leavingFrom = $to;
                            $flight->goingTo = $from;
                            $flight->departureDate = $returnDate['mon'] . "/" . $returnDate['mday'] . "/" . $returnDate['year'];
                            $flight->departTime = "";
                            $flight->departLocation = "";
                            $flight->arrivalTime = "";
                            $flight->arrivalLocation = "";
                            $flight->flightNumber = "";
                            $flight->airbus = "";
                            $flight->direct = "";
                            $flight->duration = "";

                            $businessFlex = $SOLD_OUT;
                            $economyFlex = $SOLD_OUT;
                            $saverFlex = $SOLD_OUT;

                            foreach ($tr->children as $td) {
                                if ($td->getAttribute('class') == "matrix_cal_body matrix_cal_body_dep") {
                                    $depTimeSR = $td->children(0);
                                    $flight->departLocation = trim($depTimeSR->children(1)->find('table tbody tr td', 0)->plaintext);
                                    $flight->departTime = trim($depTimeSR->children(3)->plaintext);
                                } else if ($td->getAttribute('class') == "matrix_cal_body matrix_cal_body_arr") {
                                    $arrTimeSR = $td->children(0);
                                    $flight->arrivalLocation = trim($arrTimeSR->children(1)->find('table tbody tr td', 0)->plaintext);
                                    $flight->arrivalTime = trim($arrTimeSR->children(3)->plaintext);
                                } else if ($td->getAttribute('class') == "matrix_cal_body matrix_cal_body_flifo") {
                                    $flightInfoDiv = $td->children(0);
                                    $flight->flightNumber = trim($flightInfoDiv->children(2)->children(0)->plaintext);
                                    $flight->airbus = trim($flightInfoDiv->children(3)->plaintext);
                                } else if ($td->getAttribute('class') == "matrix_cal_body matrix_cal_body_stops") {
                                    $flight->direct = trim($td->children(0)->plaintext);
                                } else if (strpos($td->getAttribute('class'), "matrix_cal_body matrix_cal_body_fare1") !== false) {
                                    $price = $td->find('span a', 0);
                                    if (!empty($price)) {
                                        $businessFlex = $price->plaintext;
                                    }
                                } else if (strpos($td->getAttribute('class'), "matrix_cal_body matrix_cal_body_fare2") !== false) {
                                    $price = $td->find('span a', 0);
                                    if (!empty($price)) {
                                        $economyFlex = $price->plaintext;
                                    }
                                } else if (strpos($td->getAttribute('class'), "matrix_cal_body matrix_cal_body_fare3") !== false) {
                                    $price = $td->find('span a', 0);
                                    if (!empty($price)) {
                                        $saverFlex = $price->plaintext;
                                    }
                                }
                            }

                            $flight->duration = floor((strtotime($flight->arrivalTime) - strtotime($flight->departTime)) / 3600) . ":" . (strtotime($flight->arrivalTime) - strtotime($flight->departTime) - (floor((strtotime($flight->arrivalTime) - strtotime($flight->departTime)) / 3600)) * 3600) / 60;
                            $flight->currency = "$";
                            $flight->business = (trim(strtoupper($businessFlex)) == $SOLD_OUT) ? $businessFlex : round(trim(str_replace(",", "", str_replace($flight->currency, "", $businessFlex))) * 1.2 / USD_VND);
                            $flight->economy = (trim(strtoupper($economyFlex)) == $SOLD_OUT) ? $economyFlex : round(trim(str_replace(",", "", str_replace($flight->currency, "", $economyFlex))) * 1.2 / USD_VND);
                            $flight->saverFlex = (trim(strtoupper($saverFlex)) == $SOLD_OUT) ? $saverFlex : round(trim(str_replace(",", "", str_replace($flight->currency, "", $saverFlex))) * 1.2 / USD_VND);

                            $flight->stop = array();

                            $result[] = $flight;
                        }
                    }
                }
            }
        }
        return $result;
    }

    public function booking() {
        $departclass = (!empty($_POST["departclass"]) ? $_POST["departclass"] : "");
        $returnclass = (!empty($_POST["returnclass"]) ? $_POST["returnclass"] : "");

        if (empty($departclass) && empty($returnclass)) {
            redirect("flights/search", "back");
        }

        $booking->departure = new stdClass();
        $booking->departure->flight_id = 0;
        $booking->departure->flight = NULL;
        $booking->departure->classtype = "economy";
        $booking->departure->fare = 0;

        $booking->return = new stdClass();
        $booking->return->flight_id = 0;
        $booking->return->flight = NULL;
        $booking->return->classtype = "economy";
        $booking->return->fare = 0;

        if (!empty($departclass)) {
            $departclass = explode("_", $departclass);
            $booking->departure->flight_id = $departclass[0];
            $booking->departure->classtype = $departclass[1];

            $flight = $this->m_flight->getFlight($booking->departure->flight_id);
            $booking->departure->flight = $flight;
            $booking->departure->fare = $flight->{$booking->departure->classtype};
        }

        if (!empty($returnclass)) {
            $returnclass = explode("_", $returnclass);
            $booking->return->flight_id = $returnclass[0];
            $booking->return->classtype = $returnclass[1];

            $flight = $this->m_flight->getFlight($booking->return->flight_id);
            $booking->return->flight = $flight;
            $booking->return->fare = $flight->{$booking->return->classtype};
        }

        $this->session->set_userdata("flight_booking", $booking);

        $view_data["nations"] = $this->m_nation->getItems();

        $tmpl_content['content'] = $this->load->view("flight/booking", $view_data, TRUE);
        $this->load->view('layout/flight', $tmpl_content);
    }

    public function cal_fees() {
        $travelers = (!empty($_POST["adults"]) ? $_POST["adults"] : 1) + (!empty($_POST["children"]) ? $_POST["children"] : 0);

        $booking = $this->session->userdata("flight_booking");

        $pax = new stdClass();
        $pax->adults = 0;
        $pax->children = 0;
        $pax->infants = 0;

        for ($i = 1; $i <= $travelers; $i++) {
            $birthdate = (!empty($_POST["birthdate_" . $i]) ? $_POST["birthdate_" . $i] : 0);
            if ((date('Y') - date('Y', strtotime($birthdate))) > 12) {
                $pax->adults += 1;
            } else {
                $pax->children += 1;
            }
        }

        $fare = $booking->departure->fare + $booking->return->fare;
        $total_fee = ($fare * $travelers) - (round(($fare * $pax->children) * 0.25));

        echo $total_fee;
    }

    public function checkout() {
        $search = $this->session->userdata("flight_search");
        $booking = $this->session->userdata("flight_booking");

        $booking->travelers = (!empty($_POST["adults"]) ? $_POST["adults"] : 0) + (!empty($_POST["children"]) ? $_POST["children"] : 0);
        $booking->fullname = (!empty($_POST["fullname"]) ? $_POST["fullname"] : "");
        $booking->email = (!empty($_POST["email"]) ? $_POST["email"] : "");
        $booking->phone = (!empty($_POST["phone"]) ? $_POST["phone"] : "");
        $booking->message = (!empty($_POST["message"]) ? $_POST["message"] : "");
        $booking->payment = (!empty($_POST["payment"]) ? $_POST["payment"] : "");

        $booking->paxs = array();
        $booking->adults = 0;
        $booking->children = 0;
        $booking->infants = 0;

        for ($i = 1; $i <= $booking->travelers; $i++) {
            $pax = null;
            $pax->fullname = (!empty($_POST["firstname_" . $i]) ? $_POST["firstname_" . $i] : "") . " " . (!empty($_POST["lastname_" . $i]) ? $_POST["lastname_" . $i] : "");
            $pax->gender = (!empty($_POST["gender_" . $i]) ? $_POST["gender_" . $i] : "Male");
            $pax->birthdate = (!empty($_POST["birthdate_" . $i]) ? $_POST["birthdate_" . $i] : 0);
            $pax->nationality = (!empty($_POST["nationality_" . $i]) ? $_POST["nationality_" . $i] : "");

            if ((date('Y') - date('Y', strtotime($pax->birthdate))) > 12) {
                $booking->adults += 1;
            } else {
                $booking->children += 1;
            }

            $booking->paxs[] = $pax;
        }

        $booking->total_fee = 0;

        if (!empty($booking->departure)) {
            $booking->total_fee += ($booking->departure->fare * $booking->travelers) - (round(($booking->departure->fare * $booking->children) * 0.25));
        }
        if (!empty($booking->return)) {
            $booking->total_fee += ($booking->return->fare * $booking->travelers) - (round(($booking->return->fare * $booking->children) * 0.25));
        }

        /*
         * Save
         */

        // Create new account
        $is_new_account = false;
        $user = $this->m_user->getUserByEmail($booking->email);
        $password = "";
        if (empty($user)) {
            $password = $this->m_user->uuid();
            $data = array(
                'fullname' => $booking->fullname,
                'username' => $booking->email,
                'password' => md5($password),
                'password_text' => $password,
                'email' => $booking->email,
                'phone' => $booking->phone
            );
            $this->m_user->add($data);
            $is_new_account = true;
        }

        $user = $this->m_user->getUserByEmail($booking->email);
        $user_id = 0;
        if ($user != null) {
            $user_id = $user->id;
            $password = $user->password_text;
        }

        // Get book id
        $booking->id = $this->util->GetNextValue("tv_flight_booking", "id");

        // Booking key
        $booking->key = 'flight_' . md5(time());

        // Add to booking list
        $data = array(
            'id' => $booking->id,
            'booking_key' => $booking->key,
            'adults' => $booking->adults,
            'children' => $booking->children,
            'total_fee' => $booking->total_fee,
            'fullname' => $booking->fullname,
            'email' => $booking->email,
            'phone' => $booking->phone,
            'message' => $booking->message,
            'payment_method' => $booking->payment,
            'booking_date' => date("Y-m-d H:i:s"),
            'promotion_code' => "",
            'discount' => 0,
            'user_id' => $user_id,
            'status' => 0,
        );

        $succed = true;

        if (!$this->m_flight->add_booking($data)) {
            $succed = false;
        } else {

            if (!empty($booking->departure->flight_id)) {
                $ticket["book_id"] = $booking->id;
                $ticket["leaving_from"] = $search->leavingFrom;
                $ticket["going_to"] = $search->goingTo;
                $ticket["departure_date"] = $search->departDate;
                $ticket["arrival_date"] = $search->returnDate;
                $ticket["duration"] = $booking->departure->flight->duration;
                $ticket["airline"] = $booking->departure->flight->airline;
                $ticket["flight"] = $booking->departure->flight->flight;
                $ticket["stops"] = $booking->departure->flight->stops;
                $ticket["fare"] = $booking->departure->fare;
                $ticket["class_type"] = $booking->departure->classtype;

                if (!$this->m_flight->add_ticket($ticket)) {
                    $succed = false;
                }
            }

            if (!empty($booking->return->flight_id)) {
                $ticket["book_id"] = $booking->id;
                $ticket["leaving_from"] = $search->goingTo;
                $ticket["going_to"] = $search->leavingFrom;
                $ticket["departure_date"] = $search->returnDate;
                $ticket["arrival_date"] = $search->departDate;
                $ticket["duration"] = $booking->return->flight->duration;
                $ticket["airline"] = $booking->return->flight->airline;
                $ticket["flight"] = $booking->return->flight->flight;
                $ticket["stops"] = $booking->return->flight->stops;
                $ticket["fare"] = $booking->return->fare;
                $ticket["class_type"] = $booking->return->classtype;

                if (!$this->m_flight->add_ticket($ticket)) {
                    $succed = false;
                }
            }

            foreach ($booking->paxs as $pax) {
                $booking_pax["book_id"] = $booking->id;
                $booking_pax["fullname"] = $pax->fullname;
                $booking_pax["gender"] = $pax->gender;
                $booking_pax["birthdate"] = date("Y-m-d", strtotime($pax->birthdate));
                $booking_pax["nationality"] = $pax->nationality;

                if (!$this->m_flight->add_pax($booking_pax)) {
                    $succed = false;
                }
            }
        }

        if ($succed) {
            // Payment
            $payment = $booking->payment;

            // Send mail to sales department
            $tpl_data = array(
                "FULLNAME" => $booking->fullname,
                "PROMOTION" => 0,
                "DISCOUNT" => 0,
                "LEAVING_FROM" => $search->leavingFrom,
                "GOING_TO" => $search->goingTo,
                "DEPARTURE_DATE" => $search->departDate,
                "RETURN_DATE" => $search->returnDate,
                "ADULTS" => $booking->adults,
                "CHILDREN" => $booking->children,
                "INFANTS" => $booking->infants,
                "TOTAL_FEE" => $booking->total_fee,
                "DEPARTURE_FLIGHT" => $booking->departure,
                "RETURN_FLIGHT" => $booking->return,
                "PAXS" => $booking->paxs,
                "EMAIL" => $booking->email,
                "PHONE" => $booking->phone,
                "MESSAGE" => $booking->message,
                "PAYMENT_METHOD" => $booking->payment,
                "NEW_ACCOUNT" => $is_new_account,
                "USER_LOGIN" => $user->username,
                "PASSWORD" => $password,
            );

            $subject = "BOOKING #F" . $booking->id . ": Vietnam Flight Payment Remind";

            $tpl_data["RECEIVER"] = MAIL_INFO;
            $messageToAdmin = $this->mail_tpl->flight_payment_remind($tpl_data);

            $tpl_data["RECEIVER"] = $booking->email;
            $messageToClient = $this->mail_tpl->flight_payment_remind($tpl_data);

            // Send to SALE Department
            $mail = array(
                "subject" => $subject . " - " . $booking->fullname,
                "from_sender" => $booking->email,
                "name_sender" => $booking->fullname,
                "to_receiver" => MAIL_INFO,
                "message" => $messageToAdmin
            );
            $this->mail->config($mail);
            $this->mail->sendmail();

            // Send confirmation to SENDER
            $mail = array(
                "subject" => $subject,
                "from_sender" => MAIL_INFO,
                "name_sender" => SITE_NAME,
                "to_receiver" => $booking->email,
                "message" => $messageToClient
            );
            $this->mail->config($mail);
            $this->mail->sendmail();

            if ($payment == 'OnePay') {
                //Redirect to OnePay
                $vpcURL = OP_PAYMENT_URL;

                $vpcOpt['Title'] = "Settle payment online at " . SITE_NAME;
                $vpcOpt['AgainLink'] = urlencode($_SERVER['HTTP_REFERER']);
                $vpcOpt['vpc_Merchant'] = OP_MERCHANT;
                $vpcOpt['vpc_AccessCode'] = OP_ACCESSCODE;
                $vpcOpt['vpc_MerchTxnRef'] = $booking->key;
                $vpcOpt['vpc_OrderInfo'] = "F" . $booking->id;
                $vpcOpt['vpc_Amount'] = $booking->total_fee * 100;
                $vpcOpt['vpc_ReturnURL'] = OP_RETURN_URL;
                $vpcOpt['vpc_Version'] = "2";
                $vpcOpt['vpc_Command'] = "pay";
                $vpcOpt['vpc_Locale'] = "en";
                $vpcOpt['vpc_TicketNo'] = $_SERVER['REMOTE_ADDR'];
                $vpcOpt['vpc_Customer_Email'] = $booking->email;
                $vpcOpt['vpc_Customer_Id'] = $user_id;

                $md5HashData = "";

                ksort($vpcOpt);

                $appendAmp = 0;

                foreach ($vpcOpt as $k => $v) {
                    // create the md5 input and URL leaving out any fields that have no value
                    if (strlen($v) > 0) {
                        // this ensures the first paramter of the URL is preceded by the '?' char
                        if ($appendAmp == 0) {
                            $vpcURL .= urlencode($k) . '=' . urlencode($v);
                            $appendAmp = 1;
                        } else {
                            $vpcURL .= '&' . urlencode($k) . "=" . urlencode($v);
                        }
                        if ((strlen($v) > 0) && ((substr($k, 0, 4) == "vpc_") || (substr($k, 0, 5) == "user_"))) {
                            $md5HashData .= $k . "=" . $v . "&";
                        }
                    }
                }

                $md5HashData = rtrim($md5HashData, "&");
                $md5HashData = strtoupper(hash_hmac('SHA256', $md5HashData, pack('H*', OP_SECURE_SECRET)));

                $vpcURL .= "&vpc_SecureHash=" . $md5HashData;

                header("Location: " . $vpcURL);
                die();
            } else if ($payment == 'Credit Card') {
                //Redirect to gate2shop
                $numberofitems = 1;
                $totalAmount = $booking->total_fee;
                $productName = "Vietnam Flight booking";
                $productPrice = $booking->total_fee / $booking->travelers;
                $productNum = $booking->travelers;
                $datetime = gmdate("Y-m-d H:i:s");

                // Cal checksum
                $checksum = md5(G2S_SECRET_KEY . G2S_MERCHANT_ID . G2S_CURRENTCY . $totalAmount . $productName . $productPrice . $productNum . $datetime);

                $link = 'https://secure.Gate2Shop.com/ppp/purchase.do?';
                $link .= 'version=' . G2S_VERSION;
                $link .= '&merchant_id=' . G2S_MERCHANT_ID;
                $link .= '&merchant_site_id=' . G2S_MERCHANT_SITE_ID;
                $link .= '&total_amount=' . $totalAmount;
                $link .= '&numberofitems=' . $numberofitems;
                $link .= '&currency=' . G2S_CURRENTCY;
                $link .= '&item_name_1=' . $productName;
                $link .= '&item_amount_1=' . $productPrice;
                $link .= '&item_quantity_1=' . $productNum;
                $link .= '&time_stamp=' . $datetime;
                $link .= '&checksum=' . $checksum;
                $link .= '&customField1=' . $booking->key;
                $link .= '&customField2=' . $booking->email;

                header('Location: ' . $link);
                die();
            } else if ($payment == 'Paypal') {
                $amount		= $booking->total_fee;
				$item_name	= "Vietnam Flight booking";
				$quantity	= $booking->travelers;
				
                $link = 'https://www.paypal.com/cgi-bin/webscr?';
                $link .= 'cmd=_xclick';
                $link .= '&business='.PAYPAL_BUSINESS;
                $link .= '&item_name='.$item_name;
                $link .= '&quantity='.$quantity;
                $link .= '&amount='.$amount.' USD';
                $link .= '&no_shipping=1';
                $link .= '&no_note=1';
                $link .= '&currency_code=USD';
                $link .= '&return='.BASE_URL.'/payment/sucess/' . $key;
                $link .= '&cancel_return='.BASE_URL.'/payment/failure/'.$key;
				
                header('Location: '.$link);
                die();
            }
        }

        $view_data["client_name"] = $booking->fullname;

        $tmpl_content['content'] = $this->load->view("payment/finish", $view_data, TRUE);
        $this->load->view('layout/main', $tmpl_content);
    }

    function success($key = "") {
        if (empty($key)) {
            $key = !empty($_GET["key"]) ? $_GET["key"] : "";
        }

        if (!empty($key)) {
            $key = str_ireplace(".html", "", $key);
        }

        $data = array('status' => 1);
        $where = array('booking_key' => $key);

        $this->m_flight->update_booking($data, $where);

        $booking = $this->m_flight->getBooking(NULL, $key);
        if ($booking != null) {
            $paxs = $this->m_flight->getPaxs($booking->id);

            // Create new account
            $user = $this->m_user->getUserByEmail($booking->email);

            // Send mail to sales department
            $tpl_data = array(
                "FULLNAME" => $booking->fullname,
                "PROMOTION" => 0,
                "DISCOUNT" => 0,
                "TOTAL_FEE" => $booking->total_fee,
                "PAXS" => $paxs,
                "EMAIL" => $booking->email,
                "PHONE" => $booking->phone,
                "MESSAGE" => $booking->message,
                "PAYMENT_METHOD" => $booking->payment_method,
                "NEW_ACCOUNT" => false,
                "USER_LOGIN" => $user->username,
                "PASSWORD" => $user->password_text,
            );

            $subject = "BOOKING #F" . $booking->id . ": Confirm Vietnam Flight " . $booking->payment_method . " Payment Successful";

            $tpl_data["RECEIVER"] = MAIL_INFO;
            $messageToAdmin = $this->mail_tpl->flight_payment_successful($tpl_data);

            $tpl_data["RECEIVER"] = $booking->email;
            $messageToClient = $this->mail_tpl->flight_payment_successful($tpl_data);

            // Send to SALE Department
            $mail = array(
                "subject" => $subject . " - " . $booking->fullname,
                "from_sender" => $booking->email,
                "name_sender" => $booking->fullname,
                "to_receiver" => MAIL_INFO,
                "message" => $messageToAdmin
            );
            $this->mail->config($mail);
            $this->mail->sendmail();

            // Send confirmation to SENDER
            $mail = array(
                "subject" => $subject,
                "from_sender" => MAIL_INFO,
                "name_sender" => SITE_NAME,
                "to_receiver" => $booking->email,
                "message" => $messageToClient
            );
            $this->mail->config($mail);
            $this->mail->sendmail();
        }

        $view_data["client_name"] = $booking->fullname;

        $tmpl_content['content'] = $this->load->view("payment/success", $view_data, TRUE);
        $this->load->view('layout/main', $tmpl_content);
    }

    function failure($key = "") {
        if (empty($key)) {
            $key = !empty($_GET["key"]) ? $_GET["key"] : "";
        }

        $errMsg = "";

        if (!empty($key)) {
            $key = str_ireplace(".html", "", $key);

            $booking = $this->m_flight->getBooking(NULL, $key);
            if ($booking != null) {
                $paxs = $this->m_flight->getPaxs($booking->id);

                // Create new account
                $user = $this->m_user->getUserByEmail($booking->email);

                $tpl_data = array(
                    "FULLNAME" => $booking->fullname,
                    "PROMOTION" => 0,
                    "DISCOUNT" => 0,
                    "TOTAL_FEE" => $booking->total_fee,
                    "PAXS" => $paxs,
                    "EMAIL" => $booking->email,
                    "PHONE" => $booking->phone,
                    "MESSAGE" => $booking->message,
                    "PAYMENT_METHOD" => $booking->payment_method,
                    "NEW_ACCOUNT" => false,
                    "USER_LOGIN" => $user->username,
                    "PASSWORD" => $user->password_text,
                );

                $subject = "BOOKING #F" . $booking->id . ": Confirm Vietnam Flight " . $booking->payment_method . " Payment Failure";

                $tpl_data["RECEIVER"] = MAIL_INFO;
                $messageToAdmin = $this->mail_tpl->flight_payment_failure($tpl_data);

                $tpl_data["RECEIVER"] = $booking->primary_email;
                $messageToClient = $this->mail_tpl->flight_payment_failure($tpl_data);

                // Send to SALE Department
                $mail = array(
                    "subject" => $subject . " - " . $booking->fullname,
                    "from_sender" => $booking->email,
                    "name_sender" => $booking->fullname,
                    "to_receiver" => MAIL_INFO,
                    "message" => $messageToAdmin
                );
                $this->mail->config($mail);
                $this->mail->sendmail();

                // Send confirmation to SENDER
                $mail = array(
                    "subject" => $subject,
                    "from_sender" => MAIL_INFO,
                    "name_sender" => SITE_NAME,
                    "to_receiver" => $booking->email,
                    "message" => $messageToClient
                );
                $this->mail->config($mail);
                $this->mail->sendmail();
            }
        }

        $view_data["client_name"] = $booking->fullname;

        $tmpl_content['content'] = $this->load->view("payment/failure", $view_data, TRUE);
        $this->load->view('layout/main', $tmpl_content);
    }

    public function flight($id = NULL, $direction = 'out') {
        $route = $this->m_flight->getFlight($id);
        $view_data["direction"] = $direction;
        $view_data["route"] = $route;
        $this->load->view("flight/flight", $view_data);
    }

}

?>