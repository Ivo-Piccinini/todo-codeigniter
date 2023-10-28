<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class profile extends CI_Controller{
        public function index(){
            redirect("profile/editar");
        }
        
        public function editar(){
            $this->load->model("usuarios_model"); // cargamos el modelo
            $this->load->library("form_validation"); // Si no cargamos la librería en el autoload, lo hacemos así
            // Este código es parte de la librería form_validation
            $this->form_validation->set_rules("pass","contraseña","required");
            $this->form_validation->set_rules("confpass","conf.contraseña","required|matches[pass]");
            // Si el usuario no ingresa datos, lo redirige a login
            if ($this->form_validation->run() == FALSE){
                $this->load->view('change_pass');
            } else {
                // el set_value solo funciona si están seteadas las reglas en el set_rules, si no hay ninguna va a quedar vacío
                $pass = set_value("pass");
                $usuario_id = $this->session->userdata("usuario_id");
                if ($this->usuarios_model->change_pass($usuario_id,$pass)) {
                    $this->session->set_flashdata("msj","<p class='alert alert-success'>Contraseña actualizada</p>");
                } else {
                    $this->session->set_flashdata("msj","<p class='alert alert-secondary'>No hay campos</p>");
                }
                redirect("profile/editar");
            }
        }
        public function editar_usuario(){
            $this->load->model("usuarios_model"); // cargamos el modelo
            $this->load->library("form_validation"); // Si no cargamos la librería en el autoload, lo hacemos así
            // Este código es parte de la librería form_validation
            $this->form_validation->set_rules("newuser","nuevo_usuario","required");
            if ($this->form_validation->run() == FALSE){
                $this->load->view('change_pass');
            } else {
                // el set_value solo funciona si están seteadas las reglas en el set_rules, si no hay ninguna va a quedar vacío
                $newuser = set_value("newuser");
                $usuario_id = $this->session->userdata("usuario_id");
                if ($this->usuarios_model->change_name($usuario_id,$newuser)) {
                    $this->session->set_userdata("usuario",$newuser);
                    $this->session->set_flashdata("msj-usuario","<p class='alert alert-success'>Nombre de usuario actualizado</p>");
                } else {
                    $this->session->set_flashdata("msj-usuario","<p class='alert alert-secondary'>No hay campos</p>");
                }
                redirect("profile/editar");
            }
        }

        public function admin_usuarios(){
            $datos = array();
            $this->load->model("usuarios_model");
            $datos["usuarios"] = $this->usuarios_model->obtener_usuarios();
            if($this->session->userdata("rol") == 1){
                $this->load->view("admin_usuarios",$datos);
            } else {
                redirect("tareas/index");
            }
        }

        public function quitar_usuario($usuario_id=null){
            $usuario_id = intval($usuario_id);
            if($usuario_id > 0){
                $this->load->model('usuarios_model');
                $this->usuarios_model->borrar_usuario($usuario_id);
            }
            redirect("profile/admin_usuarios");
        }
    }
?>