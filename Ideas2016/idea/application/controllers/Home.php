<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Karachi");
    }
     
    public function index() {
        $this->load->view('header');
        $this->load->view('menubar_web');
        $this->load->view('v_homepage');
        $this->load->view('footer1');
    }
     public function add() {
        $this->load->view('header');
        $this->load->view('menubar_web');
        $this->load->view('wahab');
        $this->load->view('footer1');
    }
    

}
