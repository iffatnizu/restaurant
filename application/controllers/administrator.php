<?php

require_once APPPATH . 'restaurant/siteConfig.php';
require_once APPPATH . 'restaurant/dbConfig.php';
require_once APPPATH . 'restaurant/adminconfig.php';

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administrator extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'site', 'cookie', 'form', 'url'));
        $this->load->library(array('imageresizer'));
        $this->load->model('model_administrator');
    }

    public function index() {
        $this->login();
    }

    public function login() {
        if (!$this->session->userdata('_cheapaschipscleaningAdminLogin')) {

            if (isset($_POST['submit'])) {
                $login = $this->model_administrator->dologin();

                if ($login != '0') {
                    $session['_cheapaschipscleaningAdminLogin'] = true;
                    $session['_cheapaschipscleaningAdminID'] = $login[DBConfig::TABLE_ADMIN_ATT_ADMIN_ID];

                    $this->session->set_userdata($session);

                    redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_DASHBOARD));
                } else {
                    $session['_errorlAdminLogin'] = true;
                    $this->session->set_userdata($session);
                }
            }

            $data['title'] = 'Welcome to Administrator Panel';
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_LOGIN, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_DASHBOARD));
        }
    }

    public function dashboard() {
        if ($this->session->userdata('_cheapaschipscleaningAdminLogin')) {
            $data['title'] = 'Dashboard || Cheapaschipscleaning  Admin';
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_DASBOARD, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function logout() {
        $session['_cheapaschipscleaningAdminLogin'] = FALSE;
        $session['_directoryAdminID'] = FALSE;
        $this->session->unset_userdata($session);

        redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
    }

    public function sitecontent($contentname, $contentTitle) {
        if ($this->session->userdata('_cheapaschipscleaningAdminLogin')) {
            if ($contentname && $contentTitle) {
                if (isset($_POST['updateInformation'])) {
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('title', 'Title', 'required');
                    $this->form_validation->set_rules('editor1', 'Description', 'required');
                    if (!$this->form_validation->run() == FALSE) {
                        $update = $this->model_administrator->updateSiteContent();

                        if ($update) {
                            $session['_success'] = true;
                            $this->session->set_userdata($session);
                            redirect($_POST['currentUrl']);
                        }
                    }
                }
                $data['title'] = urldecode($contentTitle) . '|| Cheapaschipscleaning  Admin';
                $data['contentTitle'] = urldecode($contentTitle);
                $data['contentName'] = $contentname;
                $data['content'] = $this->model_administrator->getSiteContent($contentname);
                $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
                $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
                $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_SITE_CONTENT, $data, TRUE);
                $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
            } else {
                redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
            }
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function faq() {
        if ($this->session->userdata('_cheapaschipscleaningAdminLogin')) {
            if (isset($_POST['insertFaq'])) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('Question', 'Question', 'required');
                $this->form_validation->set_rules('Answer', 'Answer', 'required');
                if (!$this->form_validation->run() == FALSE) {
                    $i = $this->model_administrator->insertFAQ();

                    if ($i == '1') {
                        $session['_success'] = true;
                        $this->session->set_userdata($session);
                        redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_FAQ);
                    }
                }
            }
            $data['title'] = 'Dashboard || Cheapaschipscleaning  Admin';
            $data['faq'] = getFAQ();
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_FAQ, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function deletefaq($id = 0) {
        if ($this->session->userdata('_cheapaschipscleaningAdminLogin')) {
            $d = $this->model_administrator->deletefaq($id);
            redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_FAQ);
        }
    }

    public function siteparameter() {
        if ($this->session->userdata('_cheapaschipscleaningAdminLogin')) {
            if (isset($_POST['submit'])) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('siteTitle', 'Site Title', 'required');
                $this->form_validation->set_rules('siteMetaKeyword', 'Site Meta Keyword', 'required');
                $this->form_validation->set_rules('siteMetaDescription', 'Site Meta Description', 'required');
                $this->form_validation->set_rules('siteEmail', 'Site Email Address', 'required');
                $this->form_validation->set_rules('sitePhone', 'Site Phone', 'required');


                if (!$this->form_validation->run() == FALSE) {
                    $u = $this->model_administrator->updateSiteParameter();

                    if ($u == '1') {
                        $session['_success'] = true;
                        $this->session->set_userdata($session);
                        redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_SITE_PARAMETER);
                    }
                }
            }
            $data['title'] = 'Site Parameter || Cheapaschipscleaning  Admin';
            $data['details'] = getSitParameter();
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_SITE_PARAMETER, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function changepassword() {
        if ($this->session->userdata('_cheapaschipscleaningAdminLogin')) {
            if (isset($_POST['updatePassword'])) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('old_password', 'Old Password', 'required');
                $this->form_validation->set_rules('new_password', 'New Password', 'required|matches[con_new_password]');
                $this->form_validation->set_rules('con_new_password', 'Password Confirmation', 'required');

                if (!$this->form_validation->run() == FALSE) {
                    $update = $this->model_administrator->changepassword();
                    if ($update == '1') {
                        $data['_success'] = true;
                        $this->session->set_userdata($data);
                        redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_CHANGE_PASSWORD);
                    } else {
                        $data['_notmached'] = true;
                        $this->session->set_userdata($data);
                        redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_CHANGE_PASSWORD);
                    }
                }
            }

            $data['title'] = 'Change Administrator Password || Cheapaschipscleaning  Admin';
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_SITE_CHANGE_PASSWORD, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function lists($name = "") {
        if ($this->session->userdata('_cheapaschipscleaningAdminLogin')) {


            if ($name == true) {
                if ($name == "services") {

                    if (isset($_POST['insertService'])) {
                        $this->load->library('form_validation');
                        $this->form_validation->set_rules('service-name', 'Service name', 'required');
                        $this->form_validation->set_rules('service-details', 'Service details', 'required');

                        if (!$this->form_validation->run() == FALSE) {
                            $insert = $this->model_administrator->insertService();

                            if ($insert == 1) {
                                $data['_success'] = true;
                                $this->session->set_userdata($data);
                                redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LIST . $name);
                            }
                        }
                    }

                    $data['title'] = 'Service List || Cheapaschipscleaning Admin';
                    $data['service'] = $this->model_administrator->getService();
                    $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_SERVICE_LIST, $data, TRUE);
                }
            }
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);

            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function deleteservice($serviceId) {
        if ($this->session->userdata('_cheapaschipscleaningAdminLogin')) {
            $delete = $this->model_administrator->deleteservice($serviceId);

            if ($delete == 1) {
                redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LIST . "services");
            }
        }
    }

    public function manageCategory() {
        if ($this->session->userdata('_cheapaschipscleaningAdminLogin')) {
            if (isset($_POST['submit'])) {

                if ($_FILES['userfile']['name']) {

                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('catTitle', 'Category Title', 'required');
                    $this->form_validation->set_rules('catDetails', 'Category Details', 'required');

                    if (!$this->form_validation->run() == FALSE) {
                        $u = $this->model_administrator->insertNewImage();

                        if ($u == '1') {
                            $session['_success'] = true;
                            $this->session->set_userdata($session);
                            redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_MANAGE_CATEGORY);
                        }
                    }
                } else {
                    $d['_errorUpload'] = true;
                    $this->session->set_userdata($d);
                    redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_MANAGE_CATEGORY);
                }
            }
            $data['title'] = 'Manage Category || Cheapaschipscleaning  Admin';
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_MANAGE_IMAGE, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function viewCategory() {
        if ($this->session->userdata('_cheapaschipscleaningAdminLogin')) {
            $data['title'] = 'View Category || Cheapaschipscleaning  Admin';
            $data['category'] = $this->model_administrator->getAllCategory();
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_VIEW_CATEGORY, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        }
    }

    public function deleteCategory($id) {
        if ($this->session->userdata('_cheapaschipscleaningAdminLogin')) {
            $d = $this->model_administrator->deleteCategory($id);

            if ($d == 1) {
                redirect(base_url() . Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_VIEW_CATEGORY);
            }
        }
    }

    public function editCategory($id = 0) {
        if ($this->session->userdata('_cheapaschipscleaningAdminLogin')) {
            if (isset($_POST['submit'])) {


                $this->load->library('form_validation');
                $this->form_validation->set_rules('catTitle', 'Category Title', 'required');
                $this->form_validation->set_rules('catDetails', 'Category Details', 'required');

                if (!$this->form_validation->run() == FALSE) {
                    $u = $this->model_administrator->updateCategory($id);

                    if ($u == '1') {
                        $session['_success'] = true;
                        $this->session->set_userdata($session);
                        redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_EDIT_CATEGORY . $id);
                    }
                }
            }
            $data['title'] = 'Edit Category || Cheapaschipscleaning  Admin';
            $data['details'] = $this->model_administrator->getCategoryDetails($id);
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_EDIT_CATEGORY, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function editService($id = 0) {
        if ($this->session->userdata('_cheapaschipscleaningAdminLogin')) {
            if (isset($_POST['submit'])) {


                $this->load->library('form_validation');
                $this->form_validation->set_rules('serTitle', 'Service Title', 'required');
                $this->form_validation->set_rules('serDetails', 'Service Details', 'required');

                if (!$this->form_validation->run() == FALSE) {
                    $u = $this->model_administrator->updateServices($id);

                    if ($u == '1') {
                        $session['_success'] = true;
                        $this->session->set_userdata($session);
                        redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_EDIT_SERVICE . $id);
                    }
                }
            }
            $data['title'] = 'Edit Category || Cheapaschipscleaning  Admin';
            $data['details'] = $this->model_administrator->getServiceDetails($id);
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_EDIT_SERVICE, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function viewService() {
        if ($this->session->userdata('_cheapaschipscleaningAdminLogin')) {
            $data['title'] = 'View Service || Cheapaschipscleaning  Admin';
            $data['service'] = $this->model_administrator->getAdditinalServices();
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_VIEW_SERVICE, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        }
    }

    public function deleteServiceImage($serviceId) {
        if ($this->session->userdata('_cheapaschipscleaningAdminLogin')) {
            $delete = $this->model_administrator->deleteServiceImage($serviceId);

            if ($delete == 1) {
                redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_VIEW_SERVICE);
            }
        }
    }

}
