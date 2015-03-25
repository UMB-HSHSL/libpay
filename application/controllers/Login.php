<?php
defined('BASEPATH') or exit('No direct script access allowed');


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
        // load requested authenticator and check if the user is already authenticated.
        $this->load->add_package_path(APPPATH.'third_party/authenticator/');
        $this->load->library(config_item('authenticator'), array(), 'authenticator');
        $this->load->remove_package_path();

        try {
            $this->authenticator->authenticate($this->input->post('username'), $this->input->post('password'));
            redirect("admin");
        } catch (Authentication_exception $e) {
            flash_message('error', "Authentication error: " . $e->getMessage());
            redirect('login');
        }
    }
}
