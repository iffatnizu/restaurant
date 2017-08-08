<div class="mLeftContainer">
    <div class="recentActivity">
        <div class="arrow">&nbsp;</div>                       
        <h3 class="title" style="margin-top: -12px;"><i class="icon-dashboard"></i> User Dashboard</h3><br clear="all"/>
        <span id="titleDes">Manage your personal info</span>
        <hr/>

        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#home" data-toggle="tab">Statistics</a></li>
            <li><a href="#profile" data-toggle="tab">Profile</a></li>
            <li class="dropdown active">
                <a data-toggle="dropdown" class="dropdown-toggle" id="myTabDrop1" href="#">Settings <b class="caret"></b></a>
                <ul aria-labelledby="myTabDrop1" role="menu" class="dropdown-menu">
                    <li class="active"><a tabindex="-1" href="<?php echo base_url().SiteConfig::CONTROLLER_USER.SiteConfig::METHOD_USER_EDIT_PROFILE ?>">Edit Profile</a></li>
                    <li class=""><a tabindex="-1" href="<?php echo base_url().SiteConfig::CONTROLLER_USER.SiteConfig::METHOD_USER_CHANGE_PASSWORD ?>">Change Password</a></li>
                </ul>
            </li>
            <li><a href="#messages" data-toggle="tab">Messages</a></li>
            
        </ul>

        <?php
        //debugPrint($profile);
        ?>
        <div class="tab-content">
            <div class="tab-pane active" id="home">
                User statistics
            </div>
            <div class="tab-pane" id="profile">
                <div class="panel panel-default" style="margin-top: 2px;">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><i class="icon-search"></i> View Profile</div>

                    <!-- Table -->
                    <table class="table">
                        <tr>
                            <td>First Name</td>
                            <td><?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_FIRST_NAME] ?></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_LAST_NAME] ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $profile[DBConfig::TABLE_USER_ATT_USER_EMAIL_ADDRESS] ?></td>
                        </tr>
                        <tr>
                            <td>Date of Birth</td>
                            <td><?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_DOB] ?></td>
                        </tr>
                        <tr>
                            <td>Profile Picture</td>
                            <td>
                                <?php
                                if ($profile[DBConfig::TABLE_USER_INFO_ATT_USER_PROFILE_PIC] == true) {
                                    echo '<img src="' . base_url() . 'assets/public/profile/' . $profile[DBConfig::TABLE_USER_INFO_ATT_USER_PROFILE_PIC] . '" alt="pro" width="120" height="120"/>';
                                } else {
                                    echo '<img src="' . base_url() . 'assets/public/profile/not-found.jpg" alt="pro" width="120" height="120"/>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Zip Code</td>
                            <td><?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_ZIP_CODE] ?></td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td>
                                <?php 
                                if(!empty($profile['stateinfo']))
                                {
                                    echo $profile['stateinfo'];
                                }
                                else
                                {
                                    echo '<a href="'.  base_url().SiteConfig::CONTROLLER_USER.SiteConfig::METHOD_USER_EDIT_PROFILE.'">Please set your state</a>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>
                                <?php 
                                if(!empty($profile['cityinfo']))
                                {
                                    echo $profile['cityinfo'];
                                }
                                else
                                {
                                    echo '<a href="'.  base_url().SiteConfig::CONTROLLER_USER.SiteConfig::METHOD_USER_EDIT_PROFILE.'">Please set your state</a>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_ADDRESS] ?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_PHONE] ?></td>
                        </tr>
                        <tr>
                            <td>Member since</td>
                            <td><?php echo date("F j Y g:i a", $profile[DBConfig::TABLE_USER_ATT_USER_REGISTRATION_DATE]) ?></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a href="<?php echo base_url().SiteConfig::CONTROLLER_USER.SiteConfig::METHOD_USER_EDIT_PROFILE ?>" class="btn btn-warning">Edit Profile Information</a></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="messages">
                message
            </div>
            
        </div>

        <script>
            $(function() {
                $('#myTab a[href="#profile"]').tab('show')
            })
        </script>



    </div>
</div>
