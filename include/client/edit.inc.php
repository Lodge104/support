<?php

if(!defined('OSTCLIENTINC') || !$thisclient || !$ticket || !$ticket->checkUserAccess($thisclient)) die('Access Denied!');

?>

<h1>
    <?php echo sprintf(__('Editing Ticket #%s'), $ticket->getNumber()); ?>
</h1>

<form action="tickets.php" method="post">
    <?php echo csrf_token(); ?>
    <input type="hidden" name="a" value="edit"/>
    <input type="hidden" name="id" value="<?php echo Format::htmlchars($_REQUEST['id']); ?>"/>
<table class="table">
    <tbody id="dynamic-form">
    <?php if ($forms)
        foreach ($forms as $form) {
            $form->render(false);
    } ?>
    </tbody>
</table>
<hr>
<div class="row">
	<div class="col-xs-12">
		<button type="submit" class="btn btn-success pull-right">Update</button>
		<button type="reset" class="btn btn-default">Reset</button>
		<button type="button" class="btn btn-danger" onclick="javascript:window.location.href='index.php';">Cancel</button>
	</div>
</div>
</form>
