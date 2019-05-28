<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_newReunion extends CI_Model { 
	/*definición de atributos*/
	private $idReunion;
	private $titulo;
	private $asunto;
	private $fecha;
	private $lugar;
	private $hora;
	private $estatus;
	private $idUsuario;


   public function __construct() {
      parent::__construct();
   }
   public function get_datos($data)
	{	
		print $data['titulo'];
		print $data['asunto'];
		print $data['fecha'];
		print $data['lugar'];
		print $data['hora'];
		print $data['estatus'];
	$consulta= "INSERT INTO reuniones(titulo,asunto,fecha,lugar,hora,estatus,idUsuario) VALUES ('".$data['titulo']."','".$data['asunto']."','".$data['fecha']."','".$data['lugar']."','".$data['hora']."',".$data['estatus'].",1)";
   $sql=$this->db->query($consulta);
  return $sql;
	}

	public function getAllReuniones(){
		$query = $this->db->get('reuniones');
		return $query->result_array();//row_array();
	}

	public function getReunionesUsuario($idUsuario){
		//$this->db->select('*');//,reuniones.username,tbl_user.userid,tbl_usercategory.typee
		//$this->db->from('reuniones');
		//$this->db->join('relReunionUsuario','relReunionUsuario.idUsuario=reuniones.idUsuario');
		//$this->db->where('relReunionUsuario.idUsuario',$idUsuario);
		$query=$this->db->query('SELECT rn.*
			FROM reuniones AS rn
			INNER JOIN relReunionUsuario as ru on rn.idReunion = ru.idReunion
			INNER JOIN usuarios as u on ru.idUsuario = u.idUsuario
			Where u.idUsuario ='.$idUsuario);
		return $query->result_array();
	}
	
	
}
?>