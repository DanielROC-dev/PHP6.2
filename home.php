<?php
session_start();
if(isset($_SESSION["mail"]))
{
    echo'<h1>Login succes, welkom ' .$_SESSION["mail"]. '<h1>';
    
    echo '<form method="post"><button type="submit" name="logout">logout</button></form>';
    if(isset($_POST['logout'])){
        session_destroy();
        header("location:index.php");
    }
}

?>