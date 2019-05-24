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

	public function agregarInvitadoReunion(){
		if(!isset($_POST['idUsuario'])){
			echo "error, no se han recibido parametros";
		}
		$idU = $_POST['idUsuario'];
		$idR = $_POST['idReunion'];
		$exist = $this->reunUs->existeUsuario($idU,$idR);
		if($exist->existe){
			echo "Este usuario ya esta invitado a esta reunioin";
		}else{
			$hecho = $this->reunUs->agregarUsuario($idU,$idR);
			echo $hecho;
		}
		
		//echo json_encode($exist);
	}

	public function quitarUsuarioReunion()
	{
		if(!isset($_POST['idUsuario'])){
			echo "No hay parametros";
			return "";
		}
		$idUsuario = $_POST['idUsuario'];
		$idReunion = $_POST['idReunion'];
		//echo $idUsuario." -> R-".$idReunion;
		$hecho = $this->reunUs->eliminarUsuarioReunion($idUsuario,$idReunion);
		echo $hecho;
	}

}

?>