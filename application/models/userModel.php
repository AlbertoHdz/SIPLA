<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class UserModel extends CI_Model{
	/*definición de atributos*/
	private $idUsuario;
	private $usuario;
	private $password;
	private $idRol;

	/*constructor vacio*/
	function __construct(){
		parent::__construct();
	}

	/**
	* Método para hacer el login de usuarios,
	* para ello hacemos uso de los datos enviados en el formulario
	**/
	public function login()
	{
		$this->db->where('usuario', $this->input->post('usuario'));
		$this->db->where('password', $this->input->post('password'));
		$query = $this->db->get('usuarios');

		// Verificamos que se haya obtenido la información
		if($query->num_rows() == 1)
		{
			return $query->row();
		} else
		{
			return null;
		}
	}

	public function exists(){
		$this->db->where('usuario', $this->input->get('usuario'));
		$query = $this->db->get('usuarios');
		if($query->num_rows() == 1){
			return 1;
		}else{
			return 0;
		}
	}

	public function create(){
		$data = array(
			'usuario' => $this->input->post("usuario"),
			'password' => $this->input->post("password"),
			'idRol' => (int)$this->input->post("idRol")
		);
		$this->db->insert("usuarios",$data);
	}

}

?>