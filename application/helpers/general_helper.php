<?php 
function _is_logged_in(){
    $ci =& get_instance();
    $ci->load->library ('session');
    $is_logged_in = $ci->session->userdata( 'is_logged_in' );
    if (! isset ( $is_logged_in ) || $is_logged_in != TRUE) {
        redirect( base_url().'auth/login','refresh' );
    }
}