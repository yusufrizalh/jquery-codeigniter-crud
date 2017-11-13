<?php 

class Model_customers extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getCustomers()
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'customers.customerNumber';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_customer']) ? strval($_POST['search_customer']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('customers')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from customers
            where concat(customerName,'',contactLastName,'',contactFirstName)  like '%$search%' order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function saveCustomer()
    {
        $data = [
            'customerName' => $this->input->post('customerName'),
            'contactFirstName' => $this->input->post('contactFirstName'),
            'contactLastName' => $this->input->post('contactLastName'),
            'phone' => $this->input->post('phone'),
            'addressLine1' => $this->input->post('addressLine1'),
            'addressLine2' => $this->input->post('addressLine2'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'postalCode' => $this->input->post('postalCode'),
            'country' => $this->input->post('country'),
        ];
        $this->db->insert('customers',$data);
        return $this->db->insert_id();
    }

    public function updateCustomer($id)
    {
        $data =  [
            'customerName' => $this->input->post('customerName'),
            'contactFirstName' => $this->input->post('contactFirstName'),
            'contactLastName' => $this->input->post('contactLastName'),
            'phone' => $this->input->post('phone'),
            'addressLine1' => $this->input->post('addressLine1'),
            'addressLine2' => $this->input->post('addressLine2'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'postalCode' => $this->input->post('postalCode'),
            'country' => $this->input->post('country')
        ];

        $this->db->where('customerNumber',$id);
        $this->db->set($data);
        return $this->db->update('customers');
    }

    public function destroyCustomer($id)
    {
        $this->db->where('customerNumber',$id);
        return $this->db->delete('customers');
        // return $this->db->delete($this->table,['id' => $id]);
    }
}