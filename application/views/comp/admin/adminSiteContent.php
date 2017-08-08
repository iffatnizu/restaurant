<div id=main role=main>
    <div id=main-content>
        <h1>Site <?php echo $contentTitle ?> : <?php echo $contentTitle ?> information</h1>

        <div class=grid_12>
            <div class=block-border>
                <div class=block-content>
                    <p style="font-size: 13px;color: green;font-weight: bold;" id="msg">
                        <?php
                        if ($this->session->userdata('_success')) {
                            echo $contentTitle.' Info Successfully Updated';
                        }
                        $session['_success'] = FALSE;
                        $this->session->unset_userdata($session);
                        ?>
                    </p>
                    
                    <?php
                    //debugPrint($content);
                    if(empty ($content))
                    {
                        $content[Dbconfig::TABLE_CONTENT_ATT_CONTENT_TITLE] = "";
                        $content[Dbconfig::TABLE_CONTENT_ATT_CONTENT_DETAILS] = "";
                    }
                    ?>

                    <div>
                        <script type="text/javascript">
                            window.onload = function() {
                                CKEDITOR.replace('editor1');
                            };
                        </script>

                        <form id="sitecontent" action="<?php echo current_url() ?>" method="POST">
                            <input type="hidden" name="contentName" value="<?php echo $contentName; ?>"/>
                            <input type="hidden" name="currentUrl" value="<?php echo current_url() ?>"/>
                            <table>
                                <tr>
                                    <td>Title Text</td>
                                    <td><input type="text" name="title" value="<?php echo $content[Dbconfig::TABLE_CONTENT_ATT_CONTENT_TITLE]; ?>"/> <?php echo form_error('title'); ?></td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td><textarea name="editor1"><?php echo $content[Dbconfig::TABLE_CONTENT_ATT_CONTENT_DETAILS]; ?></textarea>  <?php echo form_error('editor1'); ?></td>
                                </tr>
                                 <tr>
                                     <td>&nbsp;</td>
                                    <td><input type="submit" value="Update" name="updateInformation" class="btn btn-danger"/></td>
                                </tr>
                            </table>
                            
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
