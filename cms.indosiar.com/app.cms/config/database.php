<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = '192.168.7.97';
$db['default']['username'] = 'indocms';
$db['default']['password'] = 'P4stiAd@p3rub@han';
$db['default']['database'] = 'indosiar_www';
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = FALSE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

$db['sphinx']['hostname'] = '192.168.7.97';
$db['sphinx']['port']     = '9306';
$db['sphinx']['username'] = '';
$db['sphinx']['password'] = '';
$db['sphinx']['database'] = '';
$db['sphinx']['dbdriver'] = 'mysql';
$db['sphinx']['dbprefix'] = '';
$db['sphinx']['pconnect'] = TRUE;
$db['sphinx']['db_debug'] = TRUE;
$db['sphinx']['cache_on'] = FALSE;
$db['sphinx']['cachedir'] = '';
$db['sphinx']['char_set'] = 'utf8';
$db['sphinx']['dbcollat'] = 'utf8_general_ci';
$db['sphinx']['swap_pre'] = '';
$db['sphinx']['autoinit'] = TRUE;
$db['sphinx']['stricton'] = FALSE;

# set db write for thevoice_tools
$db['db_thevoiceindonesia_tools_write']['hostname'] = "192.168.7.97";
$db['db_thevoiceindonesia_tools_write']['username'] = "thevoice";
$db['db_thevoiceindonesia_tools_write']['password'] = "gr0upV0cal";
$db['db_thevoiceindonesia_tools_write']['database'] = "thevoiceindonesia_tools";
$db['db_thevoiceindonesia_tools_write']['dbdriver'] = "mysql";
$db['db_thevoiceindonesia_tools_write']['dbprefix'] = '';
$db['db_thevoiceindonesia_tools_write']['pconnect'] = FALSE;
$db['db_thevoiceindonesia_tools_write']['db_debug'] = FALSE;
$db['db_thevoiceindonesia_tools_write']['cache_on'] = FALSE;
$db['db_thevoiceindonesia_tools_write']['cachedir'] = '';
$db['db_thevoiceindonesia_tools_write']['char_set'] = 'utf8';
$db['db_thevoiceindonesia_tools_write']['dbcollat'] = 'utf8_general_ci';
$db['db_thevoiceindonesia_tools_write']['swap_pre'] = '';
$db['db_thevoiceindonesia_tools_write']['autoinit'] = FALSE;
$db['db_thevoiceindonesia_tools_write']['stricton'] = FALSE;

# set db write for thevoice_www
$db['db_thevoiceindonesia_www_write']['hostname'] = "192.168.7.97";
$db['db_thevoiceindonesia_www_write']['username'] = "thevoice";
$db['db_thevoiceindonesia_www_write']['password'] = "gr0upV0cal";
$db['db_thevoiceindonesia_www_write']['database'] = "thevoiceindonesia_www";
$db['db_thevoiceindonesia_www_write']['dbdriver'] = "mysql";
$db['db_thevoiceindonesia_www_write']['dbprefix'] = '';
$db['db_thevoiceindonesia_www_write']['pconnect'] = FALSE;
$db['db_thevoiceindonesia_www_write']['db_debug'] = FALSE;
$db['db_thevoiceindonesia_www_write']['cache_on'] = FALSE;
$db['db_thevoiceindonesia_www_write']['cachedir'] = '';
$db['db_thevoiceindonesia_www_write']['char_set'] = 'utf8';
$db['db_thevoiceindonesia_www_write']['dbcollat'] = 'utf8_general_ci';
$db['db_thevoiceindonesia_www_write']['swap_pre'] = '';
$db['db_thevoiceindonesia_www_write']['autoinit'] = FALSE;
$db['db_thevoiceindonesia_www_write']['stricton'] = FALSE;


?>
