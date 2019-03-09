<?php
$dateOfBirth = "12-06-2000";
$today = date("Y-m-d");
$diff = date_diff(date_create($dateOfBirth), date_create($today));
$age = $diff->format('%y');
echo 'Age is '.$age;
?>