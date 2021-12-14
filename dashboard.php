<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Dashboard</title>
</head>
<body>
    <?php
        session_start();

        if(!isset($_SESSION['name']) || !isset($_SESSION['user_id']) || $_SESSION['name'] == '')
        {
            header('locaion: login.php');
            echo ('<h3 class="text-dask">Please <a href="login.php">Login</a> first to check your progress!</h3>');
        }
        else
        {
            require_once 'nav.php';
            include 'config.php';
    ?>

        <div class="d-flex justify-content-center align-items-center" style="height:100%">
            <h3 class="d-flex justify-content-center align-items-center">Dashboard</h3>
        </div>
   
    <?php } ?>

    <script src="js/script.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/popper.js"></script>
</body>
</html>