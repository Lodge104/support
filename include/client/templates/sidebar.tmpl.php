<?php
    $faqs = FAQ::getFeatured()->select_related('category')->limit(5);
    if ($faqs->all()) { ?>
         <h3><?php echo __('Featured Questions'); ?></h3>
         <ul class="list-group">
<?php   foreach ($faqs as $F) { ?>
            <li class="list-group-item"><a href="<?php echo ROOT_PATH; ?>kb/faq.php?id=<?php
                echo urlencode($F->getId());
                ?>"><?php echo $F->getLocalQuestion(); ?></a></li>
<?php   } ?>
            </ul>
<?php
    }
    $resources = Page::getActivePages()->filter(array('type'=>'other'));
    if ($resources->all()) { ?>
    <hr>
            <h4><?php echo __('Other Resources'); ?></h4>
            <ul class="list-group">
<?php   foreach ($resources as $page) { ?>
            <li class="list-group-item"><a href="<?php echo ROOT_PATH; ?>pages/<?php echo $page->getNameAsSlug();
            ?>"><?php echo $page->getLocalName(); ?></a></li>
<?php   } ?>
            </ul>
<?php
    }
        ?>

