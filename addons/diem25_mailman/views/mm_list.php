<?php
/**
 * Created by PhpStorm.
 * User: xaviersoler
 * Date: 11/06/2016
 * Time: 09:12
 */
namespace tikiaddon\diem25\mailman;
use Zend\Http\Request;
use  tikiaddon\diem25\mailman\services_mailman;
//include "../lib/services_mailman.php";
//require_once '/Users/xaviersoler/Sites/tiki15/addons/diem25_mailman/lib/services_mailman.php';

function mm_list($data, $params){
    $ret="coucou toi<br/>";
    global $prefs;
    $mm=$prefs['ta_diem25_mailman_MailmanList'];
    $mailmanconfs=json_decode($mm);
    //$ret.= print_r($mm, true) .'<br/>';
    //$ret.= print_r($mailmanconfs, true)  .'<br/>';
    $app = \TikiAddons::get('diem25_mailman');
    $ml= \TikiLib::lib('tikiaddon.diem25.mailmam.services_mailman');
foreach($mailmanconfs as $mm){
    $ret .=$mm->name ;
    $ml->setadminPW($mm->pass);
    $ml->setadminURL($mm->site);
    $ml->setList($mm->list);
    $ret .= ' version :'. $ml->version();
    $members=$ml->members();
    $ret .= ' nb :' . count($members);
    $ret .="<pre>".print_r($members,true)."</pre>";
   // $ret .="<pre>".print_r($ml->ldoc ,true)."</pre>";
    $ret .='<br/>';

}


    $ret.="<br/>Fin";
    return $ret;
}