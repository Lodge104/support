<<<<<<< HEAD
        </div>
    </div>
    <div id="footer">
        <div class="container"> <div class="row">
            <div class="fwidgets">
                <div class="col-sm-4">
                    <h2> Reach Us </h2>

                    Occoneechee Council - BSA<br>
                    3231 Atlantic Avenue <br>
                    Raleigh, NC 27604

                </div>
                <div class="col-sm-4">
                    <h2> Important links </h2>
                    <ul>
                        <li><a href="https://lodge104.net">Lodge Website</a></li>
                        <li><a href="https://registration.lodge104.net">Lodge Registration Portal</a></li>
                        <li><a href="https://survey.lodge104.net">Lodge Survey System</a></li>
                        <li><a href="https://noac.lodge104.net">Lodge NOAC Portal</a></li>
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

            <div class="clear"></div>
            </div>

            <div class="col-md-12">
                <div class="footer-content">
                    <p>Copyright &copy; <?php echo date('Y'); ?> <?php echo (string) $ost->company ?: 'osTicket.com'; ?> - All rights reserved.</p>                </div>
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
    <script type="text/javascript" src="ajax.php/i18n/<?php
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
=======
		</div>
		<!-- /.container -->
	</section>
	<!-- /#main -->
	
	<footer>
		<div class="container text-center">
			<p>Copyright &copy; <?php echo date('Y'); ?> <?php echo (string) $ost->company ?: 'osTicket.com'; ?> - All rights reserved.</p>
		</div>
		<!-- /.container -->
	</footer>


<div id="overlay"></div>
<div id="loading">
    <div class="modal" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Please wait...</h4>
      			</div>
	  			<div class="modal-body">
		  			<div class="progress">
		  				<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
		  					<span class="sr-only">100% Complete</span>
  						</div>
					</div>
      			</div>

    		</div><!-- /.modal-content -->
  		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>
<!-- /.loading -->

<!-- Scripts -->

<?php
if (($lang = Internationalization::getCurrentLanguage()) && $lang != 'en_US') { ?>
    <script type="text/javascript" src="ajax.php/i18n/<?php
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
>>>>>>> parent of 7093d97... 2020 Update
