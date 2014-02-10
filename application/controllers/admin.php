<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
  public function index()
  {
    // Check to make sure that user is logged in
    $access = $this->session->userdata('access');

    if ($access != 'admin')
    {
      // User is not logged in so can't view the page
      $this->session->set_flashdata('message', 'Not authorized to view page');
      redirect(site_url("/welcome"));
    }
    // Load models
    $this->load->model('ldap_model');

    // Get initial user infomation
    $user = $this->session->userdata('username');
    $data = $this->ldap_model->get_user($user);
    
    //print_r($data);

    // Load Views
    $this->load->view('header');
    $this->load->view('sidebar');
    $this->load->view('admin_panel', $data);
    $this->load->view('footer');
  }
}
