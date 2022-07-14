<?php
    session_start() ;
    // if not logged 
    if(!isset($_SESSION['userdata'])){
        header("location: ../login.html") ;
    }
    $userdata = $_SESSION['userdata'] ;
    $groupsdata = $_SESSION['groupsdata'] ;

    if($_SESSION['userdata']['status']==0){
        $status = '<b style="color:red"> Not Voted </b>' ;
    }
    else{
        $status = '<b style="color:green"> Voted </b>' ;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../Styles/dashboard.css">
</head>
    <style>
        body{
            margin: 0 ;
            padding:0 ;
        }
    </style>
<body >
    <style>
        .profile{
            display: grid ;
            background-color : white;
            width : 30% ;
            padding: 25px ;
            float : left ;
        }
        .groups{
            display: grid;
            background-color :white;
            width : 60% ;
            padding: 25px ;
            float : right ;
        }
        #votebtn{
            width:20%;
            border : 1px solid #ddd ;
            border-radius: 3px;
            outline: 0;
            padding:7px ;
            box-shadow: inset 1px 1px 5px rgba(0,0,0,0.9);
        }
        .gimage{
            float: right ;
        }
        #voted{
            background-color : green;

        }
    </style>
   
    <div class="navbar">
        
        <div>
            <a href="#">Online Voting System</a> <span>| </span>
            <a href="#"> Home </a>  <span>| </span>
        </div>
        <div>
            <a href="./register.html"> </a><span>| </span>
            <a href="logout.php">LogOut</a>
        </div>
    
    </div>

    <div class="maindiv">
        <div class="firstdiv">
            <marquee width="100%" direction="right" height="100px">
                <h1>Online Voting Dashboard</h1>
            </marquee>
        </div>
    </div>

    <div class="mainsection">
        <div class="profile">
            <center><img src="../uploads/<?php echo $userdata['photo'] ?>" height="150" width="150" alt=""> </center> </b> <br> <br>
            <b>Name   : <?php echo $userdata['name'] ?></b> <br> <br>
            <b>Mobile : <?php echo $userdata['contact'] ?></b> <br> <br>
            <b>Status : <?php echo $status ?></b> <br> <br>
            
        </div>
        <div  class="groups">
            <?php
                if($_SESSION['groupsdata']){
                    for($i = 0; $i<count($groupsdata); $i++){
                        ?>
                            <img class="gimage" id="gimage" src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" height="150" width="150" alt=""> <br> <br>
                            <b>Representative Name  :  <?php echo $groupsdata[$i]['name'] ?></b> <br> <br>
                            <b>Representative Votes :  <?php echo $groupsdata[$i]['votes'] ?></b> <br> <br>
                            <form action="../api/votes.php" method="post">
                                <input type="hidden" name="rvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
                                <input type="hidden" name="rid" value="<?php echo $groupsdata[$i]['id'] ?>">
                                <?php
                                    if($_SESSION['userdata']['status']==0){
                                        ?>
                                        <input type="submit" name="votebtn" value="vote" id="votebtn">
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <button disabled type="button" name="votebtn" value="vote" id="voted" >Voted</button>
                                        <?php
                                    }
                                ?>
                            </form>
                            <br> <br>
                        <?php
                    }
                }
            ?>
        </div>

    </div>
    
</body>
</html>