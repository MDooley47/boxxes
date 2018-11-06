<?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
    
    $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ? true : false;
    
    if ((!$userid) || ($userid == null)) $sessionON = false;
    else $sessionON = true;
    
    if ($sessionON == true) {
        if ($isAjax == true) {
            echo $userid . "*" . $username;
            }
        else echo "Browser";
        }
    else {
        if ($isAjax == true) echo "Error Status -1";
        else echo "Browser";
        }
    ?>