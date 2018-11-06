$(function() { $(document).ready(function() {
        isWebApp = (window.navigator.standalone == true) ? true : false;
            if (isWebApp == true) $.getScript("./JavaScript/webAppLinks.js");
            else $.getScript("./JavaScript/webAppLinks.js");
        whoIsLoggedIn();
        });
    if(window.location.hash) {
        var target_offset = $(window.location.hash).offset() ? $(window.location.hash).offset().top : 0;
        $('html, body').animate({scrollTop:target_offset - 75}, 500);
        }
    $('#searchBuddiesWrapper').submit(function(sub) {
        sub.preventDefault();
        searchValue = document.getElementById('searchBuddies').value;
        if ((searchValue == null ) || (searchValue == "" )) {
            displaySearch(false);
            return false;
            }
        $.post("./searchBuddies.php", {"searchBuddies":searchValue}, function (data) { displaySearch(data);});
        });
    $('#loginInputWrapper').submit(function(sub) {
        sub.preventDefault();
        userNameInput = document.getElementById('loginUsername').value;
        userPasswordInput = document.getElementById('loginPassword').value;
            if ((userNameInput == null ) || (userNameInput == "" ) || (userPasswordInput == null) || (userPasswordInput == "")) {
            loggedIn(false);
            return false;
            }
        $.post("./Login.php", {"userName":userNameInput, "userPassword":userPasswordInput}, function (data) { loggedIn(data);});
        });
    $('#registerInputWrapper').submit(function(sub) {
        sub.preventDefault();
        userNameInput = document.getElementById('registerUsername').value;
        userFNameInput = document.getElementById('registerFName').value;
        userLNameInput = document.getElementById('registerLName').value;
        userEmailInput = document.getElementById('registerEmail').value;
        userPasswordVerifyInput = document.getElementById('registerPasswordVerify').value;
        userPasswordInput = document.getElementById('registerPassword').value;
        userMNameInput = document.getElementById('registerMName').value;
        if (userMNameInput == "") userMNameInput = null;
        if ((userNameInput == "") || (userFNameInput == "" ) || (userLNameInput == "" ) || (userEmailInput == "" ) || (userPasswordInput == "" ) || (userPasswordVerifyInput == "") || (registerEmailCheckTF() == false)) {
            registerMe(false);
            return false;
            }
        $.post("./Register.php", {"userName":userNameInput, "userPassword":userPasswordInput, "userPasswordVerify":userPasswordVerifyInput,"userFName":userFNameInput,"userMName":userMNameInput,"userLName":userFNameInput,"userEmail":userEmailInput}, function (data) { registerMe(data);});
        });
      $('#newPostBox_wrapper').submit(function(sub) {
        sub.preventDefault();
        newPostBox = document.getElementById('newPostBox_input').value;
        document.getElementById('postData').value = newPostBox;
        document.getElementById('newPostBox_wrapper').submit();
        });
    });
$(document).on('click','a[href^="#"]',function(event){
                       event.preventDefault();
                       var target_offset = $(this.hash).offset() ? $(this.hash).offset().top : 0;
                       $('html, body').animate({scrollTop:target_offset - 75}, 500);
                       });
$(document).scroll(function() {
    topOfWindow = refreshPuller();
    if ((topOfWindow <= -1) && (window.loadingMore == false) && (window.canLoadMore == true)) loadMorePosts();
    });



/* REGISTER

if ((registerNameCheck("F") == true) && (registerNameCheck("L") == true) && (registerUsernameCheck() == true) && (registerUsernameACheck() == true) && (registerEmailCheck() == true) && (registerEmailACheck() == true) && (registerPasswordsMatch() == true))

*/