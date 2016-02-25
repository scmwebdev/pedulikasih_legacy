<?
echo "START: ".date("Y/m/d H:i:s")."<br />";

$iUpd = $iAdd = $iTotal = 0;
$strTemp = "";

set_time_limit(0);

function grab_url($url, $ref="", $header=0) {
		$useragent 	= array (
									'Mozilla/4.0 (compatible; MSIE 5.00; Windows 98)',
									'Mozilla/4.0 (compatible; MSIE 5.5; Windows 98; Win 9x 4.90; Wanadoo 6.2)',
									'Mozilla/4.0 (compatible; MSIE 5.5; Windows NT 5.0)',
									'Mozilla/4.0 (compatible; MSIE 5.5; Windows NT 5.0; Installed by Symantec Package; Maxthon)',
									'Mozilla/4.0 (compatible; MSIE 6.0; AOL 9.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; InfoPath.1)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0; .NET CLR 1.1.4322)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0; Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1) )',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 2.0.50727)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; FunWebProducts)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; FunWebProducts; .NET CLR 1.1.4322; ZangoToolbar 4.8.3)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; FunWebProducts; InfoPath.2)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1) ; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; .NET CLR 3.0.04506.648)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SBUA)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; (R1 1.5))',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; InfoPath.2)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; MEGAUPLOAD 2.0)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; Seekmo 10.0.345.0)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; InfoPath.1)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727; .NET CLR 1.1.4322)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727; .NET CLR 1.1.4322; MAXTHON 2.0)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727; .NET CLR 3.0.04506.648; .NET CLR 3.5.21022)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; Ant.com; FDM; .NET CLR 2.0.50727)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; Avant Browser; .NET CLR 2.0.50727)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; FunWebProducts)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; FunWebProducts; .NET CLR 1.1.4322)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; FunWebProducts; .NET CLR 2.0.50727)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; FunWebProducts; MEGAUPLOAD 2.0)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; FunWebProducts; Seekmo 10.0.427.0)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; FunWebProducts; SIMBAR={C0098832-C712-41F8-AFDA-53A216B18FAC}; InfoPath.1)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; FunWebProducts; Zango 10.3.70.0)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; InfoPath.1)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; InfoPath.1; MEGAUPLOAD 2.0)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; InfoPath.2)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; InfoPath.2; .NET CLR 1.1.4322)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; InfoPath.2; .NET CLR 2.0.50727; InfoPath.1)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; InfoPath.2; MEGAUPLOAD 2.0)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; InfoPath.2; MEGAUPLOAD 2.0; SBUA)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; Maxthon)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; MEGAUPLOAD 2.0; .NET CLR 2.0.50727)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1) )',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1) ; .NET CLR 2.0.50727)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; MRSPUTNIK 2, 0, 0, 17 HW; MRA 5.0 (build 02053))',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; SIMBAR Enabled)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; SIMBAR={8A5909BE-CCE3-43D7-89DF-6F45550C29A9})',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; SIMBAR={9FBDEFD6-5E0D-11DD-B3B5-000D5613AAFF}; .NET CLR 2.0.50727; .NET CLR 1.1.4322)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; SIMBAR={AE83E378-6C4A-46E9-8C65-158174B6484B}; InfoPath.2; .NET CLR 1.1.4322)',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; User-agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; http://bsalsa.com) )',
									'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; Zango 10.3.70.0; 3P_UASE 1.0.20.0)',
									'Mozilla/4.0 (compatible; MSIE 7.0;  Windows NT 5.2)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; .NET CLR 3.0.04506.648; InfoPath.2)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; InfoPath.1; .NET CLR 3.0.04506.30)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; InfoPath.2)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; MAXTHON 2.0)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; MEGAUPLOAD 2.0)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; InfoPath.2; .NET CLR 2.0.50727)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; InfoPath.2; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; InfoPath.2; FDM; .NET CLR 2.0.50727)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 2.0.50727)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 2.0.50727; .NET CLR 1.1.4322)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; FDM)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 2.0.50727; InfoPath.1)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; FDM)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; FDM; InfoPath.1)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; FunWebProducts)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; FunWebProducts; .NET CLR 1.1.4322; Seekmo 10.0.424.0)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; FunWebProducts; Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1) ; MEGAUPLOAD 2.0; .NET CLR 2.0.50727; Zango 10.0.370.0)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; FunWebProducts; SIMBAR={41DBA468-6DFA-45A2-9981-4866FA6BE1C3}; .NET CLR 3.0.04506.30; InfoPath.2; .NET CLR 2.0.50727)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; IEMB3)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; IEMB3; IEMB3)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; InfoPath.2)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; InfoPath.2; IEMB3; IEMB3)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; InfoPath.2; SBUA)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; MAXTHON 2.0)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1) )',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1) ; .NET CLR 1.1.4322; .NET CLR 2.0.50727)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1) ; .NET CLR 1.1.4322; .NET CLR 2.0.50727; InfoPath.2)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1) ; .NET CLR 1.1.4322; IEMB3; MEGAUPLOAD 2.0; .NET CLR 2.0.50727; IEMB3)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1) ; .NET CLR 2.0.50727; .NET CLR 3.0.04506.648; .NET CLR 3.5.21022)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1) ; .NET CLR 2.0.50727; Zango 10.3.65.0)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; QQDownload 1.7)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; SIMBAR={798C05F1-7557-4FD7-9E36-8CA3A9C8A34A})',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; SU 3.011; .NET CLR 1.1.4322; .NET CLR 2.0.50727; MAXTHON 2.0)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; SU 3.011; Maxthon; .NET CLR 1.1.4322; .NET CLR 2.0.50727)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; SV1; FunWebProducts; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; InfoPath.1; IEMB3; .NET CLR 3.0.04506.648; IEMB3)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; Foxy/1; Foxy/1; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; FunWebProducts; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; Zune 2.5)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; .NET CLR 1.1.4322; InfoPath.2; FDM)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; InfoPath.2)',
									'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; InfoPath.2; Crazy Browser 2.0.1)',
									'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.4; en-US; rv:1.9.0.1) Gecko/2008070206 Firefox/3.0.1',
									'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_4_11; en) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.2 Safari/525.22',
									'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_4; en-us) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.2 Safari/525.20.1',
									'Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en-us) AppleWebKit/523.10.3 (KHTML, like Gecko) Version/3.0.4 Safari/523.10',
									'Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en-us) AppleWebKit/523.15.1 (KHTML, like Gecko) Version/3.0.4 Safari/523.15',
									'Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en-US; rv:1.8.1.14) Gecko/20080404 Firefox/2.0.0.14',
									'Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15',
									'Mozilla/5.0 (Macintosh; U; PPC Mac OS X 10.5; en-GB; rv:1.9b5) Gecko/2008032619 Firefox/3.0b5',
									'Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en-us) AppleWebKit/523.10.3 (KHTML, like Gecko) Version/3.0.4 Safari/523.10',
									'Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7',
									'Mozilla/5.0 (Windows; U; Windows NT 5.0; ru; rv:1.8.0.10) Gecko/20070216 Firefox/1.5.0.10',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.9.0.1) Gecko/2008070208 Firefox / 2.0.0.13 (de) (TL-FF)',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13 Creative ZENcast v2.00.14',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.14) Gecko/20080404 Firefox/2.0.0.14',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.9) Gecko/2008051206 Firefox/3.0',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.9) Gecko/2008052906 Firefox/3.0',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.8) Gecko/20050511 Firefox/1.0.4',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.0.12) Gecko/20070508 Firefox/1.5.0.12',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.0.7) Gecko/20060909 Firefox/1.5.0.7',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1) Gecko/20061010 Firefox/2.0',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.11) Gecko/20071127 Firefox/2.0.0.11',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.11pre) Gecko/20071206 Firefox/2.0.0.11 Navigator/9.0.0.5',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.12) Gecko/20080201 Firefox/2.0.0.12',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.12) Gecko/20080219 Firefox/2.0.0.12 Navigator/9.0.0.6',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.14) Gecko/20080404 Dealio Toolbar 3.1 Firefox/2.0.0.14',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.14) Gecko/20080404 Firefox/2.0 MEGAUPLOAD 1.0',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.14) Gecko/20080404 Firefox/2.0.0.12;MEGAUPLOAD 1.0',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.14) Gecko/20080404 Firefox/2.0.0.13',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.14) Gecko/20080404 Firefox/2.0.0.14',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.14',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.16) Gecko/20080702 Firefox/2.0.0.12;MEGAUPLOAD 1.0',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.16) Gecko/20080702 Firefox/2.0.0.16',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.16) Gecko/20080702 Firefox/2.0.0.16 ImageShackToolbar/4.4.3',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.16) Gecko/20080702 Firefox/2.0.0.7;MEGAUPLOAD 1.0',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.2) Gecko/20070219 Firefox/2.0.0.2',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.4) Gecko/20070515 Firefox/2.0.0.4',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.5) Gecko/20070713 Firefox/2.0.0.5',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.7) Gecko/20070914 Firefox/2.0.0.7',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.8) Gecko/20071008 Firefox/2.0.0.8',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.9) Gecko/20071025 Firefox/2.0.0.9',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9) Gecko/2008051206 Firefox/3.0',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9) Gecko/2008052906  Firefox',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9) Gecko/2008052906 Firefox/2.0.0.14;MEGAUPLOAD 1.0',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9) Gecko/2008052906 Firefox/3.0',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.1) Gecko/2008070208 Firefox/2.0.0.16;MEGAUPLOAD 1.0',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9a4pre) Gecko/20070406 Minefield/3.0a4pre',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9a7) Gecko/2007080210 GranParadiso/3.0a7',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9b5) Gecko/2008032620 Firefox/3.0b5',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; es-AR; rv:1.9) Gecko/2008052906 Firefox/3.0',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; es-ES; rv:1.8.0.12) Gecko/20070508 Firefox/1.5.0.12',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; es-ES; rv:1.8.1.14) Gecko/20080404 Firefox/2.0.0.14',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; id; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; it; rv:1.8.1.14) Gecko/20080404 Firefox/2.0.0.14',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; nl; rv:1.8.1.14) Gecko/20080404 Firefox/2.0.0.14',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; pl; rv:1.8.1.14) Gecko/20080404 Firefox/2.0.0.14',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; pl; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; pl; rv:1.8.1.16) Gecko/20080702 Firefox/2.0.0.16',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; ro; rv:1.8.1.14) Gecko/20080404 Firefox/2.0.0.14',
									'Mozilla/5.0 (Windows; U; Windows NT 5.1; tr; rv:1.9) Gecko/2008052906 Firefox/3.0',
									'Mozilla/5.0 (Windows; U; Windows NT 5.2; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15',
									'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-GB; rv:1.8.1.12) Gecko/20080201 Firefox/2.0.0.12',
									'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-GB; rv:1.8.1.14) Gecko/20080404 Firefox/2.0.0.14;MEGAUPLOAD 1.0',
									'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US) AppleWebKit/525.19 (KHTML, like Gecko) Version/3.1.2 Safari/525.21',
									'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7',
									'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.8.1.11) Gecko/20071127 Firefox/2.0.0.11',
									'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13',
									'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.8.1.14) Gecko/20080404 Firefox/2.0.0.14',
									'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.8.1.14) Gecko/20080404 Firefox/2.0.0.14 MooZa',
									'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.8.1.16) Gecko/20080702 Firefox/2.0.0.16',
									'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.8.1.9) Gecko/20071025 Firefox/2.0.0.9',
									'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.8.1.9; SBUA) Gecko/20071025 Firefox/2.0.0.9',
									'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9) Gecko/2008052906 Firefox/3.0',
									'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1',
									'Mozilla/5.0 (Windows; U; Windows NT 6.0; pl; rv:1.8.1.14) Gecko/20080404 Firefox/2.0.0.14',
									'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.8.1.3) Gecko/20070208 Mandriva/2.0.0.3-2mdv2007.1 (2007.1) Firefox/2.0.0.3',
									'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.8.1.4) Gecko/20070515 Firefox/2.0.0.4',
									'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9b5) Gecko/2008041514 Firefox/3.0b5',
									'Opera/9.01 (Windows NT 5.1; U; en)',
									'Opera/9.02 (Windows NT 5.1; U; en)',
									'Opera/9.10 (Windows NT 5.1; U; en)',
									'Opera/9.20 (Windows NT 5.1; U; en)',
									'Opera/9.21 (Windows NT 5.1; U; pt)',
									'Opera/9.22 (Windows NT 5.1; U; en)',
									'Opera/9.23 (Windows NT 5.1; U; en)',
									'Opera/9.25 (Windows NT 5.1; U; en)',
									'Opera/9.25 (Windows NT 6.0; U; en)',
									'Opera/9.26 (Windows NT 5.1; U; en)',
									'Opera/9.27 (Windows NT 5.0; U; en)',
									'Opera/9.27 (Windows NT 5.1; U; en)',
									'Opera/9.27 (Windows NT 6.0; U; en)',
									'Opera/9.50 (Windows NT 5.1; U; en)',
									'Opera/9.50 (Windows NT 6.0; U; en)',
									'Opera/9.51 (Windows NT 5.0; U; en)',
									'Opera/9.51 (Windows NT 5.1; U; en)',
									'Opera/9.51 (Windows NT 6.0; U; en)',
									'Opera/9.52 (Windows NT 5.1; U; en)'
									);
																	
		$ref_array		= array (
									"http://www.google.com/",
									"http://www.google.co.id/",
									"http://www.yahoo.com/",
									"http://search.msn.com/",
									"http://www.youtube.com/",
									"http://www.kaskus.us/",
									"http://www.lautanindonesia.com/",
									"http://www.bloggaul.com/",
									"http://gudanglagu.com/",
									"http://www.bluefame.com/",
									"http://www.kikil.org/",
									"http://www.kattunesia.org/",
									"http://www.multiply.com/",
									"http://www.friendster.com/",
									"http://www.tvxqindo.com/",
									"http://www.hi5.com/",
									"http://www.chip.co.id/",
									"http://indonesiafirst.com/",
									"http://www.blogger.com/",
									"http://www.blogspot.com/",
									"http://indonesiafirst.com",
									"http://www.adsense-id.com/",
									"http://www.cosaaranda.com/",
									"http://www.cosaaranda.biz/",
									"http://www.cosaaranda.net/",
									"http://www.sctv.co.id/",
									"http://www.liputan6.com/",
									"http://www.pintunet.com/",
									"http://www.alexa.com/",
									"http://layartancap.com/",
									"http://www.untuksemua.com/",
									"http://wordpress.com/",
									"http://www.forumponsel.com/",
									"http://www.id-joomla.com/",
									"http://www.photoshop21.com/",
									"http://www.honda-tiger.or.id/",
									"http://tagged.com/",
									"http://deviantart.com/",
									"http://kafegaul.com/",
									"http://livejournal.com/",
									"http://myspace.com/",
									"http://duniasex.com/",
									"http://kapanlagi.com/",
									"http://facebook.com/",
									"http://imeem.com/",
									"http://perfspot.com/",
									"http://id.dada.net/blog/",
									"http://www.blogcatalog.com/",
									"http://www.mybloglog.com/",
									"http://www.scitechbox.com/"
									);

		if ($ref == "") $ref = $ref_array[rand(0, count($ref_array)-1)];
		
	  $ch = curl_init(); 
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	  curl_setopt($ch, CURLOPT_URL, $url);
	  curl_setopt($ch, CURLOPT_REFERER, $ref);
	  curl_setopt($ch, CURLOPT_USERAGENT, $useragent[rand(0, count($useragent)-1)]);
	  //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	   
	  if ($header == 1) curl_setopt($ch, CURLOPT_HEADER, 1);
	 
		//http://www.proxyblind.org/proxy-list.shtml
	  //curl_setopt($ch, CURLOPT_PROXY, "91.113.205.242:1080");
	  //curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
	  $data = curl_exec($ch); 
	  curl_close($ch);
	 
		return $data;
}

function grab_post($url, $post, $ref="http://www.google.com/", $header=0){
	$ualist[] = "Mozilla/5.0 (compatible; Konqueror/4.0; Microsoft Windows) KHTML/4.0.80 (like Gecko)";  
	$ualist[] = "Mozilla/5.0 (compatible; Konqueror/3.92; Microsoft Windows) KHTML/3.92.0 (like Gecko)";  
	$ualist[] = "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; WOW64; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; Media Center PC 5.0; .NET CLR 1.1.4322; Windows-Media-Player/10.00.00.3990; InfoPath.2";  
	$ualist[] = "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; InfoPath.1; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; Dealio Deskball 3.0)";  
	$ualist[] = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; NeosBrowser; .NET CLR 1.1.4322; .NET CLR 2.0.50727)"; 
	$ua = $ualist[array_rand($ualist)];

	$ch = curl_init();  
	curl_setopt($ch, CURLOPT_USERAGENT, $ua);  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
	curl_setopt($ch, CURLOPT_URL, $url);	
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_REFERER, $ref);
	curl_setopt($ch, CURLOPT_HEADER, $header);
	
	$buffer = curl_exec($ch);  
	
	curl_close($ch);
	
	return $buffer;
}

//$data = grab_url("http://www.rocktainment.com/share/WA1uIZ7W/Sheila On 7 - Have Fun", "http://www.stafaband.info/gf/");
//echo $data;
//exit;

$data = grab_url("http://www.stafaband.info/download-lagu-mp3-gratis.html");
if (preg_match_all('/<b>(.*)<\/b><\/a> - <a href="\/download\/([0-9]*)\/(.*)" style=\'font-size:8pt;\'>(.*)<\/a>/U', $data, $links)) {
	for ($i=0; $i<count($links[1]); $i++) {
		if ($links[1][$i] != "" && $links[2][$i] != "" && $links[3][$i] != "") {
			get_lagu('http://www.stafaband.info/download/'.$links[2][$i].'/'.$links[3][$i], $links[1][$i], $links[4][$i]);
		}
	}
} else {
	echo "inner not found<br>";
}


function get_lagu($url, $artis, $lagu) {
	global $iUpd;
	global $iAdd;
	global $iTotal;
	global $strTemp;
	
	$data 	= grab_url($url);
	$artis 	= trim($artis);
	$lagu 	= trim($lagu);
	
	if (substr($lagu, -2) == " *") $lagu = substr($lagu, 0, strlen($lagu)-2);
	
	// Get Download Link
	$arrdownload = array();
		
	//if (preg_match('/http:\/\/www.stafaband.info\/embed-([0-9]*).html/', $data, $links)) {
	//	$tmpdownload = grab_url("http://www.stafaband.info/embed-".$links[1].".html");
	//	if (preg_match('/<param name="FlashVars" value="mediaPath=(.*)" \/>/U', $tmpdownload, $flash_link)) {
	//		$tmpdownload = grab_url("http://www.stafaband.info".$flash_link[1], "", 1);
	//		echo "http://www.stafaband.info".$flash_link[1].$tmpdownload;
	//		exit();
	//	}
	//}
	
	if (preg_match('/<form action="\/([0-9]*)\/(.*).mp3" method=/', $data, $links)) {
		$tmpdownload = grab_url("http://www.stafaband.info/".$links[1]."/".$links[2].".mp3", $url);
		if (preg_match('/<iframe src="(.*)"/', $tmpdownload, $match)) $arrdownload[] = $match[1];			
			
		$form_file = $form_fname = $form_idf = "";
		
		if (preg_match('/<input type=hidden name=file value=(.*)>/', $data, $form_links)) $form_file = $form_links[1];

		if ($form_file != "") {
			$ualist[] = "Mozilla/5.0 (compatible; Konqueror/4.0; Microsoft Windows) KHTML/4.0.80 (like Gecko)";  
			$ualist[] = "Mozilla/5.0 (compatible; Konqueror/3.92; Microsoft Windows) KHTML/3.92.0 (like Gecko)";  
			$ualist[] = "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; WOW64; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; Media Center PC 5.0; .NET CLR 1.1.4322; Windows-Media-Player/10.00.00.3990; InfoPath.2";  
			$ualist[] = "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; InfoPath.1; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; Dealio Deskball 3.0)";  
			$ualist[] = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; NeosBrowser; .NET CLR 1.1.4322; .NET CLR 2.0.50727)"; 
			$ua = $ualist[array_rand($ualist)];
			
			$url = "http://www.stafaband.info/".$links[1]."/".$links[2].".mp3";
			$post = "file=".$form_file."&submit=".urlencode('DOWNLOAD NOW');

			$postdata = grab_post($url, $post, "http://www.stafaband.info/", 1);
			if (preg_match('/location: (.*)/', $postdata, $match)) $arrdownload[] = $match[1];
		}
	}
	
	if (preg_match('/href="\/([0-9]*)\/(.*).mp3"/', $data, $links)) {
		$tmpdownload = grab_url("http://www.stafaband.info/".$links[1]."/".$links[2].".mp3", "http://www.stafaband.info/", 1);
		if (preg_match('/location: (.*)/', $tmpdownload, $match)) $arrdownload[] = $match[1];
		//echo $tmpdownload;
	}
	
	//direct download
	if (preg_match('/soundFile=http:\/\/(.*).4shared.com\/(.*)">/', $data, $links)) $arrdownload[] = "http://".$links[1].".4shared.com/".$links[2];
	if (preg_match('/<input type=hidden name=url value="(.*)">/', $data, $links)) $arrdownload[] = $links[1];
	if (preg_match('/<a href="\/direct_(.*).mp3">/', $data, $links)) {
		$tmpdownload = grab_url("http://stafaband.info/direct_".str_replace(' ','%20',$links[1]).".mp3", "", 1);
		//$tmpdownload = get_headers("http://stafaband.info/direct_".str_replace(' ','%20',$links[1]).".mp3");
		if (preg_match('/location: (.*)/', $tmpdownload, $match)) $arrdownload[] = $match[1];
	}
	if (preg_match('/soundFile=http:\/\/www.stafaband.info\/(.*)">/', $data, $links)) {
		$tmpdownload = grab_url("http://www.stafaband.info/".$links[1], "http://www.stafaband.info/", 1);
		if (preg_match('/location: (.*)/', $tmpdownload, $match)) $arrdownload[] = $match[1];
	}
	if (preg_match('/<form method=POST action=\/gf/', $data)) {
		$form_file = $form_fname = $form_idf = "";

		if (preg_match('/<input type=hidden value=\'(.*)\' name=file>/', $data, $links)) $form_file = $links[1];
		if (preg_match('/<input type=hidden name=fname value="(.*)">/', $data, $links)) $form_fname = $links[1];
		if (preg_match('/<input type=hidden name=idf value="(.*)">/', $data, $links)) $form_idf = $links[1];

		if ($form_file != "" && $form_fname != "" && $form_idf != "") {
			$ualist[] = "Mozilla/5.0 (compatible; Konqueror/4.0; Microsoft Windows) KHTML/4.0.80 (like Gecko)";  
			$ualist[] = "Mozilla/5.0 (compatible; Konqueror/3.92; Microsoft Windows) KHTML/3.92.0 (like Gecko)";  
			$ualist[] = "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; WOW64; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; Media Center PC 5.0; .NET CLR 1.1.4322; Windows-Media-Player/10.00.00.3990; InfoPath.2";  
			$ualist[] = "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; InfoPath.1; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; Dealio Deskball 3.0)";  
			$ualist[] = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; NeosBrowser; .NET CLR 1.1.4322; .NET CLR 2.0.50727)"; 
			$ua = $ualist[array_rand($ualist)];
			
			$url = "http://www.stafaband.info/gf";
			$post = "file=".$form_file."&idf=".$form_idf."&fname=".urlencode($form_fname)."&submit=".urlencode('Click Here To Download This MP3');

			$postdata = grab_post($url, $post, "http://www.stafaband.info/", 1);

			if (preg_match('/location: (.*)/', $postdata, $match)) $arrdownload[] = $match[1];
		}
	}
	
	// Get Album Name
	$album = "";
	if (preg_match('/<tr><td class=ld1>Album         <\/td><td class=ld>: (.*)<\/td><\/tr>/', $data, $match)) {
		if ($match[1] != "-" && $match[1] != "Unknown Album") $album = $match[1];
		$album = trim($album);
	}
	
	// Get Lyric
	$lirik 			= "";
	$artislagu 	= $artis.' - '.$lagu;
	$f 					= array('(', ')', '[', ']', '*', '/', '?', "'");
	$r   				= array('\(', '\)', '\[', '\]', '\*', '\/', '\?', "\\'");

	//$pattern 		= '/<font class=ldlirik>Lirik '.str_replace($f, $r, $artislagu).'<\/font><p><font color=lightgreen>(.*)<\/font><p><font style=\'font:normal 9px verdana; color: orange;\'>/s';
	$pattern 		= '/<hr size=1><font color=lightgreen size=2>(.*)<\/font><p><font style=\'font:normal 9px verdana; color: orange;\'>/s';
	if (preg_match('/<hr size=1><font color=lightgreen size=2>(.*)<\/font><p><font style=\'font:normal 9px verdana; color: orange;\'>/s', $data, $match)) $lirik = $match[1];
	if (strlen($lirik) < 10) $lirik = "";
	
	// Get Video
	$video = "";
	if (preg_match('/youtube.com\/watch\?v=(.*)&backcolor=0x1E0B02/', $data, $match)) $video = "http://www.youtube.com/watch?v=".$match[1];
	
	$lagu = str_replace('<font color=lightgreen>*</font>', '', $lagu);
	
	echo '
	Artis: '.$artis.'<br />
	Lagu: '.$lagu.'<br />
	Album: '.$album.'<br />
	Download: ';
	
	print_r($arrdownload);
	
	echo '<br />
	Video: '.$video.'<br />
	Lirik: '.(($lirik == "") ? 'NO' : 'YES').'
	<hr />';
	
	
	$iTotal = $iTotal + 1;
	
	// database process
	if (count($arrdownload) > 0 && $artis != "" && $lagu != "") {
		$strTemp .= "<item>\r\n";
		$strTemp .= "	<artis>$artis</artis>\r\n";
		$strTemp .= "	<lagu>$lagu</lagu>\r\n";
		$strTemp .= "	<album>$album</album>\r\n";
		$strTemp .= "	<video>$video</video>\r\n";
		foreach ($arrdownload as $download) {
			if ($download != "http://stafaband.info/d.php") $strTemp .= "	<mp3>$download</mp3>\r\n";
		}
		$strTemp .= "	<lirik>$lirik</lirik>\r\n";
		$strTemp .= "</item>\r\n";
	}
}

if ($strTemp != "") {
	file_put_contents("quizzz.txt", $strTemp);
	
	//$ftp_server = "tehran.dreamhost.com";
	$ftp_server = "174.121.135.194";
	//$ftp_user_name = "walamsyah";
	$ftp_user_name = "kampreto";
	$ftp_password = "hsx6546tdy";
	
	$source_file = "quizzz.txt";
	$destination_file = "/public_html/todaygossips.com/inc/stafaband.txt";
	
	// set up basic connection
	$conn_id = ftp_connect($ftp_server); 
	
	// login with username and password
	$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_password); 
	
	// check connection
	if ((!$conn_id) || (!$login_result)) { 
	    echo "FTP connection has failed!<br />";
	    echo "Attempted to connect to $ftp_server for user $ftp_user_name"; 
	    exit; 
	} else {
	    echo "Connected to $ftp_server, for user $ftp_user_name<br />";
	}
	
	// upload the file
	$upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY); 
	
	// check upload status
	if (!$upload) { 
	    echo "FTP upload has failed!<br />";
	} else {
	    echo "Uploaded $source_file to $ftp_server as $destination_file <br />";
	}
	
	// close the FTP stream 
	ftp_close($conn_id); 
}

echo '      
<hr />
FINISH: '.date("Y/m/d H:i:s").'<br />
TOTAL: '.$iTotal.'<br />
UPDATE: '.$iUpd.'<br />
ADD: '.$iAdd;
?>