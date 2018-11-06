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
    
    $usernameUV = $_POST['userName'];
    $password = $_POST['userPassword'];
    $password = trim($password);
    $passwordVerify = $_POST['userPasswordVerify'];
    $passwordVerify = trim($passwordVerify);
    $firstName = $_POST['userFName'];
    $middleName = $_POST['userMName'];
    $lastName = $_POST['userLName'];
    $email = $_POST['userEmail'];
    
    
    $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ? true : false;
    
     if ((!$userid) || ($userid == null)) $sessionON = false;
     else $sessionON = true;
    
    if ($sessionON == true) $errorStatus = 2;
    else if (($usernameUV == "") || ($password == "") || ($passwordVerify == "") || ($password != $passwordVerify) || ($firstName == "") || ($lastName == "") || ($email == "")) $errorStatus = 2;
    else {
        require('./_php/framework.php');
        if (registerNewUser($firstName, $middleName, $lastName, $usernameUV, 0, $password, $passwordVerify, $email) == false) $errorStatus = 0;
        else $errorStatus = 1;
       }
    
    if ($isAjax) {
        if (($errorStatus == 0) || ($errorStatus == 2)) echo "false";
        else echo true;
        }
    else echo "Browser";
    ?>