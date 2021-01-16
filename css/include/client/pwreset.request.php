<?php
if(!defined('OSTCLIENTINC')) die('Access Denied');

$userid=Format::input($_POST['userid']);
?>
<div class="cover"> 
    <div class="container"> <div class="row"> <div class="col-md-12"> 
        <div class="page-title">   
            <h1><?php echo __('Forgot My Password'); ?></h1>
            <p><?php echo __(
            'Enter your username or email address in the form below and press the <strong>Send Email</strong> button to have a password reset link sent to your email account on file.');
            ?>
        </div>

        <form action="pwreset.php" method="post" id="clientLogin">
            <div style="width:50%;display:inline-block">
            <?php csrf_token(); ?>
            <input type="hidden" name="do" value="sendmail"/>
            <strong><?php echo Format::htmlchars($banner); ?></strong>
            <br><br>
            <div class="form-group">
                <label for="username"><?php echo __('Username'); ?>:</label>
                <input class="form-control" id="username" type="text" name="userid" size="30" value="<?php echo $userid; ?>">
            </div>
            <p>
                <input class="btn btn-primary" type="submit" value="<?php echo __('Send Email'); ?>">
            </p>
            </div>
        </form>
    </div></div></div>
</div>
