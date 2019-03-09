<?php
 
// Importing DBConfig.php file.
 
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
 $question = $obj['questionName'];
 $answer = $obj['answer'];
 $teacherName = $obj['teacherName'];

 $CheckSQLnew = "SELECT * FROM answer WHERE enroll='$enroll'  and teacher='$teacherName' and question='$question'";
 // $Sql_Query = "select * from register where email = '$email' and password = '$password' ";
 $date = date('Y-m-d H:i:s');
 // Executing SQL Query.
 $checknew = mysqli_fetch_array(mysqli_query($con,$CheckSQLnew));
 

 if(isset($checknew)){

    $EmailExistMSG = $enroll .' Already Exist, Please Try Again !!!';
    
    // Converting the message into JSON format.
   $EmailExistJson = json_encode($EmailExistMSG);
    
   // Echo the message.
    echo $EmailExistJson ; 
   
    }

    else{

$Sql_Query = "insert into answer (enroll,name,email,question,teacher,answer) values ('$enroll','$name','$email','$question','$teacherName','$answer')";
 
 
 if(mysqli_query($con,$Sql_Query)){
 
 // If the record inserted successfully then show the message.
$MSG = 'question Registered Successfully' ;
 
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