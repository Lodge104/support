<div class="row">
	<div class="col-md-8">
	<?php
	    $categories = Category::objects()
	        ->exclude(Q::any(array(
	            'ispublic'=>Category::VISIBILITY_PRIVATE,
	            'faqs__ispublished'=>FAQ::VISIBILITY_PRIVATE,
	        )))
	        ->annotate(array('faq_count'=>SqlAggregate::COUNT('faqs')))
	        ->filter(array('faq_count__gt'=>0));
	    if ($categories->exists(true)) { ?>
	        <h2><?php echo __('Click on the category to browse FAQs.'); ?></h2>
	        <ul id="kb" class="list-group">
	<?php
	        foreach ($categories as $C) { ?>
	            <li class="list-group-item">
	            <h4><i class="fa fa-folder"></i> <?php echo sprintf('<a href="faq.php?cid=%d">%s (%d)</a>', $C->getId(), Format::htmlchars($C->getLocalName()), $C->faq_count); ?></h4>
	            <div class="list-group-text" style="margin:10px 0">
	                <?php echo Format::safe_html($C->getLocalDescriptionWithImages()); ?>
	            </div>
		            <ul>
		<?php foreach ($C->faqs
		                    ->exclude(array('ispublished'=>FAQ::VISIBILITY_PRIVATE))
		                    ->limit(5) as $F) { ?>
		                <li class="list-group-item"><i class="fa fa-question-circle"></i>
		                <a href="faq.php?id=<?php echo $F->getId(); ?>">
		                <?php echo $F->getLocalQuestion() ?: $F->getQuestion(); ?>
		                </a></li>
		<?php } ?>
		            </ul>
	            </li>
	<?php   } ?>
	       	</ul>
	<?php
	    } else {
	        echo __('NO FAQs found');
	    }
	?>
	</div>
	<!-- /col -->
	<div class="col-md-4">
		<form method="get" action="faq.php">
	        <input type="hidden" name="a" value="search"/>
	        <select name="topicId"  style="width:100%;max-width:100%"
	            onchange="javascript:this.form.submit();" class="form-control">
	            <option value="">—<?php echo __("Browse by Topic"); ?>—</option>
	<?php
	$topics = Topic::objects()
	    ->annotate(array('has_faqs'=>SqlAggregate::COUNT('faqs')))
	    ->filter(array('has_faqs__gt'=>0));
	foreach ($topics as $T) { ?>
	        <option value="<?php echo $T->getId(); ?>"><?php echo $T->getFullName();
	            ?></option>
	<?php } ?>
	        </select>
	        </form>
	        
	    <hr/>

        <section>
            <h4 class="header"><?php echo __('Other Resources'); ?></h4>
        </section>
	</div>
	<!-- col -->
</div>
<!-- /row -->
