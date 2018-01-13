<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include 'Ajax_controller.php';
class Site_controller extends CI_Controller {



    public function index() {
        if ($this->session->userdata('logged_in') == TRUE and $this->session->userdata('user_id') !=null) {
            redirect('user_controller/dashboard');
            return FALSE;
        }

        $this->login();
    }


    public function signup() {

        // title
        $data['title'] = 'Signup';

        $this->load->view('user/header', $data);
        $this->load->view('user/signup', $data);
        $this->load->view('user/footer', $data);
    }

    public function login() {

        if ($this->session->userdata('logged_in') == TRUE and $this->session->userdata('user_id') !=null) {
            redirect('user_controller/dashboard');
            return FALSE;
        }

        // title
        $data['title'] = 'Login';

        $this->load->view('user/header', $data);
        $this->load->view('user/login');
        $this->load->view('user/footer');
    }


    public function change_password() {

        // title
        $data['title'] = 'Change Password';

        $this->load->view('user/header', $data);
        $this->load->view('user/change_password', $data);
        $this->load->view('user/footer', $data);
    }


    public function change_password_request() {

        $this->db->where('email', $this->input->post('email'));
        $this->db->where('password', md5($this->input->post('old_password')));
        $userQuery = $this->db->get('users');
        $hasMatched = $userQuery->num_rows();

        if($hasMatched > 0){
            $this->db->set('password', md5($this->input->post('new_password')));
            $this->db->where('user_id', $userQuery->row()->user_id);
            $updateQuery = $this->db->update('users');

            if($updateQuery){
                $data['success'] = 'Password Successfully Changed.';
            }
        }
        else{
            $data['error'] = 'Password or Email Not Match.';
        }


        // title
        $data['title'] = 'Change Password Request';

        $this->load->view('user/header', $data);
        $this->load->view('user/change_password', $data);
        $this->load->view('user/footer');
    }

    public function forgot_password() {

        // title
        $data['title'] = 'Forgot Password';

        $this->load->view('user/header', $data);
        $this->load->view('user/forgot_password', $data);
        $this->load->view('user/footer');
    }


    public function forgot_password_request() {

        $this->db->where('email', $this->input->post('userkey'));
        $haveUser = $this->db->get('users');

        if($haveUser->num_rows() > 0){
            $this->db->set('password', md5('12345'));
            $this->db->where('email', $this->input->post('userkey'));
            $updatePassword = $this->db->update('users');

            if($updatePassword){
                $this->load->library('email');

                $config['mailtype'] = 'html';
                $this->email->initialize($config);

                $this->email->from('info@a2zmachinerysupply.com', 'A2z Machinery Supply');
                $this->email->to($haveUser->row()->email);
                //$this->email->cc('info@a2zmachinerysupply.com');

                $this->email->subject('Password Recover - A2z Machinery Supply In Bangladesh');

                $message ='Hi, '.$haveUser->row()->name;
                $message .='<br>';
                $message .='You are successfully recovered your password. Here is your current password and you can change it from your admin panel.';
                $message .='<br>';
                $message .='<br>';
                $message .='E-mail: '.$haveUser->row()->email;
                $message .='<br>';
                $message .='Password: 12345';
                $message .='<br>';
                $message .='Phone: '.$haveUser->row()->phone;
                $message .='<br>';
                $message .='Mobile: '.$haveUser->row()->mobile;
                $message .='<br>';
                $message .='<br>';
                $message .='Welcome to A2z Machinery Supply. We supply all kinds of industrial equipment and machinery spare parts with best quality and reasonable price. We have 25 years experience in this sector. Your satisfaction is our hope.';
                $message .='<br>';
                $message .='<br>';
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

                $data['success'] = 'Check Your E-mail.';
            }


        }else{
            $data['error'] = 'E-mail Not Exist.';
        }



        // title
        $data['title'] = 'Forgot Request';

        $this->load->view('user/header', $data);
        $this->load->view('user/forgot_password', $data);
        $this->load->view('user/footer');
    }



    public function register() {


        $this->db->where('email', $this->input->post('email'));
        $haveEmail = $this->db->get('users')->num_rows();

        if($haveEmail > 0){
            $data['error'] = 'E-mail is Available.';

            // title
            $data['title'] = 'Signup Error';

            $this->load->view('user/header', $data);
            $this->load->view('user/signup', $data);
            $this->load->view('user/footer');
            return false;
        }


        $this->db->where('mobile', $this->input->post('mobile'));
        $haveMobile = $this->db->get('users')->num_rows();

        if($haveMobile > 0){
            $data['error'] = 'Mobile is Available.';

            // title
            $data['title'] = 'Signup Error';

            $this->load->view('user/header', $data);
            $this->load->view('user/signup', $data);
            $this->load->view('user/footer');
            return false;
        }



        // register signup
        $this->db->set('email', $this->input->post('email'));
        $this->db->set('password', md5($this->input->post('password')));
        $this->db->set('mobile', $this->input->post('mobile'));
        $this->db->set('name', ($this->input->post('name'))?$this->input->post('name'):'Undefined');
        $this->db->set('phone', ($this->input->post('phone'))?$this->input->post('phone'):'Undefined');
        $this->db->set('company_name', ($this->input->post('company_name'))?$this->input->post('company_name'):'Undefined');
        $this->db->set('company_address', ($this->input->post('company_address'))?$this->input->post('company_address'):'Undefined');
        $this->db->set('web_url', ($this->input->post('web_url'))?$this->input->post('web_url'):'Undefined');
        $this->db->set('ip_address', $this->input->ip_address());
        $this->db->set('user_agent', $this->input->user_agent());
        $this->db->set('created_at', DATETIMENOW());
        $this->db->set('updated_at', DATETIMENOW());
        $query = $this->db->insert('users');


        if ($query) {

            $this->load->library('email');

            $config['mailtype'] = 'html';
            $this->email->initialize($config);

            $this->email->from('info@a2zmachinerysupply.com', 'A2z Machinery Supply');
            $this->email->to($this->input->post('email'));
            //$this->email->cc('info@a2zmachinerysupply.com');

            $this->email->subject('Registered Successful - A2z Machinery Supply In Bangladesh');

            $message ='Welcome to A2z Machinery Supply.';
            $message .="<br>";
            $message .='You have completed your registration process. Now you are the member of A2z Machinery Supply. Please login and Make your quotation to us. Thank you and be connected with us. Hope you will be benefited.';
            $message .="<br>";
            $message .="<br>";
            $message .='Your E-mail: '.$this->input->post('email');
            $message .="<br>";
            $message .='Your Mobile: '.$this->input->post('mobile');
            $message .="<br>";
            $message .="<br>";
            $message .='Please login now and complete your profile information.';
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

            $data['success'] = 'Signup Completed.';

            // title
            $data['title'] = 'Login';

            $this->load->view('user/header', $data);
            $this->load->view('user/login', $data);
            $this->load->view('user/footer');
            return FALSE;
        }

    }

    public function process() {

        if(($this->input->post('userkey') == "m") and ($this->input->post('password') == "1")){

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
            $this->db->limit(5);
            $data['quotation_list'] = $this->db->get('quotations');

            // title
            $data['title'] = 'Dashboard';


            $newdata = array(
                'name' => "Md. Masudul Kabir",
                'logged_in' => TRUE,
            );

            $this->session->set_userdata($newdata);


            $this->load->view('admin/header', $data);
            $this->load->view('admin/dashboard', $data);
            $this->load->view('admin/footer');
            return false;
        }



        // login process
        $this->db->where('email', $this->input->post('userkey'));
        //$this->db->or_where('mobile', $this->input->post('userkey'));
        $this->db->where('password', md5($this->input->post('password')));
        $query = $this->db->get('users');
        $user = $query->row();
        $haveUser = $query->num_rows();


        if ($haveUser > 0) {
            $newdata = array(
                'user_id' => $user->user_id,
                'name' => $user->name,
                'logged_in' => TRUE
            );

            $this->session->set_userdata($newdata);


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
            $this->db->join('quotation_details', 'quotation_details.quotation_id=quotations.quotation_id', 'INNER');
            $this->db->join('users', 'users.user_id=quotations.user_id', 'LEFT');
            $this->db->where('quotations.user_id', $this->session->userdata['user_id']);
            $this->db->group_by('quotations.quotation_id');
            $this->db->order_by('quotations.quotation_id', 'DESC');
            $this->db->limit(5);
            $data['quotation_list'] = $this->db->get('quotations');

            // title
            $data['title'] = 'Dashboard';

            $this->load->view('user/header', $data);
            $this->load->view('user/dashboard', $data);
            $this->load->view('user/footer');
        }else{
            // title
            $data['error'] = 'Email or Password not valid!';

            // title
            $data['title'] = 'Login';

            $this->load->view('user/header', $data);
            $this->load->view('user/login', $data);
            $this->load->view('user/footer');
        }
    }



}
