<?php
if(!defined('OSTCLIENTINC') || !$thisclient || !$ticket || !$ticket->checkUserAccess($thisclient)) die('Access Denied!');

$info=($_POST && $errors)?Format::htmlchars($_POST):array();

$dept = $ticket->getDept();

if ($ticket->isClosed() && !$ticket->isReopenable())
    $warn = __('This ticket is marked as closed and cannot be reopened.');

//Making sure we don't leak out internal dept names
if(!$dept || !$dept->isPublic())
    $dept = $cfg->getDefaultDept();

if ($thisclient && $thisclient->isGuest()
    && $cfg->isClientRegistrationEnabled()) { ?>


    <div id="alert alert-info">
        <i class="fa fa-compass fa-2x"></i>
        <strong><?php echo __('Looking for your other tickets?'); ?></strong></br>
        <a href="<?php echo ROOT_PATH; ?>login.php?e=<?php
            echo urlencode($thisclient->getEmail());
        ?>"><?php echo __('Sign In'); ?></a>
        <?php echo sprintf(__('or %s register for an account %s for the best experience on our help desk.'),
            '<a href="account.php?do=create">','</a>'); ?>
    </div>
    <!-- /.alert -->


<?php } ?>


<div class="row"> 

    <div class="col-xs-12"> 
        <header class="page-title"> 
	        <ul class="list-inline pull-right">
		        <li><a class="tkt-refresh pull-right" href="tickets.php?id=<?php echo $ticket->getId(); ?>" title="<?php echo __('Reload'); ?>"><i class="fa fa-refresh"></i></a></li>
                        
                <li><a class="tkt-refresh pull-right" href="tickets.php?a=print&id=<?php echo $ticket->getId(); ?>" title="<?php echo __('Print'); ?>"><i class="fa fa-print"></i></a></li>
                <?php if ($ticket->hasClientEditableFields()
                // Only ticket owners can edit the ticket details (and other forms)
                && $thisclient->getId() == $ticket->getUserId()) { ?>
                        <li><a class="action-button pull-right tkt-edit" href="tickets.php?a=edit&id=<?php
                             echo $ticket->getId(); ?>" title="<?php echo __('Edit'); ?>"><i class="fa fa-pencil"></i> </a></li>
                <?php } ?>
	        </ul>
            <h3><?php echo sprintf(__('Ticket #%s'), $ticket->getNumber()); ?>
                <span class="text-info">
                <?php $subject_field = TicketForm::getInstance()->getField('subject');
                    echo $subject_field->display($ticket->getSubject()); ?>
                </span>  
            </h3>
        </header>
    </div>
    <!-- /.col -->
    
</div>
<!-- /.row -->

<div class="row"> 
    <div class="col-xs-6">
	    <div class="table-responsive">
		    <table class="table table-bordered table-striped">
		        <tr>
		            <th width="160"><?php echo __('Ticket Status');?>:</th>
		            <td><?php echo ($S = $ticket->getStatus()) ? $S->getLocalName() : ''; ?></td>
		        </tr>
		        <tr>
		            <th><?php echo __('Department');?>:</th>
		            <td><?php echo Format::htmlchars($dept instanceof Dept ? $dept->getName() : ''); ?></td>
		        </tr>
		        <tr>
		            <th><?php echo __('Create Date');?>:</th>
		            <td><?php echo Format::datetime($ticket->getCreateDate()); ?></td>
		        </tr>
		   </table>
	    </div>
	    <!-- /.table-responsive -->
    </div>
	<!-- /.col -->
	<div class="col-xs-6">
		<div class="table-responsive">
	       	<table class="table table-bordered table-striped">
	           <tr>
	               <th width="160"><?php echo __('Name');?>:</th>
	               <td><?php echo mb_convert_case(Format::htmlchars($ticket->getName()), MB_CASE_TITLE); ?></td>
	           </tr>
	           <tr>
	               <th width="160"><?php echo __('Email');?>:</th>
	               <td><?php echo Format::htmlchars($ticket->getEmail()); ?></td>
	           </tr>
	           <tr>
	               <th><?php echo __('Phone');?>:</th>
	               <td><?php echo $ticket->getPhoneNumber(); ?></td>
	           </tr>
	        </table>
		</div>
		<!-- /.table-responsive -->
    </div>
	<!-- /.col -->
</div>
<!-- /.row -->
                
<div class="row"> 
	<?php
	$sections = array();
    foreach (DynamicFormEntry::forTicket($ticket->getId()) as $i=>$form) {
        // Skip core fields shown earlier in the ticket view
	    $answers = $form->getAnswers()->exclude(Q::any(array(
	        'field__flags__hasbit' => DynamicFormField::FLAG_EXT_STORED,
	        'field__name__in' => array('subject', 'priority'),
	        Q::not(array('field__flags__hasbit' => DynamicFormField::FLAG_CLIENT_VIEW)),
	    )));
        // Skip display of forms without any answers
	    foreach ($answers as $j=>$a) {
	        if ($v = $a->display())
	            $sections[$i][$j] = array($v, $a);
	    } ?>
	    <div class="col-xs-12">
		    <div class="table-responsive">
		        <table class="table table-bordered table-striped">
		            <?php foreach ($sections as $i=>$answers) {
	                    if (in_array($answer->getField()->get('name'), array('name', 'email', 'subject')))
	                        continue;
	                    elseif ($answer->getField()->get('private'))
	                        continue;
	                    ?>
	                    <tr>		                
	                    <th colspan="2"><?php echo $form->getTitle(); ?></th>
	                    </tr>
	                    <?php foreach ($answers as $A) {
							list($v, $a) = $A; ?>
		                    <tr>		                
		                    <th width="160"><?php echo $a->getField()->get('label'); ?></th>
		                    <td><?php echo $v; ?></td>
		                    </tr>
		                <?php } ?>
	                <?php } ?>
		       </table>
		    </div>
		    <!-- /.table-responsive -->
	    </div>
		<!-- /.col -->
	<?php } ?>
</div>
<!-- /.row -->

<?php
    $ticket->getThread()->render(array('M', 'R'), array(
                'mode' => Thread::MODE_CLIENT,
                'html-id' => 'ticketThread')
            );
?>

<div class="clear" style="padding-bottom:10px;"></div>
<?php if($errors['err']) { ?>
    <div class="alert alert-danger" id="msg_error"><?php echo $errors['err']; ?></div>
<?php }elseif($msg) { ?>
    <div class="alert alert-info" id="msg_notice"><?php echo $msg; ?></div>
<?php }elseif($warn) { ?>
    <div class="alert alert-warning" id="msg_warning"><?php echo $warn; ?></div>
<?php } 



if (!$ticket->isClosed() || $ticket->isReopenable()) { ?>
<form id="reply" action="tickets.php?id=<?php echo $ticket->getId(); ?>#reply" name="reply" method="post" enctype="multipart/form-data">
	
	<?php csrf_token(); ?>
	<input type="hidden" name="id" value="<?php echo $ticket->getId(); ?>">
    <input type="hidden" name="a" value="reply">
	
	<div class="row">
		<div class="col-xs-12">
			<h2><?php echo __('Post a Reply');?></h2>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
	
	<div class="row">
		<div class="col-xs-12">
			<div class="form-group">
	            <?php
                if($ticket->isClosed()) {
                    $msg='<label>'.__('Ticket will be reopened on message post').'</label>';
                } else {
                    $msg='<label>'.__('To best assist you, we request that you be specific and detailed').'</label>';
                }
                ?>
	            <span id="msg"><em><?php echo $msg; ?> </em></span><font class="error">*&nbsp;<?php echo $errors['message']; ?></font>
		            <textarea name="message" id="message" cols="50" rows="9" wrap="soft"
		            class="form-control <?php if ($cfg->isRichTextEnabled()) echo 'richtext';
		                ?> draft" <?php
		list($draft, $attrs) = Draft::getDraftAndDataAttrs('ticket.client', $ticket->getId(), $info['message']);
		echo $attrs; ?>><?php echo $draft ?: $info['message'];
		            ?></textarea>
                    <?php
                    if ($messageField->isAttachmentsEnabled()) { ?>
            <?php
                        print $attachments->render(array('client'=>true));
            ?>
                    <?php
                    } ?>
            </div>
            <!-- /.form-group -->
		    
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
	
	<div class="row">
		<div class="col-xs-12">
            <button class="btn btn-success pull-right" type="submit"><i class="fa fa-check"></i> <?php echo __('Post Reply');?></button>
		    <button class="btn btn-default" type="reset"><i class="fa fa-refresh"></i> <?php echo __('Reset');?></button>
			<button class="btn btn-default" type="button" onClick="history.go(-1)"><i class="fa fa-times"></i> <?php echo __('Cancel'); ?></button>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

</form>

<?php } ?>


<script type="text/javascript">
<?php
// Hover support for all inline images
$urls = array();
foreach (AttachmentFile::objects()->filter(array(
    'attachments__thread_entry__thread__id' => $ticket->getThreadId(),
    'attachments__inline' => true,
)) as $file) {
    $urls[strtolower($file->getKey())] = array(
        'download_url' => $file->getDownloadUrl(),
        'filename' => $file->name,
    );
} ?>
showImagesInline(<?php echo JsonDataEncoder::encode($urls); ?>);
</script>
