<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Success extends CI_Controller
{
  public function index()
  {
    /*
      Simple success to let the user know that everything worked out
    */

    // Load Views
    $this->load->view('header');
    $this->load->view('sidebar');
    $this->load->view('success_view');
    $this->load->view('footer');
  }
}
