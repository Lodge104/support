        </div>
    </div>
    <div id="footer">
<div class="container"> <div class="row">
    <div class="fwidgets">

        <div class="col-md-4">
            <h2> Reach Us </h2>

            Occoneechee Council - BSA<br> 
            3231 Atlantic Avenue <br>
            Raleigh, NC 27604 <br>

        </div>
        <div class="col-md-4">
            <h2> Important links </h2>
            <ul>
                <li><a href="https://lodge104.net">Main Website</a></li>
                <li><a href="http://www.oa-bsa.org/">National Order of the Arrow</a></li>
                <li><a href="http://www.southern.oa-bsa.org/">Southern Region</a></li>
                <li><a href="http://www.sr7b.org/">Section SR-7B - Southern Region</a></li>
            </ul>
            
        </div>
        <div class="col-md-4">
            <h2> Contact US </h2>

            <i class="icon-phone-sign"></i> 919-872-4884 <br>
            <i class="icon-envelope"></i> support@lodge104.net

            <div class="social-icons">
                <ul>
                    <li> <a href="https://facebook.com/lodge104"> <i class="icon-facebook"></i> </a> </li>
                    <li> <a href="https://twitter.com/lodge104"> <i class="icon-twitter"></i> </a> </li>
                    <li> <a href="https://instagram.com/lodge104"> <i class="icon-instagram"></i> </a> </li>                        
                    <li> <a href="https://youtube.com/oalodge104"> <i class="icon-youtube"></i> </a> </li>
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
