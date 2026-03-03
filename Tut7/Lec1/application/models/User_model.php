<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

  private $table = 'users';

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function get_users()
  {
    return $this->db->get($this->table)->result();
  }

  public function get_user_by_id($id)
  {
    return $this->db->where('id', $id)
      ->get($this->table)
      ->row();
  }

  public function insert_user($data)
  {
    return $this->db->insert($this->table, $data);
  }

  public function update_user($id, $data)
  {
    return $this->db->where('id', $id)
      ->update($this->table, $data);
  }


  public function delete_user($id)
  {
    return $this->db->where('id', $id)
      ->delete($this->table);
  }
}
