<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }

    public function login() {
        $is_logged_in = $this->session->userdata( 'is_logged_in' );
        if (isset ( $is_logged_in ) || $is_logged_in === TRUE) {
            redirect( base_url().'events','refresh' );
        }
        $this->load->view('login'); // Crea esta vista
    }

    public function do_login() {
        $username = $_POST['email'];
        $password = $_POST['password'];

        $this->load->model('auth_model'); 
        $user=$this->auth_model->check_credentials($username, md5($password));
        if ($user) {
            $user_data = array(
                'user_id' => $user->id,
                'user_name' => $user->name,
                'is_logged_in' => TRUE
            );
            $this->session->set_userdata($user_data);
            redirect('events');
        } else {
            redirect('auth/login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}