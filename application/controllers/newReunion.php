<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class newReunion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
			// Muestra el contenido
			$this->load->view('headers');
			$this->load->view('navbar');
			$this->load->view('new_reunion');
			$this->load->view('footer');
		
	}

	
}

?>