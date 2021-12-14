<?php

    session_start();
    
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        
        
        
        $requestMailId = $_POST['email'];
        $_SESSION['requestMailId'] = $requestMailId;
        include './../config.php';

        if (isset($_POST["email"]) && (!empty($_POST["email"])))
        {
            $error= '';
            $email = $_POST["email"];
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if (!$email)
            {
                $error .="Invalid email address";
            }
            else
            {
                $query = "SELECT * FROM `users` WHERE email='" . $email . "'";
                $results = mysqli_query($conn, $query);
                $row = mysqli_num_rows($results);
                if ($row == "") {
                    $error .= "User Not Found";
                }
            }
            if ($error != "") {
                echo $error;
            }
            else
            {

                $output = '';

                $expFormat = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y"));
                $expDate = date("Y-m-d H:i:s", $expFormat);
                $token = md5(time());
                $addToken = substr(md5(uniqid(rand(), 1)), 3, 10);
                $token = $token . $addToken;

                // Insert into reset_table
                mysqli_query($conn, "INSERT INTO `reset_table` (`email`, `token`, `expdate`) VALUES ('" . $requestMailId . "', '" . $token . "', '" . $expDate . "');") or dir("Database Error, Try again!");


                $output.='<p>Please click on the following link to reset your password.</p>';
                
                $output.='<p><a href="http://localhost/vivek/recover/newPassword.php?token=' . $token . '&email=' . $requestMailId . '&action=reset" target="_blank">http://localhost/vivek/newPassword.php?token=' . $token . '&email=' . $requestMailId . '&action=reset</a></p>';
                $body = $output;


            }

            //Server settings
            require('PHPMailer/Exception.php');
            require('PHPMailer/SMTP.php');
            require('PHPMailer/PHPMailer.php');
            $mail = new PHPMailer\PHPMailer\PHPMailer();

            try
            {

        
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'vivekjgupta90@gmail.com';                     //SMTP username
                $mail->Password   = 'HukkaLala';                               //SMTP password
                $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;      //ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 587;       //465;                        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
                //Recipients
                $mail->setFrom('vivek@itvedant.com', 'ITVEDANT');
                $mail->addAddress('vivekjgupta90@gmail.com',);     //Add a recipient
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Password Reset - ITVEDANT';
                $mail->Body    = $body;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                
                if (!$mail->Send()) {
                    echo "Mail Sending Error: " . $mail->ErrorInfo;
                } else {
                    echo "<script>alert('An email has been sent')</script>";
                }
            }
            catch (Exception $e)
            {
                echo "Message could not be sent. Mail Sending Error: {$mail->ErrorInfo}";
            }

        }


    }
    
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    

    
?>