<?php
$conn = mysqli_connect("localhost","root","","idiscuss");
$showError = "False";
if(isset($_POST['login'])){
$email = $_POST['email'];
$pass = $_POST['password'];

$sql = "SELECT * FROM users WHERE user_email='$email'";
$result = mysqli_query($conn,$sql);
$numRows = mysqli_num_rows($result);
//for verifying password
if($numRows == 1){
  $row = mysqli_fetch_assoc($result);
  if(password_verify($pass,$row['user_password'])){
     session_start();
     $_SESSION['loggedin'] = true;
     $_SESSION['sno'] = $row['sno'];
     $_SESSION['useremail'] = $email;
    }
    header("location: /Harry iDisucuss forum website/index.php");
}
}


?>