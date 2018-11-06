<?php
    
    /* 0 = loadPostError
     * 1 = success error
     * 2 = not logged in
     *
     *
     */
    
    
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
    
    $postToLoad = $_POST['postID'];
    
    $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ? true : false;
    
    if ((!$userid) || ($userid == null)) $sessionON = false;
    else $sessionON = true;
    
    if ($sessionON == false) $errorStatus = 2;
    else {
        require('../_php/framework.php');
        $postData = returnPost($postToLoad);
        if ($postInfo == false) $errorStatus = 0;
        else {
            $errorStatus = 1;
        }
    }
    
    if ($isAjax) {
        echo $postData;
    }
    else echo "Browser";
    ?>