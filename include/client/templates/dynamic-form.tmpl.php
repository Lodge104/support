<?php
// Return if no visible fields
global $thisclient;
if (!$form->hasAnyVisibleFields($thisclient))
    return;

$isCreate = (isset($options['mode']) && $options['mode'] == 'create');
?>
    <div class="form-header" style="margin-bottom:0.5em">
    <h3><?php echo Format::htmlchars($form->getTitle()); ?></h3>
    <span><?php echo Format::display($form->getInstructions()); ?></span>
    </div>
        <table width="100%">
    <?php
    // Form fields, each with corresponding errors follows. Fields marked
    // 'private' are not included in the output for clients
   // global $thisclient;
    foreach ($form->getFields() as $field) {
        try {
            if (!$field->isEnabled())
                continue;
        }
        catch (Exception $e) {
            // Not connected to a DynamicFormField
        }

        if ($isCreate) {
            if (!$field->isVisibleToUsers() && !$field->isRequiredForUsers())
                continue;
        } elseif (!$field->isVisibleToUsers()) {
            continue;
        }
        ?>
            <tr class="form-group">
            <td colspan="2" style="padding-top:10px;">
            <?php if (!$field->isBlockLevel()) { ?>
                <label for="<?php echo $field->getFormName(); ?>"><span class="<?php
                    if ($field->isRequiredForUsers()) echo 'required'; ?>">
                <?php echo Format::htmlchars($field->getLocal('label')); ?>
            <?php if ($field->isRequiredForUsers() &&
                    ($field->isEditableToUsers() || $isCreate)) { ?>
                <span class="error">*</span>
            <?php }
            ?></span><?php
                if ($field->get('hint')) { ?>
                    <em style="color:gray;display:inline-block"><?php
                        echo Format::viewableImages($field->getLocal('hint')); ?> </em>
                <?php
                } ?>
            <br/>
            <?php
            }
            if ($field->isEditableToUsers() || $isCreate) {
                $field->render(array('client'=>true));
                ?></label><?php
                foreach ($field->errors() as $e) { ?>
                    <div class="error"><?php echo $e; ?></div>
                <?php }
                $field->renderExtras(array('client'=>true));
            } else {
                $val = '';
                if ($field->value)
                    $val = $field->display($field->value);
                elseif (($a=$field->getAnswer()))
                    $val = $a->display();

                echo sprintf('%s </label>', $val);
            }
            ?>
            </td>
        </tr>

        <?php
    }
?>
    </table>
