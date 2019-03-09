



<?php
 
// Importing DBConfig.php file.
// include 'DBConfig.php';
 
// Creating connection.
$con = mysqli_connect("localhost","root","","gpm");
 
 // Getting the received JSON into $json variable.
 $json = file_get_contents('php://input');
 
 // decoding the received JSON and store into $obj variable.
 $obj = json_decode($json,true);
 
 // Populate User name from JSON $obj array and store into $name.
$enroll = $obj['enroll'];
$name = $obj['name'];
$email = $obj['email'];
$password = $obj['password'];
// $password = sha1($pass,true);
$year = $obj['year'];
$dept = $obj['dept'];
$shift = $obj['shift'];
$mobile = $obj['mobile'];
$address = $obj['address'];
$dob = $obj['dob'];
$gender = $obj['gender'];

//Checking Email is already exist or not using SQL query.
$CheckSQL = "SELECT * FROM register WHERE enroll='$enroll'  or email='$email'";
// $Sql_Query = "select * from register where email = '$email' and password = '$password' ";
$date = date('Y-m-d H:i:s');
// Executing SQL Query.
$check = mysqli_fetch_array(mysqli_query($con,$CheckSQL));


if(isset($check)){

 $EmailExistMSG = $enroll .' Already Exist, Please Try Again !!!';
 
 // Converting the message into JSON format.
$EmailExistJson = json_encode($EmailExistMSG);
 
// Echo the message.
 echo $EmailExistJson ; 

 }
 else{
 
 // Creating SQL query and insert the record into MySQL database table.
$Sql_Query = "insert into register (enroll,name,email,password,year,dept,shift,mobile,address,date,gender,dob) values ('$enroll','$name','$email','$password','$year','$dept','$shift','$mobile','$address','$date','$gender','$dob')";
 
 
 if(mysqli_query($con,$Sql_Query)){
 
 // If the record inserted successfully then show the message.
$MSG = $enroll.' Registered Successfully' ;
 
// Converting the message into JSON format.
$json = json_encode($MSG);
 
// Echo the message.
 echo $json ;
 
 }
 else{
 
 echo 'Try Again';
 
 }
 }
 mysqli_close($con);
?>
