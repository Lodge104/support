<?php
if(!defined('OSTCLIENTINC') || !$faq  || !$faq->isPublished()) die('Access Denied');

$category=$faq->getCategory();

?>
<div class="cover"> 
    <div class="container"> <div class="row"> <div class="col-md-12"> 
    <div class="page-title">  
	<h1><?php echo __('Frequently Asked Questions');?></h1>
	</div>

<ol class="breadcrumb bordered">
  <li><a href="index.php"><?php echo __('All Categories');?></a></li>
  <li><a href="faq.php?cid=<?php echo $category->getId(); ?>"><?php echo $category->getName(); ?></a></li>
</ol>
<div class="faq-entry"> 
		<div class="faq-title">
			<h2><?php echo $faq->getQuestion() ?></h2>
		</div>

		<div class="clear"></div>
		<div class="threadbody">
		<?php echo Format::safe_html($faq->getAnswerWithImages()); ?>
		</div>
		<hr>
		<p>
		<?php
		if($faq->getNumAttachments()) { ?>
		 <div><span class="faded"><b><?php echo __('Attachments');?>:</b></span>  <?php echo $faq->getAttachmentsLinks(); ?></div>
		<?php
		} ?>

		<div class="article-meta"><span class="faded"><b><?php echo __('Help Topics');?>:</b></span>
		    <?php echo ($topics=$faq->getHelpTopics())?implode(', ',$topics):' '; ?>
		</div>
		</p>
</div>
		<hr>
		<div class="faded">&nbsp;<?php echo __('Last updated').' '.Format::db_daydatetime($category->getUpdateDate()); ?></div>
    </div></div></div>
</div>
