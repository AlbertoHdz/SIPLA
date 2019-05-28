<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class propuestasController extends CI_Controller{
	
	public __construct(){
		parent::__construct();
		$this->load->model('propuestasModel','propModel',true);
		$this->load->model('reunionUsuario','reunUs',true);
	}

	public function agregarPropuesta()
	{
		if(!isset($_POST['fechaPropuesta'])){
			echo "Error, acceso denegado";		
			return "";
		}
		$idUsuario = $this->session->userdata('idUsuario');
		$idReunion = $_POST['idReunion'];
		$existe = $this->propModel->existePropuesta($idUsuario,$idReunion);
		if($existe){
			echo "Ya existe una propuesta";
		}else{
			$fechaPropuesta = $_POST['fechaPropuesta'];
			$horaPropuesta = $_POST['horaPropuesta'];
			$lugarPropuesta = $_POST['lugarPropuesta'];
			$hecho = $this->propModel->agregarPropuesta($idUsuario,$idReunion,$fechaPropuesta,$horaPropuesta,$lugarPropuesta);
			if($hecho){
				echo "ok";
				$this->reunUs->confirmacion($idUsuario,$idReunion);
			}else{
				echo "Ha ocurrido un error";
			}
		}
	}

	public function confirmarAsistencia()
	{
		$idUsuario = $this->session->userdata('idUsuario');
		$idReunion = $_POST['idReunion'];
		$query = $this->reunUs->confirmacion($idUsuario,$idReunion);
		if($query){
			echo "ok";
		}else{
			echo "Ha ocurrido un error";
		}
	}
}
?>