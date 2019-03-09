<?php

$file = basename($_FILES['pdf']['name']);
 $tmp_name = $_FILES['pdf']['tmp_name'];
if(move_uploaded_file($tmp_name,"pdf_concession/".$file)){
  echo json_encode([
    "Message" => "The file has been uploaded",
    "Status" => "OK"
    ]);
}else{
  echo json_encode([
    "Message" => "sorry",
    "Status" => "Error"
    ]);
} 
?>