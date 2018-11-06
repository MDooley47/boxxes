<?php
    
    /* 0 = liked error
     * 1 = success error
     * 2 = not logged in
     *
     *
     */
    
    
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
    
    $postToLike = $_POST['postID'];
    
    $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ? true : false;
    
    if ((!$userid) || ($userid == null)) $sessionON = false;
    else $sessionON = true;
    
    if ($sessionON == false) $errorStatus = 2;
    else {
        require('./_php/framework.php');
        if (likePost($postToLike, $userid) == false) $errorStatus = 0;
        else $errorStatus = 1;
        }

    if ($isAjax) {
        echo $errorStatus . "W" . $postToLike;
        }
    else echo "Browser";
?>