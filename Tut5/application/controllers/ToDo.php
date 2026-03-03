<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ToDo extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->database();
    $this->load->library('session');
    $this->load->helper(array('form', 'url'));
    $this->load->model('Todo_model'); // IMPORTANT
  }

  public function index()
  {
    // Generate unique user id ONLY if not exists
    if (!$this->session->userdata('user_id')) {

      $unique_id = uniqid();
      $this->session->set_userdata('user_id', $unique_id);

      log_message('debug', 'New User ID generated: ' . $unique_id);
    }

    $user_id = $this->session->userdata('user_id');

    // Insert new task
    if ($this->input->post('action_title')) {

      $data = array(
        'user_id' => $user_id,
        'action_title' => $this->input->post('action_title')
      );

      $this->Todo_model->add_action($data);
    }

    // Retrieve existing tasks
    $data['actions'] = $this->Todo_model->get_actions($user_id);

    $this->load->view('todo_view', $data);
  }
}
