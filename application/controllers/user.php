<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
  {
    parent::__construct();
    $this->load->library(array('form_validation'));
  }

  public function index()
  {
    /*
      This function loads the data from the LDAP account and displays 
      the form to update it.
    */

    // Check to make sure that user is logged in
    $access = $this->session->userdata('access');

    if (($access != 'user') && ($access != 'admin'))
    {
      // User is not logged in so can't view the page
      $this->session->set_flashdata('message', 'Not authorized to view page');
      redirect(site_url("/welcome"));
    }

    // Load model(s)
    $this->load->model('user_model');

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

    // Get initial user infomation
    $key = $this->session->userdata('key');
    $data = $this->user_model->get_user($key);

    // Load Views
    $this->load->view('header');
    $this->load->view('sidebar');
    $this->load->view('user_panel', $data);
    $this->load->view('footer');
    $this->load->view('user_panel-JS');

  }

  public function process($user)
  {
    /*
      This function takes the form data makes the changes in LDAP (TODO) and 
      emails the change.of.address@rocky.edu folks to let them know there has
      been a change.
    */

    // Load Libraries
    $this->load->library(array('email'));

    // Load models
    $this->load->model('user_model');

    // Load Configuration Items
    $email = $this->config->item('email');

    // Compose message to send.
    $message = "Please update the address for the following user\n\n";
    $message .= "Phone Number: ".$user['phone']."\n\n";
    $message .= "Current Address\n\t";
    $message .= $user['first_name'].' '.$user['last_name']."\n\t";
    $message .= $user['cur_street']."\n\t";
    $message .= $user['cur_city'].", ".$user['cur_state']." ".$user['cur_zip'];
    $message .= "\n\n\n";
    $message .= "Permanent Address\n\t";
    $message .= $user['first_name']." ".$user['last_name']."\n\t";
    $message .= $user['perm_street']."\n\t";
    $message .= $user['perm_city'].", ".$user['perm_state']." ".$user['perm_zip'];

    // Send the email to alert of the change
    $this->email->from('support@rocky.edu', 'RMC Support');
    $this->email->to($email);

    $this->email->subject("[Address Change] Change of Address for".$user['first_name']." ".$user['last_name']);
    $this->email->message($message);

    // Make sure that it is a valid session
    $access = $this->session->userdata('access');

    if (($access == 'user') || ($access == 'admin') || ($access == 'manager'))
    {
      // Send the email
      //$this->email->send();
      //redirect(site_url('/success'));
      print_r($message);
    }
    $this->session->set_flashdata('message', 'There was an error submitting data, no changes made (Err# 01)');
    redirect(site_url("/error"));
  }
}
