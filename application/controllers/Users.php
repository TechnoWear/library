<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('America/Mexico_City');

class Users extends CI_Controller {

	public function __construct() {
		parent:: __construct();

		// HELPERS
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');

		// LIBRERIES
		$this->load->library('form_validation');

		// MODELOS
		$this->load->model('M_users');
	}

	public function index()
	{
		
		$this->load->view('v_users');
	}

	public function tabla() {
		$data['data'] = $this->M_users->getUsers();

		if($data) {
			$this->load->view('tabla-users', $data);
		} else {
			echo json_encode("error al cargar los usuarios");
			exit();
		}

	}

	public function saveUser() {
		// VALIDACIONES

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

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
			"email" => $this->input->post("email")
		);
		
		if(is_numeric($id_modal)) {

			$response = $this->M_users->UPD_User($data, $id_modal);

			if($response) {
				echo json_encode("registro actualizado");
			} else {
				echo json_encode("error al actualizar");
				exit();
			}

		} else {

			$response = $this->M_users->INS_User($data);

			if($response) {
				echo json_encode("registro guardado");
			} else {
				echo json_encode("error");
				exit();
			}
		}
	}

	public function deleteUser() {
		// echo json_encode($_POST);
		// exit();

		$id = $this->input->post("id");

		$response = $this->M_users->DEL_User($id);

		if($response) {
			echo json_encode("registro eliminado");
		} else {
			echo json_encode("error");
			exit();
		}
	}

	public function getUser() {
		$id = $this->input->post("id");

		$response = $this->M_users->CNS_UserById($id);

		if($response) {
			echo json_encode($response);
		} else {
			echo json_encode("error al consultar el libro");
			exit();
		}
	}
}
