<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (preg_match('/thevoiceindonesia.co.id/', $_SERVER['HTTP_HOST'])) {
    $route['default_controller'] = "thevoiceindonesia/index";
    $route['register'] = "thevoiceindonesia/register";
    $route['prologue'] = "thevoiceindonesia/prologue";

} elseif (preg_match('/newafi.com/', $_SERVER['HTTP_HOST'])) {
    $route['default_controller'] = "afi2013/index";

} else {
    $route['default_controller'] = "home";

    $route['scaffolding_trigger'] = "";
    $route['404_override'] = 'pagenotfound';

    /* ---------- ARTICLE ROUTING ---------- */
    $route['gossip'] = "article";
    $route['gossip/:any'] = "article";

    $route['gossips'] = "article";
    $route['gossips/:any'] = "article";

    $route['indonesia-hari-ini'] = "article";
    $route['indonesia-hari-ini/:any'] = "article";

    $route['info-niaga'] = "article";
    $route['info-niaga/:any'] = "article";

    $route['patroli'] = "article";
    $route['patroli/:any'] = "article";

    $route['fokus'] = "article";
    $route['fokus/:any'] = "article";

    $route['sinopsis'] = "article";
    $route['sinopsis/:any'] = "article";

    $route['ragam'] = "article";
    $route['ragam/:any'] = "article";

    $route['kolom'] = "article";
    $route['kolom/:any'] = "article";

    $route['talk-show'] = "article";
    $route['talk-show/:any'] = "article";

    $route['video-ramadhan'] = "article";
    $route['video-ramadhan/:any'] = "article";

    $route['budaya'] = "article";
    $route['budaya/:any'] = "article";

    $route['safari-resep'] = "article";
    $route['safari-resep/:any'] = "article";

    $route['mamamia2010'] = "article";
    $route['mamamia2010/:any'] = "article";

    $route['berita-terkini'] = "article";
    $route['berita-terkini/:any'] = "article";

    $route['menu-kuliner'] = "article";
    $route['menu-kuliner/:any'] = "article";

    $route['kilas-mancanegara'] = "article";
    $route['kilas-mancanegara/:any'] = "article";
    
    $route['infotainment'] = "article";
    $route['infotainment/:any'] = "article";
    
    $route['feature'] = "article";
    $route['feature/:any'] = "article";

    $route['variety-show'] = "article";
    $route['variety-show/:any'] = "article";

    /*$route['menu-kuliner'] = "menukuliner";
    $route['menu-kuliner/:any'] = "menukuliner";*/

    /* ---------- EO ARTICLE ROUTING ---------- */

    /* ---------- SITEMAP ROUTING ---------- */
    $route['sitemap.xml'] = 'sitemapxml';
    $route['sitemap-fokus.xml'] = 'sitemapxml';
    $route['sitemap-patroli.xml'] = 'sitemapxml';
    $route['sitemap-ragam.xml'] = 'sitemapxml';
    $route['sitemap-budaya.xml'] = 'sitemapxml';
    $route['sitemap-berita-terkini.xml'] = 'sitemapxml';
    $route['sitemap-sinopsis.xml'] = 'sitemapxml';
    $route['sitemap-gossip.xml'] = 'sitemapxml';
    $route['sitemap-safari-resep.xml'] = 'sitemapxml';
    $route['sitemap-talk-show.xml'] = 'sitemapxml';
    $route['sitemap-kolom.xml'] = 'sitemapxml';
    $route['sitemap-videofiesta.xml'] = 'sitemapxml';
    /* ---------- EO SITEMAP ROUTING ---------- */

    $route['info-untuk-anda'] = "programme";
    $route['info-untuk-anda/:any'] = "programme";

    $route['jadwal-acara'] = "jadwalacara";
    $route['jadwal-acara/:any'] = "jadwalacara";

    $route['berita-foto'] = "beritaphoto";
    $route['berita-foto/:any'] = "beritaphoto";



    $route['search'] = "search";
    $route['search/:any'] = "search";
    $route['komentarlist/:any'] = "komentarlist";

    $route['tags'] = "tags";
    $route['tags/:any'] = "tags";

    $route['tag'] = "tags";
    $route['tag/:any'] = "tags";

    $route['program-change'] = "programchange";

    $route['investorx'] = "investor";
    $route['investorx/:any'] = "investor";

    $route['investoradmin'] = "investoradmin";
    $route['investoradmin/:any'] = "investoradmin";

    $route['syarat-audisi-mamamia'] = "syarataudisimamamia";

    $route['hasil-audisi-mamamia-2010'] = "hasilaudisimamamia";
    $route['hasil-audisi-mamamia-2010-tahap-2'] = "hasilaudisimamamiatahap2";

    $route['promo'] = "promo";
    $route['promo/:any'] = "promo";

    $route['peduli-kasih'] = "pedulikasih";
    $route['peduli-kasih/:any'] = "pedulikasih";

    $route['pedulikasih'] = "pedulikasih";
    //$route['pedulikasih/:any'] = "pedulikasih";

    $route['kitapeduli'] = "kitapeduli";
    //$route['kitapeduli/:any'] = "kitapeduli";

    $route['pedulikomunitas'] = "pedulikomunitas";

    $route['sepedaria'] = "sepedaria";
    $route['sepedaria/:any'] = "sepedaria";

    //$route['videofiesta'] = "videofiesta";
    //$route['videofiesta/:any'] = "videofiesta";

    $route['lpi'] = "lpi";
    $route['lpi/:any'] = "lpi";

    $route['galaxysuperstar']   = "galaxysuperstar/index";
    $route['takemeout']         = "takemeout/index";
    $route['aksi']              = "aksi/index";
    $route['aksi2014']          = "aksi2014/index";
    $route['afi2013']           = "afi2013/index";
	$route['puteri-muslimah2014'] = "puterimuslimah2014/index";
}
