<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class reunionUsuarioController extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('reunionUsuario','reunUs',true);
		$this->model->helper('form');
	}

	public function getAll(){
		$this->reunUs->getAll();
	}

	public function hello(){
		return "hello to you";
	}
}

?>