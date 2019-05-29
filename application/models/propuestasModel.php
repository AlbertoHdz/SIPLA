<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class propuestasModel extends CI_Model{
	/*definición de atributos*/
	private $idPropuesta; 	
	private $idUsuario;
	private $idReunion; 	
	private $fechaPropuesta; 	
	private $horaPropuesta; 	
	private $lugarPropuesta;

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
		return $query->result_array(); 
		
	}

	public function agregarPropuesta($idUsuario,$idReunion,$fechaPropuesta,$horaPropuesta,$lugarPropuesta){
		$sql = "INSERT INTO `propuestas_de_horario` (`idPropuesta`, `idUsuario`, `idReunion`, `fechaPropuesta`, `horaPropuesta`, `lugarPropuesta`) VALUES (NULL, '$idUsuario', '$idReunion', '$fechaPropuesta', '$horaPropuesta', '$lugarPropuesta');";
		$this->db->query($sql);
		return $this->db->affected_rows() >= 1 ? true : false;
	}

	public function existeRangoFechas($idReunion){
		$sql = "SELECT COUNT(*) AS 'existe' FROM `rangoFechas` WHERE idReunion = $idReunion";
		$query = $this->db->query($sql);
		return $query->row()->existe;
	}

	public function extenderRangoFechas($idReunion,$fechaInicial,$horaInicial,$fechaFinal,$horaFinal){
		$sql = "UPDATE `rangoFechas` SET `fechaInicial` = '$fechaInicial', `horaInicial` = '$horaInicial', `fechaFinal` = '$fechaFinal', `horaFinal` = '$horaFinal' WHERE `rangoFechas`.`idReunion` = ".$idReunion;
		$this->db->query($sql);
		return $this->db->affected_rows() >= 1 ? true : false;
	}

	public function agregarRangoFechas($idReunion,$fechaInicial,$horaInicial,$fechaFinal,$horaFinal){
		$sql = "INSERT INTO `rangoFechas` (`idRangoFechas`, `idReunion`, `fechaInicial`, `horaInicial`, `fechaFinal`, `horaFinal`) VALUES (NULL, '$idReunion', '$fechaInicial', '$horaInicial', '$fechaFinal', '$horaFinal')";
		$this->db->query($sql);
		return $this->db->affected_rows() >= 1 ? true : false;
	}
}
?>