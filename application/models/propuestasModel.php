<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class propuestasModel extends CI_Model{
	/*definición de atributos*/
	$idPropuesta; 	
	$idUsuario;
	$idReunion; 	
	$fechaPropuesta; 	
	$horaPropuesta; 	
	$lugarPropuesta;

	function __construct(){
		parent::__construct();
	}

	public function verPropuestas($idReunion)
	{
		$this->db->where('idReunion',$idReunion);
		$query = $this->db->get('propuestas_de_horario');
		return $query->result_array();
	}

	public function existePropuesta($idUsuario,$idReunion)
	{
		$sql = "SELECT COUNT(*) as 'existe' FROM propuestas_de_horario WHERE idUsuario = ".$idUsuario." and idReunion = $idReunion ";
		$query = $this->db->query($sql);
		return $query->num_rows() != 1 ? false: true; 
		
	}

	public function agregarPropuesta($idUsuario,$idReunion,$fechaPropuesta,$horaPropuesta,$lugarPropuesta){
		$sql = "INSERT INTO `propuestas_de_horario` (`idPropuesta`, `idUsuario`, `idReunion`, `fechaPropuesta`, `horaPropuesta`, `lugarPropuesta`) VALUES (NULL, '$idUsuario', '$idReunion', '$fechaPropuesta', '$horaPropuesta', '$lugarPropuesta');";
		$this->db->query($sql);
		return $this->db->affected_rows() != 1 ? false : true;
	}
}
?>