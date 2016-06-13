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

/*
    $request= new Request();
    $request->setUri('https://diem25fr.org/mailman/admin/volontaires_diem25fr.org');
    $request->setMethod('POST');
    $request->getPost()->set('adminpw', 'Platon+1993');

    $client = new  \Zend\Http\Client();
    $client->setOptions( array(
        'maxredirects' => 0,
        'timeout'      => 30,
        'rfc3986strict' =>1,
        'adapter' => 'Zend\Http\Client\Adapter\Curl'
    ));
    $content = $client->send($request);
    $Encoding=$content->getHeaders()->get('Content-Encoding')->getFieldValue();

    $body=(string) $content->getContent();
    if($Encoding =="gzip"){
        $body=ltrim(gzinflate(substr($body, 10)));
    }
   //$ret.="<pre>". print_r($body,true)."</pre>";
    $ret.=strlen($body);
    $ret.="<br/>";
    $doc = new \DOMDocument();

// load the HTML string we want to strip
    $doc->loadHTML($body);
$tagstoremove = array('script');
    foreach($tagstoremove as $tn){
    // get all the script tags
        $script_tags = $doc->getElementsByTagName($tn);

        $length = $script_tags->length;

    // for each tag, remove it from the DOM
        for ($i = 0; $i < $length; $i++) {
            $script_tags->item($i)->parentNode->removeChild($script_tags->item($i));
        }
    }
// get the HTML string back
    $b2 = $doc->saveXML();

    //$b2=strip_tags($body,"<HTML><HEAD><BODY><FORM><TABLE><TR><TD><UL><LI>");
    $b2=htmlentities($b2,ENT_SUBSTITUTE, $encoding="ISO8859-1");
    //$content = \TikiLib::lib('tiki')->httprequest("http://diem25fr.org/mailman/admin/volontaires_diem25fr.org/?adminpw=Platon%2B1993");
    $ret .= "<pre>b2=".strlen($b2).$b2."</pre>";
*/
    //$ServiceMailMan= $app->lib('services_mailman');
    $ret.="<br/>Fin";
    return $ret;
}