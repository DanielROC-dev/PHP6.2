<?php
session_start();
$host = 'localhost';
$username = 'root';
$password ='';
$db = 'users';
$port = '3306';
$message = "";
try
{
    $connection = new PDO('mysql:host='.$host.';dbname='.$db.';port='.$port, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    if(isset($_POST["login"]))
    {
        if(empty($_POST["mail"]) || empty($_POST["password"]))
        {
            $message = '<label>All fields are required</label>';

        }
        else
        {
            $query = "SELECT * FROM accounts WHERE mail = :mail AND password = :password";
            $statement = $connection->prepare($query);
            $statement->execute(

                array(
                    'mail' => $_POST["mail"],
                    'password' => $_POST["password"]
                )
                
                
            );
            $count = $statement->rowCount();
            if($count > 0)
            {
                $_SESSION["mail"] = $_POST["mail"];
                header("location:home.php");
                
            }
            else
            {
                $message = '<label>mail or Password is wrong</label>';

            }
        }
    }   
} 
catch(PDOException $error)  
{  
    $message = $error->getMessage();  
}  

?>
<!DOCTYPE html>
<html>
    <head>
        <title> Login </title>
    </head>
    <body>
    <?php  
        if(isset($message))  
        {  
            echo $message;  
        }  
        ?>  
        <form method="post">
            <label> mail </label>
            <input type="text" name="mail">
            <br>
            <label> Password <label>
            <input type ="password" name="password">
            <br>
            <input type="submit" name="login" class="btn btn-primary btn-block" value="login">
            
        </form>
    </body>
</html>

