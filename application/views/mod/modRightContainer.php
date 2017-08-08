<div class="mdlRight">

    <?php
    if ($this->session->userdata('_userLogin')) {
        ?>
        <div class="itemList" style="margin-bottom: 15px;">
            <div class="itemHeader">
                <h3><i class="icon-info-sign"></i> <?php echo $this->session->userdata('_userDisplayName'); ?>'s Profile</h3>                           

            </div>

            <ul class="listItem">
                <li>
                    <div class="media-avatar">
                        <a href="javascript:;">
                            <?php
                            if ($profile[DBConfig::TABLE_USER_INFO_ATT_USER_PROFILE_PIC] == true) {
                                echo '<img src="' . base_url() . 'assets/public/profile/' . $profile[DBConfig::TABLE_USER_INFO_ATT_USER_PROFILE_PIC] . '" alt="pro" width="60" height="60"/>';
                            } else {
                                echo '<img src="' . base_url() . 'assets/public/profile/not-found.jpg" alt="pro" width="60" height="60"/>';
                            }
                            ?>
                        </a>
                    </div>
                    <div class="media-story">
                        <div class="media-title">	
                            <a href="javascript:;" class="biz-name"><?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_FIRST_NAME] . ' ' . $profile[DBConfig::TABLE_USER_INFO_ATT_USER_LAST_NAME]; ?></a>
                        </div>

                        <span class="review-count">
                            Member since :  <?php echo date("F j Y g:i a", $profile[DBConfig::TABLE_USER_ATT_USER_REGISTRATION_DATE]) ?>
                        </span>
                    </div>
                </li>
            </ul>
            <br class="clearfix"/>
            <h4><i class="icon-info-sign"></i> User Menu</h4>  

            <div class="alert alert-warning customalert"><b><i class="icon-dashboard"></i> <a href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_DASHBOARD ?>">Dashboard</a></b></div>
            <div class="alert alert-warning customalert"><b><i class="icon-edit-sign"></i> <a href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_EDIT_PROFILE ?>">Edit Profile</a></b></div>
            <div class="alert alert-warning customalert"><b><i class="icon-edit-sign"></i> <a href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_CHANGE_PASSWORD ?>">Change Password</a></b></div>
            <div class="alert alert-danger customalert"><b><i class="icon-remove-circle"></i> <a href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGOUT; ?>">Logout</a></b></div>
        </div>  

        <div class="border">&nbsp;</div>
        <br class="clearfix"/>
        <?php
    }
    ?>

    <div class="itemList" style="margin-bottom: 15px;">
        <div class="itemHeader">
            <h3><i class="icon-step-forward"></i> Getting Started </h3>                           

        </div>

        <br class="clearfix"/>


        <div class="alert alert-info customalert"><b><i class="icon-pencil"></i> <a href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_SIGN_UP ?>">Sign up for new account </a></b></div>
        
        <div class="alert alert-success customalert"><b><i class="icon-lock"></i> <a href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN; ?>">Already registered ? please login to continue</a></b></div>
    </div>  

    <div class="border">&nbsp;</div>
    <br class="clearfix"/>
    <div class="itemList">
        <div class="itemHeader">
            <h3><i class="icon-truck"></i> Popular Event</h3>                           
            <span><a href="#">See More </a></span>
        </div>

        <ul class="listItem">

            <?php
            for ($i = 0; $i <= 1; $i++) {
                ?>

                <li>
                    <div class="media-avatar">
                        <a href="#">
                            <img width="60" height="60" src="<?php echo base_url(); ?>assets/images/61s.jpg" class="photo-box-img" alt="Kokkari Estiatorio">
                        </a>
                    </div>
                    <div class="media-story">
                        <div class="media-title">	
                            <a href="#" class="biz-name">Kokkari Estiatorio</a>
                        </div>

                        <span class="review-count">
                            Sunday, Nov 10, 5:30 pm – 7:30 pm 
                        </span>
                        <div class="interested">
                            244 are interested 
                        </div>
                    </div>


                </li>

                <?php
            }
            ?>


            <!---LI-->
        </ul>
    </div>

    <div class="border">&nbsp;</div>

    <div class="itemList">
        <div class="itemHeader" style="float: left;">
            <h3><i class="icon-list"></i> Fresh List</h3>                           
            <span><a href="#">See More </a></span>
        </div>


        <ul class="listItem">

            <?php
            for ($i = 0; $i <= 1; $i++) {
                ?>

                <li>
                    <div class="media-avatar">
                        <a href="#">
                            <img width="60" height="60" src="<?php echo base_url(); ?>assets/images/62s.jpg" class="photo-box-img" alt="Kokkari Estiatorio">
                        </a>
                    </div>
                    <div class="media-story">
                        <div class="media-title">	
                            <a href="#" class="biz-name">Kokkari Estiatorio</a>
                        </div>
                        <span class="review-count">
                            Sunday, Nov 10, 5:30 pm – 7:30 pm 
                        </span>

                    </div>


                </li>

                <?php
            }
            ?>



            <!---LI-->
        </ul>
    </div>
</div>