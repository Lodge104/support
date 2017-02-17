<?php
$info = $_POST;
if (!isset($info['timezone']))
    $info += array(
        'backend' => null,
    );
if (isset($user) && $user instanceof ClientCreateRequest) {
    $bk = $user->getBackend();
    $info = array_merge($info, array(
        'backend' => $bk::$id,
        'username' => $user->getUsername(),
    ));
}
$info = Format::htmlchars(($errors && $_POST)?$_POST:$info);

?>
<h1 class="text-center"><?php echo __('Account Registration'); ?></h1>
<p class="text-center"><?php echo __(
'Use the forms below to create or update the information we have on file for your account'
); ?>
</p>
<form action="account.php" method="post">
	<?php csrf_token(); ?>
	<input type="hidden" name="do" value="<?php echo Format::htmlchars($_REQUEST['do'] ?: ($info['backend'] ? 'import' :'create')); ?>" />
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<?php
			    $cf = $user_form ?: UserForm::getInstance();
			    $cf->render(false, false, array('mode' => 'create'));
			?>
		</div>
		<!-- col -->
	</div>
	<!-- row -->
	<hr>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h3><?php echo __('Preferences');?></h3>
			
			<div class="form-group">
				<label><?php echo __('Time Zone');?></label>
				<?php
	            $TZ_NAME = 'timezone';
	            $TZ_TIMEZONE = $info['timezone'];
	            include INCLUDE_DIR.'client/templates/timezone.tmpl.php'; ?>
	            <div class="error"><?php echo $errors['timezone']; ?></div>
			</div>
			
			<h3><?php echo __('Access Credentials'); ?></h3>
			
			<?php if ($info['backend']) { ?>

				<h4><?php echo __('Login With'); ?></h4>
				<input type="hidden" name="backend" value="<?php echo $info['backend']; ?>"/>
				<input type="hidden" name="username" value="<?php echo $info['username']; ?>"/>
				<?php foreach (UserAuthenticationBackend::allRegistered() as $bk) {
				    if ($bk::$id == $info['backend']) {
				        echo $bk->getName();
				        break;
				    }
				} ?>
				
			<?php } else { ?>
			
				<div class="form-group">
					<label><?php echo __('Create a Password'); ?></label>
					<input type="password" name="passwd1" value="<?php echo $info['passwd1']; ?>" class="form-control">
			        <span class="error">&nbsp;<?php echo $errors['passwd1']; ?></span>
				</div>
				
				<div class="form-group">
					<label><?php echo __('Confirm New Password'); ?></label>
					<input type="password" name="passwd2" value="<?php echo $info['passwd2']; ?>" class="form-control">
	        		<span class="error">&nbsp;<?php echo $errors['passwd2']; ?></span>
				</div>
			
			<?php } ?>
			
		</div>
		<!-- col -->
	</div>
	<!-- row -->
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<button type="button" class="btn btn-default" onclick="javascript:window.location.href='index.php';">Cancel</button>
			<button type="submit" class="btn btn-success pull-right">Register</button>
		</div>
		<!-- col -->
	</div>
	<!-- row -->
</form>

<?php if (!isset($info['timezone'])) { ?>
<!-- Auto detect client's timezone where possible -->
<script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jstz.min.js?901e5ea"></script>
<script type="text/javascript">
$(function() {
    var zone = jstz.determine();
    $('#timezone-dropdown').val(zone.name()).trigger('change');
});
</script>
<?php }
