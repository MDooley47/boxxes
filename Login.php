<?php
    
    /* 0 = incorrect information
     * 1 = success error
     * 2 = already logged in
     *
     *
     */
    
    
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
    
    $username = $_POST['userName'];
    $password = $_POST['userPassword'];
    
    $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ? true : false;
    
    if ((!$userid) || ($userid == null)) $sessionON = false;
    else $sessionON = true;
    
    if ($sessionON == true) $errorStatus = 2;
    else {
        require('./_php/framework.php');
        if (userLogin($username, $password) == false) $errorStatus = 0;
        else $errorStatus = 1;
    }
    
    if ($isAjax) {
        if ($errorStatus == 0) echo false;
        else echo true;
    }
    else echo "Browser";
    ?>