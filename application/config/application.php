<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
$config['URL_ROOT']			= "http://www.indosiar.com/";
$config['URL_IMG']			= $config['URL_ROOT']."img/";
$config['URL_IMAGES']		= "http://static.indosiar.com/images/";
$config['URL_VIDEOS']		= "http://static.indosiar.com/video/";
$config['URL_STATIC']		= "http://static.indosiar.com/";
$config['URL_JS']			= $config['URL_ROOT']."js/";

//$config['ROOTBASEPATH']		= $_SERVER["DOCUMENT_ROOT"];
$config['ROOTBASEPATH']		= FCPATH;
$config['PATH_ROOT_IMAGES']	= $config['ROOTBASEPATH'].'static/images/';
$config['PATH_ROOT_VIDEOS']	= $config['ROOTBASEPATH'].'static/video/';

$config['URL_IMAGES_V09']	= $config['URL_IMAGES']."v09/";
$config['PATH_IMAGES_V09']	= $config['PATH_ROOT_IMAGES'].'v09/';

$config['URL_VIDEOFIESTA']	        = $config['URL_ROOT'].'videofiesta/';
$config['URL_VIDEOFIESTA_IMAGES']	= $config['URL_IMAGES'].'videofiesta/';
$config['URL_VIDEOFIESTA_IMG']		= $config['URL_IMAGES'].'videofiesta/';
$config['PATH_VIDEOFIESTA_IMAGES']	= $config['PATH_ROOT_IMAGES'].'videofiesta/';
