<script type="text/javascript">
    Cufon.replace('.logo',{
        color: '#333'
    });
</script>
<header id=header> 
    <span class="logo">
        Restaurant <br/>
        Administrator Panel
    </span>
    <article id="headerright">
        <?php
        if ($this->session->userdata('_cheapaschipscleaningAdminLogin')) {
            ?>
            <div id=user-info>
                <p> 
                    <span class=messages>Hello <a href="javascript:void(0);">Administrator</a></span> 
                    <a href="<?php echo site_url(Adminconfig::CONTROLLER_ADMINISTRATOR.Adminconfig::METHOD_ADMINISTRATOR_LOG_OUT); ?>" onclick="return confirm('Are you want to logout ?')" class="button red">Logout</a> 
                </p>
            </div>
            <div id=search-bar>
                <form id="search-form" name="search-form" action="#" method="post">
                    <input type="text" id="query" name="query" value="" autocomplete="off" placeholder="Search">
                </form>
            </div>
            <?php
        }
        ?>
    </article>
</header>

