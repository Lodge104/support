<?php
$title=($cfg && is_object($cfg) && $cfg->getTitle())
    ? $cfg->getTitle() : 'osTicket :: '.__('Support Ticket System');
$signin_url = ROOT_PATH . "login.php"
    . ($thisclient ? "?e=".urlencode($thisclient->getEmail()) : "");
$signout_url = ROOT_PATH . "logout.php?auth=".$ost->getLinkToken();

<!-- START MOD05 add Favicon  -->
<head profile=\"http://www.w3.org/2005/10/profile\">
<link rel=\"icon\" 
      type=\"image/gif\" 
      href=\"https://www.support.lodge104.net/favicon.gif\">
<!-- END MOD05 Changes -->

header("Content-Type: text/html; charset=UTF-8");
?>
<!DOCTYPE html>
<html <?php
if (($lang = Internationalization::getCurrentLanguage())
        && ($info = Internationalization::getLanguageInfo($lang))
        && (@$info['direction'] == 'rtl'))
    echo 'dir="rtl" class="rtl"';
?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo Format::htmlchars($title); ?></title>
    <meta name="description" content="customer support platform">
    <meta name="keywords" content="osTicket, Customer support system, support ticket system">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/osticket.css?19292ad" media="screen"/>

    <link href='https://fonts.googleapis.com/css?family=Arimo:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>css/bootstrap.css?19292ad" media="screen"/>   
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>css/bootstrap-multiselect.css?19292ad" media="screen"/>  
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>css/theme.css?19292ad" media="screen"/>

    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>css/print.css?19292ad" media="print"/>
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>scp/css/typeahead.css?19292ad"
         media="screen" />
    <link type="text/css" href="<?php echo ROOT_PATH; ?>css/ui-lightness/jquery-ui-1.10.3.custom.min.css?19292ad"
        rel="stylesheet" media="screen" />
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/thread.css?19292ad" media="screen"/>
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/redactor.css?19292ad" media="screen"/>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/font-awesome.min.css?19292ad"/>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/flags.css?19292ad"/>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/rtl.css?19292ad"/>
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-ui-1.10.3.custom.min.js?19292ad"></script>
    <script src="<?php echo ROOT_PATH; ?>js/osticket.js?19292ad"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/filedrop.field.js?19292ad"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery.multiselect.min.js?19292ad"></script>

    <script src="<?php echo ROOT_PATH; ?>scp/js/bootstrap-typeahead.js?19292ad"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor.min.js?19292ad"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor-osticket.js?19292ad"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor-fonts.js?19292ad"></script>

    <script type="text/javascript" src="<?php echo ASSETS_PATH; ?>js/tinynav.js?19292ad"></script>
    <script type="text/javascript" src="<?php echo ASSETS_PATH; ?>js/bootstrap.js?19292ad"></script>
    <script type="text/javascript" src="<?php echo ASSETS_PATH; ?>js/bootstrap-multiselect.js?19292ad"></script>
    <?php
    if($ost && ($headers=$ost->getExtraHeaders())) {
        echo "\n\t".implode("\n\t", $headers)."\n";
    }
    ?>
</head>
<body>
    <div id="container">

        <div id="header">

            <div class="top-bar">
                <div class="container"><div class="row">
                    <div class="col-md-12">
                        <?php
                        if ($thisclient && is_object($thisclient) && $thisclient->isValid()
                            && !$thisclient->isGuest()) {
                         echo Format::htmlchars($thisclient->getName()).'&nbsp;|';
                         ?>
                        <a href="<?php echo ROOT_PATH; ?>profile.php"><?php echo __('Profile'); ?></a> |
                        <a href="<?php echo ROOT_PATH; ?>tickets.php"><?php echo sprintf(__('Tickets <b>(%d)</b>'), $thisclient->getNumTickets()); ?></a> -
                        <a href="<?php echo $signout_url; ?>"><?php echo __('Sign Out'); ?></a>
                        <?php
                        } elseif($nav) {
                            if ($cfg->getClientRegistrationMode() == 'public') { ?>
                                <?php echo __('Guest User'); ?> | <?php
                            }
                            if ($thisclient && $thisclient->isValid() && $thisclient->isGuest()) { ?>
                                <a href="<?php echo $signout_url; ?>"><?php echo __('Sign Out'); ?></a><?php
                            }
                            elseif ($cfg->getClientRegistrationMode() != 'disabled') { ?>
                                <a href="<?php echo $signin_url; ?>"><?php echo __('Sign In'); ?></a>
                        <?php }
                        } ?>   

                        <?php
                        if (($all_langs = Internationalization::availableLanguages())
                            && (count($all_langs) > 1)
                        ) {
                            foreach ($all_langs as $code=>$info) {
                                list($lang, $locale) = explode('_', $code);
                        ?>
                                <a class="flag flag-<?php echo strtolower($locale ?: $info['flag'] ?: $lang); ?>"
                                    href="?<?php echo urlencode($_GET['QUERY_STRING']); ?>&amp;lang=<?php echo $code;
                                    ?>" title="<?php echo Internationalization::getLanguageDescription($code); ?>">&nbsp;</a>
                        <?php }
                        } ?>                     
                    </div>

                </div></div>

            </div>

            <div class="head">
                <div class="container"> <div class="row">
                <div class="col-md-12"> 
                    <a id="logo" href="<?php echo ROOT_PATH; ?>index.php"
                    title="<?php echo __('Support Center'); ?>">
                        <span class="valign-helper"></span>
                        <img src="<?php echo ROOT_PATH; ?>logo.php" border=0 alt="<?php
                        echo $ost->getConfig()->getTitle(); ?>">
                    </a>
                </div>
                </div></div>
            </div>


            <div class="container"> <div class="row">
                <div class="col-md-12">
                    <?php
                    if($nav){ ?>
                    <ul id="nav">
                        <?php
                        if($nav && ($navs=$nav->getNavLinks()) && is_array($navs)){
                            foreach($navs as $name =>$nav) {
                                echo sprintf('<li><a class="%s %s" href="%s">%s</a></li>%s',$nav['active']?'active':'',$name,(ROOT_PATH.$nav['href']),$nav['desc'],"\n");
                            }
                        } ?>
                    </ul>
                    <?php
                    }else{ ?>
                     <hr>
                    <?php
                    } ?>
                </div>
                <script>
                  $(function () {
                    $("#nav").tinyNav({
                        header: 'Navigation'
                    });
                  });
                </script>
            </div></div>


        </div> <!-- End header -->

        <div class="clear"></div>


        <div id="content">

        <div class="alert-area">
            <div class="container"> <div class="row"> <div class="col-md-12"> 
                 <?php if($errors['err']) { ?>
                    <div id="msg_error"><?php echo $errors['err']; ?></div>
                 <?php }elseif($msg) { ?>
                    <div id="msg_notice"><?php echo $msg; ?></div>
                 <?php }elseif($warn) { ?>
                    <div id="msg_warning"><?php echo $warn; ?></div>
                 <?php } ?>
            </div></div></div>
         </div> 