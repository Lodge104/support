Everytime you update this software, add these back in.

/include/class.ticket.php
Under Ticket Sources, add this code underneath the email one.
            'Live Chat' =>
            /* @trans */ 'Live Chat',
If you get an 500 error on the site, check the database under ost_ticket and make sure Live Chat is still an option in the table.

/include/client/footer.inc.php
Add the google analytics toward the end of the footer but before "End of Footer" note.
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-37461006-10"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-37461006-10');
</script>
