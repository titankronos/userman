<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
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

    // Load models
    $this->load->model('user_model');

    // Get initial user infomation
    $key = $this->session->userdata('key');

    $data = $this->user_model->get_user($key);

    // Load Views
    $this->load->view('header');
    $this->load->view('sidebar');
    $this->load->view('user_panel_index', $data);
    $this->load->view('footer');
    $this->load->view('user_panel-JS');

  }

  public function process()
  {
    /*
      This function takes the form data makes the changes in LDAP (TODO) and 
      emails the change.of.address@rocky.edu folks to let them know there has
      been a change.
    */

    // Load Libraries
    $this->load->library(array('form_validation','email'));

    // Load models
    //$this->load->model('ldap_model');

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

    if($_POST)
    {
      if($this->form_validation->run()) // Form successfully validated
      {
        // Load Configuration Items
        $email = $this->config->item('email');
        
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $phone = preg_replace("/[^0-9]/", "", $this->input->post('phone'));

        $cur_street = $this->input->post('cur_street');
        $cur_city = $this->input->post('cur_city');
        $cur_state = $this->input->post('cur_state');
        $cur_zip = $this->input->post('cur_zip');

        $perm_street = $this->input->post('perm_street');
        $perm_city = $this->input->post('perm_city');
        $perm_state = $this->input->post('perm_state');
        $perm_zip = $this->input->post('perm_zip');

        // Compose message to send.
        $message = "Please update the address for the following user\n\n";
        $message .= "Phone Number: $phone\n\n";
        $message .= "Current Address\n";
        $message .= "\t $first_name $last_name \n";
        $message .= "\t $cur_street \n";
        $message .= "\t $cur_city, $cur_state $cur_zip\n";
        $message .= "\n \n";
        $message .= "Permanent Address\n";
        $message .= "\t $first_name $last_name\n";
        $message .= "\t $perm_street\n";
        $message .= "\t $perm_city, $perm_state $perm_zip\n";

        // Send the email to alert of the change
        $this->email->from('support@rocky.edu', 'RMC Support');
        $this->email->to($email);

        $this->email->subject("[Address Change] Change of Address for $first_name $last_name");
        $this->email->message($message);

        // Make sure that it is a valid session
        $access = $this->session->userdata('access');

        if (($access == 'user') || ($access == 'admin') || ($access == 'manager'))
        {
          // Change the ldap infomation
          $data['mobile'] = $phone;

          $data['street'] = $cur_street;
          $data['postaladdress'] = $cur_city;
          $data['st'] = $cur_state;
          $data['postalcode'] = $cur_zip;
          
          if ($this->user_model->set_user($dn, $password, $data))
          {
            // Send the email
            //$this->email->send();
            redirect(site_url('/success'));
          }
        }

        $this->session->set_flashdata('message', 'There was an error submitting data, no changes made (Err# 01)');
        redirect(site_url("/error"));
      }
      // Form validation not successful
    }

    // Load Views
    $this->load->view('header');
    $this->load->view('sidebar');
    $this->load->view('user_panel');
    $this->load->view('footer');
    $this->load->view('user_panel-JS');
  }
}
