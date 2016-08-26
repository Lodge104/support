        </div>
    </div>
    <div id="footer">
<div class="container"> <div class="row">
    <div class="fwidgets">
            <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-37461006-10', 'auto');
  ga('send', 'pageview');

</script>

        <div class="col-md-4">
            <h2> Reach Us </h2>

Occoneechee Council - BSA<br> 
            3231 Atlantic Avenue<br>
            Raleigh, NC 27604

        </div>
        <div class="col-md-4">
            <h2> Important links </h2>
            <ul>
                <li><a href="https://lodge104.net">Main Site</a></li>
                <li><a href="http://www.oa-bsa.org/">National Order of the Arrow</a></li>
                <li><a href="http://www.southern.oa-bsa.org/">Southern Region</a></li>
                <li><a href="http://www.sr7b.org/">Section SR-7B</a></li>
            </ul>
            
        </div>
        <div class="col-md-4">
            <h2> Contact US </h2>

            <i class="icon-phone-sign"></i> 1-800-662-7102 <br>
            <i class="icon-envelope"></i> support@lodge104.net 

            <div class="social-icons">
                <ul>
                    <li> <a href="facebook.com/lodge104"> <i class="icon-facebook"></i> </a> </li>
                    <li> <a href="twitter.com/lodge104"> <i class="icon-twitter"></i> </a> </li>
                    <li> <a href="instagram.com/lodge104"> <i class="icon-instagram"></i> </a> </li>                        
                    <li> <a href="youtube.com/oalodge104"> <i class="icon-youtube"></i> </a> </li>
//                    <li> <a href="snapchat.com/add/lodge104"> <i class="icon-snapchat"></i> </a> </li>
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
    <script type="text/javascript" src="ajax.php/i18n/<?php
        echo $lang; ?>/js"></script>
<?php } ?>
</body>
</html>
