<?
echo "START: ".date("Y/m/d H:i:s")."<br />";
$iTotal = 0;
$tgl = mktime(0, 0, 0, date("m"), date("d")-1, date("Y"));
$files = glob('../system/cache/*');
if (isset($_REQUEST['all'])) {
	foreach($files as $file) {
		unlink($file);
		$iTotal++;
	}
} else {
	foreach($files as $file) {
		if (is_file($file) && filemtime($file) < $tgl) {
			unlink($file);
			$iTotal++;
		}
	}
}
echo '
FINISH: '.date("Y/m/d H:i:s").'<br />
TOTAL FILES: '.$iTotal;
?>