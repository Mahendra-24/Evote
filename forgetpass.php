<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">

    <title>E-voting</title>
    <!--

TemplateMo 548 Training Studio

https://templatemo.com/tm-548-training-studio

-->
    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-training-studio.css">
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">eVoting</a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->

                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <img src=".\voteIndia.jpg" alt="" class="center">

        <div class="video-overlay header-text">
            <div class="caption">
                <h6>Webixun Infoways</h6>
                <h2>Online <em>Voting </em>System</h2>
                <h6><em>Safe .Reliable .Secure .Fast</em></h6>
                </br>
                </br>
                <!--*****Form Section Start Here********-->
               
                <?php
        
                if (empty($_POST['voterEmail']))
                {
                    echo "
                    <form method='POST'action='forgetpass.php'>
                    <h3 style='color: rgb(223, 68, 12);' class='specialHead'>Forget Password</h3>
                    </br>

                    </br>
                    <input type='text' name='voterEmail' placeholder='Enter Your Email ID'>
                    </br>
                    </br>
                   
                    <button type='submit' name='submit' style='background-color: rgb(223, 68, 12) ;'><strong>Generate OTP </strong></button>
                    

                </form>";
                }
                else{
                    echo $_POST['submit'];
                    echo "
                    <form method='POST'action='forgetpass.php'>
                    <h3 style='color: rgb(223, 68, 12);' class='specialHead'>OTP</h3>
                    </br>

                    </br>
                    <input type='text' name='OTP' placeholder='Enter Your OTP'>
                    </br>
                    </br>
                   
                    <button type='submit' name='submit' style='background-color: rgb(223, 68, 12) ;'><strong>Generate OTP </strong></button>
                    

                </form>";
                }
           
                ?>
            </div>
        </div>
    </div>
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
      
          if (empty($_POST['voterEmail'])) {
              $error = "Email is Required.";
              echo $error;
          } else {
              //Recipient detail
              $voterEmail = test_input($_POST['voterEmail']);
              $OTP = rand(1000, 9999);
      
      
              $var_str = var_export($OTP, true);
              $var = "<?php\n\n\$OTPSave = $var_str;\n\n?>";
              file_put_contents('OTP.php', $var);
      
              //Save email temp for future UPDATE in database
              $var_str2 = var_export($voterEmail, true);
              $var2 = "<?php\n\n\$voterEmail = $var_str2;\n\n?>";
              file_put_contents('voterEmail', $var2);
              
              // Instantiation and passing `true` enables exceptions
              $mail = new PHPMailer(true);
      
              try {
                  //Server settings
                  $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                  $mail->isSMTP();                                            // Send using SMTP
                  $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                  $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                  $mail->Username   = 'phpuserphp@gmail.com';                     // SMTP username
                  $mail->Password   = 'Phpusers';                               // SMTP password
                  //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                  $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
      
                  //Recipients
                  $mail->setFrom('from@example.com', 'Mailer');
                  $mail->addAddress($voterEmail, 'voterEmail');     // Add a recipient
                  $mail->addReplyTo('info@example.com', 'Information');
                  $mail->addCC('cc@example.com');
                  $mail->addBCC('bcc@example.com');
      
                  // Attachments
                  //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                  //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
      
                  // Content
                  $mail->isHTML(true);                                  // Set email format to HTML
                  $mail->Subject = 'You OTP from Webixiun limited';
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
                  header("Location: resetPass.php");
              }
          }
      
      
      
      
          ?>
      

    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; 2020 Webixun Infoways

                        - Designed by <a rel="nofollow" href="https://templatemo.com" class="tm-text-link"
                            target="_parent">Mahendra Kumar Gupta</a></p>

                    <!-- You shall support us a little via PayPal to info@templatemo.com -->

                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>
    <script src="assets/js/mixitup.js"></script>
    <script src="assets/js/accordions.js"></script>

    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

</body>

</html>