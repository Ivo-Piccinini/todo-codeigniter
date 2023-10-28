<?php
// ---verifica que pasemos por indexi si o si ---
defined('BASEPATH') OR exit('No direct script access allowed');

//clase matriz de controladores : todas las clases arrancan con CI , esto nos permite trabajar en el framework

class tareas extends CI_Controller {

	public function __construct(){
		// Esta línea es obligatoria en los constructores
		parent::__construct(); // significa que ademas de cargar este constructor, hay que cargar el de CI_Controller
		if(!$this->session->userdata("usuario_id")){
			$this->session->set_flashdata("mensaje","PROHIBIDO");
			redirect("auth/ingresar");
		}
	}
// --- METODO OBLIGATORIO : INDEX ----
// no se usa echo , ni a html , ya que si queremos mostrar algo lo ponemos en la carpeta view		
	public function index(){
		$datos = array();
		$this->load->model('tareas_model');
		$this->tareas_model->set_usuario($this->session->userdata('usuario_id'));
		$datos["tareas"] = $this->tareas_model->listar();
		$datos["total"] = count($datos["tareas"]);
		$datos["prioridades"] = $this->tareas_model->prioridades();
		$this->load->view('tareas',$datos); // -- VIEWS , WELCOME MESSAGE ,seleccionamos la carpeta views y el archivo welcome
	}
	public function guardar(){
		$this->load->model('tareas_model');
		$texto = $this->input->post("tarea");
		$prioridad = $this->input->post("prioridad");
		$usuario_id = $this->session->userdata("usuario_id");
		$this->tareas_model->crear($texto,$usuario_id,$prioridad);
		redirect("tareas");
	}

	public function quitar($id=null){
		$tarea_id = intval($id);
		if($tarea_id > 0){
			$this->load->model('tareas_model');
			$this->tareas_model->borrar($tarea_id);
		}
		redirect("tareas/index");
	}

	public function quitar_todo(){
		$this->load->model("tareas_model");
		$this->tareas_model->set_usuario($this->session->userdata('usuario_id'));
		$this->tareas_model->borrar_todo();
		redirect("tareas/index");
	}
}
