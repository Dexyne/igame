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

class Yardspace extends CI_Controller {

	public $layout = 'space_game';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ship_model', 'ship');
		$this->load->model('queue_model', 'queue');
		$this->load->model('dependencies_model', 'dependencies');
	}

	public function index()
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			$data = array();

			$data['list'] = $this->ship->get_all();
			$level = current($this->planet_model->get_planet($this->session->userdata('planet_id'), 'yardspace'));
			$ys_level = current($this->planet_model->get_planet($this->session->userdata('planet_id'), 'metal_mine, crystal_mine, deuterium_synthesizer, solar_plant'));
			$building_level = current($this->planet_model->get_planet($this->session->userdata('planet_id'), 'metal_mine, crystal_mine, deuterium_synthesizer, solar_plant, factory_robots, yardspace'));
			$dependencies = $this->dependencies->get_allForType('yardspace');

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


			if($level->yardspace == 0) {
				$data['existing'] = False;
			} else {
				$data['in_queue'] = $this->queue->into('yardspace', $this->session->userdata('planet_id'));
			}

			$this->load->view('game/yardspace/index', $data);
		}
	}
}
