<?php
class M_books extends CI_MODEL {

    public function __construct() {
        parent:: __construct();

        // CONEXION BD
        $this->load->database();
    }

    public function getBooks() {
        $this->db->select('B.id as id, B.name as name, B.author as author, C.name as category, B.user as user, U.name as user_name');
        $this->db->from('book as B');
        $this->db->join('category as C','B.category=C.id','inner');
        $this->db->join('user as U','B.user=U.id','left');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function CNS_BookById($id) {
        $this->db->select('B.id as id, B.name as name, B.author as author, B.category as category');
        $this->db->from('book as B');
        $this->db->where('B.id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function getCategories() {
        $this->db->select('id, name');
        $this->db->from('category');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function INS_Book($data) {
        $this->db->insert('book', $data);

        return $this->db->insert_id();
    }

    public function UPD_Book($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('book', $data);

        return $this->db->affected_rows();
    }

    public function DEL_Book($id) {
        $this->db->where('id',$id);
        $this->db->delete('book');

        return "exito";
    }

    public function DEL_UserOfBook($id) {
        $this->db->where('id',$id);
        $this->db->set('user', '0');
        $this->db->update('book');

        return $this->db->affected_rows();;
    }
}