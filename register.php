<?php

// check if the user has click the submit button
// check if user has filled every form
// check wether the two password are identical
// check e-mail adress and password using regular expression
// email format : "^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$"
// user_name : "/^.(0,50)$"
// password : "/^.(6,20)$"
// security check : addslashes()/ $db->escape_string()/ $db->real_escape_string()
// check if email has been used before
// ecrypt password using md5()
// if everyting if fine, insert into database


if(!empty($_POST['submit'])){
    if(empty($_POST['user_name'])||empty($_POST['password'])||empty($_POST['confirm_password'])){
        exit("Please fill al the forms.<a href='./register.php'>RETURN</a>");
    }
    if($_POST['password']!==$_POST['confirm_password']){
        exit("Please check your password.<a href='./register.php'>RETURN</a>");
    }
    $pattern = "/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
    if(!preg_match($pattern, $_POST['email'])){
        exit("Please use a valid email adress.<a href='./register.php'>RETURN</a>");
    }
    $pattern = "/^.{6,20}$/";
    if(!preg_match($pattern, $_POST['password'])){
        exit("Your password should contain at least 6 characters and no more than 20 characters.<a href='./register.php'>RETURN</a>");
    }

    //security measures for database

    $user_name=addslashes($_POST['user_name']);
    $password=addslashes($_POST['password']);
    $email=addslashes($_POST['email']);
    
    require_once("./connect.php");

    //check email

    $sql="SELECT * FROM `user` WHERE `email`='{$email}'";
    $result=$db->query($sql);
    if($db->error){
        exit("SQL error.<a href='./register.php'>RETURN</a>");
    }
    if($result->num_rows!==0){ //check if theres any match for e-mail
        exit("Please use another e-mail adress.<a href='./register.php'>RETURN</a>");
    }

    //destroy new object and insert data into database

    $result->free();
    $password= md5($password);
    $sql="INSERT INTO `user` SET `user_name`='{$user_name}', `email`='{$email}', `password`='{$password}'";
    $result=$db->query($sql);
    if($result===true){
        header("Location: ./login.php"); 
    } else {
        echo "registration failed";
    }
    $db->close();
    
}


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper" id="one">
        <div class="card">
            <h2>Sign Up</h2>
            <p>Please fill this form to create an account.</p>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="user_name" class="form-control" placeholder="username">

                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="email" class="form-control" placeholder="email">
                </div>  

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="password">
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" placeholder="confirm password">

                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit">
                    <input type="reset" class="btn btn-default" value="Reset">
                </div>
</br></br></br>
                <p>Already have an account? <a href="login.php">Login here</a>.</p>
            </form>
        </div> 
    </div>    
</body>
</html>