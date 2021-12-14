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
            <form action="mailRecoveryLogic.php" method="POST">
                <div class="card-body" style="width:350px;">
                    <div class="card-header">
                        <h5>Enter your Email Id</h5>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="name@domain.com">
                    </div>
                    <input type="submit" class="btn btn-primary" value="SUBMIT">
                    <a href="./../login.php" class="btn btn-secondary">Back</a>
                    <!-- <div class="mt-3 card-footer">
                        <h5>Confirmation message</h5>
                    </div> -->
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