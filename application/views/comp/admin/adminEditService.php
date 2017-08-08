<div id=main role=main>
    <div id=main-content>

        <?php
        if ($this->session->userdata('_success')) {
            echo '<p style="text-indent:12px;" class="btn-success">Service successfully updated</p>';
        }
        $session['_success'] = false;
        $this->session->unset_userdata($session);
        ?>

        <h1>Edit Service <a href="<?php echo base_url().Adminconfig::CONTROLLER_ADMINISTRATOR.Adminconfig::METHOD_ADMINISTRATOR_VIEW_SERVICE ?>" class="btn btn-danger" style="float: right">View All</a></h1>



        <form action="<?php echo current_url() ?>" method="POST" enctype="multipart/form-data">
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
                                <td valign="top">Service Title</td>
                                <td><input type="text" name="serTitle" value="<?php echo $details[DBConfig::TABLE_SERVICE_ATT_SERVICE_NAME] ?>"/> <?php echo form_error('serTitle'); ?></td>
                            </tr>
                            <tr>
                                <td>Service Details</td>
                                <td><textarea name="serDetails"><?php echo $details[DBConfig::TABLE_SERVICE_ATT_SERVICE_DETAILS] ?></textarea>  <?php echo form_error('serDetails'); ?></td>
                            </tr>
                            <script type="text/javascript">
                                CKEDITOR.replace('serDetails');
                            </script>
                            <tr>
                                <td valign="top">Upload Image</td>
                                <td>
                                    <?php
                                    if($details[DBConfig::TABLE_SERVICE_ATT_SERVICE_IMAGE]==true){
                                    ?>
                                    <img src="<?php echo base_url() ?>assets/public/site/<?php echo $details[DBConfig::TABLE_SERVICE_ATT_SERVICE_IMAGE] ?>" width="120" height="120" alt=""/>
                                    <?php                                    
                                    }
                                    ?>
                                    <br/>
                                    
                                    <input type="file" name="userfile" style="height: 25px;"/>

                                    <?php
                                    if ($this->session->userdata('_errorUpload')) {
                                        echo '<p style="text-indent:12px;color:red;">Image Required</p>';
                                    }
                                    $er['_errorUpload'] = false;
                                    $this->session->unset_userdata($er);
                                    ?>
                                </td>
                            </tr>


                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="submit" name="submit" value="add" class="btn btn-danger"/></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
