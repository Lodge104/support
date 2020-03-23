Everytime you update this software, add these back in.

/include/class.ticket.php
Under Ticket Sources, add this code underneath the email one.
            'Live Chat' =>
            /* @trans */ 'Live Chat',
If you get an 500 error on the site, check the database under ost_ticket and make sure Live Chat is still an option in the table.

Line 186
    // Ticket Sources
    static protected $sources =  array(
            'Phone' =>
            /* @trans */ 'Phone',
            'Email' =>
            /* @trans */ 'Email',
            'Live Chat' =>
            /* @trans */ 'Live Chat',

            'Web' =>
            /* @trans */ 'Web',
            'API' =>
            /* @trans */ 'API',
            'Other' =>
            /* @trans */ 'Other',
            );


/include/client/open.inc.php
Add this code at line 10

if(isset($_REQUEST["tid"])){
    $info['topicId']=$_REQUEST["tid"];
    }


/include/client/footer.inc.php
Add the google analytics toward the end of the footer but before "End of Footer" note. Copy the old footer before overwriting
