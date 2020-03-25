<?php
if(!defined('OSTCLIENTINC')) die('Access Denied');

$userid=Format::input($_POST['userid']);
?>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<h1><?php echo __('Forgot My Password'); ?></h1>
		<p><?php echo __(
		'Enter your username or email address in the form below and press the <strong>Send Email</strong> button to have a password reset link sent to your email account on file.');
		?></p>
		
		<form action="pwreset.php" method="post" id="clientLogin">
		    <?php csrf_token(); ?>
		    <input type="hidden" name="do" value="sendmail"/>
		    <h3><?php echo Format::htmlchars($banner); ?></h3>
		    <div class="form-group">
		        <label for="username"><?php echo __('Username'); ?>:</label>
		        <input id="username" type="text" name="userid" size="30" value="<?php echo $userid; ?>" class="form-control">
		    </div>
		    <button class="btn btn-success btn-block" type="submit"><?php echo __('Send Email'); ?></button>
		</form>
		
	</div>
	<!-- col -->
</div>
<!-- row -->
		
