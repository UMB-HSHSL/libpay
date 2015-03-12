<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__ . '/Simple_logger.php';

/**
 * Colorize log output
 */
class Color_logger extends Simple_logger
{
    protected static $ANSI_CODES = array(
        "off"        => 0,
        "bold"       => 1,
        "italic"     => 3,
        "underline"  => 4,
        "blink"      => 5,
        "inverse"    => 7,
        "hidden"     => 8,

        "black"      => 30,
        "red"        => 31,
        "green"      => 32,
        "yellow"     => 33,
        "blue"       => 34,
        "magenta"    => 35,
        "cyan"       => 36,
        "white"      => 37,

        "black_bg"   => 40,
        "red_bg"     => 41,
        "green_bg"   => 42,
        "yellow_bg"  => 43,
        "blue_bg"    => 44,
        "magenta_bg" => 45,
        "cyan_bg"    => 46,
        "white_bg"   => 47
    );

    protected function colorize($str, $color)
    {
        return "\033[" . self::$ANSI_CODES[$color] . "m{$str}\033[" . self::$ANSI_CODES["off"] . "m";
    }

    public function trace($str){$this->log(Logger::MASK_TRACE, $this->colorize($str, 'white'));}
    public function debug($str){$this->log(Logger::MASK_DEBUG, $this->colorize($str, 'cyan'));}
    public function info($str) {$this->log(Logger::MASK_INFO,  $this->colorize($str, 'green'));}
    public function warn($str) {$this->log(Logger::MASK_WARN,  $this->colorize($str, 'yellow'));}
    public function error($str){$this->log(Logger::MASK_ERROR, $this->colorize($str, 'magenta'));}
    public function fatal($str){$this->log(Logger::MASK_FATAL, $this->colorize($str, 'red'));}

}
