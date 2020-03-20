<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('America/Mexico_City');

class Books extends CI_Controller {

	public function __construct() {
		parent:: __construct();

		// HELPERS
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');

		// LIBRERIES
		$this->load->library('form_validation');

		// MODELOS
		$this->load->model('M_books');
	}

	public function index()
	{
		
		$data['categories'] = $this->M_books->getCategories();
		$data['users'] = $this->M_books->getUsers();
		if($data) {
			$this->load->view('v_books', $data);
		} else {
			echo json_encode("error al cargar las categorias");
			exit();
		}
	}

	public function tabla() {
		$data['data'] = $this->M_books->getBooks();

		if($data) {
			$this->load->view('tabla', $data);
		} else {
			echo json_encode("error al cargar los libros");
			exit();
		}

	}

	public function saveBook() {
		// echo json_encode($_POST);
		// exit();

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('author', 'Autor', 'required|trim');
		$this->form_validation->set_rules('category', 'Category', 'required|trim');
		

		if ($this->form_validation->run() == FALSE) {
			echo json_encode(validation_errors());
			exit();
		}

		$id_modal = $this->input->post("id_modal");

		// echo json_encode($_POST);
		// exit();

		// DATA A ENNVIAR
		$data = array(
			"name" => $this->input->post("name"),
			"author" => $this->input->post("author"),
			"category" => $this->input->post("category"),
			"published" => date('Y-m-d h:i:s'),
			"user" => "0"
		);

		if(is_numeric($id_modal)) {

			$response = $this->M_books->UPD_Book($data, $id_modal);

			if($response) {
				echo json_encode("registro actualizado");
			} else {
				echo json_encode("error al actualizar");
				exit();
			}

		} else {

			$response = $this->M_books->INS_Book($data);

			if($response) {
				echo json_encode("registro guardado");
			} else {
				echo json_encode("error");
				exit();
			}
		}
	}

	public function addUser() {
		// echo json_encode($_POST);
		// exit();

		$id_modal = $this->input->post("id_modal_user");
		$id_user = $this->input->post("user");

		// echo json_encode($_POST);
		// exit();

		// DATA A ENNVIAR
		$data = array(
			"user" => $this->input->post("user")
		);

			$response = $this->M_books->UPD_Book($data, $id_modal);

			if($response) {
				echo json_encode("registro actualizado");
			} else {
				echo json_encode("error al actualizar");
				exit();
			}

	}

	public function deleteBook() {
		// echo json_encode($_POST);
		// exit();

		$id = $this->input->post("id");

		$response = $this->M_books->DEL_Book($id);

		if($response) {
			echo json_encode("registro eliminado");
		} else {
			echo json_encode("error");
			exit();
		}
	}

	public function deleteUserOfBook() {
		// echo json_encode($_POST);
		// exit();

		$id = $this->input->post("id");

		$response = $this->M_books->DEL_UserOfBook($id);

		if($response) {
			echo json_encode("registro actualizado");
		} else {
			echo json_encode("error");
			exit();
		}
	}

	public function getBook() {
		$id = $this->input->post("id");

		$response = $this->M_books->CNS_BookById($id);

		if($response) {
			echo json_encode($response);
		} else {
			echo json_encode("error al consultar el libro");
			exit();
		}
	}
}
