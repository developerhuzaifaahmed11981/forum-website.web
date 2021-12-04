<?php 
session_start();

$conn = mysqli_connect("localhost","root","","idiscuss");

echo '
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Top categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
$sql = "SELECT * FROM categories  LIMIT 5";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
           echo ' <li><a class="dropdown-item" href="threadlist.php?id='. $row['cat_id'] .'">'. $row['cat_name'] .'</a></li>';
         
}       
          echo  '</ul>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
      
      </ul>';
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
         echo '<form class="d-flex" action="search.php" method="GET">
         <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
         <button class="btn btn-outline-success" type="submit">Search</button>
          <p class="text-primary my-0 mx-4">welcome '.$_SESSION['useremail'].'</p>
          <a href="partials/_logout.php" class="btn btn-outline-danger" type="button">Logout</a>
          </form>';  
      }else{
       echo ' 
       <p class="text-danger my-1 mx-2 py-1">Welcome-Guest</p>
         <div class="row mx-2">
         
         <div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</div>
         </div>
         <div class="row mx-2">
      
          <div class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#loginModal">Login</div>
        </div>
          ';
        
      }
     
         
   

  echo ' </div>
</nav>';

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true"){
  echo '
  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successfully user signup</strong> You can now login
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  ';

}
?>