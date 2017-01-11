<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MY_Controller {

    public function index() {
        $this->load->view('header');
        $this->load->view('login');
        $this->load->view('footer');
    }
//    public function unauthorize() {
//        $this->load->view('header');
//        $this->load->view('noprivilege');
//        $this->load->view('unauthorized');
//        $this->load->view('footer');
//    }

    public function settings() {
        $session = $this->session->userdata;
        if (count($session) > 1) {
            $session = $session['logged_in'];
            if ($session['admin_type'] === "SUPER") {
                $this->load->view('header');
                $this->load->view('menubar');
                $this->load->view('settings');
                $this->load->view('footer');
            } else {
                $this->load->view('header');
                $this->load->view('menubar');
                $this->load->view('unauthorized');
                $this->load->view('footer');
            }
        } else {
            $this->load->view('header');
            $this->load->view('login');
            $this->load->view('footer');
        }
    }

    public function dashboard() {
        
                $this->load->view('header');
                $this->load->view('menubar');
                $this->load->view('dashboard');
                $this->load->view('footer');
            }
       
    public function notification() {
       $session = $this->session->userdata;
        if (count($session) > 1) {
            $session = $session['logged_in'];
            if ($session['privilege'] === "NOTIFICATION" or $session['admin_type'] === "SUPER") {
                $this->load->view('header');
                $this->load->view('menubar');
                $this->load->view('notification');
                $this->load->view('footer');
            } else if ($session['privilege1'] === "NOTIFICATION") {
                $this->load->view('header');
                $this->load->view('menubar');
                $this->load->view('notification');
                $this->load->view('footer');
            } else if ($session['privilege2'] === "NOTIFICATION") {
                $this->load->view('header');
                $this->load->view('menubar');
                $this->load->view('notification');
                $this->load->view('footer');
            } else {
                $this->load->view('header');
                $this->load->view('menubar');
                $this->load->view('noprivilege');
                $this->load->view('footer');
            }
        } else {
            $this->load->view('header');
            $this->load->view('login');
            $this->load->view('footer');
        }
    }

    public function addEvent() {
       $session = $this->session->userdata;
        if (count($session) > 1) {
            $session = $session['logged_in'];
            if ($session['privilege'] === "EVENT" or $session['admin_type'] === "SUPER") {
                $this->load->view('header');
                $this->load->view('menubar');
                $this->load->view('addevent');
                $this->load->view('footer');
            } else if ($session['privilege1'] === "EVENT") {
                $this->load->view('header');
                $this->load->view('menubar');
                $this->load->view('addevent');
                $this->load->view('footer');
            } else if ($session['privilege2'] === "EVENT") {
                $this->load->view('header');
                $this->load->view('menubar');
                $this->load->view('addevent');
                $this->load->view('footer');
            } else {
                $this->load->view('header');
                $this->load->view('menubar');
                $this->load->view('noprivilege');
                $this->load->view('footer');
            }
        } else {
            $this->load->view('header');
            $this->load->view('login');
            $this->load->view('footer');
        }
    }

    public function logout() {
        $session_data = array(
            'username' => '',
            'authorization' => '',
            'admin_type' => '',
            'privilege' => '',
        );
        $this->session->unset_userdata('logged_in', $session_data);
        $this->load->view('header');
        $this->load->view('login');
        $this->load->view('footer');
    }

}
