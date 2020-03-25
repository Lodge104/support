<?php
if(!defined('OSTCLIENTINC')) die('Access Denied');

$email=Format::input($_POST['luser']?:$_GET['e']);
$passwd=Format::input($_POST['lpasswd']?:$_GET['t']);

$content = Page::lookupByType('banner-client');

if ($content) {
    list($title, $body) = $ost->replaceTemplateVariables(
        array($content->getName(), $content->getBody()));
} else {
    $title = __('Sign In');
    $body = __('To better serve you, we encourage our clients to register for an account and verify the email address we have on record.');
}

?>
<div class="row"> 

    <div class="col-xs-12"> 
        <header class="page-title text-center">   
            <h1><?php echo Format::display($title); ?></h1>
			<p><?php echo Format::display($body); ?></p>
        </header>
    </div>
    <!-- /.col -->
    
</div>
<!-- /.row -->

<form action="login.php" method="post" id="clientLogin">
    <?php csrf_token(); ?>

	<div class="row"> 
	
	    <div class="col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4 well"> 
	        <div class="login-box">
		    	<strong><?php echo Format::htmlchars($errors['login']); ?></strong>
		    </div>
			<div class="form-group">
				<label><?php echo __('Email or Username'); ?></label>
				<input id="username" type="text" name="luser" value="<?php echo $email; ?>" class="form-control">
			</div>
			<!-- /.form-group -->
			<div class="form-group">
				<label><?php echo __('Password'); ?></label>
				<input id="passwd" type="password" name="lpasswd" size="30" value="<?php echo $passwd; ?>" class="form-control">
			</div>
			<!-- /.form-group -->
			<div class="form-group">
				<input class="btn btn-success btn-block" type="submit" value="<?php echo __('Sign In'); ?>">
				<?php if ($suggest_pwreset) { ?>
					<a class="btn btn-link btn-block" href="pwreset.php"><?php echo __('Forgot My Password'); ?></a>
				<?php } ?>
			</div>
			<!-- /.form-group -->
			
	    </div>
	    <!-- /.col -->
	    
	</div>
	<!-- /.row -->
	
</form>
	
<div class="row">
	<div class="col-xs-12 text-center">
		
		<?php

		$ext_bks = array();
		foreach (UserAuthenticationBackend::allRegistered() as $bk)
		    if ($bk instanceof ExternalAuthentication)
		        $ext_bks[] = $bk;
		
		if (count($ext_bks)) {
		    foreach ($ext_bks as $bk) { ?>
				<div class="external-auth"><?php $bk->renderExternalLink(); ?></div>
			<?php
		    }
		}
		if ($cfg && $cfg->isClientRegistrationEnabled()) {
		    if (count($ext_bks)) echo '<hr style="width:70%"/>'; ?>
		    <p>
		    	<?php echo __('Not yet registered?'); ?> <a href="account.php?do=create"><?php echo __('Create an account'); ?></a>
		    </p>
		<?php } ?>
		<p><?php echo __("I'm an agent"); ?> — <a href="<?php echo ROOT_PATH; ?>scp/"><?php echo __('sign in here'); ?></a></p>

		<?php if ($cfg->getClientRegistrationMode() != 'disabled' || !$cfg->isClientLoginRequired()) {
			echo '<p>';
		    echo sprintf(__('If this is your first time contacting us or you\'ve lost the ticket number, please %s open a new ticket %s'),
		        '<a href="open.php">', '</a>');
		    echo '</p>';
		} ?>
	</div>
</div>
<!-- /.row -->