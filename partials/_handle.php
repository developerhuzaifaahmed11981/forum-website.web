<?php
$conn = mysqli_connect("localhost","root","","idiscuss");
$showError = "False";
if(isset($_POST['signup'])){
$email = $_POST['email'];
$pass = $_POST['password'];
$cpass = $_POST['cpassword'];

//chech whether this email exist
$existsql = "SELECT * FROM users WHERE user_email='$email'";
$result = mysqli_query($conn,$existsql);
$numRows = mysqli_num_rows($result);
if($numRows > 0){
 $showError = 'username is already exist';
}else{
  if($pass == $cpass){
     $hash = password_hash($pass, PASSWORD_DEFAULT);
     $sql = "INSERT INTO users(user_email,user_password) VALUES('$email','$hash')";
     $result = mysqli_query($conn,$sql);
     if($result){
 echo '  <script>
 swal({
 title: "Good job!",
 text: "You are registered!",
 icon: "success",
});</script>';
       $showAlert = true;
       header("location: /Harry iDisucuss forum website/index.php?signupsuccess=true");
       exit();
       
     }
  }else{
    $showError = 'password do not match ';
  }
}
header("location: /Harry iDisucuss forum website/index.php?signupsuccess=false&error=$showError");

}


?>