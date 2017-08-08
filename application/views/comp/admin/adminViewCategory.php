<div id=main role=main>
    <div id=main-content>
        <h1><?php echo $title ?> <a href="<?php echo base_url().Adminconfig::CONTROLLER_ADMINISTRATOR.Adminconfig::METHOD_ADMINISTRATOR_MANAGE_CATEGORY ?>" class="btn btn-danger" style="float: right;">Add New</a></h1>


        <div class=grid_12>
            <div class=block-border>
                <div class=block-content>

                    <link href="<?php echo base_url() ?>scripts/plugins/datatable/css/demo_table_jui.css" rel="stylesheet" type="text/css"/>
                    <link href="<?php echo base_url() ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css"/>

                    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>scripts/plugins/datatable/js/jquery.js"></script>
                    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>scripts/plugins/datatable/js/jquery.dataTables.js"></script>
                    <script type="text/javascript" charset="utf-8">
                        $(document).ready(function() {
                            var oTable = $('#example').dataTable({
                                "bJQueryUI": true,
                                "sPaginationType": "full_numbers"

                            });
                        });
                    </script>
                    <style>
                        .ui-icon{
                            float: right;
                            margin-top: 4px;
                        }
                        .dataTables_info{
                            font-size: small;
                        }
                    </style>
                    <div id="dynamic">
                        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                            <thead>
                                <tr>
                                    <td width="20%">Name</td>
                                    <td width="25%">Image</td>
                                    <td width="15%">Details</td>
                                    <td width="15%">Edit</td>
                                    <td width="15%">Delete</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($category)) {
                                    foreach ($category as $cat) {
                                        ?>
                                        <tr>
                                            <td><?php echo $cat[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_NAME] ?></td>
                                            <td><img src="<?php echo base_url() ?>assets/public/site/<?php echo $cat[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_IMAGE] ?>" width="120" height="120" alt=""/></td>
                                            <td><?php echo substr($cat[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_DETAILS],0,75) ?></td>
                                            <td><a href="<?php  echo base_url().Adminconfig::CONTROLLER_ADMINISTRATOR.Adminconfig::METHOD_ADMINISTRATOR_EDIT_CATEGORY.$cat[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID] ?>" class="btn btn-info">Edit</a></td>
                                            <td><a href="<?php  echo base_url().Adminconfig::CONTROLLER_ADMINISTRATOR.Adminconfig::METHOD_ADMINISTRATOR_DELETE_CATEGORY.$cat[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID] ?>" class="btn btn-danger" onclick="return confirm('Are you sure ?')">Delete</a></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
