<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/Stripe.php';

class Logout extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->session->sess_destroy();

        redirect('login');
    }

}
