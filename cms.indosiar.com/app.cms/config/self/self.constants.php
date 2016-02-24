<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
define ('TITLE',    'CONTENT INDOSIAR.COM');
define ('PFOLDER',  'app.cms/');
define ('ASSETS',   'assets/');
define ('EXTJS',    ASSETS.'extjs4/');
define ('CSS',      ASSETS.'css/'.PFOLDER);
define ('JS',       ASSETS.'js/'.PFOLDER);
define ('IMAGES',   ASSETS.'images/');
define ('ICONS',    IMAGES.'icons/');

if (isset($_SERVER['HTTP_HOST'])) {
    $domain  = explode('.', $_SERVER['HTTP_HOST']);
    $host = '';
    if (isset($domain[0])) {
        switch ($domain[0]) {
            case 'devel' : $host = 'devel.'; break;
            case 'local' : $host = 'local.';
        }
        $channel = (($domain[0] == 'local') or ($domain[0] == 'devel')) ? $domain[1] : $domain[0];
    }
    defined('HOST') || define('HOST', $host);
} else {
    define('HOST', '');
}

//define ('STATIC_PATH', str_replace("cms.indosiar.com","indosiar.com",$_SERVER["DOCUMENT_ROOT"]).'/static/');
define ('STATIC_PATH', '/usr/share/nginx/www/static.indosiar.com/');
define ('STATIC_URL', 'http://'.HOST.'static.indosiar.com/');
?>
