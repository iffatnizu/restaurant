<div class="header">
    <div class="headerTop">

        <?php
        if (!$this->session->userdata('_userLogin')) {
            ?>
            <a href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_SIGN_UP; ?>" class="login">Registration <img alt="login" src="<?php echo base_url(); ?>assets/css/restaurant/images/arrow_login.png"/></a>
            <a href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN; ?>" class="login">Login <img alt="login" src="<?php echo base_url(); ?>assets/css/restaurant/images/arrow_login.png"/></a>
            <?php
        } else {
            
            ?>
            
            <a href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGOUT; ?>" class="login">Logout <img alt="login" src="<?php echo base_url(); ?>assets/css/restaurant/images/arrow_login.png"/></a>
            <a href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_DASHBOARD; ?>" class="login">Dashboard <img alt="login" src="<?php echo base_url(); ?>assets/css/restaurant/images/arrow_login.png"/></a>
            <?php
            }
            ?>
        <a href="#" class="lang">US (EN)</a>
    </div>
    <div class="headerBtm">
        <div class="headerBtmLeft">
            <a href="<?php echo base_url(); ?>"> <img alt="logo" src="<?php echo base_url(); ?>assets/css/restaurant/images/logo.png"/> </a>
        </div>
        <div class="headerBtmRight">
            <form>
                <input type="text" name="" class="search" placeholder="Search"/>
                <input type="text" name="" class="near" placeholder="Near"/>
                <input type="image" class="submitBtn" src="<?php echo base_url(); ?>assets/css/restaurant/images/btn_search.png"/>
            </form>
            <br clear="all"/>
            <ul class="cities">
                <li><a href="#">Reno</a></li>
                <li><a href="#">San Francisco</a></li>
                <li><a href="#">New York</a></li>
                <li><a href="#">San Jose</a></li>
                <li><a href="#">Los Angeles</a></li>
                <li><a href="#">Chicago</a></li>
                <li><a href="#">More Cities >></a></li>
            </ul>
        </div>
    </div>
</div>

<div class="navigation">
    <ul class="mainNav">
        <li class="l1"><img alt="*" src="<?php echo base_url(); ?>assets/css/restaurant/images/circle.png"/></li>
        <li class="home"><a href="<?php echo base_url(); ?>"><img alt="home" src="<?php echo base_url(); ?>assets/css/restaurant/images/home.png"/> Home</a></li>
        <li><a href="#">About me </a></li>
        <li><a href="#">Write a Review </a></li>
        <li><a href="#">Find Friends </a></li>
        <li><a href="#">Messages</a></li>
        <li><a href="#">Talk</a></li>
        <li><a href="#">Events</a></li>
    </ul>
</div>