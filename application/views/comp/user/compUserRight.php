<div class="mdlRight">

    <div class="itemList">
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
                        <a href="javascript:;" class="biz-name"><?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_FIRST_NAME].' '.$profile[DBConfig::TABLE_USER_INFO_ATT_USER_LAST_NAME]; ?></a>
                    </div>

                    <span class="review-count">
                        Member since :  <?php echo date("F j Y g:i a", $profile[DBConfig::TABLE_USER_ATT_USER_REGISTRATION_DATE]) ?>
                    </span>
                </div>
            </li>
        </ul>
        <br class="clearfix"/>
        <h4><i class="icon-info-sign"></i> User Menu</h4>  
        
        <div class="alert alert-warning customalert"><b><i class="icon-dashboard"></i> <a href="<?php echo base_url().SiteConfig::CONTROLLER_USER.SiteConfig::METHOD_USER_DASHBOARD ?>">Dashboard</a></b></div>
        <div class="alert alert-warning customalert"><b><i class="icon-edit-sign"></i> <a href="<?php echo base_url().SiteConfig::CONTROLLER_USER.SiteConfig::METHOD_USER_EDIT_PROFILE ?>">Edit Profile</a></b></div>
        <div class="alert alert-warning customalert"><b><i class="icon-list"></i> <a href="<?php echo base_url().SiteConfig::CONTROLLER_LIST.SiteConfig::METHOD_LIST_MANAGE_LIST ?>">Manage Lists</a></b></div>
        <div class="alert alert-warning customalert"><b><i class="icon-list-alt"></i> <a href="<?php echo base_url().SiteConfig::CONTROLLER_BUSINESS.SiteConfig::METHOD_BUSINESS_MANAGE ?>">Manage List Items</a></b></div>
        <div class="alert alert-warning customalert"><b><i class="icon-edit-sign"></i> <a href="<?php echo base_url().SiteConfig::CONTROLLER_USER.SiteConfig::METHOD_USER_CHANGE_PASSWORD ?>">Change Password</a></b></div>
        <div class="alert alert-danger customalert"><b><i class="icon-remove-circle"></i> <a href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGOUT; ?>">Logout</a></b></div>
    </div>    
</div>