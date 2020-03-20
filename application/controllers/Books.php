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

		// OBTIENE LAS CATEGORIAS DE LOS LIBROS PARA PODER ASIGNARSELA
		$data['categories'] = $this->M_books->getCategories();
		// OBTIENE LOS USARIOS REGISTRADOS PARA PODER ASIGNARLES LIBROS
		$data['users'] = $this->M_books->getUsers();
		if($data) {
			$this->load->view('v_books', $data);
		} else {
			echo json_encode("error al cargar las categorias");
			exit();
		}
	}

	public function tabla() {

		// OBTIENE LA DATA DE LOS LIBROS PARA LLENAR LA TABLA
		$data['data'] = $this->M_books->getBooks();

		if($data) {
			// SE ENVIA LA DATA A LA TABLA
			$this->load->view('tabla', $data);
		} else {
			echo json_encode("error al cargar los libros");
			exit();
		}

	}

	// FUNCION QUE REALIZA EL INSERT O UPDATE SEGUN SEA EL CASO
	public function saveBook() {
	
		// REGLAS PARA VALIDAR
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('author', 'Autor', 'required|trim');
		$this->form_validation->set_rules('category', 'Category', 'required|trim');
		

		if ($this->form_validation->run() == FALSE) {
			// SI UNA REGLA NO SE CUMPLE RETORNA EL ERROR
			echo json_encode(validation_errors());
			exit();
		}

		// RECIBE EL ID DEL LIBRO ÁRA SABER SI PROCEDE A INSERT O UPDATE
		$id_modal = $this->input->post("id_modal");

		// DATA A ENNVIAR
		$data = array(
			"name" => $this->input->post("name"),
			"author" => $this->input->post("author"),
			"category" => $this->input->post("category"),
			"published" => date('Y-m-d h:i:s'),
			"user" => "0"
		);

		// SI EL ID_MODAL(ID DEL LIBRO) RECIBE EL NUMERO PROCEDE A REALIZAR UPDATE
		if(is_numeric($id_modal)) {

			$response = $this->M_books->UPD_Book($data, $id_modal);

			if($response) {
				echo json_encode("registro actualizado");
			} else {
				echo json_encode("error al actualizar");
				exit();
			}
		// DE NO RECIBIR UN NUMERO DE LIBRO PROCEDE A REALIZAR UN INSERT
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

		// RECIBE EL ID DEL LIBRO PARA ANEXARLE UN PRESTAMO AL USUARIO
		$id_modal = $this->input->post("id_modal_user");
		// RECIBE EL ID DEL USUARIO AL CUAL SE LE VA A REALIZAR EL PRESTAMO
		$id_user = $this->input->post("user");

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

		// RECIBE EL ID DEL LIBRO PARA ELIMINARLO
		$id = $this->input->post("id");

		// ENVIA EL ID A LA FUNCION ENCARGADA DE ILIMINAR EL LIBRO
		$response = $this->M_books->DEL_Book($id);

		if($response) {
			echo json_encode("registro eliminado");
		} else {
			echo json_encode("error");
			exit();
		}
	}

	public function deleteUserOfBook() {

		// RECIBE EL ID DEL LIBO PARA RETIRARLE EL USUARIO REGISTRADO AL QUE SE LE HIZO EL PRESTAMO
		$id = $this->input->post("id");

		$response = $this->M_books->DEL_UserOfBook($id);

		if($response) {
			echo json_encode("registro actualizado");
		} else {
			echo json_encode("error");
			exit();
		}
	}

	// FUNCION QUE CONSULTA UN LIBRO POR SU ID PARA LLENAR EL MODAL DE ACTUALIZACION
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
