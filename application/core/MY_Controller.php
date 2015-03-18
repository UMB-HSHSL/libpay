<?php

require_once APPPATH . 'libraries/LibpayException.php';
require_once APPPATH . 'libraries/LibpayError.php';


require_once APPPATH . 'third_party/log4php/src/main/php/Logger.php';
require_once APPPATH . 'libraries/LoggerLayoutPatternColor.php';



/**
 * Simple controller parent class:
 *
 * 1. requires all requests to come in via SSL
 * 2. instantiates a Logger instance.
 * 3. logs all SQL queries at TRACE level
 *
 */
class MY_Controller extends CI_Controller
{
    public $logger = null;

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
    protected function is_post()
    {
        return 'post' == strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function __destruct() {

        // Let's determine which databases are currently connected to
        foreach (get_object_vars($this) as $CI_object)
        {
            if (is_object($CI_object) && is_subclass_of(get_class($CI_object), 'CI_DB') )
            {
                foreach ($CI_object->queries as $key => $val) {
                    $val = str_replace("\n", " ", $val);
                    $val = str_replace("\t", " ", $val);
                    $time = number_format($CI_object->query_times[$key], 4);
                    $this->logger->trace("{$time} {$val}");
                }
            }
        }


    }
}

require_once 'Authenticated_Controller.php';