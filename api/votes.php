<?php
    session_start() ;
    include("connect.php") ;
    $votes = $_POST['rvotes'] ;
    $total_votes = $votes+1 ;
    $rid = $_POST['rid'] ;
    $uid = $_SESSION['userdata']['id'] ;

    $update_votes = mysqli_query($connect, "UPDATE user SET votes='$total_votes' WHERE id='$rid' ") ;
    $update_user_status = mysqli_query($connect," UPDATE user SET status=1 WHERE id='$uid' ") ;

    if( $update_votes and $update_user_status ){
        $groups = mysqli_query($connect, " SELECT id,name,votes,photo FROM user WHERE role=2 ");
        $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC) ;

        $_SESSION['userdata']['status'] = 1 ;
        $_SESSION['groupsdata'] = $groupsdata ;

        echo '
            <script>
                alert("Voting Successful "); 
                window.location = "../routes/dashboard.php"  ; 
            </script>
        ';
    }
    else{
        echo '
            <script>
                alert("Some Error Occured in Updation of Votes "); 
                window.location = "../routes/dashboard.php"  ; 
            </script>
        ';
    }
?>