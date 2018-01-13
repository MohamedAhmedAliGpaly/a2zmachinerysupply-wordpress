<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include 'Ajax_controller.php';
class User_controller extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if ($this->session->userdata('logged_in') != TRUE  and $this->session->userdata('user_id') == null) {
            redirect('site_controller/login');
            return FALSE;
        }
    }


    function history($reason, $quotation_id, $product_description, $quantity_unit, $expected_price, $quoted_price){
        $this->db->set('created_at', DATETIMENOW());
        $this->db->set('user_id', $this->session->userdata('user_id'));
        $this->db->set('reason', $reason);
        $this->db->set('quotation_id', $quotation_id);
        $this->db->set('product_description', $product_description);
        $this->db->set('quantity_unit', $quantity_unit);
        $this->db->set('expected_price', $expected_price);
        $this->db->set('quoted_price', $quoted_price);
        $this->db->insert('history');
    }

    public function quotation_entry(){

        // quotation id
        $data['quotation_id'] = $this->db->get('quotations')->last_row()->quotation_id+1;

        // quotation details
        $this->db->join('quotation_details', 'quotation_details.quotation_id=quotations.quotation_id', 'LEFT');
        $this->db->where('quotations.quotation_id', $data['quotation_id']);
        $data['quotation_list'] = $this->db->get('quotations');


        // title
        $data['title'] = 'Quotation Entry';

        $this->load->view('user/header', $data);
        $this->load->view('user/quotation_entry');
        $this->load->view('user/footer');
    }


    public function search_quotation(){

        // quotation details
        $this->db->select('users.user_id, quotations.created_at, users.company_name, quotations.quotation_id, quotations.status, SUM(quotation_details.quantity_unit * quotation_details.expected_price) AS total_expected_price, SUM(quotation_details.quantity_unit * quotation_details.quoted_price) AS total_quoted_price');
        $this->db->join('quotation_details', 'quotation_details.quotation_id=quotations.quotation_id', 'LEFT');
        $this->db->join('users', 'users.user_id=quotations.user_id', 'LEFT');

        $this->db->where('quotations.user_id', $this->session->userdata['user_id']);

        $this->db->like('quotations.quotation_id', $this->input->post('quotation_id'));
        $this->db->like('quotations.created_at', $this->input->post('created_at'));
        $this->db->like('quotations.status', $this->input->post('status'));


        $this->db->group_by('quotation_details.quotation_id');
        $this->db->order_by('quotations.quotation_id', 'DESC');
        $this->db->limit(SEARCH_LIMIT);
        $data['quotation_list'] = $this->db->get('quotations');


        // title
        $data['title'] = 'Search Quotation';

        $this->load->view('user/header', $data);
        $this->load->view('user/quotation_list', $data);
        $this->load->view('user/footer');
    }



    public function search_quotation_item(){

        // quotation details
        $this->db->select('quotations.created_at, quotations.quotation_id, quotation_details.product_description, quotation_details.quantity_unit, quotation_details.expected_price, quotation_details.quoted_price, quotations.status');
        $this->db->join('quotations', 'quotations.quotation_id=quotation_details.quotation_id', 'LEFT');
        $this->db->join('users', 'users.user_id=quotations.user_id', 'LEFT');

        $this->db->where('quotations.user_id', $this->session->userdata['user_id']);

        $this->db->like('quotations.quotation_id', $this->input->post('quotation_id'));
        $this->db->like('quotations.created_at', $this->input->post('created_at'));
        $this->db->like('quotation_details.product_description', $this->input->post('product_description'));
        $this->db->like('quotation_details.expected_price', $this->input->post('expected_price'));
        $this->db->like('quotation_details.quoted_price', $this->input->post('quoted_price'));
        $this->db->like('quotations.status', $this->input->post('status'));

        $this->db->order_by('quotations.quotation_id', 'DESC');
        $this->db->limit(SEARCH_LIMIT);
        $data['quotation_item_list'] = $this->db->get('quotation_details');

        // title
        $data['title'] = 'Search Quotation Item';

        $this->load->view('user/header', $data);
        $this->load->view('user/quotation_item_list', $data);
        $this->load->view('user/footer');
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

        // History
        $this->history('Saving', $data['quotation_id'], $this->input->post('product_description'), $this->input->post('quantity_unit'), ($this->input->post('expected_price'))?$this->input->post('expected_price'):'Undefined', ($this->input->post('quoted_price'))?$this->input->post('quoted_price'):'Waiting..');



        // title
        $data['title'] = 'Save Quotation';

        $this->load->view('user/header', $data);
        $this->load->view('user/quotation_entry');
        $this->load->view('user/footer');
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
            $this->db->set('expected_price', ($this->input->post('expected_price'))?$this->input->post('expected_price'):'Undefined');
            $this->db->set('quoted_price', ($this->input->post('quoted_price'))?$this->input->post('quoted_price'):'Waiting..');
            $this->db->insert('quotation_details');
        }

        // quotation details
        $this->db->join('quotation_details', 'quotation_details.quotation_id=quotations.quotation_id', 'LEFT');
        $this->db->where('quotations.quotation_id', $data['quotation_id']);
        $data['quotation_list'] = $this->db->get('quotations');



        // title
        $data['title'] = 'Add Another Item';

        $this->load->view('user/header', $data);
        $this->load->view('user/add_another_item');
        $this->load->view('user/footer');
    }


    public function quotation_list(){

        // pagination config
        $config['base_url'] = site_url() . '/user_controller/quotation_list/';
        $config['per_page'] = SETLIMIT;
        $config['num_links'] = 5;
        $this->db->where('user_id', $this->session->userdata['user_id']);
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
        $this->db->select('quotations.created_at, users.company_name, quotations.quotation_id, SUM(quotation_details.quantity_unit * quotation_details.expected_price) AS total_expected_price, SUM(quotation_details.quantity_unit * quotation_details.quoted_price) AS total_quoted_price, quotations.status');
        $this->db->join('quotation_details', 'quotation_details.quotation_id=quotations.quotation_id', 'LEFT');
        $this->db->join('users', 'users.user_id=quotations.user_id', 'LEFT');
        $this->db->where('quotations.user_id', $this->session->userdata['user_id']);
        $this->db->group_by('quotations.quotation_id');
        $this->db->order_by('quotations.quotation_id', 'DESC');
        $this->db->limit($config['per_page'], $this->uri->segment(3));
        $data['quotation_list'] = $this->db->get('quotations');


        // title
        $data['title'] = 'Quotation List';

        $this->load->view('user/header', $data);
        $this->load->view('user/quotation_list');
        $this->load->view('user/footer');

    }



    public function print_invoice($quotation_id){

        $haveQuotation = $this->db->get_where('quotations', array('quotation_id'=>$quotation_id, 'user_id'=>$this->session->userdata['user_id']))->num_rows();
        if($haveQuotation < 1){
            echo "<h1>Quotation Not Available!</h1>";
            return false;
        }

        // quotation details
        $this->db->join('users', 'users.user_id=quotations.user_id', 'LEFT');
        $this->db->where('quotation_id', $quotation_id);
        $data['quotation_list'] = $this->db->get('quotations')->row();

        $this->db->where('quotation_details.quotation_id', $quotation_id);
        $data['quotation_item_list'] = $this->db->get('quotation_details');


        // title
        $data['title'] = 'Invoice';

        $this->load->view('user/print_invoice', $data);
    }



    public function print_sample($quotation_id){

        $haveQuotation = $this->db->get_where('quotations', array('quotation_id'=>$quotation_id, 'user_id'=>$this->session->userdata['user_id']))->num_rows();
        if($haveQuotation < 1){
            echo "<h1>Quotation Not Available!</h1>";
            return false;
        }

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


    public function quotation_item_list(){

        // pagination config
        $config['base_url'] = site_url() . '/user_controller/quotation_item_list/';
        $config['per_page'] = SETLIMIT;
        $config['num_links'] = 5;
        $this->db->where('user_id', $this->session->userdata['user_id']);
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
        $this->db->select('quotations.created_at, quotations.quotation_id, quotation_details.product_description, quotation_details.quantity_unit, quotation_details.expected_price, quotation_details.quoted_price, quotations.status');
        $this->db->join('quotations', 'quotations.quotation_id=quotation_details.quotation_id', 'LEFT');
        $this->db->where('quotations.user_id', $this->session->userdata['user_id']);
        $this->db->order_by('quotations.quotation_id', 'DESC');
        $this->db->limit($config['per_page'], $this->uri->segment(3));
        $data['quotation_item_list'] = $this->db->get('quotation_details');

        // title
        $data['title'] = 'Quotation Item List';

        $this->load->view('user/header', $data);
        $this->load->view('user/quotation_item_list');
        $this->load->view('user/footer');
    }


    public function dashboard(){

        // user
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $data['user'] = $this->db->get('users')->row();

        // processing
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->where('status', 'processing');
        $data['quotation_processing']=$this->db->get('quotations')->num_rows();

        // quoted
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->where('status', 'quoted');
        $data['quotation_quoted']=$this->db->get('quotations')->num_rows();


        // pending
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->where('status', 'pending');
        $data['quotation_pending']=$this->db->get('quotations')->num_rows();

        // completed
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->where('status', 'completed');
        $data['quotation_completed']=$this->db->get('quotations')->num_rows();


        // canceled
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->where('status', 'canceled');
        $data['quotation_canceled']=$this->db->get('quotations')->num_rows();

        // quotation details
        $this->db->select('quotations.created_at, quotations.quotation_id, users.company_name, SUM(quotation_details.quantity_unit * quotation_details.expected_price) AS total_expected_price, SUM(quotation_details.quantity_unit * quotation_details.quoted_price) AS total_quoted_price, quotations.status');
        $this->db->join('quotation_details', 'quotation_details.quotation_id=quotations.quotation_id', 'LEFT');
        $this->db->join('users', 'users.user_id=quotations.user_id', 'LEFT');
        $this->db->where('quotations.user_id', $this->session->userdata['user_id']);
        $this->db->group_by('quotations.quotation_id');
        $this->db->order_by('quotations.quotation_id', 'DESC');
        $this->db->limit(5);
        $data['quotation_list'] = $this->db->get('quotations');


        // title
        $data['title'] = 'Dashboard';

        $this->load->view('user/header', $data);
        $this->load->view('user/dashboard');
        $this->load->view('user/footer');
    }

    public function update_profile(){

        // update user
        $this->db->set('company_name', ($this->input->post('company_name'))?$this->input->post('company_name'):'Undefined');
        $this->db->set('company_address', ($this->input->post('company_address'))?$this->input->post('company_address'):'Undefined');
        $this->db->set('web_url', ($this->input->post('web_url'))?$this->input->post('web_url'):'Undefined');
        $this->db->set('name', ($this->input->post('name'))?$this->input->post('name'):'Undefined');
        $this->db->set('email', $this->input->post('email'));
        $this->db->set('phone', ($this->input->post('phone'))?$this->input->post('phone'):'Undefined');
        $this->db->set('mobile', $this->input->post('mobile'));
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $query = $this->db->update('users');

        if($query){
            $data['success'] = 'Profile has been updated.';
        }

        // get user
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $data['user'] = $this->db->get('users')->row();

        // title
        $data['title'] = 'Update Profile';

        $this->load->view('user/header', $data);
        $this->load->view('user/my_profile');
        $this->load->view('user/footer');
    }

    public function redirect_quotation_edit($quotation_id){

        $data['quotation_id'] = $quotation_id;

        $this->load->view('user/header', $data);
        $this->load->view('user/redirect_quotation_edit');
        $this->load->view('user/footer');

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

        $this->load->view('user/header', $data);
        $this->load->view('user/quotation_edit');
        $this->load->view('user/footer');
    }



    public function update_quotation(){

        $quotation_id = $this->input->post('quotation_id');

        $count = count($this->input->post('quotation_detail_id'));

        for($i=0; $i<$count; $i++){
            // update quotation details
            $this->db->set('product_description', $this->input->post('product_description')[$i]);
            $this->db->set('quantity_unit', $this->input->post('quantity_unit')[$i]);
            $this->db->set('expected_price', ($this->input->post('expected_price')[$i])?$this->input->post('expected_price')[$i]:'Undefined');
            //$this->db->set('quoted_price', $this->input->post('quoted_price')[$i]);
            $this->db->where('quotation_detail_id', $this->input->post('quotation_detail_id')[$i]);
            $this->db->update('quotation_details');


            // History
            $this->history('Updating', $quotation_id, $this->input->post('product_description')[$i], $this->input->post('quantity_unit')[$i], ($this->input->post('expected_price')[$i])?$this->input->post('expected_price')[$i]:'Undefined', ($this->input->post('quoted_price')[$i])?$this->input->post('quoted_price')[$i]:'Waiting..');

        }


        // Quotation list
        $this->db->select('users.*, quotations.created_at, quotations.quotation_id, SUM(quotation_details.quantity_unit * quotation_details.expected_price) AS total_expected_price, SUM(quotation_details.quantity_unit * quotation_details.quoted_price) AS total_quoted_price, quotations.status');
        $this->db->join('quotation_details', 'quotation_details.quotation_id=quotations.quotation_id', 'LEFT');
        $this->db->join('users', 'users.user_id=quotations.user_id', 'LEFT');
        $this->db->where('quotations.quotation_id', $quotation_id);
        $this->db->group_by('quotations.quotation_id');
        $this->db->order_by('quotations.quotation_id', 'DESC');
        $data['quotation'] = $this->db->get('quotations')->row();


        // Quotation details list
        $this->db->where('quotation_details.quotation_id', $quotation_id);
        $this->db->order_by('quotation_detail_id', 'ASC');
        $data['quotation_detail_list'] = $this->db->get('quotation_details');





        $data['success'] = "Quotation updated successfully.";

        // Title
        $data['title'] = 'Quotation Edit';

        $this->load->view('user/header', $data);
        $this->load->view('user/quotation_edit', $data);
        $this->load->view('user/footer');
    }


    public function ajax_canceled_quotation(){
        // get quotation_id
        $quotation_id = $this->input->get('quotation_id');


            $this->db->where('quotation_id', $quotation_id);
            $this->db->set('status', 'canceled');
            $query = $this->db->update('quotations');

            if($query){
                echo 'canceled';
            }

    }

    public function processing($quotation_id){


        $this->db->where('quotation_id', $quotation_id);
        $this->db->set('status', 'processing');
        $query = $this->db->update('quotations');

        if($query){
            // quotation details
            $this->db->select('quotations.created_at, quotations.quotation_id, users.company_name, SUM(quotation_details.quantity_unit * quotation_details.expected_price) AS total_expected_price, SUM(quotation_details.quantity_unit * quotation_details.quoted_price) AS total_quoted_price, quotations.status');
            $this->db->join('quotation_details', 'quotation_details.quotation_id=quotations.quotation_id', 'LEFT');
            $this->db->join('users', 'users.user_id=quotations.user_id', 'LEFT');
            $this->db->where('quotations.user_id', $this->session->userdata['user_id']);

            $this->db->group_by('quotations.quotation_id');
            $this->db->order_by('quotations.quotation_id', 'DESC');
            $data['quotation_list'] = $this->db->get('quotations');

            // title
            $data['title'] = 'Quotation List';

            $this->load->view('user/header', $data);
            $this->load->view('user/quotation_list');
            $this->load->view('user/footer');
        }

    }

    public function ajax_quotation_details_item_delete(){
        // get quotation_detail_id
        $quotation_detail_id = $this->input->get('quotation_detail_id');

        $this->db->where('quotation_detail_id', $quotation_detail_id);
        $query = $this->db->delete('quotation_details');

        if($query){
            echo 'deleted';
        }

    }


    public function my_profile(){

        // get user
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $data['user'] = $this->db->get('users')->row();

        // title
        $data['title'] = 'My Profile';

        $this->load->view('user/header', $data);
        $this->load->view('user/my_profile');
        $this->load->view('user/footer');
    }


    public function logout() {

        $this->session->sess_destroy();

        // title
        $data['title'] = 'Logout';

        $this->load->view('user/header', $data);
        $this->load->view('user/login', $data);
        $this->load->view('user/footer', $data);
    }


}
