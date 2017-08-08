<div id=main role=main>
    <div id=main-content>
        <h1>Service List</h1>

        <div class=grid_12>
            <div class=block-border>
                <div class=block-content>
                    <p style="font-size: 13px;color: green;font-weight: bold;" id="msg">
                        <?php
                        if ($this->session->userdata('_success')) {
                            echo 'Service Successfully Inserted';
                        }
                        $session['_success'] = FALSE;
                        $this->session->unset_userdata($session);
                        ?>
                    </p>

                    <?php
                    //debugPrint($content);
                    ?>

                    <div style="float: left;">

                        <form id="sitecontent" action="<?php echo current_url() ?>" method="POST">
                            <table>
                                <tr>
                                    <td>Service Name</td>
                                    <td><input type="text" name="service-name" value=""/> <?php echo form_error('service-name'); ?></td>
                                </tr>

                                <tr>
                                    <td>Service Details</td>
                                    <td><textarea name="service-details"></textarea>  <?php echo form_error('service-details'); ?></td>
                                </tr>
                                <script type="text/javascript">
                                    CKEDITOR.replace('service-details');
                                </script>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><input type="submit" value="Update" name="insertService" class="btn btn-danger"/></td>
                                </tr>
                            </table>


                        </form>
                    </div>
                    <br clear="all"/>
                    <div style="float: left;width: 500px;font-size: 11px">
                        <script type="text/javascript">
                            $(document).ready(function() {
                                // FAQ Code
                                $('#faqs h5').each(function() {
                                    var tis = $(this), state = false, answer = tis.next('div').hide().css('height', 'auto').slideUp();
                                    tis.prepend("<span>+</span> ")
                                    tis.click(function() {
                                        state = !state;
                                        answer.slideToggle(state);
                                        tis.toggleClass('active', state);
                                        if (tis.hasClass('active')) {
                                            tis.find('span').text('-');
                                        } else {
                                            tis.find('span').text('+');
                                        }
                                    });
                                }); // end each faqs
                            })
                        </script>
                        <?php
                        //debugPrint($service);
                        ?>
                        <div id="faqs"><!-- dont remove this id faqs -->
                            <p>Previous service list</p>
                            <?php
                            if (!empty($service)) {
                                foreach ($service as $value) {
                                    ?>
                                    <h5><?php echo $value[DBConfig::TABLE_SERVICE_LIST_ATT_SERVICE_LIST_NAME]; ?><a onclick="return confirm('Are you sure ?');" style="float: right;" href="<?php echo site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_DELETE_SERVICE . $value[DBConfig::TABLE_SERVICE_LIST_ATT_SERVICE_LIST_ID]); ?>">Delete</a></h5>
                                    <div>
                                        <p style="font-size: 12px;line-height: normal;"><?php echo $value[DBConfig::TABLE_SERVICE_DETAILS_ATT_SERVICE_DETAILS]; ?></p>
                                    </div><!-- end faq item -->
                                    <?php
                                }
                            }
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
