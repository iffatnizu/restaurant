<div class="mLeftContainer">
    <div class="recentActivity">
        <div class="arrow">&nbsp;</div>                       
        <h3 class="title" style="margin-top: -12px;"><i class="icon-th-large"></i> Business Details</h3><br clear="all"/>
        <span id="titleDes">View business details </span>
        <hr/>

        <?php
        //debugPrint($details);
        ?>

        <div id="bizBox">
            <div id="bizInfoBody">
                <div id="bizInfoHeader">
                    <h1 itemprop="name">
                        <?php
                        echo $details[DBConfig::TABLE_BUSINESS_ATT_BUSINESS_TITLE];
                        ?>
                    </h1>
                    <div id="bizRating">
                        <i class="icon-star"></i>
                        <i class="icon-star"></i>
                        <i class="icon-star"></i>
                        <i class="icon-star"></i>
                        <i class="icon-star-empty"></i>
                    </div>
                </div>
                <div id="bizInfoContent">
                    <p id="bizCategories">
                        <br/>
                        <span><b>Category:</b></span>

                        <?php
                        echo '<a href="#">'.$details['category'].'</a>';
                        ?>
                    </p>
                    <p id="bizCategories">
                        <span><b>Sub Category:</b> </span><br/>

                        <?php
                        if (!empty($details['sub-category'])) {
                            $string = '';
                            foreach ($details['sub-category'] as $cat) {

                                $string.= ' <a href="#">' . $cat['name'] . ' </a> - ';
                            }

                            $cstring = substr($string, 0, (strlen($string) - 2));

                            //echo strlen($string);
                            echo $cstring;
                        }
                        ?>
                    </p>

                    <address>
                        <?php
                        echo $details[DBConfig::TABLE_BUSINESS_ATT_BUSINESS_DETAILS];
                        ?>
                    </address>

                    <div id="bizUrl">
                        <a rel="nofollow" target="_blank" href="#">
                            <?php
                            echo ucfirst($details[DBConfig::TABLE_BUSINESS_ATT_BUSINESS_WEBSITE_URL]);
                            ?>
                        </a>
                    </div>

                    <?php
                    if ($details[DBConfig::TABLE_BUSINESS_ATT_BUSINESS_MENU_STATUS] == '1') {
                        ?>

                        <div class="menu-list">
                            <a href="#"><i class="icon-cogs"></i> Explore the Menu</a>
                        </div>
                        <?php
                    }
                    ?>
                    <br/>
                    <span>
                        <b>Health Score:</b>
                        <a href="#">96 out of 100</a>
                    </span>
                    <br/>

                    <?php
                    if (!empty($details['attribute'])) {

                        foreach ($details['attribute'] as $att) {
                            ?>
                            <span>
                                <b><?php echo $att[DBConfig::TABLE_BUSINESS_ATTRIBUTE_ATT_BUSINESS_ATTRIBUTE_TITLE] ?> :</b>
                                <?php echo $att[DBConfig::TABLE_BUSINESS_ATTRIBUTE_ATT_BUSINESS_ATTRIBUTE_VALUE] ?>
                            </span>
                            <br class="clearfix"/>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div id="bizImgBody">
                <?php
                if (!empty($details['attribute'])) {
                    foreach ($details['images'] as $img) {
                        if ($img['pos'] == 'top') {
                            ?>
                            <a href="#"><img width="120" height="120" src="<?php echo base_url() ?>assets/public/business/<?php echo $img['name']; ?>" alt="img" style="margin-bottom: 2px;"/></a><br class="clearfix"/>
                                <?php
                            } else {
                                ?>
                            <a href="#"><img width="29" height="29" src="<?php echo base_url() ?>assets/public/business/<?php echo $img['name']; ?>" alt="img"/></a>
                            <?php
                        }
                    }
                }
                ?>
            </div>
        </div>

    </div>
</div>
