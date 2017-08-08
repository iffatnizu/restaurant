<div class="mLeftContainer">
    <div class="recentActivity">
        <div class="arrow">&nbsp;</div>                       
        <h3 class="title" style="margin-top: -12px;"><i class="icon-list"></i> Manage Business List</h3><br clear="all"/>
        <span id="titleDes">Manage your business lists </span>
        <hr/>

        <?php
        if ($this->session->userdata('success')) {
            ?>
            <div class="alert alert-success">
                <i class="icon-ok-sign"></i> Business successfully added 
            </div>
            <?php
        }
        $sess['success'] = FALSE;
        $this->session->unset_userdata($sess);
        ?>

        <div class="ajax-content">

        </div>

        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a onclick="loadBusinessList()" href="#home" data-toggle="tab">All Lists</a></li>
            <li><a href="#addnew" data-toggle="tab">Create New</a></li>

        </ul>

        <?php
        //debugPrint($profile);
        ?>
        <div class="tab-content">
            <div class="tab-pane active" id="home">
                <div class="panel panel-default" style="margin-top: 2px;">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><i class="icon-list"></i> My lists</div>

                    <!-- Table -->
                    <table class="table">

                        <thead>
                            <tr>
                                <td>List Name</td>
                                <td>Added Date</td>
                            </tr>
                        </thead>
                        <tbody id="myLists">

                        </tbody>
                    </table>

                </div>
            </div>
            <div class="tab-pane" id="addnew">

                <div class="panel panel-default" style="margin-top: 2px;">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><i class="icon-step-forward"></i> Add new item </div>

                    <!-- Table -->
                    <form id="newList" action="<?php echo current_url() ?>" method="post" enctype="multipart/form-data">
                        <table class="table">
                            <tr>
                                <td style="width: 160px;">Business Title</td>
                                <td><input type="text" name="business-name" placeholder="Business Title"/></td>
                                <td><span class="error"><?php echo form_error('business-name'); ?></span></td>
                            </tr>
                            <tr>
                                <td>Business List</td>
                                <td>
                                    <select name="list-id">
                                        <option value="">-Please select-</option>
                                        <?php
                                        foreach ($lists as $list) {
                                            echo '<option value="' . $list[DBConfig::TABLE_LIST_ATT_LIST_ID] . '">' . $list[DBConfig::TABLE_LIST_ATT_LIST_NAME] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><span class="error"><?php echo form_error('list-id'); ?></span></td>
                            </tr>
                            <tr>
                                <td>Business Category</td>
                                <td>
                                    <select name="business-category" onchange="getSubcategory(this.value)">
                                        <option value="">-Please select-</option>
                                        <?php
                                        foreach ($category as $cat) {
                                            echo '<option value="' . $cat[DBConfig::TABLE_BUSINESS_CATEGORY_ATT_CATEGORY_ID] . '"> ' . $cat[DBConfig::TABLE_BUSINESS_CATEGORY_ATT_CATEGORY_NAME] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><span class="error"><?php echo form_error('business-category'); ?></span></td>
                            </tr>
                            <tr id="subcatlist" style="display: none;">
                                <td>Business Sub Category</td>
                                <td id="sub-category">

                                </td>
                                <td><span class="error"></span></td>
                            </tr>
                            <tr>
                                <td>Business Description</td>
                                <td>
                                    <textarea name="description"></textarea>
                                </td>
                                <td><span class="error"><?php echo form_error('description'); ?></span></td>
                            </tr>
                            <tr>
                                <td>Business Photo</td>
                                <td>
                                    <input type="file" name="userfile_1" style="float: left;"/> <small style="float: left;">[Required]</small><br class="clearfix"/>
                                    <input type="file" name="userfile_2"/>
                                    <input type="file" name="userfile_3"/>
                                    <input type="file" name="userfile_4"/>
                                    <input type="file" name="userfile_5"/>

                                </td>
                                <td>
                                    <span class="error">
                                        <?php
                                        if ($this->session->userdata('error')) {
                                            echo 'Upload atleast one image';
                                        }
                                        $ie['error'] = FALSE;
                                        $this->session->unset_userdata($ie);
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Business Website</td>
                                <td><input type="text" name="business-website" placeholder="Business Website"/></td>
                                <td><span class="error"></span></td>
                            </tr>
                            <tr>
                                <td>Business About</td>
                                <td>
                                    <textarea name="about"></textarea>
                                </td>
                                <td><span class="error"><?php echo form_error('about'); ?></span></td>
                            </tr>
                            <tr>
                                <td>Business Reservation Status</td>
                                <td>
                                    <input type="radio" name="brs" value="1" /> Yes
                                    <input type="radio" name="brs" value="0" checked="checked" /> No
                                </td>
                                <td><span class="error"><?php echo form_error('brs'); ?></span></td>
                            </tr>

                            <tr>
                                <td>Business Menu Status</td>
                                <td>
                                    <input type="radio" name="bms" value="1" onclick="AddMenu()"/> Yes
                                    <input type="radio" name="bms" value="0" checked="checked" onclick="removeMenu()"/> No
                                </td>
                                <td><span class="error"><?php echo form_error('brs'); ?></span></td>
                            </tr>

                            <tr id="menu-status" style="display: none;">
                                <td>Business Add Menu</td>
                                <td id="menu-list">
                                    <input type="button" name="admore" value="Add More" class="btn btn-default" style="position: absolute; margin-left:300px;" onclick="AddMenu()"/>
                                </td>
                            </tr>
<!--                            <tr id="reservation" style="display: none;">
                            <script>
                                $(function() {
                                    $("#datepicker").datepicker({
                                        showOn: "button",
                                        buttonImage: "<?php echo base_url() ?>assets/images/calendar.gif",
                                        buttonImageOnly: true
                                    });
                                    $("#datepicker2").datepicker({
                                        showOn: "button",
                                        buttonImage: "<?php echo base_url() ?>assets/images/calendar.gif",
                                        buttonImageOnly: true
                                    });
                                });
                            </script>
                            <td>Business Reservation Date</td>
                            <td>
                                <input style="width: 100px;" type="text" id="datepicker" /> To
                                <input style="width: 100px;" type="text" id="datepicker2" />
                            </td>
                            <td><span class="error"></span></td>
                            </tr>-->
                            <tr>
                                <td>Business Attribute</td>
                                <td id="attribute">
                                    <input style="width: 100px;" type="text" name="attribute-title[1]" placeholder="Title"/>
                                    <input style="width: 100px;" type="text" name="attribute-value[1]" placeholder="Value"/><br class="clearfix"/>

                                    <input style="width: 100px;" type="text" name="attribute-title[2]" placeholder="Title"/>
                                    <input style="width: 100px;" type="text" name="attribute-value[2]" placeholder="Value"/>

                                    <input class="btn btn-default" type="button" name="attribute" value="Add" onclick="addNewAtrribute()"/><br class="clearfix"/>
                                </td>
                                <td><span class="error"><?php echo form_error('attribute-title[]'); ?><?php echo form_error('attribute-value[]'); ?></span></td>
                            </tr>
                            <tr>
                                <td>Business State</td>
                                <td>
                                    <select name="state" onchange="getCityByState(this.value)">
                                        <option value="">-Please select-</option>
                                        <?php
                                        foreach ($states as $state) {
                                            echo '<option value="' . $state[DBConfig::TABLE_STATES_ATT_STATE_SHORT_NAME] . '">' . $state[DBConfig::TABLE_STATES_ATT_STATE_NAME] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><span class="error"><?php echo form_error('state'); ?></span></td>
                            </tr>
                            <tr>
                                <td>Business City</td>
                                <td>
                                    <select name="city">
                                        <option value="">-Please select-</option>
                                    </select>
                                </td>
                                <td><span class="error"><?php echo form_error('city'); ?></span></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><input class="btn btn-info" type="submit" name="submit" value="Add"/></td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </form>
                </div>

            </div>
        </div>

        <script>
            $(function() {
                $('#myTab a[href="#addnew"]').tab('show')
            })
        </script>



    </div>
</div>
