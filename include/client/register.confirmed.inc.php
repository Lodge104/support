<?php if ($content) {
    list($title, $body) = $ost->replaceTemplateVariables(
        array($content->getName(), $content->getBody())); ?>

<div class="cover"> 
    <div class="container"> <div class="row"> <div class="col-md-12"> 
        <div class="page-title">              
			<h1><?php echo Format::display($title); ?></h1>
			<p><?php
			echo Format::display($body); ?>
			</p>
			<?php } else { ?>
			<h1><?php echo __('Account Registration'); ?></h1>
			<p>
			<strong><?php echo __('Thanks for registering for an account.'); ?></strong>
			</p>
		</div>
		<p><?php echo __(
		"You've confirmed your email address and successfully activated your account.  You may proceed to check on previously opened tickets or open a new ticket."
		); ?>
		</p>
		<p><em><?php echo __('Your friendly support center'); ?></em></p>
		<?php } ?>
	</div></div></div>
</div>
