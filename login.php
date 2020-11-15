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

  //Verify $_POST 
  if (
    empty($_POST['voterEmail']) ||
    empty($_POST['loginPass'])
  ) {
    $error = "UserName or Password is Required.";
    echo $error;
  } // If no Error in POST 
  else 
  {
    $voterEmail = test_input($_POST['voterEmail']);
    $voterID = test_input($_POST['voterID']);
    $loginPass = $_POST['loginPass'];  // for encryption


    //Check
    if (!$conn) 
    {
      die("Connection Failed : " . mysqli_connect_error());
    }

    //Insert user data into user table
    $sql = "SELECT * FROM user WHERE emailid='".$voterEmail."' AND voterid = '".$voterID."' AND pwd ='".$loginPass."'";
    
    $query = mysqli_query($conn, $sql); 
    echo $loginPass;
    echo (mysqli_num_rows($query)); 
    if(mysqli_num_rows($query) >= 1)
    {   
        if ($voterEmail == 'admin@admin.com' ){
          header("location:a_dashpage.html");
        }
        else{
          header("location:dashpage.html");  
        }
    }
    else
    {
      //Redirect 
      echo "
      <script>
            alert('Wrong Password');
         
      </script>";
    }
  }
?>