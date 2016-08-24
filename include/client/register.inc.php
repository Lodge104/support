<?php
$info = $_POST;
if (!isset($info['timezone_id']))
    $info += array(
        'timezone_id' => $cfg->getDefaultTimezoneId(),
        'dst' => $cfg->observeDaylightSaving(),
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

<div class="cover"> 
    <div class="container"> <div class="row"> <div class="col-md-12"> 
        <div class="page-title"> 
            <h1><?php echo __('Account Registration'); ?></h1>
            <p><?php echo __(
            'Use the forms below to create or update the information we have on file for your account'
            ); ?>
            </p>
        </div>

   <form class="register-form" action="account.php" method="post">
              <?php csrf_token(); ?>
              <input type="hidden" name="do" value="<?php echo Format::htmlchars($_REQUEST['do']
                ?: ($info['backend'] ? 'import' :'create')); ?>" />


            
            <?php
                $cf = $user_form ?: UserForm::getInstance();
                $cf->render(false);
            ?>

            <div class="form-header">
                <h3> <?php echo __('Preferences'); ?> </h3>
            </div>
            <table width="100%">
            <tr class="form-group">
                <td colspan="2">
                    <label><?php echo __('Time Zone'); ?>:</label><br>
                    <select class="form-control" name="timezone_id" id="timezone_id">
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
                    &nbsp;<span class="error"><?php echo $errors['timezone_id']; ?></span>
                </td>
            </tr>

            <tr>
                <td width="180">
                   <label> <?php echo __('Daylight Saving'); ?>:</label>
                </td>
                <td>
                    <input type="checkbox" name="dst" value="1" <?php echo $info['dst']?'checked="checked"':''; ?>>
                    <?php echo __('Observe daylight saving'); ?>
                    <em>(<?php echo __('Current Time'); ?>:
                        <strong><?php echo Format::date($cfg->getDateTimeFormat(),Misc::gmtime(),$info['tz_offset'],$info['dst']); ?></strong>)</em>
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
