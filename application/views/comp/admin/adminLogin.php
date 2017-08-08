<div id=main role=main>

    <div id=main-content>
        <p>Please Login To Access Admin Panel</p>
        <form action="<?php echo current_url(); ?>" method="POST">
            <div class=grid_12>
                <div class=block-border>
                    <div class=block-content>
                        <p style="font-size: 11px;color: red;">
                            <?php
                            if ($this->session->userdata('_errorlAdminLogin')) {
                                echo 'Invalid ID or Pasword';
                            }
                            $session['_errorlAdminLogin'] = FALSE;
                            $this->session->unset_userdata($session);
                            ?>
                        </p>
                        <table>
                            <tr>
                                <td valign="top">Username</td>
                                <td><input type="text" name="adminUsername" value=""/></td>
                            </tr>
                            <tr>
                                <td valign="top">Password</td>
                                <td><input type="password" name="adminPassword" value=""/></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="submit" name="submit" value="Login" class="btn btn-info"/></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
