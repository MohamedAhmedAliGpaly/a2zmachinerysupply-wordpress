<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include 'Ajax_controller.php';

class Admin_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }


    function history($reason, $quotation_id, $product_description, $quantity_unit, $expected_price, $quoted_price){
        $this->db->set('created_at', DATETIMENOW());
        $this->db->set('user_id', '1');
        $this->db->set('reason', $reason);
        $this->db->set('quotation_id', $quotation_id);
        $this->db->set('product_description', $product_description);
        $this->db->set('quantity_unit', $quantity_unit);
        $this->db->set('expected_price', $expected_price);
        $this->db->set('quoted_price', $quoted_price);
        $this->db->insert('history');
    }


    public function dashboard() {

        // get quotations
        $data['quotation_query']=$this->db->get('quotations');

        // get users
        $data['user_query']=$this->db->get('users');

        // quotation details
        $this->db->select('users.*, quotations.created_at, quotations.quotation_id, SUM(quotation_details.quantity_unit * quotation_details.expected_price) AS total_expected_price, SUM(quotation_details.quantity_unit * quotation_details.quoted_price) AS total_quoted_price, quotations.status');
        $this->db->join('quotation_details', 'quotation_details.quotation_id=quotations.quotation_id', 'LEFT');
        $this->db->join('users', 'users.user_id=quotations.user_id', 'LEFT');
        $this->db->group_by('quotations.quotation_id');
        $this->db->order_by('quotations.quotation_id', 'DESC');
        $this->db->limit(25);
        $data['quotation_list'] = $this->db->get('quotations');

        // title
        $data['title'] = 'Dashboard';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/footer');
    }

    public function redirect_quotation_edit($quotation_id) {

        $data['quotation_id'] = $quotation_id;

        $this->load->view('admin/header', $data);
        $this->load->view('admin/redirect_quotation_edit');
        $this->load->view('admin/footer');
    }

    public function quotation_edit(){

        $quotation_id = $this->input->post('quotation_id');

        // quotation list
        $this->db->select('users.*, quotations.created_at, quotations.quotation_id, SUM(quotation_details.quantity_unit * quotation_details.expected_price) AS total_expected_price, SUM(quotation_details.quantity_unit * quotation_details.quoted_price) AS total_quoted_price, quotations.status');
        $this->db->join('quotation_details', 'quotation_details.quotation_id=quotations.quotation_id', 'LEFT');
        $this->db->join('users', 'users.user_id=quotations.user_id', 'LEFT');
        $this->db->where('quotations.quotation_id', $quotation_id);
        $this->db->group_by('quotations.quotation_id');
        $this->db->order_by('quotations.quotation_id', 'DESC');
        $data['quotation'] = $this->db->get('quotations')->row();

        // quotation details lit
        $this->db->where('quotation_details.quotation_id', $quotation_id);
        $this->db->order_by('quotation_detail_id', 'ASC');
        $data['quotation_detail_list'] = $this->db->get('quotation_details');

        // title
        $data['title'] = 'Quotation Edit';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/quotation_edit');
        $this->load->view('admin/footer');
    }


    public function print_invoice($quotation_id){

        $haveQuotation = $this->db->get_where('quotations', array('quotation_id'=>$quotation_id))->num_rows();
        if($haveQuotation < 1){
            echo "<h1>Quotation Not Available!</h1>";
            return false;
        }

        // quotation details
        //$this->db->select('quotations.created_at, quotations.quotation_id, SUM(quotation_details.quantity_unit * quotation_details.expected_price) AS total_expected_price, SUM(quotation_details.quantity_unit * quotation_details.quoted_price) AS total_quoted_price, quotations.status');
        //$this->db->join('quotations', 'quotations.quotation_id=quotation_details.quotation_id', 'LEFT');
        //$this->db->where('quotations.user_id', $this->session->userdata['user_id']);
        $this->db->join('users', 'users.user_id=quotations.user_id', 'LEFT');
        $this->db->where('quotation_id', $quotation_id);
        $data['quotation_list'] = $this->db->get('quotations')->row();

        $this->db->where('quotation_details.quotation_id', $quotation_id);
        $data['quotation_item_list'] = $this->db->get('quotation_details');


        // title
        $data['title'] = 'Invoice';

        $this->load->view('user/print_invoice', $data);
    }

    public function save_quotation(){


        // check quotation id
        $this->db->where('quotation_id', $this->input->post('quotation_id'));
        $quotation_query = $this->db->get('quotations');

        if($quotation_query->num_rows() > 0){
            // quotation id
            $data['quotation_id'] = $quotation_query->row()->quotation_id;
        }
        else{
            // insert quotation
            $this->db->set('quotation_id', $this->input->post('quotation_id'));
            $this->db->set('created_at', $this->input->post('created_at'));
            $this->db->set('updated_at', $this->input->post('created_at'));
            $this->db->set('user_id', $this->session->userdata('user_id'));
            $this->db->insert('quotations');

            // quotation id
            $data['quotation_id'] = $this->input->post('quotation_id');

        }


        // insert quotation details
        $this->db->set('quotation_id', $data['quotation_id']);
        $this->db->set('product_description', $this->input->post('product_description'));
        $this->db->set('quantity_unit', $this->input->post('quantity_unit'));
        $this->db->set('expected_price', ($this->input->post('expected_price'))?$this->input->post('expected_price'):'Undefined');
        $this->db->set('quoted_price', ($this->input->post('quoted_price'))?$this->input->post('quoted_price'):'Waiting..');
        $this->db->insert('quotation_details');


        // quotation details
        $this->db->join('quotation_details', 'quotation_details.quotation_id=quotations.quotation_id', 'LEFT');
        $this->db->where('quotations.quotation_id', $data['quotation_id']);
        $data['quotation_list'] = $this->db->get('quotations');


        // title
        $data['title'] = 'Save Quotation';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/quotation_entry');
        $this->load->view('admin/footer');
    }

    public function print_sample($quotation_id){

        // quotation details
        $this->db->join('users', 'users.user_id=quotations.user_id', 'LEFT');
        $this->db->where('quotation_id', $quotation_id);
        $data['quotation_list'] = $this->db->get('quotations')->row();

        $this->db->where('quotation_details.quotation_id', $quotation_id);
        $data['quotation_item_list'] = $this->db->get('quotation_details');


        // title
        $data['title'] = 'Sample';

        $this->load->view('user/print_sample', $data);
    }


    public function update_quotation(){

        $quotation_id = $this->input->post('quotation_id');

        $count = count($this->input->post('quotation_detail_id'));

        for($i=0; $i<$count; $i++){
            // update quotation details
            $this->db->set('product_description', $this->input->post('product_description')[$i]);
            $this->db->set('quantity_unit', $this->input->post('quantity_unit')[$i]);
            //$this->db->set('expected_price', $this->input->post('expected_price')[$i]);
            $this->db->set('quoted_price', $this->input->post('quoted_price')[$i]);
            $this->db->where('quotation_detail_id', $this->input->post('quotation_detail_id')[$i]);
            $this->db->update('quotation_details');

            // History
            $this->history('Updating', $quotation_id, $this->input->post('product_description')[$i], $this->input->post('quantity_unit')[$i], ($this->input->post('expected_price')[$i])?$this->input->post('expected_price')[$i]:'Undefined', ($this->input->post('quoted_price')[$i])?$this->input->post('quoted_price')[$i]:'Waiting..');


        }




        // quotation list
        $this->db->select('users.*, quotations.created_at, quotations.quotation_id, SUM(quotation_details.quantity_unit * quotation_details.expected_price) AS total_expected_price, SUM(quotation_details.quantity_unit * quotation_details.quoted_price) AS total_quoted_price, quotations.status');
        $this->db->join('quotation_details', 'quotation_details.quotation_id=quotations.quotation_id', 'LEFT');
        $this->db->join('users', 'users.user_id=quotations.user_id', 'LEFT');
        $this->db->where('quotations.quotation_id', $quotation_id);
        $this->db->group_by('quotations.quotation_id');
        $this->db->order_by('quotations.quotation_id', 'DESC');
        $data['quotation'] = $this->db->get('quotations')->row();

        // quotation details lit
        $this->db->where('quotation_details.quotation_id', $quotation_id);
        $this->db->order_by('quotation_detail_id', 'ASC');
        $data['quotation_detail_list'] = $this->db->get('quotation_details');

        // title
        $data['title'] = 'Quotation Edit';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/quotation_edit');
        $this->load->view('admin/footer');
    }

    public function quotation_list(){

        // pagination config
        $config['base_url'] = site_url() . '/admin_controller/quotation_list/';
        $config['per_page'] = SETLIMIT;
        $config['num_links'] = 5;
        $config['total_rows'] = $this->db->get('quotations')->num_rows();

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '<li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';

        $this->pagination->initialize($config);

        // quotation details
        $this->db->select('users.*, quotations.created_at, quotations.quotation_id, SUM(quotation_details.quantity_unit * quotation_details.expected_price) AS total_expected_price, SUM(quotation_details.quantity_unit * quotation_details.quoted_price) AS total_quoted_price, quotations.status');
        $this->db->join('quotation_details', 'quotation_details.quotation_id=quotations.quotation_id', 'LEFT');
        $this->db->join('users', 'users.user_id=quotations.user_id', 'LEFT');
        $this->db->group_by('quotation_details.quotation_id');
        $this->db->order_by('quotations.quotation_id', 'DESC');
        $this->db->limit($config['per_page'], $this->uri->segment(3));
        $data['quotation_list'] = $this->db->get('quotations');


        // title
        $data['title'] = 'Quotation List';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/quotation_list');
        $this->load->view('admin/footer');
    }



    public function quotation_item_list(){

        // pagination config
        $config['base_url'] = site_url() . '/admin_controller/quotation_item_list/';
        $config['per_page'] = SETLIMIT;
        $config['num_links'] = 5;
        $config['total_rows'] = $this->db->get('quotation_details')->num_rows();

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '<li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';

        $this->pagination->initialize($config);

        // quotation details
        $this->db->select('quotations.created_at, quotations.quotation_id, quotation_details.product_description, quotation_details.quantity_unit, quotation_details.expected_price, quotation_details.quoted_price, quotations.status');
        $this->db->join('quotation_details', 'quotation_details.quotation_id=quotations.quotation_id', 'LEFT');
        $this->db->group_by('quotations.quotation_id');
        $this->db->order_by('quotations.quotation_id', 'DESC');
        $this->db->limit($config['per_page'], $this->uri->segment(3));
        $data['quotation_item_list'] = $this->db->get('quotations');


        // title
        $data['title'] = 'Quotation List';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/quotation_item_list');
        $this->load->view('admin/footer');
    }



    public function history_list(){

        // pagination config
        $config['base_url'] = site_url() . '/admin_controller/history_list/';
        $config['per_page'] = 100;
        $config['num_links'] = 5;
        $config['total_rows'] = $this->db->get('history')->num_rows();

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '<li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';

        $this->pagination->initialize($config);

        // quotation details
        $this->db->select('history.created_at, history.quotation_id, history.reason, history.user_id, users.company_name, history.product_description, history.quantity_unit, history.expected_price, history.quoted_price');
        $this->db->join('users', 'users.user_id=history.user_id', 'LEFT');
        $this->db->order_by('history_id', 'DESC');
        $this->db->limit($config['per_page'], $this->uri->segment(3));
        $data['history_list'] = $this->db->get('history');


        // title
        $data['title'] = 'History';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/history', $data);
        $this->load->view('admin/footer');
    }


    public function search_history_list(){

        // quotation details
        $this->db->select('history.created_at, history.quotation_id, history.reason, history.user_id, users.company_name, history.product_description, history.quantity_unit, history.expected_price, history.quoted_price');
        $this->db->join('users', 'users.user_id=history.user_id', 'LEFT');

        $this->db->like('history.created_at', $this->input->post('created_at'));
        $this->db->like('history.reason', $this->input->post('reason'));
        $this->db->like('history.quotation_id', $this->input->post('quotation_id'));
        $this->db->like('users.company_name', $this->input->post('company_name'));
        $this->db->like('users.user_id', $this->input->post('user_id'));
        $this->db->like('users.company_address', $this->input->post('company_address'));
        $this->db->like('users.phone', $this->input->post('phone'));
        $this->db->like('users.mobile', $this->input->post('mobile'));
        $this->db->like('users.email', $this->input->post('email'));
        $this->db->like('users.web_url', $this->input->post('web_url'));
        $this->db->like('history.product_description', $this->input->post('product_description'));
        $this->db->like('history.quantity_unit', $this->input->post('quantity_unit'));
        $this->db->like('history.expected_price', $this->input->post('expected_price'));
        $this->db->like('history.quoted_price', $this->input->post('quoted_price'));

        $this->db->order_by('history_id', 'DESC');
        $this->db->limit(SEARCH_LIMIT);
        $data['history_list'] = $this->db->get('history');

        // title
        $data['title'] = 'History Search';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/history', $data);
        $this->load->view('admin/footer');
    }




    public function search_quotation(){


        // quotation details
        $this->db->select('users.user_id, quotations.created_at, users.company_name, users.company_address, quotations.quotation_id, users.name, users.phone, users.mobile, users.email, users.web_url, quotations.status, SUM(quotation_details.quantity_unit * quotation_details.expected_price) AS total_expected_price, SUM(quotation_details.quantity_unit * quotation_details.quoted_price) AS total_quoted_price');
        $this->db->join('quotation_details', 'quotation_details.quotation_id=quotations.quotation_id', 'LEFT');
        $this->db->join('users', 'users.user_id=quotations.user_id', 'LEFT');

        $this->db->like('quotations.created_at', $this->input->post('date'));
        $this->db->like('users.company_name', $this->input->post('company_name'));
        $this->db->like('users.company_address', $this->input->post('company_address'));
        $this->db->like('quotations.quotation_id', $this->input->post('quotation_id'));
        $this->db->like('users.name', $this->input->post('name'));
        $this->db->like('users.phone', $this->input->post('phone'));
        $this->db->like('users.mobile', $this->input->post('mobile'));
        $this->db->like('users.email', $this->input->post('email'));
        $this->db->like('users.web_url', $this->input->post('web_url'));
        $this->db->like('quotations.status', $this->input->post('status'));

        $this->db->group_by('quotation_details.quotation_id');
        $this->db->order_by('quotations.quotation_id', 'DESC');
        $this->db->limit(SEARCH_LIMIT);
        $data['quotation_list'] = $this->db->get('quotations');


        // title
        $data['title'] = 'Search Quotation';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/quotation_list');
        $this->load->view('admin/footer');
    }


    public function add_another_item($quotation_id){


        // check quotation id
        $this->db->where('quotation_id', $quotation_id);
        $quotation_query = $this->db->get('quotations');

        if($quotation_query->num_rows() > 0){
            // quotation id
            $data['quotation_id'] = $quotation_query->row()->quotation_id;
        }


        if(!empty($_POST)){
            // insert quotation details
            $this->db->set('quotation_id', $data['quotation_id']);
            $this->db->set('product_description', $this->input->post('product_description'));
            $this->db->set('quantity_unit', $this->input->post('quantity_unit'));
            $this->db->set('expected_price', $this->input->post('expected_price'));
            $this->db->insert('quotation_details');
        }


        // quotation details
        $this->db->join('quotation_details', 'quotation_details.quotation_id=quotations.quotation_id', 'LEFT');
        $this->db->where('quotations.quotation_id', $data['quotation_id']);
        $data['quotation_list'] = $this->db->get('quotations');



        // title
        $data['title'] = 'Add Another Item';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/add_another_item');
        $this->load->view('admin/footer');
    }


    public function search_quotation_item(){

        // quotation details
        $this->db->select('quotations.created_at, quotations.quotation_id, quotation_details.product_description, quotation_details.quantity_unit, quotation_details.expected_price, quotation_details.quoted_price, quotations.status');
        $this->db->join('quotations', 'quotations.quotation_id=quotation_details.quotation_id', 'LEFT');
        $this->db->join('users', 'users.user_id=quotations.user_id', 'LEFT');

        $this->db->like('quotations.quotation_id', $this->input->post('quotation_id'));
        $this->db->like('quotations.created_at', $this->input->post('date'));
        $this->db->like('quotation_details.product_description', $this->input->post('product_description'));
        $this->db->like('quotation_details.expected_price', $this->input->post('expected_price'));
        $this->db->like('quotation_details.quoted_price', $this->input->post('quoted_price'));
        $this->db->like('users.company_name', $this->input->post('company_name'));
        $this->db->like('users.company_address', $this->input->post('company_address'));
        $this->db->like('users.name', $this->input->post('name'));
        $this->db->like('users.phone', $this->input->post('phone'));
        $this->db->like('users.mobile', $this->input->post('mobile'));
        $this->db->like('users.email', $this->input->post('email'));
        $this->db->like('users.web_url', $this->input->post('web_url'));
        $this->db->like('quotations.status', $this->input->post('status'));

        $this->db->order_by('quotations.quotation_id', 'DESC');
        $this->db->limit(SEARCH_LIMIT);
        $data['quotation_item_list'] = $this->db->get('quotation_details');


        // title
        $data['title'] = 'Search Quotation Item';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/quotation_item_list', $data);
        $this->load->view('admin/footer');
    }


    public function processing($quotation_id){


        $this->db->where('quotation_id', $quotation_id);
        $this->db->set('status', 'processing');
        $query = $this->db->update('quotations');

        if($query){
            // quotation details
            $this->db->select('users.*, quotations.created_at, quotations.quotation_id, SUM(quotation_details.quantity_unit * quotation_details.expected_price) AS total_expected_price, SUM(quotation_details.quantity_unit * quotation_details.quoted_price) AS total_quoted_price, quotations.status');
            $this->db->join('quotation_details', 'quotation_details.quotation_id=quotations.quotation_id', 'LEFT');
            $this->db->join('users', 'users.user_id=quotations.user_id', 'LEFT');
            $this->db->group_by('quotations.quotation_id');
            $this->db->order_by('quotations.quotation_id', 'DESC');
            $data['quotation_list'] = $this->db->get('quotations');


            // title
            $data['title'] = 'Quotation List';

            $this->load->view('admin/header', $data);
            $this->load->view('admin/quotation_list');
            $this->load->view('admin/footer');
        }

    }


    public function quoted($quotation_id){


        $this->db->where('quotation_id', $quotation_id);
        $this->db->set('status', 'quoted');
        $query = $this->db->update('quotations');

        if($query){
            // quotation details
            $this->db->select('users.*, quotations.created_at, quotations.quotation_id, SUM(quotation_details.quantity_unit * quotation_details.expected_price) AS total_expected_price, SUM(quotation_details.quantity_unit * quotation_details.quoted_price) AS total_quoted_price, quotations.status');
            $this->db->join('quotation_details', 'quotation_details.quotation_id=quotations.quotation_id', 'LEFT');
            $this->db->join('users', 'users.user_id=quotations.user_id', 'LEFT');
            $this->db->group_by('quotations.quotation_id');
            $this->db->order_by('quotations.quotation_id', 'DESC');
            $data['quotation_list'] = $this->db->get('quotations');

            $quotation =  $data['quotation_list']->row();



            $this->load->library('email');

            $config['mailtype'] = 'html';
            $this->email->initialize($config);

            $this->email->from('info@a2zmachinerysupply.com', 'A2z Machinery Supply');
            $this->email->to($quotation->email);
            //$this->email->cc('info@a2zmachinerysupply.com');

            $this->email->subject('Quotation Quoted - A2z Machinery Supply In Bangladesh');

            $message ='<h1 style="background-color: #5bc0de; color: white; font-weight: 100; font-family: fantasy; font-size: 28px; letter-spacing: 0.02em; text-decoration: underline; padding: 10px 15px; margin-bottom: 20px;">Quotation Quoted</h1>';
            $message .='Welcome to A2z Machinery Supply.';
            $message .="<br>";
            $message .='The quotation has been quoted successfully. Please check the quotation and confirm us. If any requirement please fell free and contact with us. Your satisfaction is our hope. Thanks and welcome to next step.';
            $message .="<br>";
            $message .="<br>";
            $message .='<span style="color: red; text-decoration: underline;">Brief of Quotation:</span>';
            $message .="<br>";
            $message .='Quotation Id: #'.$quotation->quotation_id;
            $message .="<br>";
            $message .='Created At: '.$quotation->created_at;
            $message .="<br>";
            $message .='Company Name: '.$quotation->company_name;
            $message .="<br>";
            $message .="<br>";
            $message .='<span style="color: red; text-decoration: underline;">Short Links:</span>';
            $message .="<br>";
            $message .='Edit your quotation - <a target="_blank" href="http://a2zmachinerysupply.com/order/user_controller/redirect_quotation_edit/'.$quotation->quotation_id.'.html">Quotation Edit</a>';
            $message .="<br>";
            $message .='See details of your quotation - <a target="_blank" href="http://a2zmachinerysupply.com/order/user_controller/print_sample/'.$quotation->quotation_id.'.html">Print Sample</a>';
            $message .="<br>";
            $message .='Print as Invoice of your quotation - <a target="_blank" href="http://a2zmachinerysupply.com/order/user_controller/print_invoice/'.$quotation->quotation_id.'.html">Print Invoice</a>';
            $message .="<br>";
            $message .="<br>";
            $message .='Thanking From';
            $message .="<br>";
            $message .='A2z Machinery Supply';
            $message .="<br>";
            $message .='Phone: 9588952';
            $message .="<br>";
            $message .='Mobile: 01676-717945';
            $message .="<br>";
            $message .='Email: <a target="_blank" href="mailto:info@a2zmachinerysupply.com">info@a2zmachinerysupply.com</a>';
            $message .="<br>";
            $message .='Web: <a target="_blank" href="http://www.a2zmachinerysupply.com/">a2zmachinerysupply.com</a>';

            $this->email->message($message);
            $this->email->send();




            // title
            $data['title'] = 'Quotation List';

            $this->load->view('admin/header', $data);
            $this->load->view('admin/quotation_list');
            $this->load->view('admin/footer');
        }

    }


    public function pending($quotation_id){


        $this->db->where('quotation_id', $quotation_id);
        $this->db->set('status', 'pending');
        $query = $this->db->update('quotations');

        if($query){
            // quotation details
            $this->db->select('users.*, quotations.created_at, quotations.quotation_id, SUM(quotation_details.quantity_unit * quotation_details.expected_price) AS total_expected_price, SUM(quotation_details.quantity_unit * quotation_details.quoted_price) AS total_quoted_price, quotations.status');
            $this->db->join('quotation_details', 'quotation_details.quotation_id=quotations.quotation_id', 'LEFT');
            $this->db->join('users', 'users.user_id=quotations.user_id', 'LEFT');
            $this->db->group_by('quotations.quotation_id');
            $this->db->order_by('quotations.quotation_id', 'DESC');
            $data['quotation_list'] = $this->db->get('quotations');

            $quotation = $data['quotation_list']->row();


            $this->load->library('email');

            $config['mailtype'] = 'html';
            $this->email->initialize($config);

            $this->email->from('info@a2zmachinerysupply.com', 'A2z Machinery Supply');
            $this->email->to($quotation->email);
            //$this->email->cc('info@a2zmachinerysupply.com');

            $this->email->subject('Quotation Pending - A2z Machinery Supply In Bangladesh');

            $message ='<h1 style="background-color: #f89406; color: white; font-weight: 100; font-family: fantasy; font-size: 28px; letter-spacing: 0.02em; text-decoration: underline; padding: 10px 15px; margin-bottom: 20px;">Quotation Pending</h1>';
            $message .='Welcome to A2z Machinery Supply.';
            $message .="<br>";
            $message .='The quotation is pending for nothing response. Please check the quotation and confirm us. If any requirement please fell free and contact with us. Your satisfaction is our hope. Thanks and welcome to next step.';
            $message .="<br>";
            $message .="<br>";
            $message .='<span style="color: red; text-decoration: underline;">Brief of Quotation:</span>';
            $message .="<br>";
            $message .='Quotation Id: #'.$quotation->quotation_id;
            $message .="<br>";
            $message .='Created At: '.$quotation->created_at;
            $message .="<br>";
            $message .='Company Name: '.$quotation->company_name;
            $message .="<br>";
            $message .="<br>";
            $message .='<span style="color: red; text-decoration: underline;">Short Links:</span>';
            $message .="<br>";
            $message .='Edit your quotation - <a target="_blank" href="http://a2zmachinerysupply.com/order/user_controller/redirect_quotation_edit/'.$quotation->quotation_id.'.html">Quotation Edit</a>';
            $message .="<br>";
            $message .='See details of your quotation - <a target="_blank" href="http://a2zmachinerysupply.com/order/user_controller/print_sample/'.$quotation->quotation_id.'.html">Print Sample</a>';
            $message .="<br>";
            $message .='Print as Invoice of your quotation - <a target="_blank" href="http://a2zmachinerysupply.com/order/user_controller/print_invoice/'.$quotation->quotation_id.'.html">Print Invoice</a>';
            $message .="<br>";
            $message .="<br>";
            $message .='Thanking From';
            $message .="<br>";
            $message .='A2z Machinery Supply';
            $message .="<br>";
            $message .='Phone: 9588952';
            $message .="<br>";
            $message .='Mobile: 01676-717945';
            $message .="<br>";
            $message .='Email: <a target="_blank" href="mailto:info@a2zmachinerysupply.com">info@a2zmachinerysupply.com</a>';
            $message .="<br>";
            $message .='Web: <a target="_blank" href="http://www.a2zmachinerysupply.com/">a2zmachinerysupply.com</a>';

            $this->email->message($message);
            $this->email->send();



            // title
            $data['title'] = 'Quotation List';

            $this->load->view('admin/header', $data);
            $this->load->view('admin/quotation_list');
            $this->load->view('admin/footer');
        }

    }


    public function completed($quotation_id){


        $this->db->where('quotation_id', $quotation_id);
        $this->db->set('status', 'completed');
        $query = $this->db->update('quotations');

        if($query){
            // quotation details
            $this->db->select('users.*, quotations.created_at, quotations.quotation_id, SUM(quotation_details.quantity_unit * quotation_details.expected_price) AS total_expected_price, SUM(quotation_details.quantity_unit * quotation_details.quoted_price) AS total_quoted_price, quotations.status');
            $this->db->join('quotation_details', 'quotation_details.quotation_id=quotations.quotation_id', 'LEFT');
            $this->db->join('users', 'users.user_id=quotations.user_id', 'LEFT');
            $this->db->group_by('quotations.quotation_id');
            $this->db->order_by('quotations.quotation_id', 'DESC');
            $data['quotation_list'] = $this->db->get('quotations');



            $quotation = $data['quotation_list']->row();


            $this->load->library('email');

            $config['mailtype'] = 'html';
            $this->email->initialize($config);

            $this->email->from('info@a2zmachinerysupply.com', 'A2z Machinery Supply');
            $this->email->to($quotation->email);
            //$this->email->cc('info@a2zmachinerysupply.com');

            $this->email->subject('Quotation Completed - A2z Machinery Supply In Bangladesh');

            $message ='<h1 style="background-color: #f89406; color: white; font-weight: 100; font-family: fantasy; font-size: 28px; letter-spacing: 0.02em; text-decoration: underline; padding: 10px 15px; margin-bottom: 20px;">Quotation Pending</h1>';
            $message .='Welcome to A2z Machinery Supply.';
            $message .="<br>";
            $message .='The quotation is completed. We are happy to give you a service. Thanks and welcome to next step. Your satisfaction is our hope.';
            $message .="<br>";
            $message .="<br>";
            $message .='<span style="color: red; text-decoration: underline;">Brief of Quotation:</span>';
            $message .="<br>";
            $message .='Quotation Id: #'.$quotation->quotation_id;
            $message .="<br>";
            $message .='Created At: '.$quotation->created_at;
            $message .="<br>";
            $message .='Company Name: '.$quotation->company_name;
            $message .="<br>";
            $message .="<br>";
            $message .='<span style="color: red; text-decoration: underline;">Short Links:</span>';
            $message .="<br>";
            $message .='See details of your quotation - <a target="_blank" href="http://a2zmachinerysupply.com/order/user_controller/print_sample/'.$quotation->quotation_id.'.html">Print Sample</a>';
            $message .="<br>";
            $message .='Print as Invoice of your quotation - <a target="_blank" href="http://a2zmachinerysupply.com/order/user_controller/print_invoice/'.$quotation->quotation_id.'.html">Print Invoice</a>';
            $message .="<br>";
            $message .="<br>";
            $message .='Thanking From';
            $message .="<br>";
            $message .='A2z Machinery Supply';
            $message .="<br>";
            $message .='Phone: 9588952';
            $message .="<br>";
            $message .='Mobile: 01676-717945';
            $message .="<br>";
            $message .='Email: <a target="_blank" href="mailto:info@a2zmachinerysupply.com">info@a2zmachinerysupply.com</a>';
            $message .="<br>";
            $message .='Web: <a target="_blank" href="http://www.a2zmachinerysupply.com/">a2zmachinerysupply.com</a>';

            $this->email->message($message);
            $this->email->send();



            // title
            $data['title'] = 'Quotation List';

            $this->load->view('admin/header', $data);
            $this->load->view('admin/quotation_list');
            $this->load->view('admin/footer');
        }

    }


    public function canceled($quotation_id){


        $this->db->where('quotation_id', $quotation_id);
        $this->db->set('status', 'canceled');
        $query = $this->db->update('quotations');

        if($query){
            // quotation details
            $this->db->select('users.*, quotations.created_at, quotations.quotation_id, SUM(quotation_details.quantity_unit * quotation_details.expected_price) AS total_expected_price, SUM(quotation_details.quantity_unit * quotation_details.quoted_price) AS total_quoted_price, quotations.status');
            $this->db->join('quotation_details', 'quotation_details.quotation_id=quotations.quotation_id', 'LEFT');
            $this->db->join('users', 'users.user_id=quotations.user_id', 'LEFT');
            $this->db->group_by('quotations.quotation_id');
            $this->db->order_by('quotations.quotation_id', 'DESC');
            $data['quotation_list'] = $this->db->get('quotations');
            $quotation = $data['quotation_list']->row();


            $this->load->library('email');

            $config['mailtype'] = 'html';
            $this->email->initialize($config);

            $this->email->from('info@a2zmachinerysupply.com', 'A2z Machinery Supply');
            $this->email->to($quotation->email);
            //$this->email->cc('info@a2zmachinerysupply.com');

            $this->email->subject('Quotation Canceled - A2z Machinery Supply In Bangladesh');

            $message ='<h1 style="background-color: #ee5f5b; color: white; font-weight: 100; font-family: fantasy; font-size: 28px; letter-spacing: 0.02em; text-decoration: underline; padding: 10px 15px; margin-bottom: 20px;">Quotation Canceled</h1>';
            $message .='Welcome to A2z Machinery Supply.';
            $message .="<br>";
            $message .='The quotation is canceled for nothing response. Please check the quotation and confirm us. If any requirement please fell free and contact with us. Your satisfaction is our hope. Thanks and welcome to next step.';
            $message .="<br>";
            $message .="<br>";
            $message .='<span style="color: red; text-decoration: underline;">Brief of Quotation:</span>';
            $message .="<br>";
            $message .='Quotation Id: #'.$quotation->quotation_id;
            $message .="<br>";
            $message .='Created At: '.$quotation->created_at;
            $message .="<br>";
            $message .='Company Name: '.$quotation->company_name;
            $message .="<br>";
            $message .="<br>";
            $message .='<span style="color: red; text-decoration: underline;">Short Links:</span>';
            $message .="<br>";
            $message .='Edit your quotation - <a target="_blank" href="http://a2zmachinerysupply.com/order/user_controller/redirect_quotation_edit/'.$quotation->quotation_id.'.html">Quotation Edit</a>';
            $message .="<br>";
            $message .='See details of your quotation - <a target="_blank" href="http://a2zmachinerysupply.com/order/user_controller/print_sample/'.$quotation->quotation_id.'.html">Print Sample</a>';
            $message .="<br>";
            $message .='Print as Invoice of your quotation - <a target="_blank" href="http://a2zmachinerysupply.com/order/user_controller/print_invoice/'.$quotation->quotation_id.'.html">Print Invoice</a>';
            $message .="<br>";
            $message .="<br>";
            $message .='Thanking From';
            $message .="<br>";
            $message .='A2z Machinery Supply';
            $message .="<br>";
            $message .='Phone: 9588952';
            $message .="<br>";
            $message .='Mobile: 01676-717945';
            $message .="<br>";
            $message .='Email: <a target="_blank" href="mailto:info@a2zmachinerysupply.com">info@a2zmachinerysupply.com</a>';
            $message .="<br>";
            $message .='Web: <a target="_blank" href="http://www.a2zmachinerysupply.com/">a2zmachinerysupply.com</a>';

            $this->email->message($message);
            $this->email->send();




            // title
            $data['title'] = 'Quotation List';

            $this->load->view('admin/header', $data);
            $this->load->view('admin/quotation_list');
            $this->load->view('admin/footer');
        }

    }


    public function user_edit($user_id) {
        // user list
        $this->db->where('user_id', $user_id);
        $data['user'] = $this->db->get('users')->row();

        // page title
        $data['title'] = 'User Edit';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/user_edit', $data);
        $this->load->view('admin/footer');
    }


    public function user_list() {
        // pagination config
        $config['base_url'] = site_url() . '/admin_controller/user_list/';
        $config['per_page'] = SETLIMIT;
        $config['num_links'] = 5;
        $config['total_rows'] = $this->db->get('users')->num_rows();

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '<li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';

        $this->pagination->initialize($config);

        // product list
        $this->db->order_by('user_id', 'DESC');
        $this->db->limit($config['per_page'], $this->uri->segment(3));
        $data['user_list'] = $this->db->get('users');


        // page title
        $data['title'] = 'User List';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/user_list', $data);
        $this->load->view('admin/footer');
    }


    public function search_user() {

        // product list
        $this->db->like('company_name', $this->input->post('company_name'));
        $this->db->like('company_address', $this->input->post('company_address'));
        $this->db->like('email', $this->input->post('email'));
        $this->db->like('name', $this->input->post('name'));
        $this->db->like('phone', $this->input->post('phone'));
        $this->db->like('mobile', $this->input->post('mobile'));
        $this->db->like('web_url', $this->input->post('web_url'));
        $this->db->order_by('company_name', 'ASC');
        $this->db->limit(SEARCH_LIMIT);
        $data['user_list'] = $this->db->get('users');

        // page title
        $data['title'] = 'Search User';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/user_list', $data);
        $this->load->view('admin/footer');
    }


    public function update_user() {


        // save user
        $this->db->set('company_name', ($this->input->post('company_name'))?$this->input->post('company_name'):'Undefined');
        $this->db->set('company_address', ($this->input->post('company_address'))?$this->input->post('company_address'):'Undefined');
        $this->db->set('web_url', ($this->input->post('web_url'))?$this->input->post('web_url'):'Undefined');
        $this->db->set('name', ($this->input->post('name'))?$this->input->post('name'):'Undefined');
        $this->db->set('email', $this->input->post('email'));
        $this->db->set('phone', ($this->input->post('phone'))?$this->input->post('phone'):'Undefined');
        $this->db->set('mobile', $this->input->post('mobile'));
        $this->db->set('updated_at', DATETIMENOW());
        $this->db->where('user_id', $this->input->post('user_id'));
        $query = $this->db->update('users');

        if($query){
            $data['success'] = true;
        }

        // user list
        $this->db->where('user_id', $this->input->post('user_id'));
        $data['user'] = $this->db->get('users')->row();

        // page title
        $data['title'] = 'Update User';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/user_edit', $data);
        $this->load->view('admin/footer');
    }


    public function ajax_delete_user(){

        // get sub_user_id
        $user_id = $this->input->get('user_id');


        $this->db->where('user_id', $user_id);
        $query = $this->db->delete('users');
        if($query){
            echo 'deleted';
        }

    }


    public function ajax_delete_quotation_detail_item(){

        // get quotation_detail_id
        $quotation_detail_id = $this->input->get('quotation_detail_id');


        $this->db->where('quotation_detail_id', $quotation_detail_id);
        $query = $this->db->delete('quotation_details');

        if($query){
            echo 'deleted';
        }

    }


}
