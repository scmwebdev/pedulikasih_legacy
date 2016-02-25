<?php
define('DB_USERNAME_PK', 'myidc');
define('DB_PASSWORD_PK', 'conn3cT4dmiN');
define('DB_NAME_PK', 'pedulikasih');
define('DB_HOST_PK', '127.0.0.1');

function dbconnectpk() {
	global $koneksidb;

	$koneksidb = mysql_connect (DB_HOST_PK, DB_USERNAME_PK, DB_PASSWORD_PK);
	if (!$koneksidb) die('Could not connect: ' . mysql_error());
	mysql_select_db(DB_NAME_PK) or die ('Can not use '.DB_NAME_PK.' : ' . mysql_error());
}

function dbclosepk() {
	global $koneksidb;
	
	mysql_close($koneksidb);
}
function replaceFunnyChar( $input ){

$translation = array(
    '’' => "'",
    "�\"" => '-',
    'é' => '�',
    'è' => '�',
    '“' => '"',
    '�' => '"',
    '‘' => "'",
    'â' => '�',
    '�"' => '�',
    '�"' => '�',
    'ī' => 'i',
    '阴' => '?',
    '陰' => '?',
    "阳" => "?",
    "陽" => "?",
    '´' => "'",
    'ü' => '�',
    "�,�'" => "'",
    '•' => '�'
);


foreach( $translation as $find => $replace ){
    $output = str_replace($find, $replace, $input );    
    //$output = preg_replace("/" . $find . "/", $replace, $input );
}
return $output;
}

?>