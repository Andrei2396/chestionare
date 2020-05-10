<?php require_once("F:/Programare/XAMPP/htdocs/chestionare/connect.php"); ?>
<?php session_start(); ?>
<?php

if(!empty($_POST['submit'])){
    if(empty($_POST['user_name'])||empty($_POST['password'])){
        exit("Please fill al the forms.<a href='./login.php'>RETURN</a>");
    }

    $user_name=addslashes($_POST['user_name']);
    $password=addslashes($_POST['password']);

    require_once("./connect.php");

    $sql="SELECT * FROM `user` WHERE `user_name`='{$user_name}'";
    $result=$db->query($sql);
    if($db->error){
        exit("SQL error.<a href='./login.php'>RETURN</a>");
    }
    if($result->num_rows===0){ //check if theres any match for username
        exit("Account does not exist.<a href='./login.php'>RETURN</a>");
    }

    //compare the password

    $password = md5($password);
    $array = $result->fetch_array(); //de unde stie exact ca trebuie sa ia parola?
    $result->free();
    $db->close();
    if($password===$array['password']){
        setcookie("id",$array['user_id'], 0, "/");
        $security=md5($array['user_id'].$array['password']."one_plus_two_is_three");
        setcookie("security", $security, 0, "/");
        echo "<script>window.location.href='./index.php'</script>";
        $_SESSION['username']=$user_name;
    }else {
        exit("<br>Wrong password!");
    }  
}
?>