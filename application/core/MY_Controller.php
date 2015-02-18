<?php

/**
 * Simple controller parent class requires all requests to come in via SSL. 
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
