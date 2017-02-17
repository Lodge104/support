<?php
if(!defined('OSTCLIENTINC') || !$faq  || !$faq->isPublished()) die('Access Denied');

$category=$faq->getCategory();

?>

<div class="page-title">  
	<h1><?php echo __('Frequently Asked Questions');?></h1>
</div>

<ol class="breadcrumb bordered">
  <li><a href="index.php"><?php echo __('All Categories');?></a></li>
  <li><a href="faq.php?cid=<?php echo $category->getId(); ?>"><?php echo $category->getName(); ?></a></li>
</ol>

<div class="row"> 
	<div class="col-md-8"> 

		<div class="faq-title">
			<h2><?php echo $faq->getLocalQuestion() ?></h2>
		</div>
		
		<div class="well well-lg">
			<?php echo $faq->getLocalAnswerWithImages(); ?>
		</div>
		<hr>

		<p><b><?php echo __('Help Topics');?>:</b> <?php echo ($topics=$faq->getHelpTopics())?implode(', ',$topics):' '; ?></p>

		<hr>
		<p><small><?php echo sprintf(__('Last Updated %s'), Format::relativeTime(Misc::db2gmtime($category->getUpdateDate()))); ?></small></p>
	</div>
	<!-- /.col -->
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
		
		<?php if ($attachments = $faq->getLocalAttachments()->all()) { ?>
			
			<h4><?php echo __('Attachments');?></h4>
			<ul class="list-group">
				<?php foreach ($attachments as $att) { ?>
				    <li class="list-item">
				    <a href="<?php echo $att->file->getDownloadUrl(); ?>" class="no-pjax">
				        <i class="fa fa-file-o"></i>
				        <?php echo Format::htmlchars($att->getFilename()); ?>
				    </a>
				    </li>
				<?php } ?>
			</ul>
		
		<?php }
		if ($faq->getHelpTopics()->count()) { ?>
		<section>
		    <h4><?php echo __('Help Topics'); ?></h4>
		    <ul class="list-group">
		<?php foreach ($faq->getHelpTopics() as $T) { ?>
		    <li class="list-group-item"><?php echo $T->topic->getFullName(); ?></li>
		<?php } ?>
		    </ul>
		</section>
		<?php } ?>
		
	</div>
	<!-- /col -->
</div>
<!-- /.row -->
