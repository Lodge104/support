<?php
if(!defined('OSTCLIENTINC')) die('Access Denied!');
$info=array();
if($thisclient && $thisclient->isValid()) {
    $info=array('name'=>$thisclient->getName(),
                'email'=>$thisclient->getEmail(),
                'phone'=>$thisclient->getPhoneNumber());
}

$info=($_POST && $errors)?Format::htmlchars($_POST):$info;

if(isset($_REQUEST["tid"])){
    $info['topicId']=$_REQUEST["tid"];
    }

$form = null;
if (!$info['topicId']) {
    if (array_key_exists('topicId',$_GET) && preg_match('/^\d+$/',$_GET['topicId']) && Topic::lookup($_GET['topicId']))
        $info['topicId'] = intval($_GET['topicId']);
    else
        $info['topicId'] = $cfg->getDefaultTopicId();
}

$forms = array();
if ($info['topicId'] && ($topic=Topic::lookup($info['topicId']))) {
    foreach ($topic->getForms() as $F) {
        if (!$F->hasAnyVisibleFields())
            continue;
        if ($_POST) {
            $F = $F->instanciate();
            $F->isValidForClient();
        }
        $forms[] = $F;
    }
}

?>
<h1 class="text-center"><?php echo __('Open a New Ticket');?></h1>
<p class="text-center"><?php echo __('Please fill in the form below to open a new ticket.');?></p>
<hr>
<form id="ticketForm" method="post" action="open.php" enctype="multipart/form-data">
	<?php csrf_token(); ?>
	<input type="hidden" name="a" value="open">
	<div class="row">
		<div class="col-md-4">
			<?php
        if (!$thisclient) {
            $uform = UserForm::getUserForm()->getForm($_POST);
            if ($_POST) $uform->isValid();
            $uform->render(false);
        }
        else { ?>
            <table class="table table-bordered">
	            <tr>
		            <td><b><?php echo __('Email'); ?>:</b></td>
		            <td><?php echo $thisclient->getEmail(); ?></td>
	            </tr>
	            <tr>
		            <td><b><?php echo __('Client'); ?>:</b></td>
		            <td><?php echo Format::htmlchars($thisclient->getName()); ?></td>
	            </tr>
			</table>
        <?php } ?>
		</div>
		<!-- col -->
		<div class="col-md-8">
			<h3 class="n-m-t"><?php echo __('Help Topic'); ?><font class="error">*&nbsp;<?php echo $errors['topicId']; ?></font></h3>
			<hr>
			<select class="form-control" id="topicId" name="topicId" onchange="javascript:
                    var data = $(':input[name]', '#dynamic-form').serialize();
                    $.ajax(
                      'ajax.php/form/help-topic/' + this.value,
                      {
                        data: data,
                        dataType: 'json',
                        success: function(json) {
                          $('#dynamic-form').empty().append(json.html);
                          $(document.head).append(json.media);
                        }
                      });">
                <option value="" selected="selected">&mdash; <?php echo __('Select a Help Topic');?> &mdash;</option>
                <?php
                if($topics=Topic::getPublicHelpTopics()) {
                    foreach($topics as $id =>$name) {
                        echo sprintf('<option value="%d" %s>%s</option>',
                                $id, ($info['topicId']==$id)?'selected="selected"':'', $name);
                    }
                } else { ?>
                    <option value="0" ><?php echo __('General Inquiry');?></option>
                <?php
                } ?>
            </select>
            
            <div id="dynamic-form">
	            <?php foreach ($forms as $form) {
		            include(CLIENTINC_DIR . 'templates/dynamic-form.tmpl.php');
		        } ?>
            </div>
            <?php
		    if($cfg && $cfg->isCaptchaEnabled() && (!$thisclient || !$thisclient->isValid())) {
		        if($_POST && $errors && !$errors['captcha'])
		            $errors['captcha']=__('Please re-enter the text again');
		        ?>
		        <div class="form-group">
			        <label class="required"><?php echo __('CAPTCHA Text');?></label>
			        <span class="captcha">
			        	<img src="captcha.php" border="0" align="left"></span>&nbsp;&nbsp;
		            <input id="captcha" type="text" name="captcha" size="6" autocomplete="off" class="form-control">
		            <em><?php echo __('Enter the text shown on the image.');?></em>
		            <font class="error">*&nbsp;<?php echo $errors['captcha']; ?></font>
		        </div>
            <?php
		    } ?>
            
		</div>
		<!-- col -->
	</div>
	<!-- row -->
	
	<hr>
	
	<div class="row">
		<div class="col-xs-12">
			<button type="submit" class="btn btn-success pull-right"><?php echo __('Create Ticket');?></button>
			<button type="reset" class="btn btn-default"><?php echo __('Reset');?></button>
			<button type="button" class="btn btn-default"onclick="javascript:
            $('.richtext').each(function() {
                var redactor = $(this).data('redactor');
                if (redactor && redactor.opts.draftDelete)
                    redactor.deleteDraft();
            });
            window.location.href='index.php';"><?php echo __('Cancel'); ?></button>
		</div>
		<!-- col -->
	</div>
	<!-- row -->
</form>
