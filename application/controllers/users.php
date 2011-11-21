<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

		$this->form_validation->set_rules('user[name]', 'Pseudo', 'trim|required|xss_clean');
		$this->form_validation->set_rules('user[email]', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('user[password]', 'Mot de passe', 'trim|required|callback_password_check|xss_clean');
		$this->form_validation->set_rules('user[pass_conf]', 'Confirmation du mot de passe', 'trim|required|xss_clean');

		if($this->form_validation->run()) {
			extract($this->input->post('user'));

			$data['user'] = array(
				'username'	=> $name,
				'email'		=> $email,
				'password'	=> sha1($password)
			);

			if($this->user->save($data['user'])) {
				$data['notif']['type'] = 'success';
				$data['notif']['message'] = "Inscription réussie.";
			} else {
				$data['notif']['type'] = 'warning';
				$data['notif']['message'] = "Une erreur est survenue au cours de l'opération.";
			}

			$this->load->view('users/profile/view', $data);
		} else {
			$data['notif']['type'] = 'error';
			$data['notif']['message'] = validation_errors();
					
			$this->load->view('users/form_register', $data);
		}
	}

	public function login()
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			redirect('users/show');
		}

		$data = array();
		$data['title'] = "Connexion";

		$this->form_validation->set_rules('user[login]', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('user[password]', 'Mot de passe', 'trim|required|xss_clean');

		if($this->form_validation->run())
		{
			extract($this->input->post('user'));

			if($this->user->check_id($login, $password))
			{
				$_user = $this->user->get_user($login);

				$session_data = array(
					'username'	=> $_user[0]->username,
					'email'		=> $login,
					'id'		=> (int) $_user[0]->id,
					'logged'	=> True
				);

				$this->session->set_userdata($session_data);

				$this->load->view('users/show');
			} else {
				$data['notif']['type'] = 'error';
				$data['notif']['message'] = "Votre identifiant / mot de passe est d'incorrect.";

				$this->load->view('users/form_login', $data);
			}
		} else {
			$data['notif']['type'] = 'error';
			$data['notif']['message'] = validation_errors();

			$this->load->view('users/form_login', $data);
		}
	}

	public function show()
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			$this->load->view('users/show');
		} else {
			redirect('users/login');
		}
	}

	public function logout()
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			$this->session->sess_destroy();
			redirect(base_url());
		} else {
			redirect(base_url());
		}
	}

	function password_check($password)
	{
		if ($password != $_POST['user']['pass_conf'])
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