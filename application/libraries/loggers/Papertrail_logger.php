<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once __DIR__ . '/Simple_logger.php';

/**
 * Derived from Kohana Papertrail logger,
 * https://raw.githubusercontent.com/dlucian/kohana-papertrail/master/modules/papertrail/classes/papertrail/log.php
 * Log writer for Papertrailapp.com's UDP logging facility.
 *
 * Config values url and port are required.
 *
 *
 * @package Papertrail
 * @category Logging
 * @author Lucian Daniliuc <dlucian@gmail.com>
 * @copyright (c) 2010-2013 Certified Vision SRL
 * @license http://opensource.org/licenses/MIT
 */
class Papertrail_logger extends Simple_logger
{
    private $url = 'logs.papertrailapp.com';

    private $port = 0;

    public function __construct($config = array())
    {
        parent::__construct($config);

        // will be FALSE because parent requires path, which we don't need here
        $this->_enabled = TRUE;

        if (! $this->url = $config['url']) {
            $this->_enabled = FALSE;
        }

        if (! $this->port = $config['port']) {
            $this->_enabled = FALSE;
        }
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


    protected function write_log($msg, $level)
    {
        if ($this->_enabled === FALSE)
        {
            return FALSE;
        }

        $app_name = defined('APPLICATION') ? APPLICATION : 'CIApplication';
        $component = empty($_SERVER['SERVER_ADDR']) ? 'cli' : 'web';

        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        $syslog_message = "<" . LOG_ERR . ">" . date('M d H:i:s ') . "{$app_name}/" . ENVIRONMENT . " $component: " . $msg;
        socket_sendto($sock, $syslog_message, strlen($syslog_message), 0, $this->url, $this->port);
        socket_close($sock);

        return TRUE;
    }


}