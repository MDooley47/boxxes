<?php
//PHP Framework for Boxes //uv = uservariable

$runTHIS = $_POST['functionToRun'];
$argsToRun = split(', ', $_POST['argToRun']);

#Run function via JS //DO NOT USE IN FINAL PRODUCT
function runPost($toRun, $argsToRun) {
    call_user_func_array($toRun, $argsToRun);
    }

//*********USERS - login logout************//
//Very basic -- ones later functions use
function mySQLConnect() {
    //establishes mySQL connection to the database
    mysql_connect("localhost","root","");
    mysql_select_db("Boxes");
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
				echo "Logged in $userID"; //SESSION START exd…
                $_SESSION['userid'] = $userID;
                $_SESSION['username'] = getUsername($userID);
				}
			else echo "username password wrong";
			}
		else print "username is not there";
		}
	else {
		if (useremailCheck($usernameUV) == true) {
            $userID = userIDFind($usernameUV, 1);
			if (userpasswordCheck($userID, $passwordUV) == true) {
                echo "Logged in $userID";
                $_SESSION['userid'] = $userID;
                $_SESSION['username'] = getUsername($userID);
				}
			else echo "Email's Password Wrong";
			}
        else echo "Email is not there";
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
    if (!isset($firstName)) echo "Please enter your first name.";

    #Middle name NOT requried.

    else if (!isset($lastName)) echo "Please enter your last name.";
    
    else if (!isset($usernameUV)) echo "Please enter your username.";

    else if (!isset($passwordUV)) echo "Please enter your password.";

    else if (!isset($passwordTwoUV)) echo "Please confrim your password.";

    else if (!isset($emailUV)) echo "Please enter your email.";
    #Done checking for if set
    
    else if (usernameCheck($usernameUV) == true) echo "Sorry sombody else already has that username.";

    else if (passwordMatch($passwordUV, $passwordTwoUV) == false) echo "Passwords do not match.";

    else if (useremailCheck($emailUV) == true) echo "Sorry someone is already using that email."; #Recover password?

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
            mysql_query("INSERT INTO users VALUES ('','$usernameUV', '$userRealNameUV','$passwordSet','$salt','$emailUV','0','$firstName','$middleName','$lastName','$dateTime')");
        mysql_close();
        
        // createUserFileDir(userIDFind($usernameUV, 0));
        }
    }

runPost($runTHIS, $argsToRun);
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Boxes</title>
    </head>
    <body>
        <form action="./" method="POST">
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