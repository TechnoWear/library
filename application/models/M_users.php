<?php
class M_users extends CI_MODEL {

    public function __construct() {
        parent:: __construct();

        // CONEXION BD
        $this->load->database();
    }

    public function getUsers() {
        $this->db->select('*');
        $this->db->from('user');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function CNS_UserById($id) {
        $this->db->select('U.id as id, U.name as name, U.email as email');
        $this->db->from('user as U');
        $this->db->where('U.id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function getCategories() {
        $this->db->select('id, name');
        $this->db->from('category');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function INS_User($data) {
        $this->db->insert('user', $data);

        return $this->db->insert_id();
    }

    public function UPD_User($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('user', $data);

        return $this->db->affected_rows();
    }

    public function DEL_User($id) {
        $this->db->where('id',$id);
        $this->db->delete('user');

        return "exito";
    }
}