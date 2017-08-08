<?php

function getListByUserId($userId)
{
    $CI = &get_instance();
    $CI->load->model('model_lists');
    return $CI->model_lists->getListByUserId($userId);
}
function getBusinessListByUserId($userId)
{
    $CI = &get_instance();
    $CI->load->model('model_business');
    return $CI->model_business->getBusinessListByUserId($userId);
}

