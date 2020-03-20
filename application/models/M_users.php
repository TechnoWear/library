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

    public function CNS_BookById() {
        $this->db->select('B.id as id, B.name as name, B.author as author, B.category as category');
        $this->db->from('book as B');
        $query = $this->db->get();

        return $query->result_array();
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

    public function DEL_User($id) {
        $this->db->where('id',$id);
        $this->db->delete('user');

        return "exito";
    }
}