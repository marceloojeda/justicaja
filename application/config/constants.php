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
| Analise Pedido Status Code
|--------------------------------------------------------------------------
|
| Usado para definir o status das analises das requisições de abertura
| de processo na plataforma Justiça Já.
*/
defined('ANALISEPEDIDO_NAOINICIADO') OR define('ANALISEPEDIDO_NAOINICIADO', 0);
defined('ANALISEPEDIDO_ANDAMENTO') OR define('ANALISEPEDIDO_ANDAMENTO', 1);
defined('ANALISEPEDIDO_REJEITADO') OR define('ANALISEPEDIDO_REJEITADO', 2);
defined('ANALISEPEDIDO_CANCELADO') OR define('ANALISEPEDIDO_CANCELADO', 3);
defined('ANALISEPEDIDO_CONCLUIDO') OR define('ANALISEPEDIDO_CONCLUIDO', 4);
defined('ANALISEPEDIDO_REU_INDECISO') OR define('ANALISEPEDIDO_REU_INDECISO', 5);
defined('ANALISEPEDIDO_PAP_ACEITO') OR define('ANALISEPEDIDO_PAP_ACEITO', 6);

/*
|--------------------------------------------------------------------------
| Dados SMTP
|--------------------------------------------------------------------------
|
| Usado para o envio de emails pela plataforma Justiça Já.
*/
defined('SMTP_AGENT') OR define('SMTP_AGENT', 'CodeIgniter');
defined('SMTP_PROTOCOL') OR define('SMTP_PROTOCOL', 'smtp');
defined('SMTP_HOST') OR define('SMTP_HOST', 'smtp.umbler.com');
defined('SMTP_PORT') OR define('SMTP_PORT', 587);
defined('SMTP_USER') OR define('SMTP_USER', 'sac@icantina.com.br');
defined('SMTP_PASS') OR define('SMTP_PASS', 'ojeda1979');
defined('SMTP_MAILTYPE') OR define('SMTP_MAILTYPE', 'html');
defined('SMTP_CHARSET') OR define('SMTP_CHARSET', 'iso-8859-1');
defined('SMTP_FROM') OR define('SMTP_FROM', 'sac@icantina.com.br');
defined('SMTP_FROM_NAME') OR define('SMTP_FROM_NAME', 'SAC Justica Ja');
defined('EMAIL_ADMINISTRADOR') OR define('EMAIL_ADMINISTRADOR', 'marcelo.torrilhas@gmail.com');


/*
|--------------------------------------------------------------------------
| Status Load
|--------------------------------------------------------------------------
|
| Usado para determinar o status do prazo processual
| Parado = 0, Contando = 1, Suspenso = 2
| De Parado / Contando, o prazo sempre é iniciado desde o começo
| De Suspenso / Contando, o prazo continua a contagem
*/
defined('PRAZO_PARADO') OR define('PRAZO_PARADO', 0);
defined('PRAZO_CONTANDO') OR define('PRAZO_CONTANDO', 1);
defined('PRAZO_SUSPENSO') OR define('PRAZO_SUSPENSO', 2);