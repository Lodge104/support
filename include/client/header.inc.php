<?php
$title=($cfg && is_object($cfg) && $cfg->getTitle())
    ? $cfg->getTitle() : 'osTicket :: '.__('Support Ticket System');
$signin_url = ROOT_PATH . "login.php"
    . ($thisclient ? "?e=".urlencode($thisclient->getEmail()) : "");
$signout_url = ROOT_PATH . "logout.php?auth=".$ost->getLinkToken();

header("Content-Type: text/html; charset=UTF-8");
if (($lang = Internationalization::getCurrentLanguage())) {
    $langs = array_unique(array($lang, $cfg->getPrimaryLanguage()));
    $langs = Internationalization::rfc1766($langs);
    header("Content-Language: ".implode(', ', $langs));
}
?>
<!DOCTYPE html>
<html<?php
if ($lang
        && ($info = Internationalization::getLanguageInfo($lang))
        && (@$info['direction'] == 'rtl'))
    echo ' dir="rtl" class="rtl"';
if ($lang) {
    echo ' lang="' . $lang . '"';
}
?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo Format::htmlchars($title); ?></title>
    <meta name="description" content="customer support platform">
    <meta name="keywords" content="osTicket, Customer support system, support ticket system">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
	<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/osticket.css?901e5ea" media="screen"/>
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>css/print.css?901e5ea" media="print"/>
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>scp/css/typeahead.css?901e5ea" media="screen" />
    <link type="text/css" href="<?php echo ROOT_PATH; ?>css/ui-lightness/jquery-ui-1.10.3.custom.min.css?901e5ea"rel="stylesheet" media="screen" />
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/thread.css?901e5ea" media="screen"/>
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/redactor.css?901e5ea" media="screen"/>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/font-awesome.min.css?901e5ea"/>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/flags.css?901e5ea"/>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/rtl.css?901e5ea"/>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/select2.min.css?901e5ea"/>
    
    <!-- osTT Client Theme Stylesheets -->
    	<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/osttclient/css/bootstrap.min.css" media="screen"/>
		<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/osttclient/css/osttclient.theme.min.css?v1" media="screen"/>
		
		<!-- Change your colour scheme here. Replace the below stylesheet with your preferred colour from the /assets/osttclient/css/colours directory -->
			<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/osttclient/css/colours/dark-blue-scheme.css" media="screen"/>
		<!-- End colour scheme -->
			
	<!-- End osTT Client Theme Stylesheets -->
    
    
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-1.11.2.min.js?901e5ea"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-ui-1.10.3.custom.min.js?901e5ea"></script>
    <script src="<?php echo ROOT_PATH; ?>js/osticket.js?901e5ea"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/filedrop.field.js?901e5ea"></script>
    <script src="<?php echo ROOT_PATH; ?>scp/js/bootstrap-typeahead.js?901e5ea"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor.min.js?901e5ea"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor-plugins.js?901e5ea"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor-osticket.js?901e5ea"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/select2.min.js?901e5ea"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/fabric.min.js?901e5ea"></script>
    
    
    <!-- osTT Client Theme Scripts -->
    	<script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets/osttclient/js/bootstrap.min.js"></script>
    	<script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets/osttclient/js/osticket.osttclient.js"></script>
    <!-- osTT Client Theme Scripts -->
    
    <?php
    if($ost && ($headers=$ost->getExtraHeaders())) {
        echo "\n\t".implode("\n\t", $headers)."\n";
    }

    // Offer alternate links for search engines
    // @see https://support.google.com/webmasters/answer/189077?hl=en
    if (($all_langs = Internationalization::getConfiguredSystemLanguages())
        && (count($all_langs) > 1)
    ) {
        $langs = Internationalization::rfc1766(array_keys($all_langs));
        $qs = array();
        parse_str($_SERVER['QUERY_STRING'], $qs);
        foreach ($langs as $L) {
            $qs['lang'] = $L; ?>
        <link rel="alternate" href="//<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>?<?php
            echo http_build_query($qs); ?>" hreflang="<?php echo $L; ?>" />
<?php
        } ?>
        <link rel="alternate" href="//<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>"
            hreflang="x-default" />
<?php
    }
    ?>
</head>

<body>
	<header>
		<nav class="navbar">
			<div class="pre-header">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="navbar-header row">
								<div class="col-xs-9 col-sm-12">
									
									<a class="navbar-brand" id="logo" href="<?php echo ROOT_PATH; ?>index.php"
						            title="<?php echo __('Support Center'); ?>">
						                <img src="<?php echo ROOT_PATH; ?>logo.php" border=0 alt="<?php
						                echo $ost->getConfig()->getTitle(); ?>" class="hidden-xs hidden-sm">
						                <span class="hidden-md hidden-lg"><?php echo $ost->getConfig()->getTitle(); ?></span>
						            </a>
								</div>
								<!-- /.col -->
					            <div class="col-xs-3 hidden-sm hidden-md hidden-lg">
									<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#navbar-main"  aria-expanded="false" aria-controls="navbar">
										<span class="sr-only">Toggle navigation</span>
										<i class="fa fa-bars fa-2x"></i>
									</button>
								</div>
								<!-- /.col -->
							</div>
							<!-- /.navbar-header row -->
						</div>
						<!-- /.col -->
						<div class="col-md-6">
							<ul class="list-inline pull-right hidden-xs">
									<?php
					                if ($thisclient && is_object($thisclient) && $thisclient->isValid()
					                    && !$thisclient->isGuest()) {
					                 echo Format::htmlchars($thisclient->getName()).'&nbsp;|';
					                 ?>
					                <li><a href="<?php echo ROOT_PATH; ?>profile.php"><i class="fa fa-user"></i> <?php echo __('Profile'); ?></a></li>
					                <li><a href="<?php echo ROOT_PATH; ?>tickets.php"><i class="fa fa-ticket"></i> <?php echo sprintf(__('Tickets <b>(%d)</b>'), $thisclient->getNumTickets()); ?></a></li>
					                <li><a href="<?php echo $signout_url; ?>" class="btn btn-danger"><i class="fa fa-sign-out"></i> <?php echo __('Sign Out'); ?></a></li>
					            <?php
					            } elseif($nav) {
					                if ($cfg->getClientRegistrationMode() == 'public') { ?>
					                    <li><?php echo __('Guest User'); ?></li>
					                <?php
					                }
					                if ($thisclient && $thisclient->isValid() && $thisclient->isGuest()) { ?>
					                    <li><a href="<?php echo $signout_url; ?>" class="btn btn-danger"><i class="fa fa-sign-out"></i> <?php echo __('Sign Out'); ?></a></li>
					                <?php
					                }
					                elseif ($cfg->getClientRegistrationMode() != 'disabled') { ?>
					                    <li><a href="<?php echo $signin_url; ?>" class="btn btn-success"><i class="fa fa-sign-in"></i> <?php echo __('Sign in'); ?></a></li>
					<?php
					                }
					            } ?>
					            <?php
								if (($all_langs = Internationalization::getConfiguredSystemLanguages())
								    && (count($all_langs) > 1)
								) {
									$qs = array();
									parse_str($_SERVER['QUERY_STRING'], $qs);
								    foreach ($all_langs as $code=>$info) {
								        list($lang, $locale) = explode('_', $code);
								        $qs['lang'] = $code;
								?>
								        <li><a class="flag flag-<?php echo strtolower($locale ?: $info['flag'] ?: $lang); ?>"
								            href="?<?php echo http_build_query($qs);?>" title="<?php echo Internationalization::getLanguageDescription($code); ?>">&nbsp;</a></li>
								<?php }
								} ?>
							</ul>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
				<!-- /.container -->
			</div>
			<!-- /.pre-header -->
			<div class="navbar-collapse collapse" id="navbar-main">
				<div class="navbar-container">
					<?php
			        if($nav){ ?>
			        <ul class="nav navbar-nav">
			            <?php
			            if($nav && ($navs=$nav->getNavLinks()) && is_array($navs)){
			                foreach($navs as $name =>$nav) {
			                    echo sprintf('<li class="%s"><a class="%s" href="%s">%s</a></li>',$nav['active']?'active':'',$name,(ROOT_PATH.$nav['href']),$nav['desc']);
			                }
			            } ?>
			            <?php
				            
				        // Mobile profile links
				        
		                if ($thisclient && is_object($thisclient) && $thisclient->isValid()
		                    && !$thisclient->isGuest()) {
		                 ?>
		                <li class="hidden-sm hidden-md hidden-lg"><a href="<?php echo ROOT_PATH; ?>profile.php"><i class="fa fa-user"></i> <?php echo Format::htmlchars($thisclient->getName()); ?></a></li>
		                <li class="hidden-sm hidden-md hidden-lg"><a href="<?php echo $signout_url; ?>" class="text-danger"><i class="fa fa-sign-out"></i> <?php echo __('Sign Out'); ?></a></li>
		            <?php
		            } elseif($nav) {
		                if ($thisclient && $thisclient->isValid() && $thisclient->isGuest()) { ?>
		                    <li class="hidden-sm hidden-md hidden-lg"><a href="<?php echo $signout_url; ?>" class="text-danger"><i class="fa fa-sign-out"></i> <?php echo __('Sign Out'); ?></a></li>
		                <?php
		                }
		                elseif ($cfg->getClientRegistrationMode() != 'disabled') { ?>
		                    <li class="hidden-sm hidden-md hidden-lg"><a href="<?php echo $signin_url; ?>" class="text-success"><i class="fa fa-sign-in"></i> <?php echo __('Sign In'); ?></a></li>
		<?php
		                }
		            } ?>
		            
		            <?php
					if (($all_langs = Internationalization::getConfiguredSystemLanguages())
					    && (count($all_langs) > 1)
					) {
						$qs = array();
						parse_str($_SERVER['QUERY_STRING'], $qs);
					    foreach ($all_langs as $code=>$info) {
					        list($lang, $locale) = explode('_', $code);
					        $qs['lang'] = $code;
					?>
					        <li class="hidden-sm hidden-md hidden-lg"><a class="flag flag-<?php echo strtolower($locale ?: $info['flag'] ?: $lang); ?>"
					            href="?<?php echo http_build_query($qs);?>" title="<?php echo Internationalization::getLanguageDescription($code); ?>">&nbsp;</a></li>
					<?php }
					} 
					// End Mobile profile links
					
					?>
			        </ul>
			        <?php
			        }?>
				</div>
				<!-- /.navbar-main -->
			</div>
			<!-- /#navbar-main -->
		</nav>
		<!-- /.navbar -->
	</header>
	
	<section id="main" role="main">
	
		<div class="container">

	         <?php if($errors['err']) { ?>
	            <div class="alert alert-danger"><?php echo $errors['err']; ?></div>
	         <?php }elseif($msg) { ?>
	            <div class="alert alert-info"><?php echo $msg; ?></div>
	         <?php }elseif($warn) { ?>
	            <div class="alert alert-warning"><?php echo $warn; ?></div>
	         <?php } ?>