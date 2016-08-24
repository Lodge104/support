<?php

if(!defined('OSTCLIENTINC') || !$thisclient || !$ticket || !$ticket->checkUserAccess($thisclient)) die('Access Denied!');

?>
<div class="cover"> 
    <div class="container"> <div class="row"> <div class="col-md-12"> 
        <div class="page-title">   
        <h1>
            <?php echo sprintf(__('Editing Ticket #%s'), $ticket->getNumber()); ?>
        </h1>
        </div>
<form action="tickets.php" method="post">
    <?php echo csrf_token(); ?>
    <input type="hidden" name="a" value="edit"/>
    <input type="hidden" name="id" value="<?php echo Format::htmlchars($_REQUEST['id']); ?>"/>
<table width="800">
    <tbody id="dynamic-form">
    <?php if ($forms)
        foreach ($forms as $form) {
            $form->render(false);
    } ?>
    </tbody>
</table>
<hr>
<p>
    <input class="btn btn-primary"  type="submit" value="Update"/>
    <input class="btn btn-primary"  type="reset" value="Reset"/>
    <input class="btn btn-danger" type="button" value="Cancel" onclick="javascript:
        window.location.href='index.php';"/>
</p>
</form>
</div></div></div>
</div>
