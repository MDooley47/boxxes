<?php
    require ('./_php/framework.php');
    
    
    if(isset($_POST['searchBuddies'])) {
        $output = searchBuddies($_POST['searchBuddies']);
        }
    echo $output;
    ?>