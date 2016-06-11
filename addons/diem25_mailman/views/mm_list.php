<?php
/**
 * Created by PhpStorm.
 * User: xaviersoler
 * Date: 11/06/2016
 * Time: 09:12
 */
namespace tikiaddon\diem25\mailman;
include "../lib/services_mailman.php";

function mm_list($data, $params){
    $ret="coucou toi<br/>";
    global $prefs;
    $mm=$prefs['ta_diem25_mailman_MailmanList'];
    $mailmanconfs=json_decode($mm);
    //$ret.= print_r($mm, true) .'<br/>';
    //$ret.= print_r($mailmanconfs, true)  .'<br/>';
foreach($mailmanconfs as $mm){
    $ret .=$mm->name .'<br/>';
}
    $app = \TikiAddons::get('diem25_mailman');
    //$ServiceMailMan= $app->lib('services_mailman');
    $ret.="<br/>Fin";
    return $ret;
}