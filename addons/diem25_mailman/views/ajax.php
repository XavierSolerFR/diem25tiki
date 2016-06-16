<?php
/**
 * Created by PhpStorm.
 * User: xaviersoler
 * Date: 14/06/2016
 * Time: 08:08
 */
namespace tikiaddon\diem25\mailman;

function ajax($data, $params){
    $app = \TikiAddons::get('diem25_mailman');
    return $app->smarty->fetch('mm_Controller.tpl');
}