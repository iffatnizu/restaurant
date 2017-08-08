<?php
if ($this->session->userdata('_cheapaschipscleaningAdminLogin')) {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            var element = "article nav[id=nav] ul[class=menu] li[class=parent]";
            var menu = jQuery(element);
            jQuery.each(menu, function(index, value) {
                //alert(index);
                jQuery("article nav[id=nav] ul[class=menu] li[id=parent_" + index + "]").mouseover(function() {
                    jQuery("article nav[id=nav] ul[class=menu] li[id=parent_" + index + "] ul[id=child_" + index + "]").show();
                })
                jQuery("article nav[id=nav] ul[class=menu] li[id=parent_" + index + "]").mouseout(function() {
                    jQuery("article nav[id=nav] ul[class=menu] li[id=parent_" + index + "] ul[id=child_" + index + "]").hide();
                })
            })
        })
    </script>
    <article>
        <nav id=nav>
            <ul class="menu">
                <li class="parent" id="parent_0"><a href="<?php echo site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_DASHBOARD); ?>" class=current><i class="icon-dashboard"></i> Dashboard</a></li>
                <li class="parent" id="parent_1"> <a href="javascript:void(0);"><i class="icon-cogs"></i> Setting <i class="icon-arrow-down"></i></a>
                    <ul class=sub id="child_1">
                        <li><a href="<?php echo site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_SITE_PARAMETER); ?>">Site Parameter</a></li>    

                        <li><a href="<?php echo site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_CHANGE_PASSWORD); ?>">Change Password</a></li>



                    </ul>
                </li>
                <li class="parent" id="parent_2"> <a href="javascript:void(0);"><i class="icon-tasks"></i> Content <i class="icon-arrow-down"></i></a>
                    <ul class=sub id="child_2">
                        <li><a href="<?php echo site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_SITE_CONTENT . "quote/" . urlencode('Home Page') . ""); ?>">Home Page</a></li>    
                        <li><a href="<?php echo site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_SITE_CONTENT . "howitworks/" . urlencode('How it works') . ""); ?>">How it works</a></li>
                        <li><a href="<?php echo site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_SITE_CONTENT . "contact/" . urlencode('Contact Us') . ""); ?>">Contact Us</a></li>
                        <li><a href="<?php echo site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_SITE_CONTENT . "about/" . urlencode('About Us') . ""); ?>">About Us</a></li>
                        <li><a href="<?php echo site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_SITE_CONTENT . "terms/" . urlencode('Terms and Condition') . ""); ?>">Terms &amp; Condition</a></li>
                        <li><a href="<?php echo site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_SITE_CONTENT . "affiliate/" . urlencode('Affiliate and Advertisement') . ""); ?>">Advertisement</a></li>
                        <li><a href="<?php echo site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_SITE_CONTENT . "privacy/" . urlencode('Privacy Policy') . ""); ?>">Privacy Policy</a></li>

                        <li><a href="<?php echo site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_FAQ); ?>">FAQ</a></li>

                    </ul>
                </li>


                <li class="parent" id="parent_3"><a onclick="return confirm('Are you sure want to logout')" href="<?php echo site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOG_OUT); ?>" class=current><i class="icon-lock"></i> Logout</a></li>           
            </ul>
        </nav>
    </article>
    <?php
}
?>