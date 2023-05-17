        </div>
    </div>
    <div id="footer">
        <div class="container"> <div class="row">
            <div class="fwidgets">
                <div class="col-sm-4">
                <h2> OFFICIAL SITES </h2>
                    <ul>
                        <li><a href="https://www.scouting.org/">Boy Scouts of America</a></li>
                        <li><a href="https://oa-bsa.org/">National Order of the Arrow</a></li>
                        <li><a href="https://oa-bsa.org/eastern">OA Eastern Region</a></li>
                        <li><a href="https://oae8.org">OA Section E8</a></li>
                        <li><a href="https://oa-bsa.org/about/official-oa-website-guidelines">OA Web Guidelines</a></li>
                    </ul>

                </div>
                <div class="col-sm-4">
                    <h2> LODGE WEBSITES </h2>
                    <ul>
                        <li><a href="https://lodge104.net/">Main Website</a></li>
                        <li><a href="https://store.lodge104.net/">Online Trading Post</a></li>
                        <li><a href="https://registration.lodge104.net/">Registration Portal</a></li>
                        <li><a href="https://training.lodge104.net/">Training Portal</a></li>
                        <li><a href="https://survey.lodge104.net/">Survey System</a></li>
                        <li><a href="https://support.lodge104.net/">Support System</a></li>
                        <li><a href="https://docs.lodge104.net/">Documentation Guide</a></li>
                        <li><a href="https://at.lodge104.net/">Link Shortener Tool</a></li>
                        <li><a href="https://status.lodge104.net/">Status Page</a></li>
                    </ul>

                </div>
                <div class="col-sm-4">
                    <h2> CONTACT US </h2>

                    <!-- <i class="icon-phone-sign"></i> 1800-9876-5432 <br> -->
                    <i class="icon-envelope"></i> support@lodge104.net

                    <div class="social-icons">
                        <ul>
                            <li> <a href="https://facebook.com/lodge104"> <i class="icon-facebook"></i> </a> </li>
                            <li> <a href="https://twitter.com/lodge104"> <i class="icon-twitter"></i> </a> </li>
                            <li> <a href="https://www.instagram.com/lodge104/"> <i class="icon-instagram"></i> </a> </li>
                            <li> <a href="https://www.youtube.com/oalodge104"> <i class="icon-youtube"></i> </a> </li>
                            <li> <a href="https://www.flickr.com/photos/144663840@N05/albums"> <i class="icon-flickr"></i> </a> </li>
                            <li> <a href="https://github.com/lodge104"> <i class="icon-github"></i> </a> </li>
                        </ul>
                    </div>
                </div>

            <div class="clear"></div>
            </div>

            <div class="col-md-12">
                <div class="footer-content">
                    <p>Copyright &copy; <?php echo date('Y'); ?> <?php echo (string) $ost->company ?: 'osTicket.com'; ?> - All rights reserved.</p>
                </div>
            </div>
        </div></div>
    </div>
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
