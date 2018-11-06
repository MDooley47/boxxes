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
    
    
    
    
    $userPostsIDs = explode(",", userPosts($userIDLookup));
    
    $amountofUserPosts = count($userPostsIDs);
    
    $i=1;
    while ($amountofUserPosts >= $i) {
        $postValue = returnPost($userPostsIDs[$amountofUserPosts - $i]);
        $postInfo = returnPostInfo($userPostsIDs[$amountofUserPosts - $i]);
        $postID = $userPostsIDs[$amountofUserPosts - $i];
        createPost($postValue, $postInfo, $postID);
        $i = $i + 1;
        }
    
    if ($amountofUserPosts == 0) {
        ?>

        <div id="box0" class="boxWrapper">
            <div id="box0_Header"class="boxHeader">
                <span id="box0_Header_Date" class="boxHeaderDate"></span>
                <span id="box0_Header_User" class="boxHeaderUser"></span>
                <span class="clear_both"></span>
            </div>
            <div id="box0_Content" class="boxContent">
                No posts to show yet!
            </div>
        </div>


        <?
        }

    function createPost($postValue, $postInfo, $postID) {
        $postInfo = explode("*",$postInfo);
        $postDate = $postInfo[0];
        $postName = $postInfo[1];
        $postShares = $postInfo[2];
        $postComments = $postInfo[3];
        $postLikes = $postInfo[4];
        
        ?>
            <div id="box<? echo $postID; ?>" class="boxWrapper">
                <div id="box<? echo $postID; ?>_Header"class="boxHeader">
                    <span id="box<? echo $postID; ?>_Header_Date" class="boxHeaderDate"><? echo $postDate; ?></span>
                    <span id="box<? echo $postID; ?>_Header_User" class="boxHeaderUser"><? echo $postName; ?></span>
                    <span class="clear_both"></span>
                </div>
                <div id="box<? echo $postID; ?>_Content" class="boxContent">
                    <? echo $postValue; ?>
                </div>
                <div id="box<? echo $postID; ?>_Footer" class="boxFooter">
                    <div id="box<? echo $postID; ?>_Footer_Counts" class="boxFooterCounts">
                        <div id="box<? echo $postID; ?>_Footer_Counts_ShareCount_Div" class="boxCountsDiv"><span id="box<? echo $postID; ?>_Footer_ShareCount" class="boxShareCount"><? echo $postShares; ?></span></div>
                        <div id="box<? echo $postID; ?>_Footer_Counts_CommentCount_Div" class="boxCountsDiv"><span id="box<? echo $postID; ?>_Footer_CommentCount" class="boxCommentCount"><? echo $postComments; ?></span></div>
                        <div id="box<? echo $postID; ?>_Footer_Counts_LikeCount_Div" class="boxCountsDiv"><span id="box<? echo $postID; ?>_Footer_LikeCount" class="boxLikeCount"><? echo $postLikes; ?></span></div>
                        <div class="clear_both"></div>
                    </div>
                    <div id="box<? echo $postID; ?>_Footer_Links" class="boxFooterLinks">
                        <span id="box<? echo $postID; ?>_Footer_ShareLink" class="boxShareLink boxPostLinks">Share</span>
                        <span id="box<? echo $postID; ?>_Footer_CommentLink" class="boxCommentLink boxPostLinks">Comment</span>
                        <span id="box<? echo $postID; ?>_Footer_LikeLink" class="boxLikeLink boxPostLinks"  onClick="like('<? echo $postID; ?>');" >Like</span>
                        <div class="clear_both"></div>
                    </div>
                </div>
            </div>
        <?
        }
    ?>