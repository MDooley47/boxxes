//Global Variables -- GET RID OF THESE ASAP!

window.loadingPost = false; //Until further reasearch is done only one post can be loaded at a time.
window.loadingPostID; //ID of the post currently being loaded

window.loadingMore = false; //If currently loading more posts, keep?
window.canLoadMore = false; //Default is false, change in each page! //If it is a page that has post to load; program a better solution!

window.userID;  // ↓↓↓↓↓↓  Keep  ↓↓↓↓↓↓
window.userName;// ↑↑↑↑↑↑ these? ↑↑↑↑↑↑

//Functions
function getURLParam(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) {
            return sParameterName[1];
            }
        }
    }


function like(postID) {
    $.post("./like.php", {"postID":postID}, function (data) { displayLike(data); });
    }

function displayLike (errorStatus) {
    errorStatus = errorStatus.split('W');
    if (errorStatus[0] == 0) {
        showAsLiked(errorStatus[1]);
        howmanyLikes(errorStatus[1]);
        }
    else if (errorStatus[0] == 1) {
     showAsLiked(errorStatus[1]);
     howmanyLikes(errorStatus[1]);
     }
     else if (errorStatus[0] == 2) howmanyLikes(errorStatus[1]);
     else return;
    }

function showAsLiked(postID) {
    $("#box" + postID + "_Footer_LikeLink").html("Liked");
    }

function howmanyLikes(postID) {
    $.post("./php/howManyLikes.php", {"postID":postID}, function (data) { displayHowmanyLikes(data); });
    }

function displayHowmanyLikes(errorStatus) {
    errorStatus = errorStatus.split('W');
    $("#box" + errorStatus[1] + "_Footer_LikeCount").html(errorStatus[0]);
    }

function loadPostInfo(postID) {
    window.loadingPost = true;
    window.loadingPostID = postID;
    newPostArea(postID);
    $.post("./php/loadPostInfo.php", {"postID":postID}, function (data) { displayPostInfo(data); });
    }

function loadPost(postID) {
    $.post("./php/loadPost.php", {"postID":postID}, function (data) { displayPost(data); });
    }

function displayPostInfo(errorStatus) {
    errorStatus = errorStatus.split("*");
    $("#box" + errorStatus[5] + "_Header_Date").html(errorStatus[0]);
    $("#box" + errorStatus[5] + "_Header_User").html(errorStatus[1]);
    $("#box" + errorStatus[5] + "_Footer_CommentCount").html(errorStatus[2]);
    $("#box" + errorStatus[5] + "_Footer_ShareCount").html(errorStatus[3]);
    $("#box" + errorStatus[5] + "_Footer_LikeCount").html(errorStatus[4]);
    loadPost(errorStatus[5]);
    }

function displayPost(post) {
    $("#box" + window.loadingPostID + "_Content").html(post);
    window.loadingPost = false;
    }

function newPostArea(postID) {
    afterPost = $("#article").html();
    thePost = "<div id=\"box" + postID + "\" class=\"boxWrapper\"><div id=\"box" + postID + "_Header\" class=\"boxHeader\"><span id=\"box" + postID + "_Header_Date\" class=\"boxHeaderDate\">" + "</span><span id=\"box" + postID + "_Header_User\" class=\"boxHeaderUser\">" + "</span><span class=\"clear_both\"></span></div><div id=\"box" + postID + "_Content\" class=\"boxContent\">" + "</div><div id=\"box" + postID + "_Footer\" class=\"boxFooter\"><div id=\"box" + postID + "_Footer_Counts\" class=\"boxFooterCounts\"><div id=\"box" + postID + "_Footer_Counts_ShareCount_Div\" class=\"boxCountsDiv\"><span id=\"box" + postID + "_Footer_ShareCount\" class=\"boxShareCount\">" + "</span></div><div id=\"box" + postID + "_Footer_Counts_CommentCount_Div\" class=\"boxCountsDiv\"><span id=\"box" + postID + "_Footer_CommentCount\" class=\"boxCommentCount\">" + "</span></div><div id=\"box" + postID + "_Footer_Counts_LikeCount_Div\" class=\"boxCountsDiv\"><span id=\"box" + postID + "_Footer_LikeCount\" class=\"boxLikeCount\">" + "</span></div><div class=\"clear_both\"></div></div><div id=\"box" + postID + "_Footer_Links\" class=\"boxFooterLinks\"><span id=\"box" + postID + "_Footer_ShareLink\" class=\"boxShareLink boxPostLinks\">Share</span><span id=\"box" + postID + "_Footer_CommentLink\" class=\"boxCommentLink boxPostLinks\">Comment</span><span id=\"box" + postID + "_Footer_LikeLink\" class=\"boxLikeLink boxPostLinks\" onClick=\"like('" + postID +"');\" >Like</span><div class=\"clear_both\"></div></div></div></div>";
    beforePost = thePost + afterPost;
    $("#article").html(beforePost);
    }

function registerNameCheck(ForL) {
    if (ForL == "F") {
        FNameInput = document.getElementById('registerFName').value;
        patt = /^([a-z])+$/i;
        if (FNameInput == null) {
            $("#registerFName").css('box-shadow', '0px 0px 10px #FF0000');
            return false;
            }
        else if (patt.test(FNameInput) == false) {
            $("#registerFName").css('box-shadow', '0px 0px 10px #FF0000');
            return false;
            }
        else {
            $("#registerFName").css('box-shadow', 'none');
            return true;
            }
        }
    else if (ForL == "L")  {
        LNameInput = document.getElementById('registerLName').value;
        patt = /^([a-z])+$/i;
        if (LNameInput == null) {
            $("#registerLName").css('box-shadow', '0px 0px 10px #FF0000');
            return false;
            }
        else if (patt.test(LNameInput) == false) {
            $("#registerLName").css('box-shadow', '0px 0px 10px #FF0000');
            return false;
            }
        else {
            $("#registerLName").css('box-shadow', 'none');
            return true;
            }
        }
    }

function registerUsernameCheck() {
    UsernameInput = document.getElementById('registerUsername').value;
    patt = /^([a-z0-9 ])+$/i;
    if (UsernameInput == null) $("#registerUsername").css('box-shadow', '0px 0px 10px #FF0000');
    else if (patt.test(UsernameInput) == false) $("#registerUsername").css('box-shadow', '0px 0px 10px #FF0000');
    else $("#registerUsername").css('box-shadow', 'none');

    }

function registerEmailCheck() {
    emailInput = document.getElementById('registerEmail').value;
    if (isThisAnEmail(emailInput) == true) $("#registerEmail").css('box-shadow', 'none');
    else $("#registerEmail").css('box-shadow', '0px 0px 10px #FF0000');
    }

function loggedIn(reallyTheyAre) {
    if ((reallyTheyAre == false) || (reallyTheyAre == "false")) {
        $("#loginUsername").css('box-shadow', '0px 0px 10px #FF0000');
        $("#loginPassword").css('box-shadow', '0px 0px 10px #FF0000');
        }
    else window.location.href = "./Home.php";
    }

function refreshPuller() {
    windowTopY = $(window).scrollTop();
    return windowTopY;
    }

function loadMorePosts() {
    window.loadingMore = true;
    GETuserID = getURLParam("userID");
    if ((GETuserID != null) && (GETuserID != "") && (GETuserID !== 'undefined')) loadMorePostsUser(GETuserID);
    else loadMorePostsUser(window.userID);
    setTimeout(function () { window.loadingMore = false; }, 2500); //Not loading, can only reload once every 2.5 seconds
    }

function loadMorePostsUser(loadWhos) {
    $.post("./php/loadUserPostsArray.php", {"userID":loadWhos}, function (data) {loadMorePostsLoading(data);});
    }

function loadMorePostsLoading(IDs) {
    lastLoaded = $("#article div:first-of-type").attr("id").substring(3);
    IDs = IDs.split(",");
    personPerson = [21,1,25,22,222,2];
    locationOfLastLoad = $.inArray(lastLoaded,IDs);
    if (locationOfLastLoad < IDs.length-1) {
        locOfSplice = locationOfLastLoad + 1;
        IDslengthSplice = IDs.length-locOfSplice;
        IDs = IDs.splice(locOfSplice,IDslengthSplice);
        loadMorePostsLoadThisTime(IDs, 0);
        }
    }

function loadMorePostsLoadThisTime(IDs, place) {
    if (place < IDs.length) {
        if (loadingPost == true) canLoad = false;
        else canLoad = true;
        if (canLoad == true) {
            loadPostInfo(IDs[place]);
            place = place + 1;
            loadMorePostsLoadThisTime(IDs, place);
            }
        else {
            setTimeout(function () { loadMorePostsLoadThisTime(IDs, place); },250);
            }
        }
    }

function isThisPostLoaded(ID) {
    if ($("#box" + ID).is(':visible') == true) return true;
    else return false;
    }

function whoIsLoggedIn() {
    $.post("./php/whoIsThis.php", {}, function (data) { itIsI(data); });
    }
function itIsI(whoIsThis) {
    whoIsThis = whoIsThis.split("*");
    window.userID = whoIsThis[0];
    window.userName = whoIsThis[1];
    }

function isThisAnEmail(email) {
    var emailReg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    //regex from http://stackoverflow.com/questions/46155/validate-email-address-in-javascript
    if(!emailReg.test(email)) return false;
    else return true;
    }