<?php
    include("connect.php") ;
    $showAlert = false;
    $showError = false;
    $name = $_POST['name'] ;
    $email = $_POST['email'] ;
    $password = $_POST['password'] ;
    $cpassword = $_POST['cpassword'] ;
    $contact = $_POST['contact'] ;
    $profile = $_FILES['profile']['name'] ;
    $tmp_name = $_FILES['profile']['tmp_name'];
    $role = $_POST['role'] ;
    //Checking for duplicate
    $check_user = mysqli_query($connect, " SELECT * FROM user WHERE name = '$name' ");
    $check_email = mysqli_query($connect, " SELECT * FROM user WHERE email = '$email' ");

    if(mysqli_num_rows($check_user) > 0){
        echo '
                <script>
                    alert("User Name Already Exist "); 
                    window.location = "../register.html"  ; 
                </script>
            ';
    }
    else if(mysqli_num_rows($check_email) > 0){
        echo '
                <script>
                    alert("User E-mail already Exist "); 
                    window.location = "../register.html"  ; 
                </script>
            ';
    }
    else{
        if($password==$cpassword){
            //$hash = password_hash($password, PASSWORD_DEFAULT);
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
    }
    
?>