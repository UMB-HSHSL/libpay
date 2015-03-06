<?php

/**
 * Simple controller parent class requires all requests to come in via SSL.
 *
 */
class Authenticated_Controller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (! $this->is_authenticated()) {
            redirect("login");
        }
    }

    private function is_authenticated()
    {
        return ($this->session->userdata('is_authenticated')) ? true : false;
    }
}
