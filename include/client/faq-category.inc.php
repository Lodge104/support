<?php
if(!defined('OSTCLIENTINC') || !$category || !$category->isPublic()) die('Access Denied');
?>

<h1><?php echo __('Frequently Asked Questions');?></h1>
<h2><strong><?php echo $category->getLocalName() ?></strong></h2>
<p>
<?php echo Format::safe_html($category->getLocalDescriptionWithImages()); ?>
</p>
<hr>
<div class="row">
	<div class="col-md-8">
<?php
$faqs = FAQ::objects()
    ->filter(array('category'=>$category))
    ->exclude(array('ispublished'=>FAQ::VISIBILITY_PRIVATE))
    ->annotate(array('has_attachments' => SqlAggregate::COUNT(SqlCase::N()
        ->when(array('attachments__inline'=>0), 1)
        ->otherwise(null)
    )))
    ->order_by('-ispublished', 'question');

if ($faqs->exists(true)) {
    echo '
         <h2>'.__('Further Articles').'</h2>
         <div id="faq">
            <ol class="list-group">';
foreach ($faqs as $F) {
        $attachments=$F->has_attachments?'<span class="Icon file"></span>':'';
        echo sprintf('
            <li class="list-group-item"><a href="faq.php?id=%d" >%s &nbsp;%s</a></li>',
            $F->getId(),Format::htmlchars($F->question), $attachments);
    }
    echo '  </ol>
         </div>';
}else {
    echo '<strong>'.__('This category does not have any FAQs.').' <a href="index.php">'.__('Back To Index').'</a></strong>';
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
	    ->filter(array('faqs__faq__category__category_id'=>$category->getId()))
	    as $t) { ?>
        <li class="list-group-item"><a href="?topicId=<?php echo urlencode($t->getId()); ?>"
            ><?php echo $t->getFullName(); ?></a></li>
<?php } ?>


    </div>
    <!-- col -->

</div>
<!-- /row -->
