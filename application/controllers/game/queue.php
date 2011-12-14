<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Queue extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('queue_model', 'queue');
	}

	public function update($id = '')
	{
		if(isset($id) && !empty($id) && ctype_digit($id)) {
			$element = current($this->queue->get_element($id));

			if($element && $element->planet_id == $this->session->userdata('planet_id')) {

				//$this->planet_model->update($id);
				// Terminer la mise à jour de la planète

				if($this->queue->delete($id)) {
					return True;
				}
			}
		}
	}
}