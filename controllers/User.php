<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->library(array('session'));
    $this->load->helper(array('url'));

    //ini buat load model, atau ambil data dari query
    $this->load->model('user_model');
    $this->load->model('todo_model');
  }

  public function index() {
    if (isset($_SESSION['user_id'])) {
      redirect('/user/view_home');
    } else {
      redirect('/user/view_login');
    }
  }

  public function view_register() {
    if (isset($_SESSION['user_id'])) {
      redirect('/user/view_home'); //cara akses controller pasti makek redirect
    } else {
      $this->load->view('user/register/register'); // nah kalo load baru makek load->view('namafolder/namafolder/namafile')
    }
  }

  public function view_login() {
    if (isset($_SESSION['user_id'])) {
      redirect('/user/view_home');
    } else {
      $this->load->view('user/login/login');
    }
  }

  public function view_home() {
    if (isset($_SESSION['user_id'])) {

      $todos = new stdClass(); //class standart yang bisa di define sendiri, buat nampung object ???
      $todos->data = $this->todo_model->get_user_todo($_SESSION['user_id'])->result();
      $this->load->view('user/header');
      $this->load->view('user/sidebar');
      $this->load->view('user/home/home',$todos);
      $this->load->view('user/footer');

    } else {
      redirect('/user/view_login');
    }
  }

  public function register_user() {
    $this->load->helper('form');

    $username = $this->input->post('username');
    $email    = $this->input->post('email');
    $password = $this->input->post('password');

    if ($this->user_model->create_user($username, $email, $password)) {
      $user_id = $this->user_model->get_user_id_from_username($username);

      $data = array(
        'user_id' => $user_id,
        'username' => $username,
        'email' => $email,
      );

      $this->set_user_session($data);

      redirect('/user/view_login');
    }
  }

  public function login_user() {
    $this->load->helper('form');

    $username = $this->input->post('username');
    $password = $this->input->post('password');

    if ($this->user_model->resolve_user_login($username, $password)) {

      $user_id = $this->user_model->get_user_id_from_username($username);
      $user    = $this->user_model->get_user($user_id);

      $data = array(
        'user_id' => $user_id,
        'username' => $user->username,
        'email' => $user->email,
      );

      $this->set_user_session($data);

      redirect('/user/view_home');
    } else {
      echo "<script type='text/javascript'>
      alert('Username atau password salah');
      window.location.href = '" . base_url() . "';
      </script>";
    }
  }

  public function logout_user() {
    if (isset($_SESSION['user_id'])) {
      foreach ($_SESSION as $key => $value) {
        unset($_SESSION[$key]);
      }

      redirect('/user/view_login');
    } else {

      redirect('/user/view_login');
    }
  }

  private function set_user_session($data) {
    // set session user datas
    $_SESSION['user_id']      = (int)$data['user_id'];
    $_SESSION['username']     = (string)$data['username'];
    $_SESSION['email']        = (string)$data['email'];
  }
}
?>
