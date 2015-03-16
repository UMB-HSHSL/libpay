<?php

require_once APPPATH . 'libraries/LibpayException.php';
require_once APPPATH . 'libraries/LibpayError.php';



/**
 * Simple controller parent class requires all requests to come in via SSL
 * and instantiates a Logger instance.
 *
 */
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // force SSL
        if (! isset($_SERVER['HTTPS']) || 'on' != $_SERVER['HTTPS']) {
            redirect("https://{$_SERVER['SERVER_NAME']}{$_SERVER['REQUEST_URI']}");
            exit();
        }

        // load logger
        $this->load->add_package_path(APPPATH.'third_party/logger/');
        $this->load->library('logger_wrapper', array(), 'logger');
        $this->load->remove_package_path();
    }

    /**
     * Return boolean TRUE if this is a post request; boolean FALSE otherwise.
     * @return boolean
     */
    public function is_post()
    {
        return 'post' == strtolower($_SERVER['REQUEST_METHOD']);
    }
}

require_once 'Authenticated_Controller.php';