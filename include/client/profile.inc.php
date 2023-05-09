<div class="cover">
    <div class="container"> <div class="row"> <div class="col-md-12">
        <div class="page-title">
            <h1><?php echo __('Manage Your Profile Information'); ?></h1>
            <p><?php echo __(
            'Use the forms below to update the information we have on file for your account'
            ); ?>
            </p>
        </div>

        <form action="profile.php" method="post">
        <?php csrf_token(); ?>

        <!-- <table width="800" class="padded"> -->

        <?php
        foreach ($user->getForms() as $f) {
            $f->render(['staff' => false]);
        }
        if ($acct = $thisclient->getAccount()) {
            $info=$acct->getInfo();
            $info=Format::htmlchars(($errors && $_POST)?$_POST:$info);
        ?>

        <div class="form-header">
                <h3><?php echo __('Preferences'); ?></h3>
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

<?php if ($cfg->getSecondaryLanguages()) { ?>
    <table width="100%">
    <tr class="form-group">
        <td colspan="2">
        <label> <?php echo __('Preferred Language'); ?>: </label>
    <?php
    $langs = Internationalization::getConfiguredSystemLanguages(); ?>
            <select class="form-control" name="lang">
                <option value="">&mdash; <?php echo __('Use Browser Preference'); ?> &mdash;</option>
<?php foreach($langs as $l) {
$selected = ($info['lang'] == $l['code']) ? 'selected="selected"' : ''; ?>
                <option value="<?php echo $l['code']; ?>" <?php echo $selected;
                    ?>><?php echo Internationalization::getLanguageDescription($l['code']); ?></option>
<?php } ?>
            </select>
            <span class="error">&nbsp;<?php echo $errors['lang']; ?></span>
        </td>
    </tr>
    </table>
<?php }
      if ($acct->isPasswdResetEnabled()) { ?>
          <div class="form-header">
             <h3><?php echo __('Access Credentials'); ?></h3>
         </div>
<?php if (!isset($_SESSION['_client']['reset-token'])) { ?>
<table width="100%">
<tr class="form-group">
        <td colspan="2">
        <label><?php echo __('Current Password'); ?>:</label>
        <input class="form-control" type="password" size="18" name="cpasswd" value="<?php echo $info['cpasswd']; ?>">
        &nbsp;<span class="error">&nbsp;<?php echo $errors['cpasswd']; ?></span>
        </td>
</tr>
<?php } ?>
<tr class="form-group">
        <td colspan="2">
        <label><?php echo __('New Password'); ?>:</label>
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
<?php } ?>

<hr>
<p>
    <input class="btn btn-primary"  type="submit" value="<?php echo __('Update'); ?>"/>
    <input class="btn btn-primary"  type="reset" value="<?php echo __('Reset'); ?>"/>
    <input class="btn btn-danger"  type="button" value="<?php echo __('Cancel'); ?>" onclick="javascript:
        window.location.href='index.php';"/>
</p>
        </form>
    </div></div></div>
</div>
