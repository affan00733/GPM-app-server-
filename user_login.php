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
$email = $obj['email'];
 
// Populate Password from JSON $obj array and store into $password.
$password = $obj['password'];
// $password = sha1($pass,true);
//Applying User Login query with email and password match.
$Sql_Query = "SELECT * FROM register WHERE email = '$email' and password = '$password' ";

// Executing SQL Query.
// $check = mysqli_fetch_array(mysqli_query($con,$Sql_Query));

$check =mysqli_query($con,$Sql_Query);


if(isset($check)){

 $dbdata = array();

//Fetch into associative array
 while ( $row = mysqli_fetch_assoc($check))  {
   $dbdata[]=$row;
 }

 $dataLogin = json_encode($dbdata);
//Print array in JSON format
echo  $dataLogin;

 

 }

 else{
 
 // If the record inserted successfully then show the message.
$InvalidMSG = 'Invalid Username or Password Please Try Again' ;
 
// Converting the message into JSON format.
$InvalidMSGJSon = json_encode($InvalidMSG);
 
// Echo the message.
 echo $InvalidMSGJSon ;
 
 }
 
 mysqli_close($con);
?>
