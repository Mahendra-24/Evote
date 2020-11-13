<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>

    <style>
        .headerFont {
            font-family: 'Ubuntu', sans-serif;
            font-size: 24px;
        }

        .subFont {
            font-family: 'Raleway', sans-serif;
            font-size: 14px;

        }

        .specialHead {
            font-family: 'Oswald', sans-serif;
        }

        .normalFont {
            font-family: 'Roboto Condensed', sans-serif;
        }
    </style>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <?php
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require 'vendor/autoload.php';


    // UserInput Test
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (empty($_POST['emailID'])) {
        $error = "Email is Required.";
        echo $error;
    } else {
        //Recipient detail
        $emailID = test_input($_POST['emailID']);
        $OTP = rand(1000, 9999);


        $var_str = var_export($OTP, true);
        $var = "<?php\n\n\$OTPSave = $var_str;\n\n?>";
        file_put_contents('OTP.php', $var);

        //Save email temp for future UPDATE in database
        $var_str2 = var_export($emailID, true);
        $var2 = "<?php\n\n\$emailID = $var_str2;\n\n?>";
        file_put_contents('emailID.php', $var2);
        
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'mailerphpemail@gmail.com';                     // SMTP username
            $mail->Password   = 'maileremailpass';                               // SMTP password
            //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress('.com', 'prashant singh');     // Add a recipient
            $mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'You OTP from Webixiun limited  ';
            $mail->Body  = $OTP;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            echo "P___1";
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "P___2";
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    //OTP
    if (empty($_POST['OTP'])) {
        $error = "OTP is Required.";
        echo $error;
        echo "p2";
    } else {
        echo "p1";
        echo "p1";echo "p1";echo "p1";
        include "OTP.php";
        //Recipient detail
        $OTPRec = test_input($_POST['OTP']);
        echo 'rec' . $OTPRec;
        echo 'sav' . $OTPSave;echo "hi";
        //OPT check
        if ($OTPRec == $OTPSave) {
            header("Location: newPassUser.php");
        }
    }




    ?>

    <div class="container">
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse
    " role="navigation">
            <div class="container">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-header">
                    <a href="index.html" class="navbar-brand headerFont text-lg"><strong>eVoting</strong></a>
                </div>

                <div class="collapse navbar-collapse" id="example-nav-collapse">
                    <ul class="nav navbar-nav">
                        <!-- 
            <li><a href="#featuresTab"><span class="subFont"><strong>Features</strong></span></a></li>
            <li><a href="#feedbackTab"><span class="subFont"><strong>Feedback</strong></span></a></li>
            <li><a href="#"><span class="subFont"><strong>About</strong></span></a></li>
        	-->
                    </ul>


                    <button type="submit" class="btn btn-success navbar-right navbar-btn"><span class="normalFont"><strong>Admin Panel</strong></span></button>
                </div>

            </div> <!-- end of container -->
        </nav>


        <div class="container" style="padding-top:150px;">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4" style="border:2px solid gray;padding:50px;">

                    <div class="page-header">
                        <h2 class="specialHead">Enter OTP</h2>
                    </div>
                    <form action="forgetPassGetOTP.php" method="POST">
                        <div class="form-group">


                            <input type="text" name="OTP" placeholder="Enter OTP" class="form-control"><br>



                            <button type="submit" class="btn btn-block span btn-primary "><span class="glyphicon glyphicon-user"></span> Submit and Change password</button>

                            <label id="error"></label>
                        </div>

                    </form>


                    <br>

                </div>
                <div class="col-sm-4"></div>
            </div>
        </div>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>