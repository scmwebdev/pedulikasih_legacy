<?
echo 'START = '.date("Y-m-d H:i:s").'<br />';
include("../blakang/db.php");
$data = grab_url('http://www.indosiar.com/master/news');
if (strlen($data) > 500) {
	file_put_contents(ROOTBASEPATH.'inc/index_v09_news.php', $data);
	echo $data;
} else
	echo '<p>Unsufficient data length</p>';
echo 'END = '.date("Y-m-d H:i:s").'<br />';
?>
