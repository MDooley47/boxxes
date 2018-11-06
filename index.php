<?php
$errormessage = "Sorry, but there was an error."; //default error message
//PHP Framework for Boxes //uv = uservariable

//GLOBALS
$userID;
//*********USERS************//
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

	($numrows == 1) ? userIDFind($rows[‘ID’]) : “error”;

    return ($numrows == 1) ? true : false;
    
    mysql_close();
    }

function userIDFind($ID) {
	$GLOBALS[‘userID’] = $ID;
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
	return (isitEmail() == true) ? true : false;
	}

function userLogin($usernameUV, $passwordUV) {
	$usernameORemail = (userLoginType($usernameUV) == true) ? true : false;
	if ($usernameORemail == true) {
		if (usernameCheck($usernameUV) == true) {
			if (userpasswordCheck($userID, $passwordUV) == true) {
				//SESSION START exd…
				}
			else print $GLOBALS[‘errormessage’];
			}
		else print $GLOBALS[‘errormessage’];
		}
	else {
		if (useremailCheck() == true) {
			if (userpasswordCheck($userID, $passwordUV) == true) {
				//SESSION START exd…
				}
			else print $GLOBALS[‘errormessage’];
			}
		}
	}


echo userpasswordCheck("1", "Password");

?>