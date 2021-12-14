<?php

    session_start();
    if(!isset($_SESSION['counter']))
        $_SESSION['counter'] = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Login</title>
</head>
<body style="background-color:#e3ffed;">

    <?php

        if(isset($_SESSION['msg']))
        {
            echo('<div class="alert alert-danger" role="alert">');
            foreach($_SESSION['msg'] as $i)
            {
                if($i != '')
                    echo ($i.'   |   ');
            }
            echo('</div>');
            unset($_SESSION['msg']);
        }
        elseif(isset($_SESSION['resetMag']))
        {
            echo("<div class='alert alert-success' role='alert'>".$_SESSION['resetMag']."</div>");
        }
    ?>

    <div class="container d-flex justify-content-center align-items-center">
        <div class="card text-center col-md-4 mt-5 shadow-sm d-flex justify-content-center align-items-center">
            <form action="login_validation.php" method="POST">
                <div class="card-body">
                    
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="name@domain.com">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="* * * *">
                    </div>
                    <?php
                        if($_SESSION['counter']>3)
                        {
                    ?>   
                            <div class="mb-3">
                                <div class="g-recaptcha" data-sitekey="6LcdpIwdAAAAAKtteVqxtwimUi3WbI7E2zyqcvgy"></div>
                            </div>
                    <?php } ?>
                    <input type="submit" class="btn btn-primary">
                </div>
                <div class="card-footer text-muted">
                    <a href="recover/mailAddress.php">Forgot</a> password. <br>
                    Or <a href="register.php">Sign Up</a> for new account. <br>
                </div>
            </form>
        </div>
    </div>


    <script src="js/script.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/popper.js"></script>
</body>
</html>