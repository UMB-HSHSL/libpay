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
        $this->load->library('authenticators/' . config_item('authenticator'), array(), 'authenticator');
        if (! $this->authenticator->is_authenticated()) {
            redirect("login");
        }
    }

}

// dummy exception wrapper
class Authentication_exception extends Exception
{

}