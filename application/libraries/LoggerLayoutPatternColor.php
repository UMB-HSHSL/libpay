<?php

class LoggerLayoutPatternColor extends LoggerLayoutPattern
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
        "yellow"     => 10, // colorblind boy can't tell the difference between 32 and 33
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

    public function format(LoggerLoggingEvent $event) {
        $level_colors = array(
            LoggerLevel::FATAL => 'magenta',
            LoggerLevel::ERROR => 'red',
            LoggerLevel::WARN  => 'yellow',
            LoggerLevel::INFO  => 'green',
            LoggerLevel::DEBUG => 'blue',
            LoggerLevel::TRACE => 'cyan',
        );

        $sbuf = parent::format($event);

        return $this->colorize(
            $sbuf, $level_colors[$event->getLevel()->toInt()]);
    }

}