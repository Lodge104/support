<?php
$desc = $event->getDescription(ThreadEvent::MODE_CLIENT);
if (!$desc)
    return;
?>
<div class="thread-event <?php if ($event->uid) echo 'action'; ?> alert alert-warning">
        <span class="type-icon">
          <i class="faded fa fa-<?php echo $event->getIcon(); ?>"></i>
        </span>
        <span class="faded description"><?php echo $desc; ?></span>
</div>
