<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// function defaultConfiguration() {

//     $config = array(
//         "image" => 'resources/default_files/profile/default.gif',
//         "upload" => 'resources/uploads/',
//         "thumbPath" => 'thumb/',
//         "profile" => 'profile/',
//         "allowed_types" => '.jpg',
//         "overwrite" => TRUE,
//         "max_size" => "2048000", // Can be set to particular file size, here it is 2 MB(2048 Kb)
//         "max_height" => 400,
//         "max_width" => 400
//     );
//     return $config;
// }

function emailConfiguration() {
    $emailconfig = Array(        
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://ranger.websitewelcome.com',
        'smtp_port' => 465,
        'smtp_user' => 'info@fts-admin.com',
        'smtp_pass' => 'fts123',
        'mailtype' => 'html',
        'charset' => 'iso-8859-1',
        'wordwrap' => TRUE,
        'from' => 'info@fts-admin.com'     
 //===================================//
//     
       // Testing credentials      
       // 'protocol' => 'smtp',
       // 'smtp_host' => 'ssl://smtp.gmail.com',
       // 'smtp_port' => 465,
       // 'smtp_user' => 'shahraiz.hasnain@gmail.com',
       // 'smtp_pass' => '',
       // 'mailtype' => 'html',
       // 'charset' => 'iso-8859-1',
       // 'wordwrap' => TRUE,
       // 'from' => 'shahraiz.hasnain@gmail.com'
    );
    return $emailconfig;
}


?>