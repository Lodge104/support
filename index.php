<?php
/*********************************************************************
    index.php

    Helpdesk landing page. Please customize it to fit your needs.

    Peter Rotich <peter@osticket.com>
    Copyright (c)  2006-2013 osTicket
    http://www.osticket.com

    Released under the GNU General Public License WITHOUT ANY WARRANTY.
    See LICENSE.TXT for details.

    vim: expandtab sw=4 ts=4 sts=4:
**********************************************************************/
require('client.inc.php');
$section = 'home';
require(CLIENTINC_DIR.'header.inc.php');
?>

<div id="landing_page">

<div class="container"><div class="row">

    <div class="col-md-12">
        <div class="welcome-page">
            <div class="wptext">
            <?php
            if($cfg && ($page = $cfg->getLandingPage()))
                echo $page->getBodyWithImages();
            else
                echo  '<h1>'.__('Welcome to the Support Center').'</h1>';
            ?>
              </div>
            <?php
            if($cfg && $cfg->isKnowledgebaseEnabled()){
                //FIXME: provide ability to feature or select random FAQs ??
            ?>
          

            <form action="kb/index.php" method="get" id="kb-search" class="form-inline">
                <input type="hidden" name="a" value="search">
                <div class="form-group">
                    <input placeholder="Search Knowledgebase" class="form-control" id="query" type="text" size="20" name="q" value="<?php echo Format::htmlchars($_REQUEST['q']); ?>">
                </div>
                <input class="btn" id="searchSubmit" type="submit" value="<?php echo __('Search');?>">
            </form>

            <?php } ?>

        </div>
    </div>

</div></div>


<div class="home-box">
    <div class="container"><div class="row">
        <div class="col-sm-6">
            <div id="new_ticket">
                <i class="icon-file-text"></i> 
                <h3><?php echo __('Open a New Ticket');?></h3>
                <div><?php echo __('Please provide as much detail as possible so we can best assist you. To update a previously submitted ticket, please login.');?></div>
                <a href="open.php" class="btn"><?php echo __('Open a New Ticket');?></a>
            </div>
        </div>
        <div class="col-sm-6">
            <div id="check_status" class="pull-right">
                <i class="icon-ticket"></i>
                <h3> <?php echo __('Check Ticket Status');?></h3>
                <div><?php echo __('We provide archives and history of all your current and past support requests complete with responses.');?></div>
                <a href="<?php if(is_object($thisclient)){ echo 'tickets.php';} else {echo 'view.php';}?>" class="btn"><?php echo __('Check Ticket Status');?></a>
            </div>            
        </div>
    </div></div>
</div>

<div class="clear"></div>

</div>

<?php
if($cfg && $cfg->isKnowledgebaseEnabled()) { ?>

<div class="faqbanner"> 
    <div class="container"> <div class="row"> 
        <div class="col-md-12">
            <p><?php echo sprintf(
            __('Be sure to browse our %s before opening a ticket'),
            sprintf('<a href="kb/index.php">%s</a>',
                __('Frequently Asked Questions (FAQs)')
            )); ?></p>
        </div>
    </div></div>
</div>

<?php } ?>

<div class="clear"></div>
<?php require(CLIENTINC_DIR.'footer.inc.php'); ?>
