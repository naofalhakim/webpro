<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->library(array('session'));
    $this->load->helper(array('url'));
    $this->load->model('todo_model');
  }

  public function index() {

  }

  public function save_todo() {
      $this->load->helper('form');

      $description = $this->input->post('description');
      $priority = $this->input->post('priority');
      $due_date = $this->input->post('due_date');

      $user_id = $_SESSION['user_id'];

      if($this->todo_model->create_todo($user_id,$description,$due_date,$priority)){
          echo '<script type="text/javascript">'; 
          echo 'alert("Todo Created")'; 
          echo 'window.location.href= "'.base_url().'"';
          echo '</script>'; 
      }else{
          echo '<script type="text/javascript">'; 
          echo 'alert("Creating Todo Failed")'; 
          echo 'window.location.href= "'.base_url().'"';
          echo '</script>'; 
      }
  }

  public function getTodo($todo_id) {
      
  }

  public function deleteTodo(){
    $todo_id = $this->input->get('todo_id', TRUE);
    if($this->todo_model->delete_todo($todo_id)){
          echo "<script type='text/javascript'>
          alert('Todo Deleted');
           window.location.href= '".base_url()."';
           </script>";
    }else{
       echo "failed";
          echo '<script type="text/javascript">'; 
          echo 'alert("Deleting Todo Failed, Something happened");'; 
          echo 'window.location.href= "'.base_url().'";';
          echo '</script>'; 
    }
  }

  public function updateDone(){
      $todo_id = $this->input->get('todo_id',TRUE);
      if($this->todo_model->update_todo($todo_id)){
           echo "<script type='text/javascript'>
          alert('Todo Updated');
           window.location.href= '".base_url()."';
           </script>";
      }else{
          echo '<script type="text/javascript">'; 
          echo 'alert("Deleting Todo Failed, Something happened");'; 
          echo 'window.location.href= "'.base_url().'";';
          echo '</script>'; 
      }
  }
}
?>

