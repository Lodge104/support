<?php
if(!defined('OSTCLIENTINC') || !$category || !$category->isPublic()) die('Access Denied');
?>

<div class="cover">
    <div class="container"><div class="row">

        <div class="col-md-12">
            <div class="page-title">
               <h1><?php echo $category->getFullName(); ?></h1>
               <p>
               <?php echo Format::safe_html($category->getLocalDescriptionWithImages()); ?>
               </p>
               <?php

if (($subs=$category->getSubCategories(array('public' => true)))) {
    echo '<div>';
    foreach ($subs as $c) {
        echo sprintf('<div><i class="icon-folder-open-alt"></i>
                <a href="faq.php?cid=%d">%s (%d)</a></div>',
                $c->getId(),
                $c->getLocalName(),
                $c->getNumFAQs()
                );
    }
    echo '</div>';
} ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="sidebar">
                <div class="form-group">
                    <form method="get" action="faq.php">
                    <input type="hidden" name="a" value="search"/>
                    <select class="form-control" name="topicId"  style="width:100%;max-width:100%">
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
                </div>

                <div class="form-group">
                    <form method="get" action="faq.php">
                    <input type="hidden" name="a" value="search"/>
                    <input type="text" name="q" class="search form-control" placeholder="<?php
                        echo __('Search our knowledge base'); ?>"/>
                    <input id="searchSubmit" type="submit" class="form-control btn btn-success" value="<?php echo __('Search');?>">
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
        <div class="well">
            <?php echo __('Frequently Asked Questions');?>
        </div>
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
                 <div id="faq">
                    <ol class="list-group">';
        foreach ($faqs as $F) {
                $attachments=$F->has_attachments?'<span class="Icon file"></span>':'';
                echo sprintf('
                    <li class="list-group-item"> <i class="icon-file-text"></i>  <a href="faq.php?id=%d" >%s &nbsp;%s</a></li>',
                    $F->getId(),Format::htmlchars($F->question), $attachments);
            }
            echo '  </ol>
                 </div>';
        } elseif (!$category->children){
            echo '<strong>'.__('This category does not have any FAQs.').' <a href="index.php">'.__('Back To Index').'</a></strong>';
        }
        ?>
        </div>


    </div></div>
</div>
