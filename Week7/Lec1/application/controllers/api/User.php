<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class User extends RestController
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
  }

  public function index_get()
  {
    $id = $this->get('id');

    if ($id) {
      $user = $this->User_model->get_user_by_id($id);

      if ($user) {
        $this->response(['status' => true, 'data' => $user], RestController::HTTP_OK);
      } else {
        $this->response(['status' => false, 'message' => 'User not found'], RestController::HTTP_NOT_FOUND);
      }
    } else {
      $users = $this->User_model->get_users();
      $this->response(['status' => true, 'data' => $users], RestController::HTTP_OK);
    }
  }

  public function index_post()
  {
    $data = [
      'first_name'    => $this->post('first_name'),
      'last_name'     => $this->post('last_name'),
      'email'         => $this->post('email'),
      'password_hash' => password_hash($this->post('password'), PASSWORD_DEFAULT),
      'phone'         => $this->post('phone')
    ];

    if ($this->User_model->insert_user($data)) {
      $this->response(['status' => true, 'message' => 'User created'], RestController::HTTP_CREATED);
    } else {
      $this->response(['status' => false, 'message' => 'Failed to create user'], RestController::HTTP_BAD_REQUEST);
    }
  }

  public function index_put()
  {
    $id = $this->put('id');

    $data = [
      'first_name' => $this->put('first_name'),
      'last_name'  => $this->put('last_name'),
      'email'      => $this->put('email'),
      'phone'      => $this->put('phone')
    ];

    if ($this->User_model->update_user($id, $data)) {
      $this->response(['status' => true, 'message' => 'User updated'], RestController::HTTP_OK);
    } else {
      $this->response(['status' => false, 'message' => 'Update failed'], RestController::HTTP_BAD_REQUEST);
    }
  }

  public function index_delete()
  {
    $id = $this->delete('id');

    if ($this->User_model->delete_user($id)) {
      $this->response(['status' => true, 'message' => 'User deleted'], RestController::HTTP_OK);
    } else {
      $this->response(['status' => false, 'message' => 'Delete failed'], RestController::HTTP_BAD_REQUEST);
    }
  }
}
