<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class newReunion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
			// Muestra el contenido
			$this->load->view('headers');
			$this->load->view('navbar');
			$this->load->view('new_reunion');
			$this->load->view('footer');

			
	}

	public function enviar_datos(){
			//guardamos los datos del formulario
          $titulo = $this->input->post('titulo');
          $asunto = $this->input->post('asunto');
          $fecha = $this->input->post('fecha');
          $lugar = $this->input->post('lugar');	
          $hora = $this->input->post('hora');
          $estatus= 1;
         

			$this->load->view('headers');
			$this->load->view('navbar');
			$this->load->view('footer');
			 $datos_reunion = array(
            'titulo' => trim(addslashes($titulo)),
            'asunto' =>  trim(addslashes($asunto)),
            'fecha' =>  trim(addslashes($fecha)),
            'lugar'=>	trim(addslashes($lugar)),	
            'hora' =>  trim(addslashes($hora)),
            'estatus'=> trim(addslashes($estatus))
          );		
           $sql=$this->Model_newReunion->get_datos($datos_reunion);
		
          //echo("titulo: ".$titulo."lugar: ".$lugar."fecha: ".$fecha."hora: ".$hora."asunto: ".$asunto);
	}
}

?>