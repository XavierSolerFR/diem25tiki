<?php
/**
 * Created by PhpStorm.
 * User: xaviersoler
 * Date: 29/05/2016
 * Time: 11:30
 */
function smarty_function_sharethis($params, $smarty){
    $headerlib->add_jsfile('var switchTo5x=true;');
    $headerlib->add_jsfile('http://w.sharethis.com/button/buttons.js');
    $headerlib->add_jsfile('http://s.sharethis.com/loader.js');
$html="
    stLight.options({publisher: 'f9af4939-9f01-4ee5-83a2-83b8e87dcffd', doNotHash: false, doNotCopy: false, hashAddressBar: false});
    var options={ 'publisher': 'f9af4939-9f01-4ee5-83a2-83b8e87dcffd', 'position': 'right', 'ad': { 'visible': false, 'openDelay': 5, 'closeDelay': 0}, 'chicklets': { 'items': ['facebook', 'twitter', 'linkedin', 'pinterest', 'email', 'sharethis']}};
    var st_hover_widget = new sharethis.widgets.hoverbuttons(options);
";
    return $html;
}