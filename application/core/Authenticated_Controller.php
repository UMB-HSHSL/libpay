<?php

/**
 * Redirect all unauthenticated users to login.
 *
 */
class Authenticated_Controller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        // load requested authenticator and check if the user is already authenticated.
        $this->load->add_package_path(APPPATH.'third_party/authenticator/');
        $this->load->library(config_item('authenticator'), array(), 'authenticator');
        $this->load->remove_package_path();
        if (! $this->authenticator->is_authenticated()) {
            redirect("login");
            return;
        }

        // load requested authorizer and check if the user is already authenticated.
        $this->load->add_package_path(APPPATH.'third_party/authorizer/');
        $this->load->library(config_item('authorizer'), array(), 'authorizer');
        $this->load->remove_package_path();
        if (! $this->authorizer->is_authorized($this->authenticator->username())) {
            show_error('Sorry; you are not authorized to view this page.');
        }

        $this->template->username = $this->authenticator->name();
    }

}

// dummy exception wrapper
class Authentication_exception extends Exception
{

}