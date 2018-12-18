<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

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
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code



/*
|--------------------------------------------------------------------------
| Date range utilised 
|--------------------------------------------------------------------------
*/
defined('DATE_TODAY')          OR define('DATE_TODAY', gmdate("Y-m-d",time()+(8*60*60))); // today's date
defined('DATE_TODAY_FULL')     OR define('DATE_TODAY_FULL', gmdate("Y-m-d H:i:s",time()+(8*60*60))); // today's full date & time
defined('DATE_TODAY_DAY')      OR define('DATE_TODAY_DAY', gmdate("d",time()+(8*60*60))); // today's date Hour only
defined('DATE_TODAY_HR')       OR define('DATE_TODAY_HR', gmdate("H",time()+(8*60*60))); // today's date Hour only
defined('DATE_TODAY_MTH')      OR define('DATE_TODAY_MTH', gmdate("m",time()+(8*60*60))); // today's date
defined('DATE_TODAY_YR')       OR define('DATE_TODAY_YR', gmdate("Y",time()+(8*60*60))); // today's date
defined('DATE_YESTERDAY')      OR define('DATE_YESTERDAY', date("Y-m-d",mktime(0,0,0,date(substr(DATE_TODAY,5,2)),date(substr(DATE_TODAY,8,2))-1,date(substr(DATE_TODAY,0,4)))));
defined('DATE_WK_START')       OR define('DATE_WK_START', gmdate("N",time()+(8*60*60))); // wk start
defined('DATE_LAST_30DAYS')    OR define('DATE_LAST_30DAYS', date("Y-m-d",mktime(0,0,0,date(substr(DATE_TODAY,5,2)),date(substr(DATE_TODAY,8,2))-32,date(substr(DATE_TODAY,0,4)))));//added on 19012018
defined('DATE_START_MTH')      OR define('DATE_START_MTH', gmdate("Y-m",time()+(8*60*60))."-01"); // Start of the month
defined('DATE_END_MTH')        OR define('DATE_END_MTH', gmdate("Y-m-t",time()+(8*60*60))); // End of the month
defined('DATE_LAST_MTH') 	   OR define('DATE_LAST_MTH', date("Y-m-d",strtotime("last month"))); // Start of the month
defined('DATE_START_LAST_MTH') OR define('DATE_START_LAST_MTH', date("Y-m-d",mktime(0,0,0,date(substr(DATE_START_MTH,5,2))-1,date(substr(DATE_START_MTH,8,2)),date(substr(DATE_START_MTH,0,4))))); // Start of the month
defined('DATE_LAST_WK_START')  OR define('DATE_LAST_WK_START', gmdate("Y-m-d",strtotime("last week"))); // last week's start date
defined('DATE_LAST_WK_END')    OR define('DATE_LAST_WK_END', gmdate("Y-m-d",strtotime("last week + 6 days"))); // last week's end date
defined('DATE_THIS_WK_START')  OR define('DATE_THIS_WK_START', gmdate("Y-m-d",strtotime("this week"))); // this week's date
defined('DATE_THIS_WK_END')    OR define('DATE_THIS_WK_END', gmdate("Y-m-d",strtotime("this week + 6 days"))); // this week's end date
defined('DATE_NEXT_WK_START')  OR define('DATE_NEXT_WK_START', gmdate("Y-m-d",strtotime("next week"))); // this week's date
defined('DATE_NEXT_WK_END')    OR define('DATE_NEXT_WK_END', gmdate("Y-m-d",strtotime("next week + 6 days"))); // this week's end date
/**** Date range by default (end) ****/