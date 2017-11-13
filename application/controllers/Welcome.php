<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['model_customers']);
	}
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function getCustomers()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_customers->getCustomers();
		echo json_encode($employee);
	}

	public function saveCustomer()
	{
		$input = $this->model_customers->saveCustomer();
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}

	public function updateCustomer($id)
	{
		$input = $this->model_customers->updateCustomer($id);
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}
	public function destroyCustomer()
	{
		$id = intval($_REQUEST['id']);
		$input = $this->model_customers->destroyCustomer($id);
		if ($input) {
			echo json_encode(array('success'=>true));
		}else {
			echo json_encode(array('errorMsg'=>'Some errors occured.'));
		}
	}
}
