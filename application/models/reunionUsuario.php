<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class reunionUsuario extends CI_Model{
	/*definición de atributos*/
	private $idReunion;
	private $idUsuario;

	/*constructor*/
	function __construct(){
		parent::__construct();
	}

	public function agregarUsuario(){
		//$sql = 'INSERT INTO `relReunionUsuario` (`idReunion`, `idUsuario`) VALUES ('1', '1');';
	}

	public function getUsuarios(){
		$this->db->where("idReunion",$this->input->get('idReunion'));
		$query->$this->db->get('relReunionUsuario');

		return $query->result();
	}

	public function getAll(){
		$this->db->get('relReunionUsuario');
		return $query->result();
	}
} 

?>