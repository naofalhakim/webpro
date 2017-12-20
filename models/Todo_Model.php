<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo_Model extends CI_Model {
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function create_todo($user_id, $description, $due_date, $priority) {
      $data = array(
        'user_id' => $user_id,
        'description' => $description,
        'due_date' => $due_date,
        'priority' => $priority
      );

      return $this->db->insert('todos',$data);
  }

  public function get_user_todo($user_id) {
      $this->db->from('todos');
      $this->db->where('user_id',$user_id);

      return $this->db->get();
  }

  public function update_todo($todo_id) {
    $data = array(
        'status' => 1
      );
    $this->db->where('todo_id',$todo_id);
    $this->db->update('todos',$data);

    return ($this->db->affected_rows() > 0);
  }

  public function delete_todo($todo_id){
   return  $this->db->delete('todos',array('todo_id' => $todo_id));
  }
}
?>
