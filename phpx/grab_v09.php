<?
echo 'START = '.date("Y-m-d H:i:s").'<br />';
include("../blakang/db.php");
$data = grab_url('http://www.indosiar.com/master');
//if (strlen($data) > 500)
//	file_put_contents('../inc/index_v09x.php', $data);
//else
//	echo $data;


$myFile = "../inc/index_v09.php";
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $data);
fclose($fh);

echo 'END = '.date("Y-m-d H:i:s").'<br />';
?>
