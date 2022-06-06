<?php
    $connect = mysqli_connect("localhost","root","","onlineusers",) ;
    if($connect){
        echo "Database Connection Established " ;
    }
    else{
        echo "Error in Database Connection " ;
    }
?>