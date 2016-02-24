<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
  
if ( ! function_exists('hfilters'))
{

    function hfilters($filters='')
    {
        $res1 = str_replace('[', '', $filters);
        $res1 = str_replace(']', '', $res1);
        $res1 = str_replace('}', '', $res1);
        $res1 = str_replace('{', '', $res1);
        $res1 = str_replace('"', '', $res1); 
        
        $arrres = array();
        $dx = 0;
        $arrepl = explode(',', $res1);
        foreach($arrepl as $k=>$v)
        {
            $vexpl = explode(':', $v);
            if($vexpl[0]=='type')
            {
                if ($k>0) $dx += 1;     
            } else {
                $arrres[$dx][$vexpl[0]] = $vexpl[1];           
            }
        }
        return $arrres;
    }
    
}


if ( ! function_exists('hsort'))
{

    function hsort($sort='')
    {
        $res1 = str_replace('[', '', $sort);
        $res1 = str_replace(']', '', $res1);
        $res1 = str_replace('}', '', $res1);
        $res1 = str_replace('{', '', $res1);
        $res1 = str_replace('"', '', $res1);
        $res1 = str_replace(',', ':', $res1);     
        
        $arrepl = explode(':', $res1);
        $arrres = array('property'=>$arrepl[1], 'direction'=>$arrepl[3]);
        return $arrres;
    }
    
}
