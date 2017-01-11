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
 * @author     Shahraiz Hasnain Khan shahraiz.hasnain@live.com
 */
class MY_Controller extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
//        allowCORS();
        date_default_timezone_set("Asia/Karachi");
        $this->load->model('M_session');
        $this->load->model('M_upload');
        $this->load->model('M_admin');
        $this->load->model('M_admin');
    }

    public function initializeEmailConfig() {
        $emailTo = $_POST['email'];
        $emailSubject = $_POST['contact_subject'];
        $emailMessage = $_POST['contact_message'];
        $emailconfig = emailConfiguration();
        $this->load->library('email', $emailconfig);
        $this->email->from($emailconfig['from']);
        $this->email->set_newline("\r\n");
        $this->email->to($emailTo);
        $this->email->subject($emailSubject);
        $this->email->message($emailMessage);
        if ($this->email->send()) {
            return 'true';
        } else {
            return show_error($this->email->print_debugger());
        }
        
        
       
    }
    
     public  function SendEmailSignUp($emailUser, $usercode)
     {
        $emailTo = $emailUser;
        $emailSubject = "Welcome to Ideas 2016";
        $emailMessage = "Thank you for Registeration! Your Registration Code is  " . $usercode ;
        $emailconfig = emailConfiguration();
        $this->load->library('email', $emailconfig);
        $this->email->from($emailconfig['from']);
        $this->email->set_newline("\r\n");
        $this->email->to($emailTo);
        $this->email->subject($emailSubject);
        $this->email->message($emailMessage);
        $this->email->send() ;
           
           
     }
    
    
 

}
