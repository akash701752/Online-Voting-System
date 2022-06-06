<?php
    include("connect.php") ;
    $name = $_POST['name'] ;
    $email = $_POST['email'] ;
    $password = $_POST['password'] ;
    $cpassword = $_POST['cpassword'] ;
    $contact = $_POST['contact'] ;
    $profile = $_FILES['profile']['name'] ;
    $tmp_name = $_FILES['profile']['tmp_name'];
    $role = $_POST['role'] ;
    // Checking Password and cpassword
    if($password==$cpassword){
        $upload_folder = '../uploads/' ;
        $upload = move_uploaded_file($tmp_name,$upload_folder .$profile) ;
        if($upload){
            echo "File Uploaded to uploads" ;
        }
        else{
            echo "File Uploading Failed" ;
        }
        // Inserting 
        $insert = mysqli_query($connect, " INSERT INTO user (name,email,password,contact,photo,role,status,votes) VALUES ('$name','$email','$password','$contact','$profile','$role',0,0)");

        if($insert){
            echo '
            <script>
                alert("Registration done Succeffully "); 
                window.location = "../login.html"  ; 
            </script>
        ';
        }
        else{
            echo '
            <script>
                alert("Some Error Occured in Registration  "); 
                window.location = "../register.html"  ; 
            </script>
        ';
        }
    }
    else{
        echo '
            <script>
                alert("Password and Confirm Password does NOT match "); 
                window.location = "../register.html"  ; 
            </script>
        ';
    }
?>