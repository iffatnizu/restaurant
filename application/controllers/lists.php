<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'restaurant/siteConfig.php';
require_once APPPATH . 'restaurant/dbConfig.php';

class Lists extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('url', 'site','list'));
        $this->load->database();
        $this->load->library(array('form_validation', 'email'));
        $this->load->model('model_user');
        $this->load->model('model_lists');
    }

    public function index() {

        $this->managelist();
    }
    
    public function manage()
    {
        if ($this->session->userdata('_userLogin')) {
            $data['title'] = 'USER MANAGE LIST';
            $data['profile'] = $this->model_user->getUserInfo($this->session->userdata('_userID'));
            $page['_header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_MANAGE_LIST, '', TRUE);
            $page['_right'] = $this->load->view(siteConfig::COMPONENT_USER_RIGHT_CONTAINER, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }
    
    public function addnew()
    {
        if ($this->session->userdata('_userLogin')) {
            
            if(isset($_POST['submit']))
            {
                $i = $this->model_lists->addnew($this->input->post('list-name'),$this->session->userdata('_userID'));
                
                echo $i;
            }
        }
        else {
            echo 'Session timed out try again';
        }
    }
    
    public function userlist()
    {
        if ($this->session->userdata('_userLogin')) {
            
            $list = getListByUserId($this->session->userdata('_userID'));
            
            echo json_encode($list);
            
        }
        else {
            echo 'Session timed out try again';
        }
    }
}