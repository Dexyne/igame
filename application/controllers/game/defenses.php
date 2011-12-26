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

class Defenses extends CI_Controller {

	public $layout = 'space_game';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('defense_model', 'defense');
	}

	public function index() 
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			$data = array();

			$level = current($this->planet_model->get_planet($this->session->userdata('planet_id'), 'laboratory'));

			if($level->laboratory > 0)
				$data['is_existing'] = True;
			else
				$data['is_existing'] = False;

			$this->load->view('game/defenses/index', $data);
		}
	}
}