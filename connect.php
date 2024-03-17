<?php

$name1 = $_POST['name1'];
$email = $_POST['email'];
$Username = $_POST['Username'];
$password1 = $_POST['password1'];


if (!empty($name1) || !empty($email) || !empty($Username) || !empty($password1) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "medicationdiary";

// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From register Where email = ? Limit 1";
  $INSERT = "INSERT Into register (name1 , email , Username , password1)values(?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssss", $name1,$email,$Username,$password1);
      $stmt->execute();
      echo "Registration sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>