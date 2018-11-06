<?php
    error_reporting (E_ALL ^ E_NOTICE);
#Login if possible
    session_start();
    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
    if ((!$userid) || ($userid == null)) $sessionON = false;
    else $sessionON = true;
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Boxes</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="title" content="Boxes" />
		<meta name="description" content="An whole new social network :: BETA!" />
		<meta name="Keywords" content="Social Network, new, Boxes" />
        
        <link href="http://fonts.googleapis.com/css?family=Nova+Square" rel="stylesheet" type="text/css" />
        <link href="http://fonts.googleapis.com/css?family=Source+Code+Pro" rel="stylesheet" type="text/css" />
        
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!--<meta name="apple-mobile-web-app-status-bar-style" content="default" />-->

        <!--iPhone (60x60)-->
        <link rel="apple-touch-icon" href="./images/web-app/touch-icon-iphone.png" />
        <!--iPad-->
        <link rel="apple-touch-icon" sizes="76x76" href="./images/web-app/touch-icon-ipad.png" />
        <!--iPhone (Retina)-->
        <link rel="apple-touch-icon" sizes="120x120" href="./images/web-app/touch-icon-iphone-retina.png" />
        <!--iPad (Retina)-->
        <link rel="apple-touch-icon" sizes="152x152" href="./images/web-app/touch-icon-ipad-retina.png" />
        <!-- iPhone -->
        <link href="./images/web-app/apple-touch-startup-image-320x460.png" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 1)" rel="apple-touch-startup-image" />
        <!-- iPhone (Retina) -->
        <link href="./images/web-app/apple-touch-startup-image-640x920.png" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <!-- iPhone 5 -->
        <link href="./images/web-app/apple-touch-startup-image-640x1096.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <!-- iPad (portrait) -->
        <link href="./images/web-app/apple-touch-startup-image-768x1004.png" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 1)" rel="apple-touch-startup-image" />
        <!-- iPad (landscape) -->
        <link href="./images/web-app/apple-touch-startup-image-748x1024.png" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 1)" rel="apple-touch-startup-image" />
        <!-- iPad (Retina, portrait) -->
        <link href="./images/web-app/apple-touch-startup-image-1536x2008.png" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <!-- iPad (Retina, landscape) -->
        <link href="./images/web-app/apple-touch-startup-image-1496x2048.png" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />




		<!--<meta name="revisit-after" content="7 days" />
        <meta name="google-site-verification" content="" />-->
        <?    if ($sessionON == true) echo '<meta http-equiv="refresh" content="0;URL=./Home.php?userID=' . $userid . '" />'; ?>
        
        
        <link rel="stylesheet" type="text/css" href="./CSS/Core.css" />
        <link rel="stylesheet" type="text/css" media="(max-width: 480px)" href="./CSS/Mobile.css" />
        <link rel="stylesheet" type="text/css" media="(max-width: 980px) and (min-width: 480px)" href="./CSS/Tablet.css" />
        <link rel="stylesheet" type="text/css" media="(min-width: 980px)" href="./CSS/Full.css" />
        <link rel="Shortcut Icon" type="image/x-icon" href="./images/favicon.ico" />
        
        <script type="text/JavaScript" src="./JavaScript/jQuery.js"></script>
        <script type="text/JavaScript" src="./JavaScript/framework.js"></script>
        <script type="text/JavaScript" src="./JavaScript/documentChanges.js"></script>
    </head>
    <body>
        <!--Images upload <input type="file" accept="image/*" />-->
        <div id="wrapper">
            <header>
                    <span id="hSettings"><div id="hGear"><a id="hGearLink" href="#settings"></a></div></span>
                    <form id="searchBuddiesWrapper" action="./searchBuddies.php" method="POST">
                        <input id="searchBuddies" name="searchBuddies" type="text" placeholder="Find your buddies..." />
                    </form>
                    <span id="htitle"><div id="boxesGUILogo"><a href="#top" id="boxesGUILink"></a></div></span>
                    <span class="clear_both"></span>
            </header>
            <div id="article">
                <div id="search_output">
                    
                </div>
                <div id="boxIndex1" class="boxWrapper">
                    <div id="boxIndex1_Header"class="boxHeader">
                        <span id="boxIndex1_Header_Date" class="boxHeaderDate"></span>
                        <span id="boxIndex1_Header_User" class="boxHeaderUser">Welcome to Boxes!</span>
                        <span class="clear_both"></span>
                    </div>
                    <div id="boxIndex1_Content" class="boxContent">
                        Hello! It is wonderful to see you here!
                        <br /><br />
                        Boxes is currently is alpha testing. Which means that you have a chance to directly effect its future! Suggest ideas and give feedback! The more you use Boxes now; the better it can get!
                    </div>
                </div>
                <div id="Login" class="boxWrapper">
                    <div id="boxIndex2_Header"class="boxHeader">
                        <span id="boxIndex2_Header_Date" class="boxHeaderDate"></span>
                        <span id="boxIndex2_Header_User" class="boxHeaderUser">Please Login</span>
                        <span class="clear_both"></span>
                    </div>
                    <div id="boxIndex2_Content" class="boxContent">
                        <form id="loginInputWrapper" action="./Login.php" method="POST">
                            <input id="loginUsername" name="loginUsername" type="text" placeholder="Your Username..." />
                            <input id="loginPassword" name="loginPassword" type="password" placeholder="Your Password..." />
                            <input id="loginSubmit" name="loginSubmit" class="submit" type="submit" value="Submit" />
                        </form>
                    </div>
                </div>
                <div id="Register" class="boxWrapper">
                    <div id="boxIndex3_Header"class="boxHeader">
                        <span id="boxIndex3_Header_Date" class="boxHeaderDate">or</span>
                        <span id="boxIndex3_Header_User" class="boxHeaderUser">Please Register</span>
                        <span class="clear_both"></span>
                    </div>
                    <div id="boxIndex3_Content" class="boxContent">
                        <form id="registerInputWrapper" action="./Register.php" method="POST">
                            <span class="requiredInput"><input id="registerFName" name="registerFName" type="text" placeholder="Your First Name..." onBlur="registerNameCheck('F');" /></span>
                            <input id="registerMName" name="registerMName" type="text" placeholder="Your Middle Name..." />
                            <span class="requiredInput"><input id="registerLName" name="registerLName" type="text" placeholder="Your Last Name..." onBlur="registerNameCheck('L');" /></span>
                            <span class="requiredInput"><input id="registerEmail" name="registerEmail" type="text" placeholder="Your Email..." onBlur="registerEmailCheck();" /></span>
                            <span class="requiredInput"><input id="registerUsername" name="registerUsername" type="text" placeholder="Your Username..." onBlur="registerUsernameCheck();" /></span>
                            <span class="requiredInput"><input id="registerPassword" name="registerPassword" type="password" placeholder="Your Password..." class="registerPassword" /></span>
                            <span class="requiredInput"><input id="registerPasswordVerify" name="registerPasswordVerify" type="password" placeholder="Verify Your Password..." class="registerPassword" onBlur="registerPasswordCheck();" /></span>
                            <input id="registerSubmit" name="registerSubmit" class="submit" type="submit" value="Submit" />
                        </form>
                        <div id="registerWhatMightBeWrong" style="display: none;">
                            If you are rejected it may for any or all of the highlighted fields.
                        </div>
                    </div>
                </div>
                <div id="Videos" class="boxWrapper">
                    <div id="boxIndexVideos_Header">
                        <span id="boxIndexVideos_Header_Date" class="boxHeaderDate"><small>Currently only the development<br /> video is done. (Max:60s)</small></span>
                        <span id="boxIndexVideos_Header_User" class="boxHeaderUser">House App Videos</span>
                        <span class="clear_both"></span>
                    </div>
                    <div id="boxIndexVideos_Content" class="boxContent">
                        <iframe width="100%" height="200px" src="//www.youtube.com/embed/2rFK9gX4yVg?rel=0&showinfo=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
                <div id="boxIndex4" class="boxWrapper">
                    <div id="boxIndex4_Header"class="boxHeader">
                        <span id="boxIndex4_Header_Date" class="boxHeaderDate"></span>
                        <span id="boxIndex4_Header_User" class="boxHeaderUser">How does alpha testing help?</span>
                        <span class="clear_both"></span>
                    </div>
                    <div id="boxIndex4_Content" class="boxContent">
                        Alpha testing allows for feedback to be gathered, and provides a testing environment. It enables the adding of features and the subtraction of others.
                    </div>
                </div>
                <div id="boxIndex5" class="boxWrapper">
                    <div id="boxIndex5_Header"class="boxHeader">
                        <span id="boxIndex5_Header_Date" class="boxHeaderDate"></span>
                        <span id="boxIndex5_Header_User" class="boxHeaderUser">How can I help?</span>
                        <span class="clear_both"></span>
                    </div>
                    <div id="boxIndex5_Content" class="boxContent">
                        Currently the best way for you to help Boxes make it way into the world, is to simply use it. Feedback is always welcomed and useful! If you have suggestions, please don't be afraid to get your voice out!
                    </div>
                </div>
                <noscript>
                    <div id="boxIndexJX" class="boxWrapper">
                        <div id="boxIndexJX_Header"class="boxHeader">
                            <span id="boxIndexJX_Header_Date" class="boxHeaderDate"></span>
                            <span id="boxIndexJX_Header_User" class="boxHeaderUser">JavaScript</span>
                            <span class="clear_both"></span>
                        </div>
                        <div id="boxIndexJX_Content" class="boxContent">
                            Please enable JavaScript. Boxes is planned to work without JavaScript; however, it will work much smoother with JavaScript.<br /><br />During alpha testing support for features working without JavaScript will be minamal.
                        </div>
                    </div>
                </noscript>
                <div id="boxIndex6" class="boxWrapper">
                    <div id="boxIndex6_Header" class="boxHeader">
                        <span id="boxIndex6_Header_Date" class="boxHeaderDate"></span>
                        <span id="boxIndex6_Header_User" class="boxHeaderUser">Please Note:</span>
                        <span class="clear_both"></span>
                    </div>
                    <div id="boxIndex6_Content" class="boxContent">
                        You are using the subdomain set aside for the House App Challenge. This means that security will drop. And nothing you post here will necessarily make it way to the public version!
                        <br />
                        Please use with the understanding that this is still very much in development and I take no responsibility for any loss of information. WARNING: Privacy measures are not yet in place! Anybody with your userID can view your posts!
                    </div>
                </div>
            </div>
            <div id="settings">
                <a href="./">Boxes</a>
                <a href="#Login">Login</a>
                <a href="#Register">Register</a>
                <a href="#Videos">Videos</a>
                <a href="#boxIndex4">Alpha Testing???</a>
                <a href="#boxIndex5">How Can I Help?</a>
            </div>
        </div>
    </body>
</html>