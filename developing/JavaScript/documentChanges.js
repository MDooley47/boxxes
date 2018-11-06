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
    $('#loginInputWrapper').submit(function(sub) {
        sub.preventDefault();
        userNameInput = document.getElementById('loginUsername').value;
        userPasswordInput = document.getElementById('loginPassword').value;
            if ((userNameInput == null ) || (userNameInput == "" ) || (userPasswordInput == null) || (userPasswordInput == "")) {
            loggedIn(false);
            return false;
            }
        $.post("./login.php", {"userName":userNameInput, "userPassword":userPasswordInput}, function (data) { loggedIn(data);});
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