<div class="mLeftContainer">
    <div class="recentActivity">
        <div class="arrow">&nbsp;</div>                       
        <h3 class="title" style="margin-top: -12px;"><i class="icon-edit-sign"></i> Edit Profile</h3><br clear="all"/>
        <span id="titleDes">Edit Personal Info</span>
        <hr/>

        <?php
        //debugPrint($profile);
        if ($this->session->userdata('activeMsg')) {
            ?>
            
                <?php echo $this->session->userdata('activeMsg') ?>

            <?php
        }
        $sess['activeMsg'] = FALSE;
        $this->session->unset_userdata($sess);
        ?>



        <form id="registration" enctype="multipart/form-data" action="<?php echo current_url() ?>" method="POST" autocomplete="off">
            <table style="width: 100%">
                <tr>
                    <td style="width:180px;">First Name</td>
                    <td><input type="text" name="first-name" placeholder="First Name" value="<?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_FIRST_NAME] ?>"/></td>
                    <td><span class="required"><?php echo form_error('first-name') ?></span></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type="text" name="last-name" placeholder="Last Name" value="<?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_LAST_NAME] ?>"/></td>
                    <td></td>
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
                        <input type="file" name="userfile"/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Zip Code</td>
                    <td><input type="text" name="zip" placeholder="Zip" value="<?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_ZIP_CODE] ?>"/></td>
                    <td><span class="required"><?php echo form_error('zip') ?></span></td>
                </tr>
                <tr>
                    <td>State</td>
                    <td>
                        <select style="width: 250px;" name="state" onchange="getCityByState(this.value)">
                            <option value="">-Please Select-</option>
                            <?php
                            foreach ($states as $state) {
                                
                                $selected ="";
                                
                                if($profile[DBConfig::TABLE_USER_INFO_ATT_USER_STATE_ID]==$state[DBConfig::TABLE_STATES_ATT_STATE_SHORT_NAME])
                                {
                                    $selected ='selected="selected"';
                                }
                                
                                echo '<option '.$selected.' value="' . $state[DBConfig::TABLE_STATES_ATT_STATE_SHORT_NAME] . '">' . $state[DBConfig::TABLE_STATES_ATT_STATE_NAME] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                    <td><span class="required"><?php echo form_error('state') ?></span></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>
                        <select style="width: 250px;" name="city">
                            <option value="">-Please Select-</option>
                            <?php
                            foreach($profile['statecity'] as $city)
                            {
                                $selected ="";
                                
                                if($profile[DBConfig::TABLE_USER_INFO_ATT_USER_CITY_ID]==$city[DBConfig::TABLE_CITY_ATT_CITY_ID])
                                {
                                    $selected ='selected="selected"';
                                }
                                
                                echo '<option '.$selected.' value="' . $city[DBConfig::TABLE_CITY_ATT_CITY_ID] . '">' . $city[DBConfig::TABLE_CITY_ATT_CITY_NAME] . '</option>';
                            }
                            
                            ?>
                        </select>
                    </td>
                    <td><span class="required"><?php echo form_error('city') ?></span></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><textarea name="address"><?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_ADDRESS] ?></textarea></td>
                    <td><span class="required"><?php echo form_error('address') ?></span></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><input type="text" name="phone" placeholder="phone" value="<?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_PHONE] ?>"/></td>
                    <td><span class="required"><?php echo form_error('phone') ?></span></td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input class="btn btn-info" type="submit" name="submit" value="Update"/>

                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
