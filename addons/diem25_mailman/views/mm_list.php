<?php
/**
 * Created by PhpStorm.
 * User: xaviersoler
 * Date: 11/06/2016
 * Time: 09:12
 */
namespace tikiaddon\diem25\mailman;
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
    $ret .=$mm->name .'&nbsp;';
    $ml->setadminPW($mm->pass);
    $ml->setadminURL($mm->site);
    $ml->setList($mm->list);
   // $ret .=$ml->version();
    $ret .=$mm->name .'<br/>';

}
    $client = new  \Zend\Http\Client("https://diem25fr.org/mailman/admin/volontaires_diem25fr.org/?adminpw=Platon%2B1993", array(
        'maxredirects' => 0,
        'timeout'      => 30,
        'adapter' => 'Zend\Http\Client\Adapter\Curl'
    ));
    $content = \Zend\Http\Response::fromString($client->send());

    //$content= $client->decodeGzip($content);
    

    $ret.="<br/>";

    //$content = \TikiLib::lib('tiki')->httprequest("http://diem25fr.org/mailman/admin/volontaires_diem25fr.org/?adminpw=Platon%2B1993");
    $ret .=htmlentities($content);

    //$ServiceMailMan= $app->lib('services_mailman');
    $ret.="<br/>Fin";
    return $ret;
}