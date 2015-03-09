<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/Stripe.php';

class Login extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
    }

    public function index()
    {
        $this->load->library('form_validation');
        if ($this->is_post()) {
            $this->authenticate();
            return;
        }

        $this->template->title = 'Sign In';
        $this->template->content->view('login/index');
        $this->template->publish();
    }


    private function authenticate()
    {
        $this->load->library('authenticators/' . config_item('authenticator'), array(), 'authenticator');

        try {
            $this->authenticator->authenticate($this->input->post('username'), $this->input->post('password'));
            redirect("admin");
        } catch (Authentication_exception $e) {
            flash_message('error', "Authentication error: " . $e->getMessage());
            redirect('login');
        }
    }
}
