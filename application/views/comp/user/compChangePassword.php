<div class="mLeftContainer">
    <div class="recentActivity">
        <div class="arrow">&nbsp;</div>                       
        <h3 class="title" style="margin-top: -12px;"><i class="icon-edit-sign"></i> Change Password</h3><br clear="all"/>
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

        

        <form id="registration" action="<?php echo current_url() ?>" method="POST" autocomplete="off">
            <table style="width: 100%">
                <tr>
                    <td style="width:180px;">New Password</td>
                    <td><input type="password" name="new-password" placeholder="New Password" value=""/></td>
                    <td><span class="required"><?php echo form_error('new-password') ?></span></td>
                </tr>
                
                <tr>
                    <td>Confirm New Password</td>
                    <td><input type="password" name="connew-password" placeholder="Confirm New Password" value=""/></td>
                    <td><span class="required"><?php echo form_error('connew-password') ?></span></td>
                </tr>
                
                <tr>
                    <td>Old Password</td>
                    <td><input type="password" name="old-password" placeholder="Old Password" value=""/></td>
                    <td><span class="required"><?php echo form_error('old-password') ?></span></td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input class="btn btn-info" type="submit" name="submit" value="Change"/>

                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
