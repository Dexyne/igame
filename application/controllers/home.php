<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public $layout = 'default';

	public function index()
	{
		$data['title'] = "Page d'accueil";

		$this->load->view('home', $data);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */