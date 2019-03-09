


 

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
 $name = $obj['name'];
 $email = $obj['email'];
$enroll = $obj['enroll'];
$filename = $obj['enroll'].'.pdf';
$year = $obj['year'];
$dept = $obj['dept'];
$shift = $obj['shift'];
$mobile = $obj['mobile'];
$address = $obj['address'];
$gender = $obj['gender'];
$dob = $obj['dob'];

$from = $obj['from'];
$to = $obj['to'];
$clas = $obj['clas'];
$period = $obj['period'];

$date = date('Y-m-d H:i:s');

// $dateOfBirth = "12-06-2000";
$today = date("Y-m-d");
$diff = date_diff(date_create($dob), date_create($today));
$age = $diff->format('%y');
// echo 'Age is '.$age;

     
//Checking Email is already exist or not using SQL query.
$CheckSQL = "SELECT * FROM concession WHERE enroll='$enroll'  or email='$email' or filename='$filename'";
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
$Sql_Query = "insert into concession (name,email,enroll,filename,year,dept,shift,mobile,address,gender,dob,fromC,toC,clas,period,age,date) values ('$name','$email','$enroll','$filename','$year','$dept','$shift','$mobile','$address','$gender','$dob','$from','$to','$clas','$period','$age','$date' )";
 
 
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
