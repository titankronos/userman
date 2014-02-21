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

    // Get Configuration Items
    $managers = $this->config->item('managers');
    $admins = $this->config->item('admins');

    if($_POST)
    {
      // Sanitize Username
      $username = preg_replace("/[^a-zA-Z0-9.]/", "", $_POST['username']);

      // Auth the user
      if (TRUE) //FIXME
      {

        // Set the username in a cookie
        $this->session->set_userdata('username', $username);
        $this->session->set_userdata('password', $password);

        // Find access level of user
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
      // Can't find a valid user
      $this->session->set_flashdata('message', 'Invalid Username or Password');
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
