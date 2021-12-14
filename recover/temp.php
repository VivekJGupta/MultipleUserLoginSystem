<?php


                    include './../config.php';

                    if (isset($_POST["email"]) && (!empty($_POST["email"])))
                    {
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
                            $results = mysqli_query($con, $sel_query);
                            $row = mysqli_num_rows($results);
                            if ($row == "") {
                                $error .= "User Not Found";
                            }
                        }
                        if ($error != "") {
                            echo $error;
                        } else {

                            $output = '';

                            $expFormat = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y"));
                            $expDate = date("Y-m-d H:i:s", $expFormat);
                            $token = md5(time());
                            $addToken = substr(md5(uniqid(rand(), 1)), 3, 10);
                            $token = $token . $addToken;

                            // Insert into reset_table
                            mysqli_query($conn, "INSERT INTO `reset_table` (`email`, `token`, `expdate`) VALUES ('" . $email . "', '" . $token . "', '" . $expDate . "');") or dir("Database Error, Try again!");


                            $output.='<p>Please click on the following link to reset your password.</p>';
                            
                            $output.='<p><a href="http://localhost/vivek/newPassword.php?key=' . $token . '&email=' . $email . '&action=reset" target="_blank">http://localhost/vivek/newPassword.php?token=' . $token . '&email=' . $email . '&action=reset</a></p>';
                            $body = $output;
                            $subject = "Password Recovery";

                            $email_to = $email;


                            //autoload the PHPMailer
                            require("vendor/autoload.php");
                            $mail = new PHPMailer();
                            $mail->IsSMTP();
                            $mail->Host = "mail.rathorji.in"; // Enter your host here
                            $mail->SMTPAuth = true;
                            $mail->Username = "support@rathorji.in"; // Enter your email here
                            $mail->Password = ""; //Enter your passwrod here
                            $mail->Port = 587;
                            $mail->IsHTML(true);
                            $mail->From = "support@rathorji.in";
                            $mail->FromName = "Rathorji PHP Tutorial";

                            $mail->Subject = $subject;
                            $mail->Body = $body;
                            $mail->AddAddress($email_to);
                            if (!$mail->Send()) {
                                echo "Mailer Error: " . $mail->ErrorInfo;
                            } else {
                                echo "An email has been sent";
                            }
                        }
                    }
                    ?>
                    <form method="post" action="" name="reset">
                        

                        <div class="form-group">
                           <label><strong>Enter Your Email Address:</strong></label>
                            <input type="email" name="email" placeholder="username@email.com" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <input type="submit" id="reset" value="Reset Password"  class="btn btn-primary"/>
                        </div>
                    </form>

                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </body>
</html>