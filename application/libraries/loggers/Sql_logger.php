<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__ . '/Color_logger.php';

/**
 * Log queries when the request finishes.
 *
 */
class Sql_logger extends Color_logger
{
    public function log($level, $str)
    {
        parent::log($level, $this->colorize($str, 'blue'));
    }

    // largely poached from system/libraries/Profiler.php
    public function __destruct()
    {
        $ci =& get_instance();

        $dbs = array();

        // Let's determine which databases are currently connected to
        foreach (get_object_vars($ci) as $CI_object)
        {
            if (is_object($CI_object) && is_subclass_of(get_class($CI_object), 'CI_DB') )
            {
                $dbs[] = $CI_object;
            }
        }

        foreach ($dbs as $db)
        {
            foreach ($db->queries as $key => $val) {
                $val = str_replace("\n", " ", $val);
                $val = str_replace("\t", " ", $val);

                $time = number_format($db->query_times[$key], 4);
                $this->log(LEVEL_SQL, "{$time} {$val}");
            }
        }
    }

}
