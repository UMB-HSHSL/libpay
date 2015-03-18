<?php

require_once APPPATH . 'libraries/LibpayException.php';
require_once APPPATH . 'libraries/LibpayError.php';


require_once APPPATH . 'third_party/log4php/src/main/php/Logger.php';
require_once APPPATH . 'libraries/LoggerLayoutPatternColor.php';



/**
 * Simple controller parent class requires all requests to come in via SSL
 * and instantiates a Logger instance.
 *
 */
class MY_Controller extends CI_Controller
{
    protected $logger = null;

    public function __construct()
    {
        parent::__construct();

        // force SSL
        if (! isset($_SERVER['HTTPS']) || 'on' != $_SERVER['HTTPS']) {
            redirect("https://{$_SERVER['SERVER_NAME']}{$_SERVER['REQUEST_URI']}");
            exit();
        }

        // configure logging
        Logger::configure(FCPATH . 'config/log4php.php');
        $this->logger = Logger::getLogger(get_class($this));
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