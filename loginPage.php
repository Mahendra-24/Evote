<?php

require('config.php');





if (isset($_POST["submit"])) {
    if (isset($_POST["voterEmailLogin"])  && isset($_POST["voterIDLogin"])) {
        $emailLogin = test_input($_POST["voterEmail"]);
        $voterIDLogin = test_input($_POST["voterID"]);
    }
} else {
    echo "<br>All Field Recquired";
}

$DB_HOST = "192.168.0.25";
$DB_USER = "root";
$DB_PASSWORD = "";
$DB_NAME = "db_evoting";


$conn = @mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME)
    or die("Couldn't Connect to Database :");



$sql = "INSERT INTO db_evoting.tbl_users VALUES(null,'" . $name . "','" . $email . "','" . $voterID . "','" . $selection . "');";


if (mysqli_query($conn, $sql)) {
    echo "<img src='images/success.png' width='70' height='70'>";
    echo "<h3 class='text-info specialHead text-center'><strong> YOU'VE  SUCCESSFULLY   VOTED.</strong></h3>";
    echo "<a href='index.html' class='btn btn-primary'> <span class='glyphicon glyphicon-ok'></span> <strong> Finish</strong> </a>";
} else {
    echo "<img src='images/error.png' width='70' height='70'>";
    echo "<h3 class='text-info specialHead text-center'><strong> SORRY! WE'VE SOME ISSUE..</strong></h3>";
    echo "<a href='index.html' class='btn btn-primary'> <span class='glyphicon glyphicon-ok'></span> <strong> Finish</strong> </a>";
}
