<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller
{
  public function index()
  {
    /*
      Simple success to let the user know that everything worked out
    */

    // Load Views
    $this->load->view('header');
    $this->load->view('sidebar');
    $this->load->view('error_view');
    $this->load->view('footer');
  }
}
