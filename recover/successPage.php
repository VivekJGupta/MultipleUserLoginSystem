<?php

session_start();
include './../config.php';


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $pass1 = $_POST['password1'];
    $pass2 = $_POST['password2'];

    $token = $_SESSION['token'];
    $mailID = $_SESSION['requestMailId'];


    if($pass1 != $pass2)
    {
        $_SESSION['resetMag'] = 'Password did not match, please try again!';
        header('Location: http://localhost/vivek/recover/newPassword.php?token=' . $_SESSION['token'] . '&email=' . $_SESSION['requestMailId'] . '&action=reset');
    }

    echo("<script>alert('$token - $mailID')</script>");

    if($pass1 != $pass2)
    {
        $_SESSION['resetMag'] = 'Password did not match, please try again!';
        header("Location: http://localhost/vivek/recover/newPassword.php?token=".$token."&email=".$mailID."&action=reset");
    }
    else
    {
        try
        {
            $query1 = "update users set password=$pass1 where email='$mailID';";
            $output = mysqli_query($conn, $query1) or die("Error in updation!");
            $query2 = "delete from reset_table;";
            $output = mysqli_query($conn, $query2) or die("Error in updation!");
            

            $_SESSION['resetMag'] = "Password Reset Successfully ! Please login with new password";
            echo ('<a href="./../login.php" class="btn btn-primary">Login</a>');
            header('Location: http://localhost/vivek/login.php');
        }
        catch(Exception $e)
        {
            $_SESSION['resetMag'] = "Database Error Please try again!<br>";
            echo "Error $e";
            header('Location: http://localhost/vivek/recover/newPassword.php?token='.$token.'&email='.$mailID.'&action=reset');
        }
    }
}



?>