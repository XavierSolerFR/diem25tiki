<?php
/**
 * Created by PhpStorm.
 * User: xaviersoler
 * Date: 09/06/2016
 * Time: 23:31
 */
function prefs_ta_diem25_mailman_list()
{
    return array(
        'ta_diem25_mailman_on' => array( // This main _on pref is mandatory
            'name' => tra('Activate Diem25 Mailman'),
            'description' => tra('Activate Diem25 Mailman Addon'),
            'type' => 'flag',

            'admin' => 'ta_diem25_mailman',
            'tags' => array('basic'),
            'default' => 'y',
        ),
        'ta_diem25_mailman_pearpath' => array(
            'name' => tra('Pear path'),
            'description' => tra(''),
            'type' => 'text',
            'default' => "/home3/solerx/php",
            
        ),
        'ta_diem25_mailman_MailmanList' =>array(
            'name' => tra('List of Mailman'),
            'description' => tra('List of Mailman json {mailman:[Name:{site:"",pass:"",list:"",},Name2:{site2:"",pass2:"",list2:"",},]} '),

            'type' => 'textarea',
            'size' => '8',
            'admin' => 'ta_diem25_mailman',
            'tags' => array('basic'),
            'default' => '[  
      {  
         "name":"Volontaires",
         "site":"http://diem25fr.org/mailman/admin",
         "pass":"Password",
         "list":"volontaires_diem25fr.org"
      },
      {  
         "name":"Discussion",
         "site":"http://diem25fr.org/mailman/admin",
         "pass":"Password",
         "list":"discussion_diem25fr.org"
      }
   ]',
        )
        
    );
}