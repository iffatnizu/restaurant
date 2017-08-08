<div class="mLeftContainer">
    <div class="recentActivity">
        <div class="arrow">&nbsp;</div>                       
        <h3 class="title" style="margin-top: -12px;"><i class="icon-edit-sign"></i> Forgot Password</h3><br clear="all"/>
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
                    <td style="width:180px;">E-mail Address</td>
                    <td><input type="text" name="email" placeholder="E-mail address" value=""/></td>
                    <td><span class="required"><?php echo form_error('email') ?></span></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input class="btn btn-info" type="submit" name="submit" value="Retrive password"/>

                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
