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
    
    $userIDpost = $_POST['userID'];
    $userIDget = $_GET['userID'];
    
    if (($userIDpost != null) || ($userIDpost != "")) $userIDLookup = $userIDpost;
    else if (($userIDget != null) || ($userIDget != "")) $userIDLookup = $userIDget;
    else if (($userid != null) || ($username != "")) $userIDLookup = $userid;
    else return false;
    
    
    $filename = './_php/framework.php';
   
    if (file_exists($filename) == true) require($filename);
    else require ('../_php/framework.php');
    
    
    $userPostsIDs = userPosts($userIDLookup);
    
    $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ? true : false;
    
    if ((!$userid) || ($userid == null)) $sessionON = false;
    else $sessionON = true;
    
    
    if ($isAjax) {
        echo $userPostsIDs;
        }
    else echo "Browser";
    ?>