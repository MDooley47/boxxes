<?php
    //PHP Framework for Boxes //uv = uservariable //PV = Predetrimed UV - suchas ID
    /*
    $runTHIS = $_POST['functionToRun'];
    $argsToRun = split(', ', $_POST['argToRun']);

    #Run function via JS //DO NOT USE IN FINAL PRODUCT
    function runPost($toRun, $argsToRun) {
        call_user_func_array($toRun, $argsToRun);
    }#*/

    //*********USERS - login logout************//
    //Very basic -- ones later functions use
    function mySQLConnect() {
        //establishes mySQL connection to the database
        #mysql_connect("matthews-mini","root","");
        #mysql_select_db("Boxes");
        mysql_connect("localhost","root","24601Boxxes!");
        mysql_select_db("Boxes_houseapp");
        }

    function isitEmail($email) {
        //check if email is valid
        return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false;
        //this is known for problems, but we shall see if we have any.
        }

    function hashPassword($passtoHash) {
        //this is where a has formula will be created;
        return $passtoHash;
        }

    function usernameCheck($usernameUV) { //FIX CASE SENSITIVITY
        //checks if the username given is in our database.
        mySQLConnect();
        
        
        $usernameUV = mysql_real_escape_string(trim($usernameUV));
        $query = mysql_query("SELECT * FROM users WHERE UserName='$usernameUV'");
        $numrows = mysql_num_rows($query);

        return ($numrows == 1) ? true : false;
        
        mysql_close();
        }

    function getUsername($ID) {
        mySQLConnect();
        $query = mysql_query("SELECT * FROM users WHERE ID='$ID'");
        $numrows = mysql_num_rows($query);
        $row = mysql_fetch_assoc($query);
        $dbUser = $row['UserName'];
            mysql_close();
        return $dbUser;
        }

    function userIDFind($userUV, $emailORname) {
        mySQLConnect();
        if ($emailORname == 0) { //username
            $userUV = mysql_real_escape_string(trim($userUV));
            $query = mysql_query("SELECT * FROM users WHERE UserName='$userUV'");
            $numrows = mysql_num_rows($query);
            $row = mysql_fetch_assoc($query);
            $dbID = $row['ID'];
                mysql_close();
            return $dbID;
            }
        else { //email
            $userUV = mysql_real_escape_string(trim($userUV));
            $query = mysql_query("SELECT * FROM users WHERE email='$userUV'");
            $numrows = mysql_num_rows($query);
            $row = mysql_fetch_assoc($query);
            $dbID = $row['ID'];
                mysql_close();
            return $dbID;
            }
        }

    function useremailCheck($emailUV) { //FIX CASE SENSIVITY
        if (isitEmail($emailUV) == false) return "Invalid Email";
        mySQLConnect();
        
        $emailUV = mysql_real_escape_string(trim($emailUV));
        $query = mysql_query("SELECT * FROM users WHERE email='$emailUV'");
        $numrows = mysql_num_rows($query);
        
        return ($numrows == 1) ? true : false;
        
        mysql_close();
        }

    function userpasswordCheck($userID, $userpassUV) {
        mySQLConnect();
        
        $userpassUV = mysql_real_escape_string(trim($userpassUV));
        $query = mysql_query("SELECT * FROM users WHERE ID='$userID'");
        $numrows = mysql_num_rows($query);
        
        if ($numrows != 1) return $GLOBALS['errormessage'];
        
        $row = mysql_fetch_assoc($query);
        $dbid = $row['ID'];
        $dbpass = $row['password'];
        $dbsalt = $row['salt'];

        $userpassUV = hashPassword($dbsalt . $userpassUV . $dbsalt);
        
        return ($userpassUV == $dbpass) ? true : false;

        mysql_close();
        }

    function userLoginType($userINUV) {
        //false is email; true is username.
        return (isitEmail($userINUV) == true) ? false : true;
        }

    function userLogin($usernameUV, $passwordUV) {
        $usernameORemail = (userLoginType($usernameUV) == true) ? true : false;
        if ($usernameORemail == true) {
            if (usernameCheck($usernameUV) == true) {
                $userID = userIDFind($usernameUV, 0);
                if (userpasswordCheck($userID, $passwordUV) == true) {
                    session_start();
                    $_SESSION['userid'] = $userID;
                    $_SESSION['username'] = getUsername($userID);
                    return true;
                    }
                else return false; #echo "username password wrong";
                }
            else return false; #print "username is not there";
            }
        else {
            if (useremailCheck($usernameUV) == true) {
                $userID = userIDFind($usernameUV, 1);
                if (userpasswordCheck($userID, $passwordUV) == true) {
                    session_start();
                    $_SESSION['userid'] = $userID;
                    $_SESSION['username'] = getUsername($userID);
                    return true;
                    }
                else return false; #echo "Email's Password Wrong";
                }
            else return false; #echo "Email is not there";
            }
        }

    function userLogout() {
        session_start();
        session_destroy();
        }

    function createUserFileDir($userID) {
        if (file_exists("_users/$userID") == true) {
            echo "Yes";
            return;
            }
        else {
            echo "No";
            mkdir("_users/$userID");
            chmod("_users/$userID", 0777);
            $fileName = "_users/$userID/posts.boxes";
            $fileHandle = fopen($fileName, 'w') or die("cannot open file");
            fclose($fileHandle);
            echo (file_exists("_users/$userID")) ? "Yes" : "No";
            }
        }

    function passwordMatch($passOne, $passTwo) {
        return ($passOne === $passTwo) ? true : false;
        }

    function generateSalt($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
        return $randomString;
        }

    function currentDateTime() {
        date_default_timezone_set('America/Chicago'); // CDT
        
        $current_date = date('Y-m-d H:i:s');
        
        return $current_date;
        }

    function registerNewUser($firstName, $middleName, $lastName, $usernameUV, $userRealNameUV, $passwordUV, $passwordTwoUV, $emailUV) {
        if (!isset($firstName)) return false;#echo "Please enter your first name.";

        #Middle name NOT requried.

        else if (!isset($lastName)) return false;#echo "Please enter your last name.";
        
        else if (!isset($usernameUV)) return false;#echo "Please enter your username.";

        else if (!isset($passwordUV)) return false;#echo "Please enter your password.";

        else if (!isset($passwordTwoUV)) return false;#echo "Please confrim your password.";

        else if (!isset($emailUV)) return false;#echo "Please enter your email.";
        #Done checking for if set
        
        else if (usernameCheck($usernameUV) == true) return false;#echo "Sorry sombody else already has that username.";

        else if (passwordMatch($passwordUV, $passwordTwoUV) == false) return false;#echo "Passwords do not match.";

        else if (useremailCheck($emailUV) == true) return false;#echo "Sorry someone is already using that email."; #Recover password?

        else {
            if (($userRealNameUV == true) || ($userRealNameUV == 1)) $userRealNameUV = true;
            else $userRealNameUV = 0;
            
            $salt = generateSalt(10);
            $passwordSet = hashPassword($salt . $passwordUV . $salt);
            
            $passwordSet = mysql_real_escape_string(trim($passwordSet));
            $firstName = mysql_real_escape_string(trim($firstName));
            if ($middleName) $middleName = mysql_real_escape_string(trim($middleName));
            $lastName = mysql_real_escape_string(trim($lastName));
            $usernameUV = mysql_real_escape_string(trim($usernameUV));
            $passwordUV = mysql_real_escape_string(trim($passwordUV));
            $emailUV = mysql_real_escape_string(trim($emailUV));
            $dateTime = currentDateTime();
            mySQLConnect();
                mysql_query("INSERT INTO users VALUES ('','$usernameUV', '$userRealNameUV','$passwordSet','$salt','$emailUV','0','$firstName','$middleName','$lastName','','','$dateTime')");
            mysql_close();
            userLogin($usernameUV, $passwordUV);
            return true;
            
            // createUserFileDir(userIDFind($usernameUV, 0));
            }
        }

    function newPost($userIDPV, $postContentPV) {
        mySQLConnect();
            $postContentPV = mysql_real_escape_string(trim($postContentPV));
            $dateTime = currentDateTime();
            mysql_query("INSERT INTO posts VALUES ('', '$userIDPV', '0', '0', '', '0', '', '', '$postContentPV','$dateTime')");

            $query = mysql_query("SELECT * FROM posts WHERE post='$postContentPV'");
            $numrows = mysql_num_rows($query);
            $row = mysql_fetch_assoc($query);
            $dbid = $row['ID'];
            if (checkPostExists($dbid) == false) return "Error Status = -1";
        mysql_close();
        userNewPost($userIDPV, $dbid);
        }
       
    function userNewPost($userIDPV, $postID) {
        mySQLConnect();
            $query = mysql_query("SELECT * FROM users WHERE ID='$userIDPV'");
            $numrows = mysql_num_rows($query);
            $row = mysql_fetch_assoc($query);
            if (checkPostExists($postID) == false) return "Error Status = -1";
            $dbposts = $row['Posts'];
            if ($dbposts == '') $dbpostsNew = $postID;
            else $dbpostsNew = $dbposts . ',' . $postID;
            if ($query = mysql_query("UPDATE users SET Posts='$dbpostsNew' WHERE ID='$userIDPV'")) return true;
        mysql_close();
        }

    function userPosts($userIDPV) {
        mySQLConnect();
            $query = mysql_query("SELECT * FROM users WHERE ID='$userIDPV'");
            $numrows = mysql_num_rows($query);
            $row = mysql_fetch_assoc($query);
            $dbposts = $row['Posts'];
            return $dbposts;
        mysql_close();
        }

    function checkPostExists($postID) {
        mySQLConnect();
        $query = mysql_query("SELECT * FROM posts WHERE ID='$postID'");
        $numrows = mysql_num_rows($query);
        $row = mysql_fetch_assoc($query);
        return ($row >= 1) ? true : false;
        }
        
    function returnPost($postIDPV) {
        mySQLConnect();
        $query = mysql_query("SELECT * FROM posts WHERE ID='$postIDPV'");
        $numrows = mysql_num_rows($query);
        $row = mysql_fetch_assoc($query);
        if (checkPostExists($postIDPV) == false) return "Error Status = -1";
        $dbpost = $row['post'];
        mysql_close();
        return $dbpost;
        }

    function returnPostInfo($postIDPV) {
        mySQLConnect();
        $query = mysql_query("SELECT * FROM posts WHERE ID='$postIDPV'");
        $numrows = mysql_num_rows($query);
        $row = mysql_fetch_assoc($query);
        if (checkPostExists($postIDPV) == false) return "Error Status = -1";
        $dblikes = $row['likes'];
        $dblikers = $row['likers'];
        $dbdate = $row['date'];
        $dbuserID = $row['IDofPoster'];
        $dbcommentCount = $row['commentCount'];
        mysql_close();
        $posterName = getUsername($dbuserID);
        return $dbdate . "*" . $posterName . "*" . $dbcommentCount . "*" . "0" . "*" . $dblikes;
        }

    function likePost($postIDPV, $userIDPV) {
        mySQLConnect();
        $query = mysql_query("SELECT * FROM posts WHERE ID='$postIDPV'");
        $numrows = mysql_num_rows($query);
        $row = mysql_fetch_assoc($query);
        if (checkPostExists($postIDPV) == false) return "Error Status = -1";
        $dblikes = $row['likes'];
        $dblikers = $row['likers'];
        $newLikes = $dblikes + 1;
        $newLikers = $dblikers . "," . $userIDPV;
        if (array_search($userIDPV, explode(',', $dblikers))) return false;
        if ($query = mysql_query("UPDATE posts SET likes='$newLikes', likers='$newLikers' WHERE ID='$postIDPV'")) return true;
        mysql_close();
    }   #returns false if liked before
        
    function howManyLikes($postIDPV) {
        mySQLConnect();
        $query = mysql_query("SELECT * FROM posts WHERE ID='$postIDPV'");
        $numrows = mysql_num_rows($query);
        $row = mysql_fetch_assoc($query);
        if (checkPostExists($postIDPV) == false) return "Error Status = -1";
        $dbPoster = $row['IDofPoster'];
        $dblikes = $row['likes'];
        $dblikers = $row['likers'];
        $dbcommentCount = $row['commentCount'];
        $dbpost = $row['post'];
        mysql_close();
        return $dblikes;
        }
    
    function doesFileExist($filename) {
        if (file_exists($filename) == true) return true;
        else return false;
        }
    
    function searchBuddies($searchVal) {
        $output = "";
        mySQLConnect();
        $searchKeywords = mysql_real_escape_string(htmlentities(trim($searchVal)));
        if ($searchKeywords == "") exit();
        
        $where = null;
        
        $searchKeywords = preg_split('/[\s]+/', $searchKeywords);
        
        $searchKeywords_ammount = count($searchKeywords);
        
        foreach($searchKeywords as $key=>$keyword) {
            $where .= "userName LIKE '%$keyword%'";
            if ($key != ($searchKeywords_ammount - 1)) {
                $where .= " AND ";
                }
            }
        $mySQL_search = "SELECT * FROM users WHERE " . $where;
        $query = mysql_query($mySQL_search);
        $count = mysql_num_rows($query);

        if($count == 0) {
            $output = "";
            }
        else {
            $i=0;
            if ($count == 1) $output = "";
            while($row = mysql_fetch_array($query)) {
                $dbID = $row['ID'];
                $dbuserName = $row['UserName'];
                $dbfirstName = $row['firstName'];
                $dbmiddleName = $row['middleName'];
                $dblastName = $row['lastName'];
                
                if ($i == 0) $output .= $dbID . "_-_" . $dbuserName . "_-_" . $dbfirstName . "_-_" . $dbmiddleName . "_-_" . $dblastName;
                else $output .= "-_-" . $dbID . "_-_" . $dbuserName . "_-_" . $dbfirstName . "_-_" . $dbmiddleName . "_-_" . $dblastName;
                $i = $i+1;
                }
            }
        echo $output;
        mysql_close();
        }
    
    
    #runPost($runTHIS, $argsToRun);

    /*
     <!DOCTYPE html>
     <html>
     <head>
     <title>Boxes</title>
     </head>
     <body>
     <form action="./framework.php" method="POST">
     <input name="functionToRun" id="functionToRun" type="text" placeholder="Function Name" />
     <input name="argToRun" id="argToRun" type="text" placeholder="args" />
     <input type="submit" />
     </form>
     <span id="count"></span>
     <textarea onKeyUp="charCount();" id="textCount"></textarea>
     <script type="text/javascript">
     function charCount() {
     var fullString = document.getElementById('textCount').value;
     var splitString = fullString.split('');
     document.getElementById('count').innerHTML = splitString.length;
     }
     </script>
     </body>
     </html>
     */ #copy paste for runPost();
    ?>
