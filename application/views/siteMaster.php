<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="description" content="Description"/>
        <meta name="keyword" content="keyword"/>
        <meta name="author" content=""/>
        <!-- Le styles -->

        <link href="<?php echo base_url(); ?>scripts/plugins/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>scripts/plugins/bootstrap/css/bootstrap-theme.css" rel="stylesheet"/>

        <link href="<?php echo base_url(); ?>assets/css/site.css" rel="stylesheet"/>
        <!--[if IE 7]>
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome/css/font-awesome-ie7.css"/>
        <![endif]-->
        <script type="text/javascript" src="<?php echo base_url(); ?>scripts/core/jquery-1.9.1.js"></script>
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                  <script src="<?php echo base_url(); ?>scripts/plugins/bootstrap/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->

        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/ico/favicon.ico"/>
        <script type="text/javascript" src="<?php echo base_url(); ?>scripts/site/main.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>scripts/core/jquery-ui.js"></script>
        <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet"/>
        <script type="text/javascript">
            var base_url = '<?php echo base_url(); ?>';
        </script>


    </head>

    <body>
        <div class="container">

            <?php
            if (isset($_header)) {
                echo $_header;
            }
            ?>

            <?php
            if (isset($_slider)) {
                echo $_slider;
            }
            ?>

            <div class="mdlContainer">

                <?php
                if (isset($_content)) {
                    echo $_content;
                }
                if (isset($_right)) {
                    echo $_right;
                }
                ?>

            </div>

            <br clear="all"/>

            <?php
            if (isset($_footer)) {
                echo $_footer;
            }
            ?>

        </div>
        <!-- ================================================== --> 
        <!-- Placed at the end of the document so the pages load faster --> 

        <script src="<?php echo base_url(); ?>scripts/plugins/bootstrap/js/bootstrap.js"></script> 
        <script type="text/javascript">
            !function($) {
                $(function() {
                    // carousel demo
                    $('#myCarousel').carousel({
                        interval: 7000
                    })
                })
            }(window.jQuery)
        </script> 
        <script src="<?php echo base_url(); ?>scripts/plugins/bootstrap/js/holder.js"></script>
    </body>
</html>

