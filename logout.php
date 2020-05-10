<?php
// Initialize the session
session_start();
            
// Unset all of the session variables
$_SESSION = array();

// Delete cookie
if(isset($_COOKIE['id'])&&isset($_COOKIE['security'])){
    setcookie("id","",time()-1,"/");
    setcookie("security","",time()-1,"/");
}else {
    header("location: index.php");
}
setcookie(session_name(),"",time()-1,"/");

// Destroy the session.
session_destroy();

// Redirect to login page
header("location: index.php");
exit;
?>
