<div id=main role=main>
    <div id=main-content>
        <h1>Site FAQ information</h1>

        <div class=grid_12>
            <div class=block-border>
                <div class=block-content>
                    <p style="font-size: 13px;color: green;font-weight: bold;" id="msg">
                        <?php
                        if ($this->session->userdata('_success')) {
                            echo 'FAQ Info Successfully Inserted';
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
                                    <td>FAQ Question</td>
                                    <td><input type="text" name="Question" value=""/> <?php echo form_error('Question'); ?></td>
                                </tr>
                                <tr>
                                    <td>FAQ Answer</td>
                                    <td><textarea style="width: 350px;height: 200px" name="Answer"></textarea>  <?php echo form_error('Answer'); ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><input type="submit" value="Update" name="insertFaq" class="btn btn-danger"/></td>
                                </tr>
                            </table>


                        </form>
                    </div>
                    <div style="float: right;width: 500px;font-size: 11px">
                        <script type="text/javascript">
                            $(document).ready(function(){
                                // FAQ Code
                                $('#faqs h5').each(function() {
                                    var tis = $(this), state = false, answer = tis.next('div').hide().css('height','auto').slideUp();
                                    tis.prepend("<span>+</span> ")
                                    tis.click(function() {
                                        state = !state;
                                        answer.slideToggle(state);
                                        tis.toggleClass('active',state);
                                        if(tis.hasClass('active')) {
                                            tis.find('span').text('-');
                                        } else {
                                            tis.find('span').text('+');
                                        }
                                    });
                                }); // end each faqs
                            })
                        </script>
                        <div id="faqs"><!-- dont remove this id faqs -->
                            <p>Previous FAQ</p>
                            <?php
                            if (!empty($faq)) {
                                foreach ($faq as $value) {
                                    ?>
                            <h5><?php echo $value[DBConfig::TABLE_FAQ_ATT_FAQ_QUESTION]; ?><a onclick="return confirm('Are you sure ?');" style="float: right;" href="<?php echo site_url(Adminconfig::CONTROLLER_ADMINISTRATOR.Adminconfig::METHOD_ADMINISTRATOR_DELETE_FAQ.$value[DBConfig::TABLE_FAQ_ATT_FAQ_ID]); ?>">Delete</a></h5>
                                    <div>
                                        <p style="font-size: 12px;line-height: normal;"><?php echo $value[DBConfig::TABLE_FAQ_ATT_FAQ_ANSWER]; ?></p>
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
