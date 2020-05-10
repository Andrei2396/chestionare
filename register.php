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
        exit("SQL error.<a href='./index.php'>RETURN</a>");
    }
    if($result->num_rows!==0){ //check if theres any match for e-mail
        exit("Please use another e-mail adress.<a href='./index.php'>RETURN</a>");
    }

    //destroy new object and insert data into database

    $result->free();
    $password= md5($password);
    $sql="INSERT INTO `user` SET `user_name`='{$user_name}', `email`='{$email}', `password`='{$password}'";
    $result=$db->query($sql);
    if($result===true){
        header("Location: ./index.php"); 
    } else {
        echo "registration failed";
    }
    $db->close(); 
}
?>
 