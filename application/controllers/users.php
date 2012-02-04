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

class Users extends CI_Controller {

	public $layout = 'default';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model', 'user');
	}

	public function index()
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			redirect('users/show');
		} else {
			$this->login();
		}
	}

	public function register()
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			redirect('users/show');
		}
		
		$data = array();
		$data['title'] = "S'inscrire";

		$this->form_validation->set_rules('new_user[name]', 'Pseudo', 'trim|required|xss_clean');
		$this->form_validation->set_rules('new_user[email]', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('new_user[password]', 'Mot de passe', 'trim|required|callback_password_check|xss_clean');
		$this->form_validation->set_rules('new_user[pass_conf]', 'Confirmation du mot de passe', 'trim|required|xss_clean');

		if($this->form_validation->run()) {
			extract($this->input->post('new_user'));

			$data['user'] = array(
				'username'		=> $name,
				'email'			=> $email,
				'password'		=> sha1($password),
				'created_at'	=> 'NOW()',
				'updated_at'	=> 'NOW()'
			);

			if($this->user->save($data['user'])) {
				$data['notif']['type'] = 'success';
				$data['notif']['message'] = "Inscription réussie.";
			} else {
				$data['notif']['type'] = 'warning';
				$data['notif']['message'] = "Une erreur est survenue au cours de l'opération.";
			}

			$this->login($data);
		} else {
			$data['notif']['type'] = 'error';
			$data['notif']['message'] = validation_errors();
					
			$this->load->view('users/form_register', $data);
		}
	}

	public function login($data = array())
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			redirect('users/show');
		}

		$data['title'] = "Connexion";

		if($this->input->post('user')) 
		{
			$this->form_validation->set_rules('user[login]', 'Email', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('user[password]', 'Mot de passe', 'trim|required|xss_clean');

			if($this->form_validation->run())
			{
				extract($this->input->post('user'));

				if($this->user->check_id($login, $password))
				{
					$_user = current($this->user->get_user($login));

					$session_data = array(
						'username'	=> $_user->username,
						'email'		=> $login,
						'id'		=> (int) $_user->id,
						'logged'	=> True,
						'planet_id'	=> 1
					);

					$this->session->set_userdata($session_data);
					// Mise à jour de la planète
					//$this->planet_model->edit($this->session->userdata('planet_id'));

					$this->show();
				} else {
					$data['notif']['type'] = 'error';
					$data['notif']['message'] = "Votre identifiant / mot de passe est incorrect.";

					$this->load->view('users/form_login', $data);
				}
			} else {
				$data['notif']['type'] = 'error';
				$data['notif']['message'] = validation_errors();

				$this->load->view('users/form_login', $data);
			}
		} else {
			$this->load->view('users/form_login', $data);
		}
	}

	public function show($id = null, $data = array())
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			$data = array();
			$data['title'] = "Vue du Profil";

			if(!is_null($id) && ctype_digit($id))
				$data['user'] = current($this->user->get_userById($id));
			elseif(!is_null($id) && !ctype_digit($id))
				redirect('home');
			else
				$data['user'] = current($this->user->get_userById($this->session->userdata('id')));
			
			if($this->session->userdata('id') === $id || is_null($id))
				$data['user_profile'] = True;
			else
				$data['user_profile'] = False;

			$this->load->view('users/show', $data);
		} else {
			redirect('users/login');
		}
	}

	public function edit($id = null)
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			$id = (int) $id;
			if($this->session->userdata('id') !== $id)
				redirect('users/show');

			$data = array();
			$data['title'] = "Editer le profil";

			$this->form_validation->set_rules('edit_user[name]', 'Pseudo', 'trim|required|xss_clean');
			$this->form_validation->set_rules('edit_user[email]', 'Email', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('edit_user[password]', 'Mot de passe', 'trim|callback_password_check|xss_clean');
			$this->form_validation->set_rules('edit_user[pass_conf]', 'Confirmation du mot de passe', 'trim|xss_clean');

			if($this->form_validation->run()) {
				extract($this->input->post('edit_user'));
				$user = current($this->user->get_userById($id));

				if(!empty($password))
					$pass = $password;
				else
					$pass = $user->password;

				$data['user'] = array(
					'username'		=> $name,
					'email'			=> $email,
					'password'		=> $pass,
					'created_at'	=> $user->created_at,
					'updated_at'	=> 'NOW()'
				);

				if($this->user->update($id, $data['user'])) {
					$data['notif']['type'] = 'success';
					$data['notif']['message'] = "Mise à jour réussie.";
				} else {
					$data['notif']['type'] = 'warning';
					$data['notif']['message'] = "Une erreur est survenue au cours de l'opération.";
				}

				redirect('users/show');
			} else {
				$data['notif']['type'] = 'error';
				$data['notif']['message'] = validation_errors();

				$data['user'] = current($this->user->get_userById($id));

				$this->load->view('users/form_edit', $data);
			}			
		} else {
			redirect(base_url());
		}
	}

	public function logout()
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			$this->session->sess_destroy();
		}
		
		redirect(base_url());
	}

	function password_check($password)
	{
		if (isset($_POST['new_user']) && $password != $_POST['new_user']['pass_conf'] 
			|| isset($_POST['edit_user']) && $password != $_POST['edit_user']['pass_conf'])
		{
			$this->form_validation->set_message('password_check', "Le mot de passe et sa confirmation doivent semblable.");
			return False;
		}
		else {
			return True;
		}
	}
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */