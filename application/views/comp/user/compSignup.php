<div class="mLeftContainer">
    <div class="recentActivity">
        <div class="arrow">&nbsp;</div>                       
        <h3 class="title" style="margin-top: -12px;"><i class="icon-key"></i> User Registration</h3><br clear="all"/>
        <span id="titleDes">Connect with great local businesses</span>
        <hr/>

        <?php 
        if($this->session->userdata('successMsg')){
        ?>
        <div class="alert alert-success">
            <?php echo $this->session->userdata('successMsg') ?>
        </div>
        <?php
        }
        $sess['successMsg'] = FALSE;
        $this->session->unset_userdata($sess);
        ?>

        <form id="registration" action="<?php echo current_url() ?>" method="POST" autocomplete="off">
            <table style="width: 100%">
                <tr>
                    <td style="width:180px;">First Name</td>
                    <td><input type="text" name="first-name" placeholder="First Name"/></td>
                    <td><span class="required"><?php echo form_error('first-name') ?></span></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type="text" name="last-name" placeholder="Last Name"/></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Email Address</td>
                    <td><input type="text" name="email" placeholder="Email"/></td>
                    <td><span class="required"><?php echo form_error('email') ?></span></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="Password"/></td>
                    <td><span class="required"><?php echo form_error('password') ?></span></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="con-password" placeholder="Confirm Password"/></td>
                    <td><span class="required"><?php echo form_error('con-password') ?></span></td>
                </tr>
                <tr>
                    <td>Zip Code</td>
                    <td><input type="text" name="zip" placeholder="Zip"/></td>
                    <td><span class="required"><?php echo form_error('zip') ?></span></td>
                </tr>
                <tr>
                    <td>Birthday</td>
                    <td>
                        <select name="month">
                            <option value="">Month</option>
                            <?php
                            $months = allmonth();
                            foreach ($months as $key => $month) {
                                echo '<option value="' . $month . '">' . $month . '</option>';
                            }
                            ?>
                        </select>
                        <select name="day">
                            <option value="">Day</option>
                            <?php
                            foreach (range('1', '30') as $day) {
                                echo '<option value="' . $day . '">' . $day . '</option>';
                            }
                            ?>
                        </select>
                        <select name="year">
                            <option value="">Year</option>
                            <?php
                            foreach (range(date("Y"), '1945') as $day) {
                                echo '<option value="' . $day . '">' . $day . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                    <td><span class="required"><?php echo form_error('month') ?> <?php echo form_error('day') ?> <?php echo form_error('year') ?></span></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input class="btn btn-info" type="submit" name="submit" value="Submit"/>
                        <input class="btn btn-default" type="reset" name="reset" value="Reset"/>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><a href="<?php echo base_url().SiteConfig::CONTROLLER_USER.SiteConfig::METHOD_USER_LOGIN; ?>"><i class="icon-lock"></i> <b>Already registered click here for Login</b></a></td>
                </tr>
            </table>
        </form>
    </div>
</div>
