
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>I Discuss coading Forum</title>
    <style>
    #ques {
        min-height: 433px;
    }
    </style>
</head>

<body>
<?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
   
    <?php 
$id = $_GET['threadid'];
$sql = "SELECT * FROM threads WHERE thread_id=$id";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $thread_user_id = $row['thread_user_id'];
        $sql3 = "SELECT * FROM users WHERE sno=$thread_user_id";
        $result3 = mysqli_query($conn,$sql3);
        $row3 = mysqli_fetch_assoc($result3);
        $posted_by = $row3['user_email'];
?>
    <div class="container my-4">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading"><?php echo $row['thread_title']; ?> - Forum</h4>
            <p><?php echo $row['thread_desc']; ?></p>
            <hr>
            <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
            <hr>
            <p>
                No Spam / Advertising / Self-promote in the forums.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Do not PM users asking for help.
                Remain respectful of other members at all times.

            </p>
            <p>posted by :<b> <?php echo $posted_by; ?></b></p>

        </div>
    </div>
    <?php } 
}
?>
 <?php
 if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
 ?>
      <div class="container py-2">
        <h1>Post a comment</h1>
        <form action="include/addquestion.php?threadid=<?php echo $id ?>" method="POST">
         
            <div class="form-group">
                <label for="exampleInputPassword1">Type a comment_content
                </label>
                <textarea name="content" class="form-control"></textarea>
                <input type="hidden" name="sno" value="<?php echo $_SESSION['sno']; ?>">
            </div>

            <input type="submit" class="btn btn-success" value="Post comment" name="add-comment">
        </form>
    </div>
<?php }else{
    echo ' <div class="container">
    <h3>Post a Comment</h3>
    <div class="alert alert-warning" role="alert">
    <p>You are not login . please login your self</p>
    
    </div>
    </div>';
}
 ?>
    <div class="container" id="ques">
        <h1 class="py-2 text-center">Discussions</h1>
        <?php 

$sql = "SELECT * FROM comments WHERE thread_id=$id ";
$result = mysqli_query($conn,$sql);
$noresult = true;
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $noresult = false;
        $comment_by = $row['comment_by'];
        
     
       //query for finding the useremail
        $sql2 = "SELECT * FROM users WHERE sno=$comment_by";
        $result2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
    
?>
        <div class="media py-2 shadow-sm my-2">
            <img class="mr-3" src="images/user.png" width="54px" alt="Generic placeholder image">
            <div class="media-body">
                <h5 class="mt-0"><?php echo $row2['user_email']; ?> User at <?php echo $row['comment_time']; ?> 
                </h5>
                <?php echo $row['comment_content']; ?>
            </div>
        </div>
        <?php
    }
}
if($noresult){
    echo "
    <div class='alert alert-primary' role='alert'>
    <h1 class='alert-heading'>No comments found</h1>
    <p class='lead'>
    <b>Be the first person to ans the problem.</b>
    </p>
    </div>
    ";
}
    ?>  

    </div>


    



    <?php include 'partials/_footer.php'; ?>




    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script>
  swal({
  title: "Good job!",
  text: "You clicked the button!",
  icon: "success",
});</script>
  

</body>

</html>