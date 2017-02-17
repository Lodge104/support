
<?php
global $cfg;
$entryTypes = array('M'=>'message', 'R'=>'response', 'N'=>'note');
$user = $entry->getUser() ?: $entry->getStaff();
$name = $user ? $user->getName() : $entry->poster;
$avatar = '';
if ($cfg->isAvatarsEnabled() && $user)
    $avatar = $user->getAvatar();
?>


<div class="table-responsive">
    <table class="thread-entry <?php echo $entryTypes[$entry->type]; ?> <?php if ($avatar) echo 'avatar'; ?> table table-bordered table-striped">
        <tr>
	        <th width="60">
	        	<?php if ($avatar) { ?>
				    <span class="<?php echo ($entry->type == 'M') ? '' : ''; ?> avatar" style="width: 30px;">
				<?php echo $avatar; ?>
				    </span>
				<?php } ?>
	        </th>
            <th>
				<span>
		        <?php if ($entry->flags & ThreadEntry::FLAG_EDITED) { ?>
		                <span class="label label-bare" title="<?php
		        echo sprintf(__('Edited on %s by %s'), Format::datetime($entry->updated), 'You');
		                ?>"><?php echo __('Edited'); ?></span>
		        <?php } ?>
		            </span>
		        <?php
	            echo sprintf(__('<b>%s</b> posted %s'), $name,
	                sprintf('<time datetime="%s" title="%s">%s</time>',
	                    date(DateTime::W3C, Misc::db2gmtime($entry->created)),
	                    Format::daydatetime($entry->created),
	                    Format::datetime($entry->created)
	                )
	            ); ?>
            </th>
        </tr>
        <tr>
            <td <?php if ($avatar) echo 'colspan="2"'; ?>>
                <div class="thread-body" id="thread-id-<?php echo $entry->getId(); ?>">
			        <div><?php echo $entry->getBody()->toHtml(); ?></div>
			    </div>
            </td>
        </tr>
        
        <?php if ($entry->has_attachments) { ?>
	        <tr>
	            <td <?php if ($avatar) echo 'colspan="2"'; ?>>
					    <ul class="attachments list-inline">
						    <?php
					        foreach ($entry->attachments as $A) {
							        echo '<li>';
						            if ($A->inline)
						                continue;
						            $size = '';
						            if ($A->file->size)
						                $size = sprintf(' <small class="filesize faded">%s</small>', Format::file_size($A->file->size));?>
						        <span class="attachment-info">
							        <i class="fa fa-paperclip"></i>
							        <a class="no-pjax truncate filename" href="<?php echo $A->file->getDownloadUrl();
							            ?>" download="<?php echo Format::htmlchars($A->getFilename()); ?>"
							            target="_blank"><?php echo Format::htmlchars($A->getFilename());
							        ?></a><?php echo $size;?>
						        </span>
						        <?php echo '<li>'; ?>
							<?php  }  ?>
					    </ul>
					    
	            </td>
	        </tr>
        <?php } ?>
	</table>
</div>
<!-- /.table-responsive -->


<?php
if ($urls = $entry->getAttachmentUrls()) { ?>
    <script type="text/javascript">
        $('#thread-id-<?php echo $entry->getId(); ?>')
            .data('urls', <?php
                echo JsonDataEncoder::encode($urls); ?>)
            .data('id', <?php echo $entry->getId(); ?>);
    </script>
<?php
} ?>