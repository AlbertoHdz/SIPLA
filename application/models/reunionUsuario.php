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

	public function getUsuariosReunion($idReunion){
		//$this->db->where("idReunion",$idReunion);
		$query = $this->db->query('SELECT u.*,rl.nombre FROM usuarios as u INNER JOIN relReunionUsuario as rn on rn.idUsuario = u.idUsuario INNER JOIN roles as rl on rl.idRol = u.idRol WHERE rn.idReunion = '.$idReunion);
		//print_r($query->result_array());
		return $query->result_array();
	}

	public function getAll(){
		$query = $this->db->query('SELECT u.*,rl.nombre FROM usuarios as u INNER JOIN relReunionUsuario as rn on rn.idUsuario = u.idUsuario INNER JOIN roles as rl on rl.idRol = u.idRol');
		return $query->result_array();
	}
} 

?>