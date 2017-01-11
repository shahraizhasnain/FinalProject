<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Send Email Class
 * 
 * 
 * @package    CI
 * @subpackage Controller
 * @author     Shahraiz Hasnain Khan shahraiz.hasnain@live.com
 */
class Send_Email extends MY_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Send Email
     * @return status
     */
    public function send() {
       
            if (isset($_POST['email'])) {
                $emailconfig = $this->initializeEmailConfig();
                if ($emailconfig == 'true') {
                    return responseMessage("200", "email sent successfully", $emailconfig);
                } else {
                    return responseMessage("200", "failed to send email", $emailconfig);
                }
            } else {
                return responseMessage("200", "please provide valid email address", "null");
            }
        }
    }

}
