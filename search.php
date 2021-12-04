<?php
$conn = mysqli_connect("localhost","root","","idiscuss");
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>I Discuss coading Forum</title>
    <style>
.container{
    min-height:600px;
}

    </style>
  </head>
  <body>
  <?php include 'partials/_dbconnect.php'; ?>
<?php include 'partials/_header.php'; ?>


<!--search result starts---------->
<div class="container my-3">
<h2 class="my-1 py-1">Search results for <em>"<?php echo $_GET['search']; ?></em>"</h2>
<?php 
$query = $_GET["search"];
 $sql = "SELECT * FROM threads WHERE match (thread_title,thread_desc) against ('$query')";
 $result = mysqli_query($conn,$sql);
$noresult = true;
 while($row = mysqli_fetch_assoc($result)){
     $noresult = false;
 $title = $row['thread_title'];
 $desc = $row['thread_desc'];
 $thread_id = $row['thread_id'];
 $url = "thread.php?threadid=".$thread_id;

 //display the search result 
 echo '
 <div class="result">
<h3 class="mx-1"><a href="'. $url .'">'. $title .'</a></h3>
<p>'. $desc .'</p>
 </div>
 ';

 }
 
if($noresult){
    echo '
    <div class="container">
   <div class="alert alert-success">
  <h3>No resultst found</h3>
  <p class="lead">
   </p>
suggentions:
<li>Try different keyword</li>

<li>Try valid keyword</li>
<li>Make sure that all words are correctly</li>

   </div>
    </div>
    ';
}
?>






</div>


<?php include 'partials/_footer.php'; ?>


















    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    
  </body>
</html>