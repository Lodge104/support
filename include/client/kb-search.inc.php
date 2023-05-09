<div class="cover">
    <div class="container"> <div class="row">

    <div class="col-md-12">
        <div class="page-title">
           <h1><?php echo __('Frequently Asked Questions');?></h1>
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

        <div class="well"><strong><?php echo __('Search Results'); ?></strong></div>
    <?php
        if ($faqs->exists(true)) {
            echo '<div id="faq"><p>'.sprintf(__('%d FAQs matched your search criteria.').'</p>',
                $faqs->count())
                .'<ol class="list-group">';
            foreach ($faqs as $F) {
                echo sprintf(
                    '<li class="list-group-item"> <i class="icon-file-text"></i>  <a href="faq.php?id=%d" class="previewfaq">%s</a></li>',
                    $F->getId(), $F->getLocalQuestion(), $F->getVisibilityDescription());
            }
            echo '</ol></div>';
        } else {
            echo '<strong class="faded">'.__('The search did not match any FAQs.').'</strong>';
        }
    ?>
    </div>


</div></div>
</div>
