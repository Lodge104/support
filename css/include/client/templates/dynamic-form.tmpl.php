<?php
    // Form headline and deck with a horizontal divider above and an extra
    // space below.
    // XXX: Would be nice to handle the decoration with a CSS class
    ?>
 
    <div class="form-header">
    <h3><?php echo Format::htmlchars($form->getTitle()); ?></h3>
    <span><?php echo Format::htmlchars($form->getInstructions()); ?></span>
    </div>
    <table width="100%">
    <?php
    // Form fields, each with corresponding errors follows. Fields marked
    // 'private' are not included in the output for clients
    global $thisclient;
    foreach ($form->getFields() as $field) {
        if (!$field->isVisibleToUsers())
            continue;
        ?>

                <tr class="form-group">
                    <?php if ($field->isBlockLevel()) { ?>
                        <td colspan="2">
                    <?php
                    }
                    else { ?>
                        <td><label for="<?php echo $field->getFormName(); ?>" class="<?php
                            if ($field->get('required')) echo 'required'; ?>">
                        <?php echo Format::htmlchars($field->get('label')); ?>:
                        <?php if ($field->get('required')) { ?>
                            <font class="error">*</font>
                        <?php } ?>
                    </label><br>
                    <?php
                    }
                    $field->render('client'); ?>
                    
                    <?php
                    if ($field->get('hint') && !$field->isBlockLevel()) { ?>
                        <em style="color:gray;display:inline-block"><?php
                            echo Format::htmlchars($field->get('hint')); ?></em>
                    <?php
                    }
                    foreach ($field->errors() as $e) { ?>
                       
                        <font class="error"><?php echo $e; ?></font>
                    <?php }
                    $field->renderExtras('client');
                    ?>
                    </td>
                </tr>

        <?php
    } ?>
</table>