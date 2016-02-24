<?php

define("DSN_TOOLS",           "mysql:host=192.168.7.97;dbname=liputan6_tools;charset=latin1");
define("USER_TOOLS",          "mercury");
define("PASS_TOOLS",          "g2N3oa2oD");

$tab = isset($_GET['tab']) ? $_GET['tab'] : 1;

function sql_exec($method='read', $query, $param=0, $fetch=false) {
    $result = FALSE;
    try {
        $db = new PDO(DSN_TOOLS, USER_TOOLS, PASS_TOOLS);
        $db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $stmt = $db->prepare($query);
        $param = empty($param) ? array() : $param;
        $stmt->execute($param);
        if ($method == 'read') {
            if ($fetch) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        $db = NULL;
    } catch (PDOException $e) {
        echo "<b>Error:</b> <pre>";
        print_r($e->__toString());
        echo "</pre>";
    }
    return $result;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>LSI Liputan6.com</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta http-equiv="refresh" content="15" />
<style>
* {
    margin: 0;
    padding: 0;
    font-family: verdana, arial, helvetica, sans-serif;
    font-size: 11px;
}
#wadah { margin: 20px auto; width: 800px;}
table {
    width: 100%;
}
td {
    border: 1px solid #c3ab96;
    padding: 2px;
}

th {
    border: 1px solid #c3ab96;
    padding: 2px;
    background-image: url(/tpls/webadmin/images/bg_win.gif);
}

.tab td {
    padding: 5px; text-align: center;
    border: 2px solid gray;
    background-color: maroon;
}
.tab td a {
    color: white;
    font-size: 14px;
    font-weight: bold;
    display: block;
}
.tab td.active {
    border: 2px solid maroon;
    color: maroon;
    font-size: 14px;
    font-weight: bold;
    background-color: #ccc;
}

h1 {
    border-bottom: 5px #ccc solid;
    margin-top:10px;
    margin-bottom:2px;
    font-size: 18px;
    color: maroon;
}
h2 {margin: 10px 0 5px 0; clear: both; color: maroon;}
ul { margin-left: 25px; width: 150px}
ul li { clear: both; padding: 2px 0; border-bottom: 1px dotted #ccc;}
label {width: 90px; display: block; float: left;}
span {float: left; display: block}
.polling {
    margin: 1px;
    height: 15px;
    border: 1px solid maroon;
    float:left;
}
.pol0 { background-color: #1766a1; }
.pol2 { background-color: #03b152; }
.pol1 { background-color: #cb0000; }
.pol3 { background-color: #e46c0b; }
.pol4 { background-color: #b409e5; }
.pol5 { background-color: #fdc72f; }

.persen {
    position: absolute; right: 5px; top 10px;
}

</style>
<body>
<div id="wadah">
<?php

    $menu = array(
                  '1'=>'All',
                  '2'=>'Perwilayah',
            );
?>

<table width="100%" class="tab">
    <tr>
<?php
    foreach($menu as $k=>$v) {
        if ($k == $tab) {
            echo '<td width="25%" class="active">'.$v.'</td>';
        } else {
            $href='?tab='.$k;
            echo '<td width="25%"><a href="'.$href.'">'.$v.'</a></td>';
        }
    }
?>
    </tr>
</table>

<a href="#" onclick="window.location.reload(); return false;" style="font-size: 18px;">Refresh</a>


<?php

if ($tab == 2) :

$wilayah = array('JAKARTA BARAT', 'JAKARTA TIMUR', 'JAKARTA UTARA - KEPULAUAN SERIBU',
                 'JAKARTA SELATAN', 'JAKARTA PUSAT');

foreach ($wilayah as $w) :

    $_query = 'SELECT * FROM lsi_pilkada_wilayah WHERE wilayah=?';
    $_param = array($w);
    $isi = sql_exec('read', $_query, $_param);
?>
    <h1><?=$w?></h1>
    <table>
        <tr valign="top">
            <td>


    <table>
        <tr>
            <th width="30">No.</th>
            <th width="160">Nama Calon</th>
            <th width="190">Prosentase</th>
            <th>Tgl Update</th>
        </tr>

    <?
        foreach($isi as $k => $v) : if (empty($v['namacalon'])) continue;
            $style = 'style="width:'.$v['prosentase'].'%;"';
    ?>
        <tr>
            <td align="center"><?=($k+1)?></td>
            <td><b><?=$v['namacalon']?></b></td>
            <td align="left">
                <div style="position: relative">
                    <div class="polling pol<?=$k?>" <?=$style?>></div>
                    <div class="persen"><?=$v['prosentase']?>%</div>
                </div>
            </td>
            <td align="center"><?=$v['tglupdate']?></td>
        </tr>
    <? endforeach; ?>
    </table>

    </td>
    <td width="220" style="padding-left:20px">

<?

    $_query = 'SELECT * FROM lsi_pilkada_wilayah_partisipasi WHERE region=?';
    $_param = array($w);
    $isi = sql_exec('read', $_query, $_param, 1);

?>
    <h2>PARTISIPASI PEMILIH</h2>
    <ul>
        <li><label>Prosentase</label><span> : <?=$isi['percent']?>%</span></li>
    </ul>

<?
    $_query = 'SELECT * FROM lsi_pilkada_wilayah_validasi WHERE region=?';
    $_param = array($w);
    $isi = sql_exec('read', $_query, $_param, 1);

?>
    <h2>VALIDASI SUARA PILKADA</h2>
    <ul>
        <li><label>TPS Terpilih</label><span> : <?=$isi['tpsterpilih']?></span></li>
        <li><label>TPS Masuk</label><span> : <?=$isi['tpsmasuk']?></span></li>
        <li><label>Prosentase</label><span> : <?=$isi['percent']?>%</span></li>
    </ul>


            </td>
        </tr>
    </table>

<?

endforeach;

else :

    $_query = 'SELECT * FROM lsi_pilkada';
    $_param = array();
    $isi = sql_exec('read', $_query, $_param);

?>

    <h1>ALL</h1>
    <table>
        <tr>
            <th width="30">No.</th>
            <th width="200">Nama Calon</th>
            <th width="150">Jumlah Suara</th>
            <th width="200">Prosentase</th>
            <th>Tgl Update</th>
        </tr>

    <?
    foreach($isi as $k => $v) : if (empty($v['namacalon'])) continue;
        $style = 'style="width:'.$v['prosentase'].'%;"';
    ?>
        <tr>
            <td align="center"><?=($k+1)?></td>
            <td><b><?=$v['namacalon']?></b></td>
            <td align="center"><?=$v['jmlsuara']?></td>
            <td align="left">
                <div style="position: relative">
                    <div class="polling pol<?=$k?>" <?=$style?>></div>
                    <div class="persen"><?=$v['prosentase']?>%</div>
                </div>
            </td>
            <td align="center"><?=$v['tglupdate']?></td>
        </tr>
    <? endforeach; ?>
    </table>


<? endif ?>

</div>
</body>
</html>
