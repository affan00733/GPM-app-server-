<?php
 
// Importing DBConfig.php file.
// include 'DBConfig.php';
 
// Creating connection.
 $con = mysqli_connect("localhost","root","","gpm");

 
 // Getting the received JSON into $json variable.
 $json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
 $obj = json_decode($json,true);
 
// Populate User email from JSON $obj array and store into $email.
// $email = $obj['email'];
 
// // Populate Password from JSON $obj array and store into $password.
// $password = $obj['password'];

//Applying User Login query with email and password match.
$Sql_Query = "select * from ln  where category='ln' ";

// Executing SQL Query.
$check =mysqli_query($con,$Sql_Query);

 

 
$dbdata = array();

//Fetch into associative array
 while ( $row = mysqli_fetch_assoc($check))  {
   $dbdata[]=$row;
 }

//Print array in JSON format
echo json_encode($dbdata);
 

 
 mysqli_close($con);
?>
