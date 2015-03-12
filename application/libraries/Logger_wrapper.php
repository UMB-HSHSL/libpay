<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logger_wrapper
{
    private $loggers = array();

    public function __construct()
    {
        $ci =& get_instance();

        $logger_list = config_item('loggers');
        if (is_array($logger_list)) {
            foreach ($logger_list as $logger => $config) {
                $ci->load->library("loggers/{$logger}", $config, $logger);
                $this->loggers[] = $ci->$logger;
            }

        }
    }

    /**
     * Pass a log request to each available logger
     *
     * @param method $level the log-method that was called
     * @param string $str the message
     */
    private function _log($level, $str)
    {
        foreach ($this->loggers as $logger) {
            $logger->$level($str);
        }
    }


    public function all($str)  {$this->_log('all',   $str);}
    public function trace($str){$this->_log('trace', $str);}
    public function debug($str){$this->_log('debug', $str);}
    public function info($str) {$this->_log('info',  $str);}
    public function warn($str) {$this->_log('warn',  $str);}
    public function error($str){$this->_log('error', $str);}
    public function fatal($str){$this->_log('fatal', $str);}

    /**
     * Pass a log request to each available logger
     *
     * @param int $level the requeested log level in the form of a bitmask
     * @param string $str the message
     */
    public function log($level, $str) {
        foreach ($this->loggers as $logger) {
            $logger->log($level, $str);
        }
    }

}
// END Log Class

/* End of file Log.php */
/* Location: ./system/libraries/Log.php */