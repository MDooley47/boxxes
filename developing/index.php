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
        <title>Boxxes</title>
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
        <?    if ($sessionON == true) echo '<meta http-equiv="refresh" content="0;URL=./Home.php" />'; ?>
        
        
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
                    <input id="searchBuddies" type="text" placeholder="Find your buddies..." />
                    <span id="htitle"><div id="boxesGUILogo"><a href="#top" id="boxesGUILink"></a></div></span>
                    <span class="clear_both"></span>
            </header>
            <div id="article">
                <div id="boxIndex1" class="boxWrapper">
                    <div id="boxIndex1_Header"class="boxHeader">
                        <span id="boxIndex1_Header_Date" class="boxHeaderDate"></span>
                        <span id="boxIndex1_Header_User" class="boxHeaderUser">Welcome to Boxxes!</span>
                        <span class="clear_both"></span>
                    </div>
                    <div id="boxIndex1_Content" class="boxContent">
                        Boxxes is currently being developed!
                    </div>
                </div>
                <noscript>
                    <div id="boxIndex5" class="boxWrapper">
                        <div id="boxIndex5_Header"class="boxHeader">
                            <span id="boxIndex5_Header_Date" class="boxHeaderDate"></span>
                            <span id="boxIndex5_Header_User" class="boxHeaderUser">JavaScript</span>
                            <span class="clear_both"></span>
                        </div>
                        <div id="boxIndex5_Content" class="boxContent">
                            Please enable JavaScript. Boxes is planned to work without JavaScript; however, it will work much smoother with JavaScript.<br /><br />During alpha testing support for features working without JavaScript will be minamal.
                        </div>
                    </div>
                </noscript>
            </div>
            <div id="settings">
                <a href="./">Boxes</a>
            </div>
        </div>
    </body>
</html>