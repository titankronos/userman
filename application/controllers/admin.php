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

    $data['results'] = $this->user_model->search_users($term);

    // Load Views
    $this->load->view('header');
    $this->load->view('admin_sidebar');
    $this->load->view('admin_panel', $data);
    $this->load->view('footer');
  }
}
