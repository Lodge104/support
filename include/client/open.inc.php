<?php
if(!defined('OSTCLIENTINC')) die('Access Denied!');
$info=array();
if($thisclient && $thisclient->isValid()) {
    $info=array('name'=>$thisclient->getName(),
                'email'=>$thisclient->getEmail(),
                'phone'=>$thisclient->getPhoneNumber());
}

$info=($_POST && $errors)?Format::htmlchars($_POST):$info;

$form = null;
if (!$info['topicId'])
    $info['topicId'] = $cfg->getDefaultTopicId();

if ($info['topicId'] && ($topic=Topic::lookup($info['topicId']))) {
    $form = $topic->getForm();
    if ($_POST && $form) {
        $form = $form->instanciate();
        $form->isValidForClient();
    }
}

?>
<div class="cover"> 
    <div class="container"> <div class="row"> <div class="col-md-12"> 
    
    <div class="page-title">
        <h1><?php echo __('Open a New Ticket');?></h1>
        <p><?php echo __('Please fill in the form below to open a new ticket.');?></p>
    </div>
    <div class="row">

    <form id="ticketForm" method="post" action="open.php" enctype="multipart/form-data">
    <?php csrf_token(); ?>

    <input type="hidden" name="a" value="open">
        <div class="col-md-12">
        <div class="form-group">
            <label class="required" for="topicId"><?php echo __('Help Topic');?>:</label>
            
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
                <font class="error"><?php echo $errors['topicId']; ?></font>
        </div> 
        </div>             
      
        <div class="col-md-4">
         <?php
            if (!$thisclient) {
                $uform = UserForm::getUserForm()->getForm($_POST);
                if ($_POST) $uform->isValid();
                $uform->render(false);
            }
            else { ?>
          
    <div class="form-header">
        <h3 style="margin-bottom:10px;"> User details </h3>
        <table>
        <tr><td><b><?php echo __('Email'); ?>:</b></td><td><?php echo $thisclient->getEmail(); ?></td></tr>
        <tr><td><b><?php echo __('Client'); ?>:</b></td><td><?php echo $thisclient->getName(); ?></td></tr>
        </table>
    </div>
          


            <?php } ?>
        </div>

        <div class="col-md-8">
        
        <div id="dynamic-form">
            <?php if ($form) {
                include(CLIENTINC_DIR . 'templates/dynamic-form.tmpl.php');
            } ?>
        </div>

        <tbody><?php
            $tform = TicketForm::getInstance();
            if ($_POST) {
                $tform->isValidForClient();
            }
            $tform->render(false); ?>
        </tbody>

        <tbody>
        <?php
        if($cfg && $cfg->isCaptchaEnabled() && (!$thisclient || !$thisclient->isValid())) {
            if($_POST && $errors && !$errors['captcha'])
                $errors['captcha']=__('Please re-enter the text again');
            ?>
        <tr class="captchaRow">
            <td class="required"><?php echo __('CAPTCHA Text');?>:</td>
            <td>
                <span class="captcha"><img src="captcha.php" border="0" align="left"></span>
                &nbsp;&nbsp;
                <input id="captcha" type="text" name="captcha" size="6" autocomplete="off">
                <em><?php echo __('Enter the text shown on the image.');?></em>
                <font class="error">*&nbsp;<?php echo $errors['captcha']; ?></font>
            </td>
        </tr>
        <?php
        } ?>
        <tr><td colspan=2>&nbsp;</td></tr>
        </tbody>
   

    <hr/>
      <p>
            <input class="btn btn-success" type="submit" value="<?php echo __('Create Ticket');?>">
            <input class="btn btn-primary"  type="reset" name="reset" value="<?php echo __('Reset');?>">
            <input class="btn btn-primary"  type="button" name="cancel" value="<?php echo __('Cancel'); ?>" onclick="javascript:
                $('.richtext').each(function() {
                    var redactor = $(this).data('redactor');
                    if (redactor && redactor.opts.draftDelete)
                        redactor.deleteDraft();
                });
                window.location.href='index.php';">
      </p>
      </div>
    </form>
    </div>
    </div></div></div>
</div>
