<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class reunionUsuarioController extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('reunionUsuario','reunUs',true);
	}

	public function index(){
		echo "HOola";
	}

	public function getAll(){
		$datos = $this->reunUs->getAll();
		echo json_encode($datos);
	}

	public function getUsuariosReunion(){
		$id = $_GET['idReunion'];
		$datos = $this->reunUs->getUsuariosReunion($id);
		echo json_encode($datos);
		//return json_encode($datos);
	}

	public function hello(){
		echo "hello to you";
	}
}

?>