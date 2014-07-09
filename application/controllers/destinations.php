<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Destinations extends CI_Controller {

	public function vietnam($destination=NULL)
	{
		if (!empty($destination)) {
			$hotel_destinations = $this->m_hotel_destination->load($destination);
			$tour_destinations = $this->m_tour_destination->load($destination);
			
			if (!empty($hotel_destinations)) {
				$destination = $hotel_destinations;
			} else if (!empty($tour_destinations)) {
				$destination = $tour_destinations;
			}
			
			$info->city = $hotel_destinations->id;
			$hotels = $this->m_hotel->getItems($info, 1);
			
			$info->depart_from = $tour_destinations->id;
			$tours = $this->m_tour->getItems($info, 1);
			
			$view_data = "";
			$view_data['destination'] = $destination;
			$view_data['hotels'] = $hotels;
			$view_data['tours'] = $tours;
			
			$tmpl_content = "";
			$tmpl_content['content'] = $this->load->view("destination/detail", $view_data, TRUE);
			$this->load->view('layout/main', $tmpl_content);
		}
		else {
			$hotel_destinations = $this->m_hotel_destination->getItems(NULL, 1);
			$tour_destinations = $this->m_tour_destination->getItems(NULL, 1);
			
			$hotels = $this->m_hotel->getItems(NULL, 1);
			$tours = $this->m_tour->getItems(NULL, 1);
			
			$destinations_alias = array();
			$destinations = array();
			
			// Merge destinations
			foreach ($hotel_destinations as $hotel_destination) {
				if (!in_array($hotel_destination->alias, $destinations_alias)) {
					$destinations_alias[] = $hotel_destination->alias;
					$destinations[] = $hotel_destination;
				}
			}
			foreach ($tour_destinations as $tour_destination) {
			if (!in_array($tour_destination->alias, $destinations_alias)) {
					$destinations_alias[] = $tour_destination->alias;
					$destinations[] = $tour_destination;
				}
			}
			
			$view_data = "";
			$view_data['destinations'] = $destinations;
			$view_data['hotels'] = $hotels;
			$view_data['tours'] = $tours;
			
			$tmpl_content = "";
			$tmpl_content['content'] = $this->load->view("destination/index", $view_data, TRUE);
			$this->load->view('layout/main', $tmpl_content);
		}
	}
}

?>