<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
  public function index()
  {
    // Load Helpers
    $this->load->helper('panel');

    // Check to see if user already logged in and redirect to correct panel if so
    if ($this->session->userdata('access'))
    {
      redirect(panelSelector($this->session->userdata('access')));
    }

    // Load Views
    $this->load->view('header');
    $this->load->view('sidebar');
    $this->load->view('welcome_message');
    $this->load->view('footer');
  }

  public function auth()
  {
    /* This function authtincates a user and redirects them to the approiate 
    interface. The function expects the password in clear text and returns 
    a redirect depending on the user name. */

    // Load Helpers
    $this->load->helper('panel');

    // Load Libraries
    $this->load->library(array('form_validation'));

    // Get Configuration Items
    $ldapServer = $this->config->item('ldapServer');
    $ldapDCRoot = $this->config->item('ldapDCRoot');
    $managers = $this->config->item('managers');
    $admins = $this->config->item('admins');

    // Set Validation Rules
    $this->form_validation->set_rules('username', 'username', 'required');
    $this->form_validation->set_rules('password', 'password', 'required');

    if($_POST)
    {
      if($this->form_validation->run())
      {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Sanitize Username
        $username = preg_replace("/[^a-zA-Z0-9.]/", "", $username);

        // Auth the user
        $ldapConnection = ldap_connect($ldapServer);

        if($ldapConnection)
        {
          $isBound = ldap_bind($ldapConnection);
          if(!$isBound)
            return false; // Can't anonmously bind
          $filter = "uid=$username";
          $search = ldap_search($ldapConnection, $ldapDCRoot, $filter);

          if(ldap_count_entries($ldapConnection,$search) == 1)
          {
            // Make sure that one and only one user was found
            $info = ldap_get_entries($ldapConnection,$search);

            //Attempt to Rebind with the user's password
            $dn = $info[0]['dn'];
            $bind = @ldap_bind($ldapConnection,$dn,$password);
            if(!$bind || !isset($bind))
            {
              $this->session->set_flashdata('message', 'Invalid Username or Password');
              redirect(site_url('/welcome'));
            }
            else
            {
              // Set the username in a cookie
              $this->session->set_userdata('username', $username);
              // Set the user's distinguished name and save password
              $this->session->set_userdata('dn', $dn);
              $this->session->set_userdata('password', $password);
              
              if (in_array($username, $admins))
              {
                // Admin user found redirect to admin panel
                $this->session->set_userdata('access', 'admin');
              }
              elseif (in_array($username, $managers))
              {
                // Manager user found redirect to manager panel
                $this->session->set_userdata('access', 'manager');
              }
              else
              {
                // Default redirect to user panel
                $this->session->set_userdata('access', 'user');
              }
              redirect(panelSelector($this->session->userdata('access')));
            }
          }
        }
        else
          return False; // Not able to connect to LDAP Server
      }
       $this->session->set_flashdata('message', validation_errors());
       redirect(site_url('/welcome'));
    }
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect(site_url('/welcome'));
  }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
