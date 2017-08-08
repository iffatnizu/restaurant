<div id=main role=main>
    <div id=main-content>

        <?php
        if ($this->session->userdata('_success')) {
            echo '<p style="text-indent:12px;" class="btn-success">Site information successfully updated</p>';
        }
        $session['_success'] = false;
        $this->session->unset_userdata($session);
        ?>

        <h1>Site Parameter : Add site information</h1>



        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <div class=grid_12>
                <div class=block-border>
                    <div class=block-content>
                        <style>
                            p{
                                font-size: 11px;
                                color: red;
                            }
                        </style>
                        <table>
                            <tr>
                                <td valign="top">Site Title</td>
                                <td><input type="text" name="siteTitle" value="<?php echo $details[DBConfig::TABLE_SETTINGS_ATT_SITE_TITLE]; ?>"/> <?php echo form_error('siteTitle'); ?></td>
                            </tr>
                            <tr>
                                <td valign="top">Site Meta Keyword</td>
                                <td><input type="text" name="siteMetaKeyword" value="<?php echo $details[DBConfig::TABLE_SETTINGS_ATT_SITE_META_KEYWORD]; ?>"/> <?php echo form_error('siteMetaKeyword'); ?></td>
                            </tr>
                            <tr>
                                <td valign="top">Site Meta Description</td>
                                <td><textarea name="siteMetaDescription" style="width: 350px;height: 75px;"><?php echo $details[DBConfig::TABLE_SETTINGS_ATT_SITE_META_DESCRIPTION]; ?></textarea> <?php echo form_error('siteMetaKeyword'); ?></td>
                            </tr>
                            <tr>
                                <td valign="top">Site Logo</td>
                                <td>
                                    <?php
                                    if ($details[DBConfig::TABLE_SETTINGS_ATT_SITE_LOGO] == true) {
                                        ?>
                                        <img src="<?php echo base_url() ?>/assets/public/site/<?php echo $details[DBConfig::TABLE_SETTINGS_ATT_SITE_LOGO] ?>" alt="logo"/>
                                        <br/>
                                        <?php
                                    }
                                    ?>
                                    <input type="file" name="userfile" style="height: 25px;"/>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">Site Email</td>
                                <td><input type="text" name="siteEmail" value="<?php echo $details[DBConfig::TABLE_SETTINGS_ATT_SITE_EMAIL]; ?>"/> <?php echo form_error('siteEmail'); ?></td>
                            </tr>
                            <tr>
                                <td valign="top">Site Phone</td>
                                <td><input type="text" name="sitePhone" value="<?php echo $details[DBConfig::TABLE_SETTINGS_ATT_SITE_PHONE]; ?>"/> <?php echo form_error('sitePhone'); ?></td>
                            </tr>
                            
                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="submit" name="submit" value="Update" class="btn btn-danger"/></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
