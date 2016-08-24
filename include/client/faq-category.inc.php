<?php
if(!defined('OSTCLIENTINC') || !$category || !$category->isPublic()) die('Access Denied');
?>

<div class="cover"> 
    <div class="container"> <div class="row"> <div class="col-md-12"> 
    <div class="page-title">       
    <h1><strong><?php echo $category->getName() ?></strong></h1>
    <p>
    <?php echo Format::safe_html($category->getDescription()); ?>
    </p>
    </div>

    <?php
    $sql='SELECT faq.faq_id, question, count(attach.file_id) as attachments '
        .' FROM '.FAQ_TABLE.' faq '
        .' LEFT JOIN '.ATTACHMENT_TABLE.' attach
             ON(attach.object_id=faq.faq_id AND attach.type=\'F\' AND attach.inline = 0) '
        .' WHERE faq.ispublished=1 AND faq.category_id='.db_input($category->getId())
        .' GROUP BY faq.faq_id '
        .' ORDER BY question';
    if(($res=db_query($sql)) && db_num_rows($res)) {
        echo '

            <div class="well">
            <strong>'.__('Frequently Asked Questions').'</strong>
            </div>
            <div id="faq">
                <ol class="list-group">';
        while($row=db_fetch_array($res)) {
            $attachments=$row['attachments']?'<span class="Icon file"></span>':'';
            echo sprintf('
                <li class="list-group-item"><i class="icon-file-text"></i> <a href="faq.php?id=%d" >%s &nbsp;%s</a></li>',
                $row['faq_id'],Format::htmlchars($row['question']), $attachments);
        }
        echo '  </ol>
            </div>
            <a style="color:#fff;" class="back btn btn-primary" href="index.php">&laquo; '.__('Go Back').'</a> 
            <p></p>
            ';
    }else {
        echo '<strong>'.__('This category does not have any FAQs.').' <a href="index.php">'.__('Back To Index').'</a></strong>';
    }
    ?>
    </div></div></div>
</div>
