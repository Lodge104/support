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
require_once INCLUDE_DIR . 'class.page.php';
$section = 'home';
require(CLIENTINC_DIR.'header.inc.php');
?>
<div class="landing-page">
	
	<div class="row">
		
		<?php
		$faqs = FAQ::getFeatured()->select_related('category')->limit(5);
		if ($faqs->all()) { ?>
		
			<div class="col-md-8">
			
		<?php } else { ?>
		
			<div class="col-xs-12">
				
		<?php } ?>
		
			<div class="row text-center">	
				<div class="col-xs-12">
				    <?php
				    if($cfg && ($page = $cfg->getLandingPage()))
				        echo $page->getBodyWithImages();
				    else
				        echo  '<h1>'.__('Welcome to the Support Centre').'</h1>';
				    ?>
				</div>
				<!-- /.col -->	 
				<?php
				$BUTTONS = isset($BUTTONS) ? $BUTTONS : true;
				?>
				<?php if ($BUTTONS) { ?>   
				    <div class="col-xs-12">
					    <?php if ($cfg->getClientRegistrationMode() != 'disabled' || !$cfg->isClientLoginRequired()) { ?>
						    <a href="open.php" class="block-box">
							    <i data-icon=">" class="icon"></i>
							    <?php echo __('Open a New Ticket');?>
						    </a>
						<?php } ?>
					    <a href="<?php if(is_object($thisclient)){ echo 'tickets.php';} else {echo 'view.php';}?>" class="block-box">
						    <i data-icon="~" class="icon"></i>
						    <?php echo __('Check Ticket Status');?>
					    </a>
				    </div>
				    <!-- /.col -->	
			    <?php } ?>	    
			</div>
			<!-- /.row -->
		
		</div><!-- /col -->
			
		<?php if ($faqs->all()) { ?>
	
			<div class="col-md-4">
				<?php include CLIENTINC_DIR.'templates/sidebar.tmpl.php'; ?>
			</div>
			<!-- /col -->
			
		<?php } ?>
		
		
	</div>
	<!-- /.row -->

    

	<?php
	if($cfg && $cfg->isKnowledgebaseEnabled()){
	?>
	<section class="kb well space-top-2x padding-bottom-2x">
		<div class="row text-center">
			<div class="col-md-8 col-md-offset-2">
				<h5><?php echo __('Search our knowledge base'); ?></h5>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
		<div class="row text-center">
			<div class="col-md-8 col-md-offset-2">
    
				<form action="kb/faq.php" method="get" id="kb-search">
					<input type="hidden" name="a" value="search"/>
	                <div class="row">
		                <div class="col-md-8">
			                <input type="text" class="form-control space-bottom" placeholder="<?php echo __('Search our knowledge base'); ?>" name="q">
		                </div>
		                <!-- /.col -->
		                <div class="col-md-4">
			                <button class="btn btn-success btn-block" type="submit" id="searchSubmit"><?php echo __('Search');?></button>
		                </div>
		                <!-- /.col -->	                
	                </div>
	                <!-- /.row -->
	            </form>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<hr>
	<section>
		<?php
		$cats = Category::getFeatured();
		if ($cats->all()) { ?>
		<h3 class="text-center"><?php echo __('Featured Knowledge Base Articles'); ?></h3>
		<?php
		}?>
		<ul class="list-group">
		<?php foreach ($cats as $C) { ?>
        <li class="list-group-item">
            <h4><i class="fa fa-folder-o"></i> <?php echo $C->getName(); ?></h4>
            <ul class="list-group">
			<?php foreach ($C->getTopArticles() as $F) { ?>
				<li class="list-group-item"><a href="<?php echo ROOT_PATH;
                ?>kb/faq.php?id=<?php echo $F->getId(); ?>"><?php
                echo $F->getQuestion(); ?></a>
				<div class="list-group-item-text"><?php echo $F->getTeaser(); ?></div>
				</li>
			<?php } ?>
			</ul>
		</li>
		<?php }?>
	</section>
	
    <?php
	} ?>
</div>
<!-- /.landing-page -->
	
<?php require(CLIENTINC_DIR.'footer.inc.php'); ?>