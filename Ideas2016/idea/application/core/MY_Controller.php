<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * MY_Controller
 * 
 * 
 * @package    CI
 * @subpackage Controller
 * @author     Ahmer Saeed ahmer.saeed@skillorbit.com
 */
class MY_Controller extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Karachi");
//        if (isUserLoggedIn() == "FALSE") {
//            $this->load->view('header');
//            $this->load->view('menubar_web');
//            $this->load->view('v_login');
//            $this->load->view('footer1');
//        }
    }

}
