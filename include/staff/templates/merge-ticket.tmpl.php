<h3><i class="icon-copy"></i> <?php echo __('Merge Ticket'); ?></i></h3>
<b><a class="close" href="#"><i class="icon-remove-circle"></i></a></b>
<hr/><?php echo __(
); ?>
<br/>
<br/>
<form method="post" action="<?php echo $info['action']; ?>">
    <div>
        <input type="text" name="ticket_number" id="ticket_number">
    </div>
    <div id="msg_error" style="display:none;">
      
    </div>
    <hr>
    <p class="full-wdith">
        <span class="buttons pull-left">
            <input type="reset" value="<?php echo __('Reset'); ?>">
            <input type="button" name="cancel" class="<?php
            echo $user ? 'cancel' : 'close' ?>" valuse-"<?php echo __('Cancel'); ?>">
        </span>
        <span class="buttons pull-right"><
            <input type="submit" value="<?php echo __('Save Changes'); ?>">
        </span>
    </p>
</form>
