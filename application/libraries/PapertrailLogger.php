<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Derived from Kohana Papertrail logger,
 * https://raw.githubusercontent.com/dlucian/kohana-papertrail/master/modules/papertrail/classes/papertrail/log.php
 * Log writer for Papertrailapp.com's UDP logging facility.
 *
 * @package Papertrail
 * @category Logging
 * @author Lucian Daniliuc <dlucian@gmail.com>
 * @copyright (c) 2010-2013 Certified Vision SRL
 * @license http://opensource.org/licenses/MIT
 */
class PapertrailLogger
{

    private $url = 'logs.papertrailapp.com';

    private $port = 0;

    public function __construct()
    {
        $this->url = config_item('papertrail_url');
        $this->port = config_item('papertrail_port');
    }

    /**
     * Write an array of messages.
     * Note: no spaces in the $program or $component fields otherwise it
     * screws up the filtering by Papertrail.
     *
     * $writer->write($messages);
     *
     * @param
     *            array messages
     * @return void
     */
    public function write(array $messages)
    {
        if ($this->port) {
            foreach ($messages as $message) {
                $component = 'web';
                if (empty($_SERVER['SERVER_ADDR']))
                    $component = 'cli';
                $program = 'Libpay/' . ENVIRONMENT;
                $this->send_remote_syslog($message['type'] . ' ' . $message['body'], $component, $program);
            }
        }
    }

    private function send_remote_syslog($message, $component = "web", $program = "next_big_thing")
    {
        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        foreach (explode("\n", $message) as $line) {
            $syslog_message = "<" . LOG_ERR . ">" . date('M d H:i:s ') . $program . ' ' . $component . ': ' . $line;
            socket_sendto($sock, $syslog_message, strlen($syslog_message), 0, $this->url, $this->port);
        }
        socket_close($sock);
    }

/* PHP syslog constants:
            case LOG_EMERG:   return "EMERGENCY"; break; // system is unusable
            case LOG_ALERT:   return "ALERT";     break; // action must be taken immediately
            case LOG_CRIT:    return "CRITICAL";  break; // critical conditions
            case LOG_ERR:     return "ERROR";     break; // error conditions
            case LOG_WARNING: return "WARNING";   break; // warning conditions
            case LOG_NOTICE:  return "NOTICE";    break; // normal, but significant, condition
            case LOG_INFO:    return "INFO";      break; // informational message
            case LOG_DEBUG:   return "DEBUG";     break; // debug-level message
*/
} // END class Papertrail_Log