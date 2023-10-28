<?php
class tareas_model extends CI_Model{
    // Todos los modelos tienen CRUD
    // ponerle valor por defecto es para que en el caso de que no se ingrese un dato, no de error
    // en los modelos, los métodos se llaman dataservice

    protected $usuario_id = false;
    public function set_usuario($id){
        $this->usuario_id = $id;
    }

    /*
        Para establecer la prioridad, tenemos que solicitarla como parámetro en la función,
        luego setearla en la base de datos
    */
    public function crear($texto="",$usuario_id= false, $prioridad=false){
        $this->db->set("texto",$texto);
        $this->db->set("creador",$usuario_id);
        $this->db->set("prioridad",$prioridad);
        $this->db->insert("tareas");
        return $this->db->insert_id();
    }

    /*
        Para poder mostrar la prioridad de cada tarea, hacemos un inner join, seleccionando todo de la tabla "tareas",
        y agregandole todo de la tabla "prioridades", donde "tareas.prioridad" coincida con "prioridades.prioridad_id".
        Luego verificamos que exista el usuario, y si existe, solo le mostramos las tareas que él mismo creó. 
    */
    public function listar(){
        $query = $this->db->select('*');
        $query = $this->db->from('tareas');
        $query = $this->db->join('prioridades', 'tareas.prioridad = prioridades.prioridad_id');
        if ($this->usuario_id != false) {
            $this->db->where("creador",$this->usuario_id);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function borrar($id=false){
        $this->db->where("tarea_id", $id);
        $this->db->limit(1);
        $this->db->delete("tareas");
        return $this->db->affected_rows();
    }
    
    public function borrar_todo(){
        if ($this->usuario_id != false) {
            $this->db->where("creador",$this->usuario_id);
        }
        $this->db->delete("tareas");
        return $this->db->affected_rows();
    }

    public function prioridades(){
        $this->db->where("estado",1);
        return $this->db->get("prioridades")->result_array();
    }
}