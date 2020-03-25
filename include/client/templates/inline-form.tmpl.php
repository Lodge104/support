<div class="form-inline"><?php
foreach ($form->getFields() as $field) { ?>
	<div class="form-group <?php if ($field->get('required')) echo 'required'; ?>">
        <label><?php echo Format::htmlchars($field->get('label')); ?></abel>
        <?php
        $field->render(); ?>
        <?php if ($field->get('required')) { ?>
            <span class="error">*</span>
        <?php
        }
        if ($field->get('hint') && !$field->isBlockLevel()) { ?>
            <br/><em style="color:gray;display:inline-block"><?php
                echo Format::htmlchars($field->get('hint')); ?></em>
        <?php
        }
        foreach ($field->errors() as $e) { ?>
            <br />
            <span class="error"><?php echo Format::htmlchars($e); ?></span>
        <?php } ?>
    </div>
<?php
} ?>
</div>
