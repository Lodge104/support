<?php
if(!defined('OSTCLIENTINC')) die('Access Denied');

$email=Format::input($_POST['lemail']?$_POST['lemail']:$_GET['e']);
$ticketid=Format::input($_POST['lticket']?$_POST['lticket']:$_GET['t']);

if ($cfg->isClientEmailVerificationRequired())
    $button = __("Email Access Link");
else
    $button = __("View Ticket");
?>
<h1 class="text-center"><?php echo __('Check Ticket Status'); ?></h1>
<p class="text-center"><?php
echo __('Please provide your email address and a ticket number.');
if ($cfg->isClientEmailVerificationRequired())
    echo ' '.__('An access link will be emailed to you.');
else
    echo ' '.__('This will sign you in to view your ticket.');
?></p>


<form action="login.php" method="post" id="clientLogin">
    <?php csrf_token(); ?>
<div class="row">
	<div class="col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4 well"> 
        <div class="login-box">
	    	
	    	<div><strong><?php echo Format::htmlchars($errors['login']); ?></strong></div>
	    
			<div class="form-group">
				<label for="email"><?php echo __('E-Mail Address'); ?></label>
				<input id="email" type="text" name="lemail" value="<?php echo $email; ?>" class="form-control"  placeholder="<?php echo __('e.g. john.doe@osticket.com'); ?>">
			</div>
			<!-- /.form-group -->
			<div class="form-group">
				<label for="ticketno"><?php echo __('Ticket Number'); ?></label>
				<input id="ticketno" type="text" name="lticket" value="<?php echo $ticketid; ?>" class="form-control">
			</div>
			<!-- /.form-group -->
			<div class="form-group">
				<input class="btn btn-success btn-block form-control" type="submit" value="<?php echo $button; ?>">
			</div>
			<!-- /.form-group -->
		</div>
		<!-- /.login-box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4 well"> 
		<div class="instructions">
	<?php if ($cfg && $cfg->getClientRegistrationMode() !== 'disabled') { ?>
	        <?php echo __('Have an account with us?'); ?>
	        <a href="login.php"><?php echo __('Sign In'); ?></a> <?php
	    if ($cfg->isClientRegistrationEnabled()) { ?>
	<?php echo sprintf(__('or %s register for an account %s to access all your tickets.'),
	    '<a href="account.php?do=create">','</a>');
	    }
	}?>
	    </div>
	    <!-- /.instructions -->	
	</div>
    <!-- /.col -->
</div>
<!-- /.row -->
    
</form>
<br>
<p class="text-center">
<?php 
if ($cfg->getClientRegistrationMode() != 'disabled' || !$cfg->isClientLoginRequired()) {
	echo sprintf(
__("If this is your first time contacting us or you've lost the ticket number, please %s open a new ticket %s"),
    '<a href="open.php">','</a>'); 
} ?>
</p>
