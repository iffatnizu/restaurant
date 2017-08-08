<div class="mLeftContainer">
    <div class="recentActivity">
        <div class="arrow">&nbsp;</div>                       
        <h3 class="title" style="margin-top: -12px;"><i class="icon-key"></i> User Account Activation</h3><br clear="all"/>
        <span id="titleDes">Connect with great local businesses</span>
        <hr/>

        <?php 
        if($this->session->userdata('activeMsg')){
        ?>
        
            <?php echo $this->session->userdata('activeMsg') ?>
        
        <?php
        }
        $sess['successMsg'] = FALSE;
        $this->session->unset_userdata($sess);
        ?>

        
    </div>
</div>
