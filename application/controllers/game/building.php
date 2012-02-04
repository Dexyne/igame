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

class Building extends CI_Controller {

	public $layout = 'space_game';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('building_model', 'building');
		$this->load->model('queue_model', 'queue');
		$this->load->model('dependencies_model', 'dependencies');
	}

	/**
	 | Affiche la liste de tous les bâtiments disponible et ceux en construction
	 * @param $data = array()
	 * @return void
	 */
	public function index($data = array())
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			$data['list'] = $this->building->get_all();
			$building_level = current($this->planet_model->get_planet($this->session->userdata('planet_id'), 'metal_mine, crystal_mine, deuterium_synthesizer, solar_plant, factory_robots, yardspace'));
			$dependencies = $this->dependencies->get_allForType('building');

			$b = array('metal_mine', 'crystal_mine', 'deuterium_synthesizer', 'solar_plant', 'factory_robots', 'yardspace');

			for($i = 0; $i < count($data['list']); $i++) {
				$data['list'][$i]->level = $building_level->$b[$i];
			}

			// On récupère tous les ids des bâtiments et la liste des levels
			foreach($data['list'] as $list) {
				$building_ids[] = $list->id;
				$building_levels[$list->id] = $list->level;
			}

			// On vérifie si une dépendance existe. Si oui, on regarde si le level est ok et si ce n'est pas le cas on retire l'élément
			for($i = 0; $i < count($dependencies); $i++) {
				$dep = in_array($dependencies[$i]->element_id, $building_ids);
				if($dep) {
					if($building_levels[$dependencies[$i]->needed_element_id] < $dependencies[$i]->needed_level) {
						unset($data['list'][$dependencies[$i]->element_id-1]);
					}
				}
			}

			/*
			 | Debug

				echo '<br /><br><br><br />';
				echo '<pre>'; print_r($building_ids); echo '</pre>';
				echo '<pre>'; print_r($building_levels); echo '</pre>';
				echo '<pre>'; print_r($data['list']); echo '</pre>';
				echo '<pre>'; print_r($dependencies); echo '</pre>';
			*/

			$data['in_queue'] = $this->queue->into('building', $this->session->userdata('planet_id'));

			$this->load->view('game/building/index', $data);
		} else {
			redirect('users/login');
		}
	}

	/**
	 | Fiche détaillant un bâtiment
	 * @param $id du bâtiment
	 * @return void
	 */
	public function show($id = '')
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			if(isset($id) && ctype_digit($id)) {
				$data['building'] = current($this->building->get_building($id));

				$this->load->view('game/building/show', $data);
			} else {
				$this->index();
			}
		} else {
			redirect('users/login');
		}
	}

	/**
	 | Permet la construction d'un bâtiment
	 * @param $id du bâtiment
	 * @return void
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

/* End of file building.php */
/* Location: ./application/controllers/building.php */
