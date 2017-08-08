<?php

class SiteConfig {

    CONST CONFIG_ADMIN_EMAIL = 'admin@restaurant.com';
    
    //define controllers
    CONST CONTROLLER_HOME = 'home';
    CONST CONTROLLER_USER = 'user';
    CONST CONTROLLER_LIST = 'lists';
    CONST CONTROLLER_BUSINESS = 'business';
    
    
    //define controller method 
    CONST METHOD_USER_SIGN_UP = '/signup/';
    CONST METHOD_USER_ACCOUNT = '/account/';
    CONST METHOD_USER_LOGIN = '/login/';
    CONST METHOD_USER_DASHBOARD = '/dashboard/';
    CONST METHOD_USER_LOGOUT = '/logout/';
    CONST METHOD_USER_EDIT_PROFILE = '/editprofile/';
    CONST METHOD_USER_CHANGE_PASSWORD = '/changepassword/';
    CONST METHOD_USER_GET_CITY = '/getcity/';
    CONST METHOD_USER_FORGOT_PASSWORD = '/forgotpassword/';
    
    CONST METHOD_LIST_MANAGE_LIST = '/manage/';
    CONST METHOD_LIST_ADD_NEW = '/addnew/';
    CONST METHOD_LIST_USER_LIST = '/userlist/';
    
    CONST METHOD_BUSINESS_MANAGE= '/manage/';
    
    
    //define view site master
    CONST SITE_MASTER = "siteMaster";
    
    //define view modules
    CONST MOD_HEADER = 'mod/modHeader';
    CONST MOD_RIGHT_CONTAINER = 'mod/modRightContainer';
    CONST MOD_FOOTER = 'mod/modFooter';
    

    //define view component
    CONST COMPONENT_HOME = 'comp/home/compHome';
    CONST COMPONENT_SLIDER = 'comp/home/compSlider';
    CONST COMPONENT_USER_SIGNUP = 'comp/user/compSignup';
    CONST COMPONENT_USER_ACTIVATION = 'comp/user/compActivation';
    CONST COMPONENT_USER_LOGIN = 'comp/user/compLogin';
    CONST COMPONENT_USER_DASHBOARD = 'comp/user/compDashboard';
    CONST COMPONENT_USER_RIGHT_CONTAINER = 'comp/user/compUserRight';
    CONST COMPONENT_USER_EDIT_PROFILE = 'comp/user/compEditProfile';
    CONST COMPONENT_USER_CHANGE_PASSWORD = 'comp/user/compChangePassword';
    CONST COMPONENT_USER_FORGOT_PASSWORD = 'comp/user/compForgotPassword';
    
    CONST COMPONENT_MANAGE_LIST = 'comp/lists/compManageList';
    
    CONST COMPONENT_MANAGE_BUSINESS = 'comp/business/compManageBusiness';
    CONST COMPONENT_BUSINESS_DETAILS = 'comp/business/compBusinessDetails';
    

}
