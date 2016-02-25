
<?php 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Pragma: no-cache"); 


ini_set( "max_execution_time", "3600" ); // sets the maximum execution time of this script to 1 hour. 
$fileNamex = $_FILES['FILE_FIELD']['name']; // get client side file name 
$video = $_REQUEST['video'];
$allowed_filetypes = array('.jpg','.gif','.bmp','.png','.3gp','.avi','.mp3','.wav','.mpg','.mpeg','.mov','.mp4','.flv'); 
$thum_filetypes = array('.jpg','.gif','.bmp','.png','.mp3','.wav'); 

$ext=strtolower(strstr(basename($fileNamex), '.')); 
if( $fileNamex ) { 
	if(in_array($ext,$allowed_filetypes)){
		$fileSize = $_FILES['FILE_FIELD']['size']; 
		// size of uploaded file 
		if( $fileSize == 0 ) { 
			echo  "Sorry. The upload of $fileName has failed. The file size is 0.";
			die( "Sorry. The upload of $fileName has failed. The file size is 0." ); 		
		} elseif ($fileSize>10485760) {
			echo  "Sorry. The upload of $fileName has failed. The file size is more than 10 MB.";
			die( "Sorry. The upload of $fileName has failed. The file size is more than 10 MB." ); 		
		}			
		else { 
				$uploadDir = '/homepage/idc/video/tmp/'; 
				$uploadFile = str_replace( " ", "", $uploadDir . $_FILES['FILE_FIELD']['name'] ); 			
				
				$finalDir = '/homepage/idc/video/videofromyou/'; // Where the final file will go 
				move_uploaded_file( $_FILES['FILE_FIELD']['tmp_name'], $uploadFile ); 
	
				chmod( $uploadFile, 0755 );
				$filename=strrev(strstr(strrev(basename($uploadFile)),"."));
				$fileflv=$finalDir.strrev(strstr(strrev(basename($uploadFile)),"."));
				$filedl=strrev(strstr(strrev(basename($uploadFile)),"."));
	
				exec("ffmpeg -y -i ".$uploadFile." -sameq -acodec libmp3lame -ar 22050 -ab 32 -f ".$video." -s 320x240 ".$fileflv.$video);	
				if (file_exists($fileflv.$video)) {
					exec("flvtool2 -U ".$fileflv.$video);
					//echo "ffmpeg -y -i ".$uploadFile." -sameq -acodec libmp3lame -ar 22050 -ab 32 -f ".$video." -s 320x240 ".$fileflv.$video;
					//@unlink($fileflv."flv");		
					echo "your file link is <a href=\"http://www.indosiar.com/video/videofromyou/".$filedl.$video."\">http://www.indosiar.com/video/videofromyou/".$filedl.$video."</a><br>This link will be erase in 2 days, please save the link soon<br>";				
					$movie = new ffmpeg_movie($fileflv.$video);
					echo "durasi: ".date("m:s",mktime(0,0,floor($movie->getDuration()),0,0,0));					
				}	
				else {
					echo "Sorry, some codecs from the file may be unavailable now, please check it later again";
				}	
					
		} 
	}	
	else {
		echo "file unsupported";
	}			
} else {
	echo "Upload failed";
}
?> 
