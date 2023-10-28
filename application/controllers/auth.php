<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class auth extends CI_Controller{
        public function index(){
            redirect("auth/ingresar");
        }
        
        public function ingresar(){
            $this->load->model("usuarios_model"); // cargamos el modelo
            $this->load->library("form_validation"); // Si no cargamos la librería en el autoload, lo hacemos así
            // Este código es parte de la librería form_validation
            $this->form_validation->set_rules("usuario","usuario","required|trim|strtolower"); // set_rules son las reglas que tiene que cumplir el usuario para que entre al sistema // El primer campo requiere el name del input // el 2do campo es lo que va a ver el usuario cuando le salte el error
            $this->form_validation->set_rules("password","contraseña","required");
            // Si el usuario no ingresa datos, lo redirige a login
            if ($this->form_validation->run() == FALSE){
                $this->load->view('login');
            }
            else{
                // el set_value solo funciona si están seteadas las reglas en el set_rules, si no hay ninguna va a quedar vacío
                $usuario = set_value("usuario"); // el set_value guarda en la variable lo que escribe el usuario en el campo definido
                $password = set_value("password");
                if($u = $this->usuarios_model->check_login($usuario,$password)){
                    if ($u["estado"] == 1) {
                        // Variable de sesión permanente:
                        $this->session->set_userdata("usuario_id",$u["usuario_id"]); // set_userdata es para crear una nueva variable de sesion (no se pueden guardar arrays)
                        $this->session->set_userdata("usuario",$u["usuario"]);
                        $this->session->set_userdata("rol",$u["rol"]);

                        $this->usuarios_model->actualiza_login($u["usuario_id"]);
                        redirect("tareas");
                    } else {
                        $this->session->set_flashdata("mensaje","<p class='alert alert-secondary'>Usuario desactivado</p>");
                        redirect("auth/ingresar");
                    }
                } else {
                    // Variable de sesión efímera:
                    $this->session->set_flashdata("mensaje","<p class='alert alert-danger'>Usuario o contraseña incorrectos</p>");
                    redirect("auth/ingresar");
                }
                redirect("tareas/index");
            }
        }

        public function logout(){
            // Esto destruye las variables de sesión
            $this->session->sess_destroy();
            redirect("auth");
        }
    }
?>