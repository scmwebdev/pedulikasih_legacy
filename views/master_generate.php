<?php
function download ($file_source, $file_target)
{
  // Preparations
  $file_source = str_replace(' ', '%20', html_entity_decode($file_source)); // fix url format
  //if (file_exists($file_target)) { chmod($file_target, 0777); } // add write permission

  // Begin transfer
  if (($rh = fopen($file_source, 'rb')) === FALSE) { return false; } // fopen() handles
  if (($wh = fopen($file_target, 'wb')) === FALSE) { fclose($rh); return false; } // error messages.

  while (!feof($rh))
  {
    // unable to write to file, possibly because the harddrive has filled up
    if (fwrite($wh, fread($rh, 1024)) === FALSE) { fclose($rh); fclose($wh); return false; }
  }

  // Finished without errors
  fclose($rh);
  fclose($wh);
  return true;
} 

if ($this->uri->segment(3) == "program")
	download('http://www.indosiar.com/program/master', ROOTBASEPATH."inc/index_master_program.php");
elseif ($this->uri->segment(3) == "news")
	download('http://www.indosiar.com/news/master', ROOTBASEPATH."inc/index_master_news.php");
else
	download('http://www.indosiar.com/master', ROOTBASEPATH."home.html");
?>