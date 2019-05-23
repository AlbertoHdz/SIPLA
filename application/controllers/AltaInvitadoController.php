<?php
class AltaInvitadoController extends CI_Controller {
    
    public function __construct(){
		parent::__construct();
		$this->load->model('UserModel', 'user', true);
		$this->load->helper('form');
	}
    
    public function index(){
        if ($this->session->has_userdata('isLogin')){
            $this->load->view('headers');
            $this->load->view('navbar');
            $this->load->view('AltaInvitado');
            $this->load->view('footer');
            
        }else{
            redirect(base_url(), 'refresh');
        }
    }

    public function createInvitado(){
        $this->user->create();
        redirect("LoginController");
    }

    public function verificaUsuario(){
        $exists = $this->user->exists();
        echo $exists;
    }
}
?>