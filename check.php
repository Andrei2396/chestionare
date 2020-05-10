<?php require_once("./connect.php")?>
<?php session_start(); ?>

<?php
if (!isset($_SESSION['score'])){
    $_SESSION['score']=0;
}

/*
 *  Get total questions
 */

$query="SELECT * FROM `questions` WHERE id_categorie='{$_SESSION['categories']}'";
$result = $db -> query($query) or die ($db -> error.__LINE__);
$total=$result->num_rows;


if($_POST){
    $number=$_POST['number'];
    $selected_choice=$_POST['choice'];
    $next=$number+1;
    
    /*
     *  Get correct choice 
     */

    $query="SELECT * FROM `answers` WHERE q_id ='{$_SESSION['q_id']}' AND correct_answer = 1";
    $result=$db->query($query) or die($db->error.__LINE__);
    $row=$result->fetch_assoc();
    $correct_choice=$row['a_id'];
    $_SESSION['q_id']=$_SESSION['q_id']+1;

    //  Compare
    if($correct_choice==$selected_choice){
        $_SESSION['score']=$_SESSION['score']+1;
        
    }

    //  Check if last page
    if($number == $total){
        header("Location: ./final.php"); 
    }else {
        header("Location: ./chestionar.php?n=".$next);
    }
}
?>
