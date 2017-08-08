<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'restaurant/siteConfig.php';
require_once APPPATH . 'restaurant/dbConfig.php';

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('url', 'site'));
        $this->load->database();
        $this->load->library(array('form_validation', 'email'));
        $this->load->model('model_user');
    }

    public function index() {

        $this->signup();
    }

    public function signup() {
        $data['title'] = 'USER SIGN UP';

        if (!$this->session->userdata('_userLogin')) {
            if (isset($_POST['submit'])) {

                $this->form_validation->set_rules('first-name', 'First Name', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_emailAddressCheck');
                $this->form_validation->set_rules('password', 'Password', 'required|matches[con-password]');
                $this->form_validation->set_rules('con-password', 'Confirm Password', 'required');
                $this->form_validation->set_rules('zip', 'Zip Code', 'required');
                $this->form_validation->set_rules('month', 'Month', 'required');
                $this->form_validation->set_rules('day', 'Day', 'required');
                $this->form_validation->set_rules('year', 'Year', 'required');


                if ($this->form_validation->run() == TRUE) {
//            debugPrint($_POST);
                    $this->model_user->userSignup();
                }
            }

            $page['_header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_SIGNUP, '', TRUE);
            $page['_right'] = $this->load->view(siteConfig::MOD_RIGHT_CONTAINER, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function emailAddressCheck($email = "") {

        $check = $this->model_user->emailAddressCheck($email);

        if ($check == '1') {
            $this->form_validation->set_message('emailAddressCheck', 'Email Address Already Exist');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function account($name, $token) {
        if (!$this->session->userdata('_userLogin')) {
            $this->model_user->userAccountActivation($name, $token);
            $data['title'] = 'USER ACCOUNT ACTIVATION';
            $page['_header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_ACTIVATION, '', TRUE);
            $page['_right'] = $this->load->view(siteConfig::MOD_RIGHT_CONTAINER, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function login() {
        if (!$this->session->userdata('_userLogin')) {
            $data['title'] = 'USER LOGIN';

            if (isset($_POST['login'])) {
                $this->model_user->userLogin();
            }

            $page['_header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_LOGIN, '', TRUE);
            $page['_right'] = $this->load->view(siteConfig::MOD_RIGHT_CONTAINER, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_DASHBOARD);
        }
    }

    public function dashboard() {
        if ($this->session->userdata('_userLogin')) {
            $data['title'] = 'USER DASHBOARD';
            $data['profile'] = $this->model_user->getUserInfo($this->session->userdata('_userID'));
            $page['_header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_DASHBOARD, '', TRUE);
            $page['_right'] = $this->load->view(siteConfig::COMPONENT_USER_RIGHT_CONTAINER, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function logout() {
        $session['_userLogin'] = FALSE;
        $session['_userID'] = FALSE;
        $session['_userDisplayName'] = FALSE;

        $this->session->unset_userdata($session);

        redirect(base_url());
    }

    public function editprofile() {
        if ($this->session->userdata('_userLogin')) {

            if (isset($_POST['submit'])) {

                $this->form_validation->set_rules('first-name', 'First Name', 'required');
                $this->form_validation->set_rules('zip', 'Zip Code', 'required');
                $this->form_validation->set_rules('state', 'State', 'required');
                $this->form_validation->set_rules('city', 'City', 'required');
                $this->form_validation->set_rules('address', 'Address', 'required');
                $this->form_validation->set_rules('phone', 'Phone', 'required');

                if ($this->form_validation->run() == TRUE) {

                    $this->model_user->editprofile($this->session->userdata('_userID'));
                }
            }

            $data['title'] = 'USER DASHBOARD';
            $data['states'] = $this->model_user->getAllStates();
            $data['profile'] = $this->model_user->getUserInfo($this->session->userdata('_userID'));
            $page['_header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_EDIT_PROFILE, '', TRUE);
            $page['_right'] = $this->load->view(siteConfig::COMPONENT_USER_RIGHT_CONTAINER, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function getCity() {
        $city = $this->model_user->getCityByState($_POST['id']);
        echo json_encode($city);
    }

    public function changepassword() {
        if ($this->session->userdata('_userLogin')) {

            if (isset($_POST['submit'])) {

                $this->form_validation->set_rules('new-password', 'New Password', 'required|matches[connew-password]');
                $this->form_validation->set_rules('connew-password', 'Confirm Password', 'required');
                $this->form_validation->set_rules('old-password', 'Old Password', 'required');


                if ($this->form_validation->run() == TRUE) {

                    $this->model_user->changepassword($this->session->userdata('_userID'));
                }
            }

            $data['title'] = 'USER CHANGE PASSWORD';
            $data['profile'] = $this->model_user->getUserInfo($this->session->userdata('_userID'));
            $page['_header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_CHANGE_PASSWORD, '', TRUE);
            $page['_right'] = $this->load->view(siteConfig::COMPONENT_USER_RIGHT_CONTAINER, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function forgotpassword() {
        if (!$this->session->userdata('_userLogin')) {

            if (isset($_POST['submit'])) {

                $this->form_validation->set_rules('email', 'E-mail address', 'required');

                if ($this->form_validation->run() == TRUE) {

                    $this->model_user->forgotpassword();
                }
            }

            $data['title'] = 'USER FORGOT PASSWORD';
            if ($this->session->userdata('_userLogin')) {
                $data['profile'] = $this->model_user->getUserInfo($this->session->userdata('_userID'));
            }
            $page['_header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_FORGOT_PASSWORD, '', TRUE);
            $page['_right'] = $this->load->view(siteConfig::MOD_RIGHT_CONTAINER, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

}
