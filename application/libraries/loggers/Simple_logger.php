<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once __DIR__ . '/Logger.php';
/**
 * Logger writes messages to a file.
 *
 */
class Simple_logger implements Logger {

    protected $_path;
    protected $_threshold = LOGGER::LEVEL_OFF; // default: nothing
    protected $_date_fmt  = DATE_ISO8601;
    protected $_enabled   = TRUE;


    public function __construct($config = array())
    {
        $this->_path = (isset($config['path']) && $config['path'] != '') ? $config['path'] : APPPATH.'logs/';
        if ( ! is_dir($this->_path) OR ! is_really_writable($this->_path))
        {
            $this->_enabled = FALSE;
        }

        if (is_numeric($config['threshold']))
        {
            $this->_threshold = $config['threshold'];
        }

        if (isset($config['date_format']) && $config['date_format'] != '')
        {
            $this->_date_fmt = $config['date_format'];
        }
    }

    public function threshold($t = NULL)
    {
        if (! is_null($t) && is_int($t)) {
            $this->_threshold = $t;
        }

        return $this->_threshold;
    }


    public function all($str)  {$this->log(Logger::MASK_ALL,   $str);}
    public function trace($str){$this->log(Logger::MASK_TRACE, $str);}
    public function debug($str){$this->log(Logger::MASK_DEBUG, $str);}
    public function info($str) {$this->log(Logger::MASK_INFO,  $str);}
    public function warn($str) {$this->log(Logger::MASK_WARN,  $str);}
    public function error($str){$this->log(Logger::MASK_ERROR, $str);}
    public function fatal($str){$this->log(Logger::MASK_FATAL, $str);}

    public function custom($level, $str){$this->log($level, $str);}

    private $label = array(
        Logger::MASK_FATAL => 'FATAL',
        Logger::MASK_ERROR => 'ERROR',
        Logger::MASK_WARN  => 'WARN ',
        Logger::MASK_INFO  => 'INFO ',
        Logger::MASK_DEBUG => 'DEBUG',
        Logger::MASK_TRACE => 'TRACE',
        Logger::MASK_SQL   => 'SQL  ',
        Logger::MASK_ALL   => 'ALL  ',
    );

    protected function label($level) {
        $label = '     ';
        if (isset($this->label[$level])) {
            $label = $this->label[$level];
        }

        return $label;
    }


    public function log($level, $str)
    {
        if ($level & $this->_threshold) {
            return $this->write_log($str, $this->label($level));
        }

        return FALSE;
    }

    protected function write_log($msg, $level)
    {
        if ($this->_enabled === FALSE)
        {
            return FALSE;
        }

        $level = strtoupper($level);

        $filepath = $this->_path . '/' . ENVIRONMENT . '.log';
        $message  = '';

        if ( ! file_exists($filepath))
        {
            $message .= "<"."?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?".">\n\n";
        }

        if ( ! $fp = @fopen($filepath, FOPEN_WRITE_CREATE))
        {
            return FALSE;
        }

        $message .= $level.' '.date($this->_date_fmt). ' '.$msg."\n";

        flock($fp, LOCK_EX);
        fwrite($fp, $message);
        flock($fp, LOCK_UN);
        fclose($fp);

        @chmod($filepath, FILE_WRITE_MODE);

        return TRUE;
    }




}
// END Log Class

/* End of file Log.php */
/* Location: ./system/libraries/Log.php */