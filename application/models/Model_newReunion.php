<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_newReunion extends CI_Model { 
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
}
?>