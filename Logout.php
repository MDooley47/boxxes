<?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
    
    $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ? true : false;
    
    if ((!$userid) || ($userid == null)) $sessionON = false;
    else $sessionON = true;
    
    if ($sessionON == false) $errorStatus = 2;
    else {
        require('./_php/framework.php');
        if (userLogout() == false) $errorStatus = 0;
        else $errorStatus = 1;
        }
    
    if ($isAjax) {
        if (($errorStatus == 1) || ($errorStatus == 2)) echo true;
        else echo false;
        }
    else echo "<meta http-equiv='refresh' content='0;URL=./' />";
    ?>