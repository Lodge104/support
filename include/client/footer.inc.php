        </div>
    </div>
    <div id="footer">
        <div class="container"> <div class="row">
            <div class="fwidgets">
                <div class="col-sm-4">
                    <h2> Official Sites </h2>
                    <ul>
                        <li><a href="https://scouting.org">Boy Scouts of America</a></li>
                        <li><a href="https://oa-bsa.org">National Order of the Arrow</a></li>
                        <li><a href="https://southern.oa-bsa.org">OA Southern Region</a></li>
                        <li><a href="https://sr7b.org">OA Section SR-7B</a></li>
                        <li><a href="https://oa-bsa.org/about/official-oa-website-guidelines">OA Web Guidelines</a></li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <h2> Lodge Websites </h2>
                    <ul>
                        <li><a href="https://lodge104.net">Lodge Main Website</a></li>
                        <li><a href="https://noac.lodge104.net">NOAC Portal</a></li>
                        <li><a href="https://store.lodge104.net">Online Trading Post</a></li>
                        <li><a href="https://registration.lodge104.net">Registration Portal</a></li>
                        <li><a href="https://camping.lodge104.net">Where to go Camping Guide</a></li>
                        <li><a href="https://survey.lodge104.net">Survey System</a></li>
                        <li><a href="https://at.lodge104.net">Link Shartener Tool</a></li>
                    </ul>

                </div>
                <div class="col-sm-4">
                    <h2> Contact US </h2>

                    <i class="icon-phone-sign"></i> 919-872-4884 <br>
                    <i class="icon-envelope"></i> support@lodge104.net

                    <div class="social-icons">
                        <ul>
                            <li> <a href="https://fb.com/lodge104"> <i class="icon-facebook"></i> </a> </li>
                            <li> <a href="https://twitter.com/lodge104"> <i class="icon-twitter"></i> </a> </li>
                            <li> <a href="https://instagram.com/lodge104"> <i class="icon-instagram"></i> </a> </li>
<li> <a href="https://youtube.com/oalodge104"> <i class="icon-youtube"></i> </a> </li>
<li> <a href="https://www.flickr.com/photos/144663840@N05/albums"> <i class="icon-flickr"></i> </a> </li>
                        </ul>
                    </div>
                </div>
                                <div class="col-sm-4">
                    <h2>Find Us
                        </h2>
                        <p>Occoneechee Council - BSA<br>
                    3231 Atlantic Avenue <br>
                    Raleigh, NC 27604</p>
                    
                </div>

            <div class="clear"></div>
            </div>

            <div class="col-md-12">
                <div class="footer-content">
                    <p>Copyright &copy; <?php echo date('Y'); ?> <?php echo (string) $ost->company ?: 'Occoneechee Lodge'; ?> - All rights reserved.</p>                </div>
            </div>
        </div></div>
    </div>
        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-37461006-10"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-37461006-10');
</script>
    <!-- end footer -->
<div id="overlay"></div>
<div id="loading">
    <h4><?php echo __('Please Wait!');?></h4>
    <p><?php echo __('Please wait... it will take a second!');?></p>
</div>
<?php
if (($lang = Internationalization::getCurrentLanguage()) && $lang != 'en_US') { ?>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>ajax.php/i18n/<?php
        echo $lang; ?>/js"></script>
<?php } ?>
<script type="text/javascript">
    getConfig().resolve(<?php
        include INCLUDE_DIR . 'ajax.config.php';
        $api = new ConfigAjaxAPI();
        print $api->client(false);
    ?>);
</script>
</body>
</html>
