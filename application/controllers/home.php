<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'restaurant/siteConfig.php';
require_once APPPATH . 'restaurant/dbConfig.php';

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('url', 'site'));
        $this->load->database();
        $this->load->library(array('form_validation', 'email'));
        $this->load->model('model_home');
        $this->load->model('model_user');
    }

    public function index() {

        $data['title'] = 'HOME';
        if ($this->session->userdata('_userLogin')) {
            $data['profile'] = $this->model_user->getUserInfo($this->session->userdata('_userID'));
        }

        $page['_header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
        $page['_slider'] = $this->load->view(siteConfig::COMPONENT_SLIDER, '', TRUE);
        $page['_content'] = $this->load->view(siteConfig::COMPONENT_HOME, '', TRUE);

        $page['_right'] = $this->load->view(siteConfig::MOD_RIGHT_CONTAINER, '', TRUE);
        $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

}
