<?php
class Streaming extends CI_Controller {
       public function __construct()
       {
            parent::__construct();
            redirect('http://tv.liputan6.com/watch/indosiar');
       }

	function index()
	{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title>INDOSIAR Live Streaming</title>
<meta name="description" content="Indosiar TV live streaming on the web" />
<meta name="keywords" content="live streaming" />
</head>
<frameset rows="*" frameborder="0" frameborder="no" framespacing="0" border="0">
	<frame src="http://video.liputan6.com/streaming/indosiar" marginwidth="0" marginheight="0" scrolling="auto">
</frameset>
</html>
<?php
		//$this->load->view('streaming');
		//redirect();
	}
}
?>
