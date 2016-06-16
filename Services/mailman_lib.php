<?php
/**
 * Created by PhpStorm.
 * User: xaviersoler
 * Date: 20/05/2016
 * Time: 23:14
 */

include_once "mailman.local.php";
function MyMailMan($useremail, $site, $listes, $password){
    global $pearpath;

    ini_set("include_path", "$pearpath:" . ini_get("include_path") );
    require_once 'Mailman.php';
    $msg ="";
    foreach ($listes as $liste){
        $mm = new Services_Mailman($site, $liste , $password);
        $msg .="subscribe  $useremail, $site, $liste ";
        try {
            $mm->subscribe($useremail, true);
            $msg .=" ok";

        } catch (Services_Mailman_Exception $e) {
            $msg .=" Error: " . $e->getMessage();

        }
        $msg .="<br/>";
    }
    return $msg;
}

function AddToMailManList($email)
{
    global $MailManSite,$MailManPass,$MailManListe;
    return MyMailMan($email, $MailManSite, $MailManliste, $MailManPass);
}