<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Form Validation File
 * Used in validatin different forms such as signup, login etc
 * 
 */
$config = array(
    'signup' => [
        array(
            'field' => 'user_name',
            'rules' => 'trim|required|valid_email'
        ),
        array(
            'field' => 'cell_number',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'verification_code',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'device_id',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'device_type',
            'rules' => 'trim|required'
        )
    ],
//    'register_event' => [
//        array(
//            'field' => 'user_name',
//            'rules' => 'trim|required'
//        ),
//        array(
//            'field' => 'event_id',
//            'rules' => 'trim|required'
//        )
//    ],
    'login' => [array(
            'field' => 'username',
            'label' => 'User Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'password',
            'label' => 'User Password',
            'rules' => 'trim|md5|required'
        )
    ],
    'addadmin' => [array(
            'field' => 'username',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'password',
            'rules' => 'trim|md5|required'
        )
    ],
    'logout' => [
        array(
            'field' => 'users_id',
            'label' => 'User Id',
            'rules' => 'required'
        )
    ],
    'checkUserName' => [
        array(
            'field' => 'user_name',
            'label' => 'User Name',
            'rules' => 'trim|required|valid_email'
        )
    ],
    /*
      update User profile validation
     *  */
    'updateUserProfile' => [
        array(
            'field' => 'user_first_name',
            'label' => 'First Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'user_last_name',
            'label' => 'Last Name',
            'rules' => 'trim'
        ),
        array(
            'field' => 'user_cell_number',
            'label' => 'Cell Number',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'user_street_address',
            'label' => 'Street Address',
            'rules' => 'trim|required'
        ),]
);
