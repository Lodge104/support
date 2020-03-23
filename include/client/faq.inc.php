<?php
if(!defined('OSTCLIENTINC') || !$faq  || !$faq->isPublished()) die('Access Denied');

$category=$faq->getCategory();

?>
<div class="cover">
    <div class="container"><div class="row">

        <div class="col-md-12">
            <div class="page-title">
               <h1><?php echo __('Frequently Asked Questions');?></h1>
            </div>
        </div>

        <div class="col-md-8">
            <ol class="breadcrumb bordered">
              <li><a href="index.php"><?php echo __('All Categories');?></a></li>
              <li><a href="faq.php?cid=<?php echo $category->getId(); ?>"><?php echo $category->getFullName(); ?></a></li>
            </ol>

            <div class="faq-content">
                <div class="article-title">
                <?php echo $faq->getLocalQuestion() ?>
                </div>
                <div class="threadbody bleed">
                <?php echo $faq->getLocalAnswerWithImages(); ?>
                </div>
                <hr/>
                <div class="faded"><?php echo sprintf(__('Last Updated %s'),
                    Format::relativeTime(Misc::db2gmtime($faq->getUpdateDate()))); ?></div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="sidebar">
                <div class="form-group">
                    <form method="get" action="faq.php">
                    <input type="hidden" name="a" value="search"/>
                    <input type="text" name="q" class="search form-control" placeholder="<?php
                        echo __('Search our knowledge base'); ?>"/>
                    <input id="searchSubmit" type="submit" class="form-control btn btn-success" value="<?php echo __('Search');?>">
                    </form>
                </div>

                <div class="side-content"><?php
                    if ($attachments = $faq->getLocalAttachments()->all()) { ?>
                <section>
                    <h3><?php echo __('Attachments');?>:</h3>
                <?php foreach ($attachments as $att) { ?>
                    <div>
                    <a href="<?php echo $att->file->getDownloadUrl(['id' => $att->getId()]); ?>" class="no-pjax">
                        <i class="icon-file"></i>
                        <?php echo Format::htmlchars($att->getFilename()); ?>
                    </a>
                    </div>
                <?php } ?>
                </section>
                <?php }
                if ($faq->getHelpTopics()->count()) { ?>
                <section>
                    <h3><?php echo __('Help Topics'); ?></h3>
                <?php foreach ($faq->getHelpTopics() as $T) { ?>
                    <div><?php echo $T->topic->getFullName(); ?></div>
                <?php } ?>
                </section>
                <?php }
                ?></div>

            </div>
        </div>

    </div></div>
</div>
