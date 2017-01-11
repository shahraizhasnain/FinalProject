<?php

/**
 * custom_helper 
 * Contains helper functions 
 * 
 * @package    CI
 * @subpackage Model
 * @author     Ahmer Saeed ahmer.saeed@skillorbit.com
 */
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/** Returns the status of user login / logout
 * @return bool
 */
function isUserLoggedIn() {
    if ((array_key_exists('token', $_COOKIE) && strlen($_COOKIE['token']) > 0) && (array_key_exists('x-client-id', $_COOKIE) && strlen($_COOKIE['x-client-id']) > 0) && (array_key_exists('user-id', $_COOKIE) && strlen($_COOKIE['user-id']) > 0) && (array_key_exists('user-name', $_COOKIE) && strlen($_COOKIE['user-name']) > 0) && (array_key_exists('user-first-name', $_COOKIE) && strlen($_COOKIE['user-first-name']) > 0) && (array_key_exists('user-last-name', $_COOKIE) && strlen($_COOKIE['user-last-name']) > 0) && (array_key_exists('user-role', $_COOKIE) && strlen($_COOKIE['user-role']) > 0)) {
        if ($_COOKIE['user-role'] == "user") {
            return "TRUE";
        } else {
            return "TRUE&&ADMIN";
        }
    } else {
        return "FALSE";
    }
}
