<?php require_once("./connect.php"); ?>
<?php session_start(); ?>
<?php

if(!empty($_POST['submit'])){
    if(empty($_POST['user_name'])||empty($_POST['password'])){
        exit("Please fill al the forms.<a href='./login.php'>RETURN</a>");
    }


    $user_name=addslashes($_POST['user_name']);
    $password=addslashes($_POST['password']);
    $_SESSION['username']=$user_name;

    /**
     * Fetch credentials from database
     */


    $sql="SELECT * FROM `user` WHERE `user_name`='{$user_name}'";
    $result=$db->query($sql);
    if($db->error){
        exit("SQL error.<a href='./login.php'>RETURN</a>");
    }
    if($result->num_rows===0){ //check if theres any match for username
        exit("Account does not exist.<a href='./login.php'>RETURN</a>");
    }

    //compare the password

    $password =$password;
    $array = $result->fetch_array(); //de unde stie exact ca trebuie sa ia parola?
    $result->free();
    $db->close();
    if($password===$array['password']){
        setcookie("id",$array['user_id'], 0, "/");
        $security=md5($array['user_id'].$array['password']."one_plus_two_is_three");
        setcookie("security", $security, 0, "/");
        echo "<script>window.location.href='./index.php'</script>";
 
    }else {
        exit("<br>Wrong password!");
    }  
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="wrapper">
        <div class="card border-top0" id="one">
                <form action="index.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="user_name" class="form-control" placeholder="username">
                        <span class="help-block"></span>
                    </div>    
                    <div class="form-group">
                        <input type="text" name="password" class="form-control" placeholder="password">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="form-control login" value="Login">
                    </div>
                    </br>
                    <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
                </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>   
</body>
</html>