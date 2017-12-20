<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model {
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function create_user($username, $email, $password) {
    $data = array(
      'username'     => $username,
      'email'        => $email,
      'password'     => $this->hash_password($password),
    );

    return $this->db->insert('users', $data);
  }

  public function resolve_user_login($username, $password) {
    $this->db->select('password');
    $this->db->from('users');
    $this->db->where('username', $username);
    $hash = $this->db->get()->row('password');

    return $this->verify_password_hash($password, $hash);
  }

  public function get_user_id_from_username($username) {
    $this->db->select('user_id');
    $this->db->from('users');
    $this->db->where('username', $username);

    return $this->db->get()->row('user_id');
  }

  public function get_user($user_id) {
    $this->db->from('users');
    $this->db->where('user_id', $user_id);

    return $this->db->get()->row();
  }

  private function hash_password($password) {
    return password_hash($password, PASSWORD_BCRYPT);
  }

  private function verify_password_hash($password, $hash) {
    return password_verify($password, $hash);
  }
}
?>
