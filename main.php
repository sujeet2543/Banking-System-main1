
<?php
// connection with the database
$conn  = new mysqli("localhost" , "root" , "" , "banking_system");
if($conn->connect_error){
    die("Connection Failed" . mysqli_connect_error());
}
?>