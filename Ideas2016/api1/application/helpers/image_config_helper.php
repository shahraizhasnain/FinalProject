<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$thumbSize = [
    "profile" =>
    [
        "width" => 100, "height" => 100,
        "width" => 200, "height" => 200,
        "width" => 400, "height" => 400,
        "width" => 150, "height" => 150
    ]
];

$thumbDirName = [
    "profile" =>
    [
        "small", "medium", "large", "square"
    ]
];


$thumbName = [
    "small" => 'thumb/small/',
    "medium" => 'thumb/medium/',
    "large" => 'thumb/large/',
    "xlarge" => 'thumb/xlarge/',
    "square" => 'thumb/square/',
    "original" => 'org/org/'
];

$imageConfig = [
    "maxCompressWidth" => 2048,
    "maxCompressHeight" => 2048
];

$extension = [
    "allowed" =>
    [
        "gif", "jpg", "png", "jpeg"
    ]
];
