<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');



/*
|--------------------------------------------------------------------------
| Logging Levels
|--------------------------------------------------------------------------
|
| Fatal through trace are cumulative, so trace includes everything above it.
| other levels may be enabled individually by bitwise-or'ing them,
| e.g. turn get SQL statement and error logging, do $level = LEVEL_ERROR | LEVEL_SQL.
|
| The values are expressed more obviously in binary notation, alas that is only
| available in PHP >= 5.4.
|
*/
define('LEVEL_OFF',    0); // no logging
define('LEVEL_FATAL',  1); // fatal only
define('LEVEL_ERROR',  3); // error + fatal
define('LEVEL_WARN',   7); // warn + error + fatal
define('LEVEL_INFO',  15); // info + warn + error + fatal
define('LEVEL_DEBUG', 31); // debug + info + warn + error + fatal
define('LEVEL_TRACE', 63); // trace + debug + info + warn + error + fatal

define('LEVEL_SQL',   64);   // sql only
define('LEVEL_ALL', PHP_INT_MAX);

/* End of file constants.php */
/* Location: ./application/config/constants.php */