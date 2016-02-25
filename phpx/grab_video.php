<?
include("../backend/db.php");
$data = grab_url('http://www.indosiar.com/videofiesta/master');
if (strlen($data) > 500) file_put_contents(ROOTBASEPATH.'inc/index_master_videofiesta.php', $data);
?>