<?php
    class usuarios_model extends CI_Model{
        public function obtener_por_id($id=false){
            $this->db->where("usuario_id", $id);
            $this->db->limit(1);
            $res = $this->db->get("usuarios");
            return $res->row_array(); // el row_array es para cuando tengo un solo resultado, sino se usa result_array
        }

        public function check_login($usuario="", $password=""){
            $this->db->select("usuario_id"); // Esto es para que la peticion se haga mas rápido
            $this->db->where("usuario",$usuario);
            $this->db->where("password",$password);
            $this->db->limit(1);
            $res = $this->db->get("usuarios");
            if ($res->num_rows()) {
                $tmp = $res->row_array();
                return $this->obtener_por_id($tmp["usuario_id"]);
            } else {
                return false;
            }
        }
        
        public function check_usuario($usuario=""){
            $this->db->select("usuario_id");
            $this->db->where("usuario", $usuario);
            $this->db->limit(1);
            $res = $this->db->get("usuarios");
            if($res->num_rows()){
                return true;
            } else {
                return false;
            }
        }
        public function actualiza_login($id=""){
            $this->db->set("ult_login","now()",FALSE);
            $this->db->where("usuario_id",$id);
            $this->db->update("usuarios");
            $this->db->limit(1);
            return $this->db->affected_rows();
        }
        
        public function change_pass($usuario_id= "",$new_pass= ""){
            $this->db->where("usuario_id",$usuario_id);
            $this->db->set("password",$new_pass);
            $this->db->update("usuarios");
            return $this->db->affected_rows();
        }

        public function change_name($usuario_id= "",$new_name= ""){
            $this->db->where("usuario_id",$usuario_id);
            $this->db->set("usuario",$new_name);
            $this->db->update("usuarios");
            return $this->db->affected_rows();
        }

        public function obtener_usuarios(){
            $this->db->select("*");
            $this->db->from("usuarios");
            $this->db->order_by("usuario_id");
            return $this->db->get()->result_array();
        }

        public function borrar_usuario($usuario_id = false){
            $this->db->where("usuario_id", $usuario_id);
            $this->db->limit(1);
            $this->db->delete("usuarios");
            return $this->db->affected_rows();
        }
    }
?>