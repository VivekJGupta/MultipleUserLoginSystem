<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>User Verification...</title>
</head>
<body>
    
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        require_once 'config.php';
        include 'nav.php';
        session_start();


        $email = $password = '';
        $captcha = false;
        $email_err = $password_err = '';
        $msg = '';
        $captcha_err = '';
        $flag = true;

        if($_SESSION['counter']<=3)
        {
            $_SESSION['counter'] += 1;
        }
        else
        {
            $captcha = $_POST['g-recaptcha-response'];
            $secret_key = '6LcdpIwdAAAAAB6hEkFzJkwTemVloHyFqXpoaFF1';
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.urldecode($secret_key).'&response='.urldecode($captcha);
            $response = file_get_contents($url);
            $responseKey = json_decode($response, TRUE);

            if($responseKey['success'] != 1)
                $captcha_err =  'Invalid Captcha';
        }
        

        if(empty(trim($_POST['email'])))
            $email_err = "Email is required";
        else
            $email = $_POST['email'];
        
        if(empty(trim($_POST['password'])))
            $password_err = "Password is required";
        else
            $password = $_POST['password'];
        
        

        if($email_err || $password_err || $captcha_err)
        {
            $msg = array($email_err, $password_err, $captcha_err);
            $_SESSION['msg'] = $msg;
            header('Location: login.php');
        }
        else
        {
            $query = 'select id from users where password="'.$password.'" and email="'.$email.'";';
            $DB_User = mysqli_query($conn, $query) or $msg = "Email / Password Error !";
            

            if(mysqli_num_rows($DB_User) == 1)
            {
                foreach($DB_User as $x)
                    foreach($x as $userId)
                        $_SESSION["user_id"] = $userId;

                $query = "select name from users where id=".$_SESSION['user_id'].";";
                $name = mysqli_query($conn, $query);
                if(mysqli_num_rows($name)>0)
                {
                    foreach($name as $i)
                        foreach($i as $j)
                            $_SESSION["name"] = $j;
                }
                $_SESSION['logged_in'] = true;
                unset($_SESSION['counter']);
                unset($_SESSION['msg']);
                header('Location: dashboard.php?id='.$_SESSION["name"]);
            }
            else
            {
                $msg = array('Email ID or Password is incorrect!');
                $_SESSION['msg'] = $msg;
                header('Location: login.php');
            }
        }
    }


?>

    <script src="js/script.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/popper.js"></script>
</body>
</html>

