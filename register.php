<?php
    require_once 'config.php';

    $userName = $email = $password = $confirm_password = $city = $state = '';
    $userName_err = $email_err = $password_err = $confirm_password_err = $city_err = $state_err = '';
    $msg = '';


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if(empty(trim($_POST['name'])))
            $userName_err = "User Name is required.";
        else
            $userName = $_POST['name'];

        if(empty(trim($_POST['email'])))
            $email_err = "Email field is required.";
        else
            $email = $_POST['email'];
        
        if(empty(trim($_POST['password1'])))
            $password_err = "Password is required.";
        else
            $password = $_POST['password1'];
        
        if(empty(trim($_POST['password2'])))
            $confirm_password_err = "Repeatation of password is required!";
        else
            $confirm_password = $_POST['password2'];
        
        if(empty(trim($_POST['city'])))
            $city_err = "City is required.";
        else
            $city = $_POST['city'];
        
        if(empty(trim($_POST['state'])))
            $state_err = "State is required.";
        else
            $state = $_POST['state'];


        if($userName_err || $email_err || $password_err || $confirm_password_err || $city_err || $state_err)
        {
            $msg = array($userName_err, $email_err, $password_err, $confirm_password_err, $city_err, $state_err);
            
            echo('<div class="alert alert-danger" role="alert">');
            foreach($msg as $i)
            {
                if($i != '')
                    echo ($i.'   |   ');
            }
            echo('</div>');
        }
        else if($password != $confirm_password)
        {
            $msg = "Passwords of both field did not matching. Please try again!";
            echo('<div class="alert alert-danger" role="alert">'.$msg.'</div>');
        }
        else
        {
            $query = 'insert into users(name, email, password, city, state) values("'.$userName.'", "'.$email.'", "'.$password.'", "'.$city.'", "'.$state.'")';
            mysqli_query($conn, $query) or die("<script>alert('Date Insertion Error!')</script>");
            echo('<div class="alert alert-success" role="alert">User Added Successfully !</div>');
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Register</title>
</head>
<body style="background-color:#e3ffed;">

    <div class="container d-flex justify-content-center align-items-center">
        <div class="card text-center col-md-4 mt-3 shadow-sm d-flex justify-content-center align-items-center">
            <form action="register.php" method="POST">
                <div class="card-body">
                    
                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Your Name">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="name@domain.com">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password1" id="password1" placeholder="Password">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password2" id="password2" placeholder="Repeat Password">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="city" id="city">
                            <option value="mumbai">Mumbai</option>
                            <option value="thane">Thane</option>
                            <option value="pune">Pune</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="state" id="city">
                            <option value="maharashtra">Maharashtra</option>
                        </select>
                    </div>
                    
                    <input type="submit" class="btn btn-primary">
                    <input type="reset" class="btn btn-secondary">
                    
                </div>
                <div class="card-footer text-muted">
                    Already had account? <a href="login.php">Sign in</a>
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