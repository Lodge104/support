        </div>
    </div>
    <div id="footer">
<div class="container"> <div class="row">
    <div class="fwidgets">

        <div class="col-md-4">
            <h2> Reach Us </h2>

            Company Name<br> 
            221, 2nd floor <br>
            Baker street, London, <br>
            England

        </div>
        <div class="col-md-4">
            <h2> Important links </h2>
            <ul>
                <li><a href="#">First link</a></li>
                <li><a href="#">Second link</a></li>
                <li><a href="#">Third link</a></li>
                <li><a href="#">Fourth link</a></li>
            </ul>
            
        </div>
        <div class="col-md-4">
            <h2> Contact US </h2>

            <i class="icon-phone-sign"></i> 1800-9876-5432 <br>
            <i class="icon-envelope"></i> mymail@company.com 

            <div class="social-icons">
                <ul>
                    <li> <a href="#"> <i class="icon-facebook"></i> </a> </li>
                    <li> <a href="#"> <i class="icon-twitter"></i> </a> </li>
                    <li> <a href="#"> <i class="icon-google-plus"></i> </a> </li>                        
                    <li> <a href="#"> <i class="icon-linkedin"></i> </a> </li>
                    <li> <a href="#"> <i class="icon-github"></i> </a> </li>
                </ul>
            </div>            

        </div>

    <div class="clear"></div>
    </div>
    <div class="col-md-12">
        <div class="footer-content"> 
        <p>Copyright &copy; <?php echo date('Y'); ?> <?php echo (string) $ost->company ?: 'osTicket.com'; ?> - All rights reserved.</p>
        <a id="poweredBy" href="http://osticket.com" target="_blank"><?php echo __('Helpdesk software - powered by osTicket'); ?></a>
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
