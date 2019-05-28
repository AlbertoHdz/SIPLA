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

	public function modificarEstatus($idReunion){
		$sql = "UPDATE `reuniones` SET `estatus` = '0' where idReunion = ".$idReunion."";
		$query = $this->db->query($sql);
		echo $query;
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function agregarUsuario($idUsuario,$idReunion){
		$sql = "INSERT INTO `relReunionUsuario` (`idReunion`, `idUsuario`,`confirma`) VALUES ('$idReunion', '$idUsuario','0');";
		$query = $this->db->query($sql);
		echo $query;
		return ($this->db->affected_rows() != 1) ? false : true;
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

	public function existeUsuario($idUsuario,$idReunion){
		$query = $this->db->query('SELECT COUNT(*) as "existe" FROM `relReunionUsuario` as run WHERE run.idUsuario = '.$idUsuario.' and run.idReunion = '.$idReunion);
		return $query->row();
	}

	public function eliminarUsuarioReunion($idUsuario,$idReunion)
	{
		$sql = "DELETE FROM `relReunionUsuario` where idReunion = ".$idReunion." and idUsuario = ".$idUsuario." ";
		$query = $this->db->query($sql);
		return ($this->db->affected_rows() > 0) ? true : false;
	}


	public function confirmacion($idUsuario,$idReunion)
	{
		$sql = "UPDATE `relReunionUsuario` SET `confirma`=1 WHERE `idReunion`= $idReunion AND `idUsuario`= $idUsuario";
		$this->db->query($sql);
		return ($this->db->affected_rows() > 0) ? true : false;
	}

} 

?>