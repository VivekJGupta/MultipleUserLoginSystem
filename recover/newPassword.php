<?php

session_start();


if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    
    if(!isset($_GET['email']) || !isset($_GET['token']))
    {
        die('<h3>Page not found!</h3>');
    }

    $email = $_GET['email'];
    $token = $_GET['token'];

    $_SESSION['email'] = $email;
    $_SESSION['token'] = $token;

    // $action = $_GET['action'];

    $getList = array($email, $token);
    $temp = array();
    $flag = 0;
    $error = '';
    
    include './../config.php';
    $query = 'select email, token from reset_table;';

    $results = mysqli_query($conn, $query);
    $row = mysqli_num_rows($results);
    if ($row != 1)
    {
        $error .= "Link is Expired!";
    }
    
    if ($error != "" && $email=='' && $token=='' && $action='')
    {
        echo $error;
    }
    else
    {
        foreach($results as $x)
        {
            foreach($x as $i)
            {
                array_push($temp, $i);
            }
        }

        for($i=0; $i<2; $i++)
        {
            if($getList[$i] != $temp[$i])
            {
                echo $error;
                $flag = 1;
                break;
            }
        }

        if($flag)
            echo $error;
        else
        {
        
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
    <title>Login</title>
</head>
<body style="background-color:#e3ffed;">

    <div class="container d-flex justify-content-center align-items-center">
        <div class="card text-center col-md-4 mt-5 shadow-sm d-flex justify-content-center align-items-center">
            <form action="successPage.php" method="POST">
                <div class="card-body" style="width:350px;">
                    <div class="card-header">
                        <h5>Please Enter New Password</h5>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password1" id="password1" placeholder="New Password">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm New Password">
                    </div>
                    <input type="submit" class="btn btn-primary">
                    <?php if(isset($_SESSION['resetMag'])){ ?>
                        <div class="card-footer">
                            <h5><?php echo $_SESSION['resetMag'] ?></h5>
                        </div>
                    <?php } unset($_SESSION['resetMag']); ?>
                </div>
            </form>
        </div>
    </div>


    <script src="./../js/script.js"></script>
    <script src="./../js/bootstrap.min.js"></script>
    <script src="./../js/jquery.js"></script>
    <script src="./../js/popper.js"></script>
</body>
</html>

<?php

}}}
elseif($_SERVER['REQUEST_METHOD'] == 'POST')
{
//     $pass1 = $_POST['password1'];
//     $pass2 = $_POST['password2'];

//     if($pass1 != $pass2)
//     {
//         $_SESSION['resetMag'] = 'Password did not match, please try again!';
//         header('Location: http://localhost/vivek/recover/newPassword.php?token=' . $_SESSION['token'] . '&email=' . $_SESSION['requestMailId'] . '&action=reset');
//     }
//     else
//     {
//         $email = $_SESSION['requestMailId'];

//         try
//         {
//             $query = "update users set password=$pass1 where email='$email';";
//             $output = mysqli_query($conn, $query);

//             $_SESSION['resetMag'] = 'Password Reset Successfully ! Please login with new password';
//             echo ('<a href="./../login.php" class="btn btn-primary">Login</a>');
//             header('Location: http://localhost/vivek/recover/newPassword.php');
//         }
//         catch(Exception $e)
//         {
//             $_SESSION['resetMag'] = "Database Error Please try again!<br>";
//             echo "Error $e";
//             header('Location: http://localhost/vivek/recover/newPassword.php?token=' . $_SESSION['token'] . '&email=' . $_SESSION['requestMailId'] . '&action=reset');
//         }
//     }

    echo("<h1>Page NOT Found !</h1>");

}
?>