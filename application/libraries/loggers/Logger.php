<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface Logger
{
    const LEVEL_OFF = 0;
    const LEVEL_FATAL = 0b00000001;
    const LEVEL_ERROR = 0b00000011;
    const LEVEL_WARN  = 0b00000111;
    const LEVEL_INFO  = 0b00001111;
    const LEVEL_DEBUG = 0b00011111;
    const LEVEL_TRACE = 0b00111111;

    const LEVEL_SQL   = 0b01000000;
    const LEVEL_ALL   = PHP_INT_MAX;

    const MASK_FATAL = 0b00000001;
    const MASK_ERROR = 0b00000010;
    const MASK_WARN  = 0b00000100;
    const MASK_INFO  = 0b00001000;
    const MASK_DEBUG = 0b00010000;
    const MASK_TRACE = 0b00100000;
    const MASK_SQL   = 0b01000000;
    const MASK_ALL   = 0b10000000;


    public function all($str);
    public function trace($str);
    public function debug($str);
    public function info($str);
    public function warn($str);
    public function error($str);
    public function fatal($str);
}
// END Log Class

/* End of file Log.php */
/* Location: ./system/libraries/Log.php */