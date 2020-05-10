<?php require_once("./connect.php"); ?>
<?php session_start(); ?>

<?php
 
 $number=(int) $_GET['n']; 

if(!isset($_SESSION['categories'])){
    $_SESSION['categories']=$_POST['categories'];
}


/*
 *  Get total questions
 */

$query="SELECT * FROM `questions` WHERE id_categorie='{$_SESSION['categories']}'";
$result = $db -> query($query) or die ($db -> error.__LINE__);
$total=$result->num_rows;

/*
 * Get categories
 */
$query="SELECT * FROM `questions` WHERE  `id_categorie`='{$_SESSION['categories']}'";
$result_q1 = $db -> query($query) or die ($db -> error.__LINE__);
$question1 = $result_q1 -> fetch_assoc() ;

if(!isset($_SESSION['q_id'])){
$_SESSION['q_id']=$question1['q_id'];
}

/*
 *  Get question
 */
$query="SELECT * FROM `questions` WHERE  `q_id`='{$_SESSION['q_id']}'";
$result_q = $db -> query($query) or die ($db -> error.__LINE__);
$question = $result_q -> fetch_assoc() ;

/*
 *  Get answer
 */
$query="SELECT * FROM `answers` WHERE `q_id`='{$_SESSION['q_id']}'";
$result_a = $db -> query($query) or die ($db -> error.__LINE__);
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
    <header>
        <div class="page-header">
            <h1>Welcome <?php echo $_SESSION['username'];?></h1>
        </div>
        <p>    
            <a href="index.php" class="btn btn-warning">Retake Test</a>
            <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
        </p>
    </header>
    <main>
        <div class="card">
            <form action="check.php" method="POST" >
                <p class="is_question">Question <?php echo $number?> of <?php echo $total?></p>
                <h3>  
                <?php echo $question['question'];
                ?>  
                
                </h3>
                <ul>
                <?php
                    if($result_a -> num_rows > 0){
                        while ($answer = $result_a-> fetch_assoc()){
                ?>  
                    
                    <li class="choice" >
                        <span  onclick="check()"><input class="choice1" type="radio" name="choice" value="<?php echo $answer['a_id'];?>"><?php echo $answer['answer'];?></span>       
                    </li>
                    
                <?php        
                        }
                    }
                ?>
                </ul>  
                <input type="hidden" name="number" value="<?php echo $number;?>">
                <input type="submit" class="btn btn-light">               
            </form>
        </div>
    
    </main>
    <footer>
            <h4>Copyright &copy; 2020</h4>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="index.js"></script>
</body>
</html>