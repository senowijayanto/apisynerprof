<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

  public function __construct() {
    parent::__construct();
  }

  public function login() {
    $salt     = $this->config->item('encryption_key');
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    if ( !empty($username) && !empty($password) ) {
      $this->load->model('admins_model');

      $user = $this->admins_model->get_by( 'username', $username );
      if ( $user ) {
        if ( $user->password == sha1( $password . $salt) ) {

          // Set session
          $session = array(
            'logged_in' => true
          );

          foreach ($user as $key => $value) {
            if (!in_array($key, array('password'))) {
              $session['admin_'.$key] = $value;
            }
          }

          $this->admins_model->update(
            array(
              'last_login_at' => date('Y-m-d H:i:s'),
              // 'last_login_ip' => $this->get_client_ip_address()
            ),
            array(
              'id' => $user->id
            )
          );
          $this->session->set_userdata( $session );
          echo "<a href='logout'>Logout</a>";
        } else {
          echo "Password error!";
        }
      }
      exit();
    }

    $this->load->view('admin/login');
  }

  public function logout(){
		$this->session->sess_destroy();
		redirect( base_url( 'admin/login' ) );
	}

  private function get_client_ip_address() {
		$ip = '';
		foreach ( array(
			'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP',
			'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR',
		) as $key ) {
			if ( ! isset( $_SERVER[ $key ] ) ) {
				continue;
			}

			foreach ( explode( ',', $_SERVER[ $key ] ) as $ip ) {
				$ip = trim( $ip); // just to be safe

				if ( filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false ) {
					return $ip;
				}
			}
		}

		return $ip;
	}
}
