
          <?php

          // Credentials
          $hostname = "localhost";
          $username = "root";
          $password = "";
          $database = "db_evote";

          //Establish Connection
          $conn = mysqli_connect($hostname, $username, $password, $database);


          // UserInput Test
          function test_input($data)
          {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            return $data;
          }
             
            if (empty($_POST['voterName']) || empty($_POST['voterEmail'])|| empty($_POST['voterID'])|| empty($_POST['loginPass'])) {
              $error = "UserName or Password is Required.";
              echo $error;
            } else {
   
                $voterName = test_input($_POST['voterName']);
                $voterEmail = test_input($_POST['voterEmail']);
                $voterID = test_input($_POST['voterID']);
                $loginPass = $_POST['loginPass'];
              
                //Check
                if (!$conn) {
                    die("Connection Failed : " . mysqli_connect_error());
                    
                }

                $sql = "INSERT INTO user VALUES ('" .$voterName. "','".$voterEmail. "','".$voterID. "','".$loginPass."')";
                $query = mysqli_query($conn, $sql);
                function  function_alert($message)
                {
                    //Redirect.
                echo 
                "<script>
                    alert('$message');
                    document.location = './index.html'
                    </script>";
        
                }
                //Function Call
                function_alert('You Have Successfully Registered');
                
           
            }
          ?>