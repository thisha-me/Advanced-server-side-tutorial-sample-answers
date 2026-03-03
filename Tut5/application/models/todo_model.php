<?php
class Todo_model extends CI_Model
{

  private $table = 'to-do-actions';

  public function add_action($data)
  {
    return $this->db->insert($this->table, $data);
  }

  public function get_actions($user_id)
  {
    $this->db->where('user_id', $user_id);
    $query = $this->db->get($this->table);
    return $query->result();
  }
}
