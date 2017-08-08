<div class="mLeftContainer">
    <div class="recentActivity">
        <div class="arrow">&nbsp;</div>                       
        <h3 class="title" style="margin-top: -12px;"><i class="icon-key"></i> User Login</h3><br clear="all"/>
        <span id="titleDes">Connect with great local businesses</span>
        <hr/>

        <?php 
        if($this->session->userdata('invalidMsg')){
        ?>
        <div class="alert alert-danger">
            <i class="icon-remove"></i> <?php echo $this->session->userdata('invalidMsg') ?>
        </div>
        <?php
        }
        $sess['invalidMsg'] = FALSE;
        $this->session->unset_userdata($sess);
        ?>

        <form id="login" action="<?php echo current_url() ?>" method="POST" autocomplete="off">
            <table style="width: 100%">
                
                <tr>
                    <td>Email Address</td>
                    <td><input type="text" name="email" placeholder="Email" autocomplete="off"/></td>
                    <td><span class="required"><?php echo form_error('email') ?></span></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="Password"/></td>
                    <td><span class="required"><?php echo form_error('password') ?></span></td>
                </tr>
                
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input class="btn btn-info" type="submit" name="login" value="Login"/>
                        
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><a style="color: #FFA100" href="<?php echo base_url().SiteConfig::CONTROLLER_USER.SiteConfig::METHOD_USER_FORGOT_PASSWORD; ?>"><i class="icon-key"></i> <b>If you forgot your password click here</b></a><br/> <a href="<?php echo base_url().SiteConfig::CONTROLLER_USER.SiteConfig::METHOD_USER_SIGN_UP; ?>"><i class="icon-key"></i> <b>Sign up for new account</b></a></td>
                </tr>
            </table>
        </form>
    </div>
</div>
