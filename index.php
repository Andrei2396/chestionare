<?php
    require_once("./connect.php");
    session_start();
?>
<?php    
    if(isset($_SESSION['score'])){
        unset($_SESSION['score']);
    }
    if(isset($_SESSION['categories'])){
        unset($_SESSION['categories']);
    }
    if(isset($_SESSION['q_id'])){
        unset($_SESSION['q_id']);
    }

    /*
     *  Get categories
     */
    $query="SELECT * FROM `categories`";
    $result_c = $db -> query($query) or die ($db -> error.__LINE__);

    /*
     * Display username and content
     */
    $logedin="none";
    $pleaselogin="block";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="login-blur"></div>
    <div id="login-window">
        <div class="card border-top" id="one">
            <form action="login.php" method="POST">
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
                <p>Don't have an account? <a href="#" id="register-btn">Sign up now</a>.</p>
             </form>
        </div>
    </div>
    <div id="register-window">
        <div class="card border-top" id="one">
            <form action="register.php" method="POST">
                <div class="form-group">
                   <input type="text" name="user_name" class="form-control" placeholder="username">
                    <span class="help-block"></span>
                </div>    
                <div class="form-group">
                   <input type="text" name="email" class="form-control" placeholder="email">
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                   <input type="text" name="password" class="form-control" placeholder="password">
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                   <input type="text" name="confirm_password" class="form-control" placeholder="confirm password">
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="form-control login" value="Submit">
                </div>
            </form>
        </div>
    </div>
    <header>
        <div class="page-header">
            <h1>Welcome 
                <?php 
                if(isset($_SESSION['username'])){
                    echo $_SESSION['username'];
                    $logedin="fixed";
                    $pleaselogin="none";
                }
                ?> 
            <h1>
        </div>
        <div>

            <a href="logout.php" class="btn btn-danger" style="display:<?php echo $logedin;?>">>Sign Out of Your Account</a>
        </div>
    </header>
    <main>
        <div style="display:<?php echo $logedin;?>"> 
            <form action="chestionar.php?n=1" method="POST">
                <h3>Choose a category:</h3>
                <div class="form-group col-md-4 mx-auto">
                    <select id="inputCategory" name="categories" class="form-control ">
                        <?php 
                            if($result_c -> num_rows > 0){
                                while($categories=$result_c->fetch_assoc()){
                        ?>
                        <option value="<?php echo $categories['id_categorie']?>">
                            <?php echo $categories['denumire_categorie'] ?>
                        </option>
                            <?php
                                    }
                                }
                            ?>
                    </select>                   
                </div>
                <div class="form-group mx-auto">
                    <div class="">
                        <button type="submit" class="btn btn-primary">Select</button>
                    </div> 
                </div>    
            </form>
        </div>         
        <div class="pleaselogin" style="display:<?php echo $pleaselogin;?>"> 
            <p>To test your might you first have to Log in</p>
            <a id="login-index"  class="btn btn-warning">Log in</a>
            
        </div> 
    </main>
    <footer>
            <h4>Copyright &copy; 2020</h4>
    </footer>
    <!-- Latest compiled and minified JavaScript -->   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="index.js"></script>
</body>
</html>