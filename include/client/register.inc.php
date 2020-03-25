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

<<<<<<< HEAD
        <form class="register-form" action="account.php" method="post">
          <?php csrf_token(); ?>
          <input type="hidden" name="do" value="<?php echo Format::htmlchars($_REQUEST['do']
            ?: ($info['backend'] ? 'import' :'create')); ?>" />

            <?php
                $cf = $user_form ?: UserForm::getInstance();
                $cf->render(array('staff' => false, 'mode' => 'create'));
            ?>
                <div class="form-header">
                   <h3> <?php echo __('Preferences'); ?> </h3>
               </div>
               <table width="100%">
                 <tr class="form-group">
                    <td colspan="2">
                        <label><?php echo __('Time Zone'); ?>:</label>
                        <?php
                        $TZ_NAME = 'timezone';
                        $TZ_TIMEZONE = $info['timezone'];
                        include INCLUDE_DIR.'staff/templates/timezone.tmpl.php'; ?>
                        <div class="error"><?php echo $errors['timezone']; ?></div>
                    </td>
                </tr>
                </table>

                <div class="form-header">
                    <h3><?php echo __('Access Credentials'); ?></h3>
                </div>
            <?php if ($info['backend']) { ?>
            <table width="100%">
            <tr class="form-group">
                <td width="180">
                    <?php echo __('Login With'); ?>:
                </td>
                <td>
                    <input type="hidden" name="backend" value="<?php echo $info['backend']; ?>"/>
                    <input type="hidden" name="username" value="<?php echo $info['username']; ?>"/>
            <?php foreach (UserAuthenticationBackend::allRegistered() as $bk) {
                if ($bk::$id == $info['backend']) {
                    echo $bk->getName();
                    break;
                }
            } ?>
                </td>
            </tr>
            </table>
            <?php } else { ?>
                <table width="100%">
            <tr class="form-group">
                <td colspan="2">
                    <label> <?php echo __('Create a Password'); ?>: </label>
                    <input class="form-control" type="password" size="18" name="passwd1" value="<?php echo $info['passwd1']; ?>">
                    &nbsp;<span class="error">&nbsp;<?php echo $errors['passwd1']; ?></span>
                </td>
            </tr>
            <tr class="form-group">
                <td colspan="2">
                    <label><?php echo __('Confirm New Password'); ?>:</label>
                    <input class="form-control" type="password" size="18" name="passwd2" value="<?php echo $info['passwd2']; ?>">
                    &nbsp;<span class="error">&nbsp;<?php echo $errors['passwd2']; ?></span>
                </td>
            </tr>
            </table>
            <?php } ?>

        <hr>
        <p>
            <input class="btn btn-primary" type="submit" value="Register"/>
            <input class="btn btn-primary" type="button" value="Cancel" onclick="javascript:
                window.location.href='index.php';"/>
        </p>
        </form>

</div></div></div>
</div>

<?php if (!isset($info['timezone'])) { ?>
<!-- Auto detect client's timezone where possible -->
<<<<<<< HEAD
<script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jstz.min.js?f1e9e88"></script>
=======
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
>>>>>>> parent of 7093d97... 2020 Update
=======
<script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jstz.min.js?a076918"></script>
>>>>>>> parent of 7a62b76... Merge branch 'master' of https://github.com/Lodge104/support
<script type="text/javascript">
$(function() {
    var zone = jstz.determine();
    $('#timezone-dropdown').val(zone.name()).trigger('change');
});
</script>
<?php }
