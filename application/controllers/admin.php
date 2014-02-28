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

    // Load Views
    $this->load->view('header');
    $this->load->view('admin_sidebar');
    $this->load->view('admin_panel');
    $this->load->view('footer');
  }

  function search()
  {
    // Load models
    $this->load->model('user_model');

    // Setup variables
    $term = $this->input->post('search');

    if(!empty($term))
      $data['results'] = $this->user_model->search_users($term);
    else
      redirect('/admin');

    // Load Views
    $this->load->view('header');
    $this->load->view('admin_sidebar');
    $this->load->view('admin_panel', $data);
    $this->load->view('footer');
  }

  function edit($username)
  {
    /*
      This function loads the data from the LDAP account and displays 
      the form to update it.
    */

    // Load Libraries
    $this->load->library(array('form_validation'));

    // Check to make sure that user is logged in
    $access = $this->session->userdata('access');

    if ($access != 'admin')
    {
      // User is not logged in so can't view the page
      $this->session->set_flashdata('message', 'Not logged in');
      redirect(site_url("/welcome"));
    }

    // Load model(s)
    $this->load->model('user_model');

    // Get initial user infomation
    $key = $this->user_model->find_user($username);
    $data = $this->user_model->get_user($key);

    // Set Validation Rules
    $this->form_validation->set_rules('phone', 'Phone', 'min_length[10]');
    $this->form_validation->set_rules('first_name', 'first name', 'required');
    $this->form_validation->set_rules('last_name', 'last name', 'required');

    // Current Address
    $this->form_validation->set_rules('cur_street', 'current street', 'required');
    $this->form_validation->set_rules('cur_city', 'current city', 'required');
    $this->form_validation->set_rules('cur_state', 'current state', 'required|exact_length[2]');
    $this->form_validation->set_rules('cur_zip', 'current zip', 'required|min_length[5]');
    // Permanent Address
    $this->form_validation->set_rules('perm_street', 'permanent street', 'required');
    $this->form_validation->set_rules('perm_city', 'permanent city', 'required');
    $this->form_validation->set_rules('perm_state', 'permanent state', 'required|exact_length[2]');
    $this->form_validation->set_rules('perm_zip', 'permanent zip', 'required|min_length[5]');

    // Make the missing state error message more friendly
    $this->form_validation->set_message('exact_length', 'State can not be "None"');

    if($this->form_validation->run()) // Form successfully validated
    {
      // Set variables
      $user = array();

      $user['username']     = $data['username'];
      $user['first_name']   = $this->input->post('first_name');
      $user['last_name']    = $this->input->post('last_name');
      $user['phone']        = preg_replace("/[^0-9]/", "", $this->input->post('phone'));

      $user['cur_street']   = $this->input->post('cur_street');
      $user['cur_city']     = $this->input->post('cur_city');
      $user['cur_state']    = $this->input->post('cur_state');
      $user['cur_zip']      = $this->input->post('cur_zip');

      $user['perm_street']  = $this->input->post('perm_street');
      $user['perm_city']    = $this->input->post('perm_city');
      $user['perm_state']   = $this->input->post('perm_state');
      $user['perm_zip']     = $this->input->post('perm_zip');

      // Process the form
      $this->process($user);
    }

    // Load Views
    $this->load->view('header');
    $this->load->view('admin_sidebar');
    $this->load->view('admin_panel', $data);
    $this->load->view('footer');
    $this->load->view('user_panel-JS');
  }
  
  function process($user)
  {
    print_r($user);
    echo "<br>";
    die("oops i die");
  }
}
