<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'restaurant/siteConfig.php';
require_once APPPATH . 'restaurant/dbConfig.php';

class Business extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('url', 'site', 'list'));
        $this->load->database();
        $this->load->library(array('form_validation', 'email', 'encrypt'));
        $this->load->model('model_user');
        $this->load->model('model_business');
    }

    public function index() {

        $this->managelist();
    }

    public function manage() {
        if ($this->session->userdata('_userLogin')) {

            if (isset($_POST['submit'])) {

                $this->form_validation->set_rules('business-name', 'Business Title', 'required');
                $this->form_validation->set_rules('list-id', 'List ', 'required');
                $this->form_validation->set_rules('business-category', 'Business Category ', 'required');

                $this->form_validation->set_rules('description', 'Business Description ', 'required');
                $this->form_validation->set_rules('about', 'Business About ', 'required');
                $this->form_validation->set_rules('brs', 'Business Reservation  ', 'required');
                $this->form_validation->set_rules('attribute-title[]', 'Attribute Title  ', 'required');
                $this->form_validation->set_rules('attribute-value[]', 'Attribute value  ', 'required');
                $this->form_validation->set_rules('state', 'State', 'required');
                $this->form_validation->set_rules('city', 'City', 'required');

                if ($_FILES['userfile_1']['name'] != "") {
                    if ($this->form_validation->run() == TRUE) {
                        $i = $this->model_business->addNewBusiness($this->session->userdata('_userID'));

                        if ($i == '1') {
                            $s['success'] = TRUE;
                            $this->session->set_userdata($s);

                            redirect(base_url() . SiteConfig::CONTROLLER_BUSINESS . SiteConfig::METHOD_BUSINESS_MANAGE);
                        }
                    }
                } else {
                    $ie['error'] = TRUE;
                    $this->session->set_userdata($ie);
                }
            }

            $data['title'] = 'USER MANAGE BUSINESS';
            $data['profile'] = $this->model_user->getUserInfo($this->session->userdata('_userID'));
            $data['states'] = $this->model_user->getAllStates();
            $data['lists'] = getListByUserId($this->session->userdata('_userID'));
            $data['category'] = $this->model_business->getBusinessCategory();
            $page['_header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_MANAGE_BUSINESS, '', TRUE);
            $page['_right'] = $this->load->view(siteConfig::COMPONENT_USER_RIGHT_CONTAINER, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function addnew() {
        if ($this->session->userdata('_userLogin')) {

            if (isset($_POST['submit'])) {
                $i = $this->model_lists->addnew($this->input->post('list-name'), $this->session->userdata('_userID'));

                echo $i;
            }
        } else {
            echo 'Session timed out try again';
        }
    }

    public function userlist() {
        if ($this->session->userdata('_userLogin')) {

            $list = getListByUserId($this->session->userdata('_userID'));

            echo json_encode($list);
        } else {
            echo 'Session timed out try again';
        }
    }

    public function businesslist() {
        if ($this->session->userdata('_userLogin')) {

            $list = getBusinessListByUserId($this->session->userdata('_userID'));

            echo json_encode($list);
        } else {
            echo 'Session timed out try again';
        }
    }

    public function details($string) {
        //echo decode($string);
        $data['title'] = 'BUSINESS DETAILS';
        if($string!=""){
            $data['details'] = $this->model_business->getBusinessInfo($string);
        }
        $data['profile'] = $this->model_user->getUserInfo($this->session->userdata('_userID'));
        $page['_header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
        $page['_content'] = $this->load->view(siteConfig::COMPONENT_BUSINESS_DETAILS, '', TRUE);
        $page['_right'] = $this->load->view(siteConfig::COMPONENT_USER_RIGHT_CONTAINER, '', TRUE);
        $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }
    
    public function getSubcategory()
    {
        if ($this->session->userdata('_userLogin')) {
            if(isset($_POST['submit']))
            {
                $sub = $this->model_business->getSubcategory($_POST['id']);
                
                echo json_encode($sub);
            }
        }
    }

}
