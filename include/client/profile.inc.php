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

<?php
foreach ($user->getForms() as $f) {
    $f->render(false);
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
                    <select class="form-control" name="timezone_id" id="timezone_id">
                        <option value="0">&mdash; <?php echo __('Select Time Zone'); ?> &mdash;</option>
                        <?php
                        $sql='SELECT id, offset,timezone FROM '.TIMEZONE_TABLE.' ORDER BY id';
                        if(($res=db_query($sql)) && db_num_rows($res)){
                            while(list($id,$offset, $tz)=db_fetch_row($res)){
                                $sel=($info['timezone_id']==$id)?'selected="selected"':'';
                                echo sprintf('<option value="%d" %s>GMT %s - %s</option>',$id,$sel,$offset,$tz);
                            }
                        }
                        ?>
                    </select>
                    &nbsp;<font class="error"><?php echo $errors['timezone_id']; ?></font><br>
                </td>
            </tr>

            <tr class="form-group">
                <td colspan="2">
                    <label><?php echo __('Daylight Saving') ?>:</label><br>
                    <input type="checkbox" name="dst" value="1" <?php echo $info['dst']?'checked="checked"':''; ?>>
                    <?php echo __('Observe daylight saving'); ?>
                    <em>(<?php echo __('Current Time'); ?>:
                        <strong><?php echo Format::date($cfg->getDateTimeFormat(),Misc::gmtime(),$info['tz_offset'],$info['dst']); ?></strong>)</em><br>
                </td>

            </tr>

            <tr class="form-group">
                    <td colspan="2">
                        <label> <?php echo __('Preferred Language'); ?>: </label>
                <?php
                $langs = Internationalization::availableLanguages(); ?>
                        <select class="form-control" name="lang">
                            <option value="">&mdash; <?php echo __('Use Browser Preference'); ?> &mdash;</option>
            <?php foreach($langs as $l) {
            $selected = ($info['lang'] == $l['code']) ? 'selected="selected"' : ''; ?>
                            <option value="<?php echo $l['code']; ?>" <?php echo $selected;
                                ?>><?php echo Internationalization::getLanguageDescription($l['code']); ?></option>
            <?php } ?>
                        </select>
                        <font class="error">&nbsp;<?php echo $errors['lang']; ?></font><br>
                    </td>
            </tr>
            </table>

            <?php if ($acct->isPasswdResetEnabled()) { ?>

            <div class="form-header">
                <h3><?php echo __('Access Credentials'); ?></h3>
            </div>

            <?php if (!isset($_SESSION['_client']['reset-token'])) { ?>
            <tr class="form-group">
                <td colspan="2">
                    <label><?php echo __('Current Password'); ?>:</label>

                    <input class="form-control" type="password" size="18" name="cpasswd" value="<?php echo $info['cpasswd']; ?>">
                    &nbsp;<font class="error">&nbsp;<?php echo $errors['cpasswd']; ?></font><br>
                </td>
            </tr>
            <?php } ?>
            <tr class="form-group">
                <td colspan="2">
                    <label><?php echo __('New Password'); ?>:</label>

                    <input class="form-control" type="password" size="18" name="passwd1" value="<?php echo $info['passwd1']; ?>">
                    &nbsp;<font class="error">&nbsp;<?php echo $errors['passwd1']; ?></font><br>
                </td>
            </tr>
            <tr class="form-group">
                <td colspan="2">
                    <label><?php echo __('Confirm New Password'); ?>:</label>
                    <input class="form-control" type="password" size="18" name="passwd2" value="<?php echo $info['passwd2']; ?>">
                    &nbsp;<font class="error">&nbsp;<?php echo $errors['passwd2']; ?></font><br>
                </td>
            </tr>
            <?php } ?>
            <?php } ?>
<hr>
<p>
    <input class="btn btn-primary"  type="submit" value="Update"/>
    <input class="btn btn-primary"  type="reset" value="Reset"/>
    <input class="btn btn-danger"  type="button" value="Cancel" onclick="javascript:
        window.location.href='index.php';"/>
</p>
</form>
</div></div></div>
</div>
