<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//base url akan langsung mencari function index ini
		// jadi ini merupakan index dari semua file di CI

		// /user/view_login itu bukan file, melainkan masuk kedalam class user(user.php) kemudian mengakses metode view_login

		//prinsipnya php adalah manggil string ke file lain, jadi seperti digabung cuman diwakilkan aja, 
		//jadi user/view_login seakan akan di akses padahal itu sama kyak seperti codenya dicopy dalam satu file
		redirect('/user/view_login');
	}
}
