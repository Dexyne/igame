<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This file is part of iGame
 *
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @see https://github.com/Dexyne/igame
 *
 * @copyright Copyright (c) 2011-Present, Aurélien Léger, iGame
 * All rights reserved.
 *
 * iGame is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * iGame program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with iGame.  If not, see <http://www.gnu.org/licenses/>.
 *
 * #######################################################################
 */

class Laboratory extends CI_Controller {

	public $layout = 'space_game';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('technology_model', 'technology');
		$this->load->model('queue_model', 'queue');
	}

	public function index() 
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			$data = array();

			$level = current($this->planet_model->get_planet($this->session->userdata('planet_id'), 'laboratory'));

			if($level->laboratory == 0) {
				$data['existing'] = True;
			} else {
				$data['list'] = $this->technology->get_all();
				$techno_level = current($this->planet_model->get_planet($this->session->userdata('planet_id'), 'ion, laser, plasma'));

				$t = array('ion', 'laser', 'plasma');

				for($i = 0; $i < count($data['list']); $i++) {
					$data['list'][$i]->level = $techno_level->$t[$i];
				}

				$data['in_queue'] = $this->queue->into('technology', $this->session->userdata('planet_id'));
			}

			$this->load->view('game/laboratory/index', $data);
		} else {
			redirect('users/login');
		}
	}

	/**
	 | Fiche détaillant une technologie
	 * @param $id de la technologie
	 * @return view
	 */
	public function show($id = '')
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			if(isset($id) && ctype_digit($id)) {
				$data['technology'] = current($this->technology->get_technology($id));

				$this->load->view('game/laboratory/show', $data);
			} else {
				$this->index();
			}
		} else {
			redirect('users/login');
		}
	}

	/**
	 | Permet la recherche d'une technologie
	 * @param $id de la technologie
	 * @return view
	 */
	public function create($id = '')
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			$data = array();

			if(isset($id) && ctype_digit($id)) {
				$building_type = current($this->building->get_building($id, 'name, name_clean, construct_time, multiplier'));
				$building_name = $building_type->name_clean;
				$building = current($this->planet_model->get_planet($this->session->userdata('planet_id'), $building_name));
				$building->level = $building->$building_name;

				if(isset($building_type) && !empty($building_type)) {
					// mktime(int hour, int minute, int second, int month, int day, int year)
					$date_now_in_tsp = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
					$date_finish_in_tsp = $date_now_in_tsp + ($building_type->construct_time * ($building->level + 1) * $building_type->multiplier);

					$data = array(
						'element_id'	=> $id,
						'element_type'	=> 'building',
						'planet_id'		=> $this->session->userdata('planet_id'),
						'time_start'	=> 'NOW()',
						'time_finish'	=> '\''.date('Y-m-d H:i:s', $date_finish_in_tsp).'\''
					);					

					if($this->queue->insert($data)) {
						$data['notif']['type'] = 'success';
						$data['notif']['message'] = "{$building_type->name} en cours de construction.";
					} else {
						$data['notif']['type'] = 'error';
						$data['notif']['message'] = "Une erreur est survenue.";
					}

					$this->index($data);
				} else {
					$data['notif']['type'] = 'warning';
					$data['notif']['message'] = "Le bâtiment demandé n'existe pas.";

					$this->index($data);
				}
			} else {
				$this->index();
			}
		} else {
			redirect('users/login');
		}
	}
}