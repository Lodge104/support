<h1 class="text-center"><?php echo __('Frequently Asked Questions');?></h1>

<div class="row">
	<div class="col-md-8">
    <h2><?php echo __('Search Results'); ?></h2>
<?php
    if ($faqs->exists(true)) {
        echo '<div id="faq">'.sprintf(__('<h3><span class="text-success">%d</span> FAQs matched your search criteria.</h3>'),
            $faqs->count())
            .'<ol class="list-group">';
        foreach ($faqs as $F) {
            echo sprintf(
                '<li><a href="faq.php?id=%d" class="previewfaq list-group-item">%s</a></li>',
                $F->getId(), $F->getLocalQuestion(), $F->getVisibilityDescription());
        }
        echo '</ol></div>';
    } else {
        echo '<h2>'.__('The search did not match any FAQs.').'</h2>';
    }
?>
	</div>
	<!-- /col -->
	
	<div class="col-md-4">

        <form method="get" action="faq.php">
	        <input type="hidden" name="a" value="search"/>
	        <div class="input-group">
	        	<input type="text" name="q" class="form-control" placeholder="<?php echo __('Search our knowledge base'); ?>"/>
	            <span class="input-group-btn">
	            <button class="btn btn-default" type="submit">Go!</button>
	            </span>
	        </div>
        </form>
        
        <hr>
        
        <h3><?php echo __('Help Topics'); ?></h3>
        <ul class="list-group">
		<?php
		foreach (Topic::objects()
		    ->annotate(array('faqs_count'=>SqlAggregate::count('faqs')))
		    ->filter(array('faqs_count__gt'=>0))
		    as $t) { ?>
		        <li class="list-group-item"><a href="?topicId=<?php echo urlencode($t->getId()); ?>"
		            ><?php echo $t->getFullName(); ?></a></li>
		<?php } ?>
        </ul>

		
		
		<h3><?php echo __('Categories'); ?></h3>
		
		<ul class="list-group">
			<?php
			foreach (Category::objects()
			    ->annotate(array('faqs_count'=>SqlAggregate::count('faqs')))
			    ->filter(array('faqs_count__gt'=>0))
			    as $C) { ?>
		        <li class="list-group-item"><a href="?cid=<?php echo urlencode($C->getId()); ?>"><?php echo $C->getLocalName(); ?></a></li>
			<?php } ?>

		</ul>
		
	</div>
	<!-- /col -->
	
</div>
<!-- /row -->
