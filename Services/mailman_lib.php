<?php
/**
 * Created by PhpStorm.
 * User: xaviersoler
 * Date: 20/05/2016
 * Time: 23:14
 */
function MyMailMan($useremail, $site, $listes, $password){
    ini_set("include_path", "/home3/solerx/php:" . ini_get("include_path") );
    require_once 'Services/Mailman.php';
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
    $MailManSite="http://diem25fr.org/mailman/admin";
    $mailmanpass="Platon+1993";
    $liste = array("volontaires_diem25fr.org", "discussion_diem25fr.org");
    return MyMailMan($email, $MailManSite, $liste, $mailmanpass);
}