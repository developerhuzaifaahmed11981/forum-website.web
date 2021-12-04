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
   
  
</head>

<body>
<?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    
    <?php 
$id = $_GET['id'];
$sql = "SELECT * FROM categories WHERE cat_id=$id";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
?>
    <div class="container my-4">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading"> <?php echo $row['cat_name']; ?> - Forum</h4>
            <p><?php echo $row['cat_des']; ?></p>
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
            <a href="#" class="btn btn-success">Read More</a>
        </div>
    </div>
    <?php } 
}
?>  
<?php 
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
?>
    <div class="container py-2">
        <h1>Stater Discussion</h1>
        <form action="include/addquestion.php?id=<?php echo $id; ?>" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Problem Title</label>
                <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">keep your title as short as possible</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Ellaborate your problem</label>
                <textarea name="desc" class="form-control"></textarea>
                <input type="hidden" name="sno" value="<?php echo $_SESSION['sno']; ?>">
                <p>This is sno of user in user table <?php echo $_SESSION['sno']; ?></p>
            </div>

            <input type="submit" class="btn btn-success" value="Submit" name="add-question">
        </form>
    </div>
<?php }else{
    echo '
    <div class="container">
    <h3>Stater Discussion</h3>
    <div class="alert alert-warning" role="alert">
    <p>You are not login . please login your self</p>
    
    </div>
    </div>
    ';
} ?>
    <div class="container mb-5" id="ques">
        <h1 class="py-2 text-center">Browse Questions</h1>
        <?php 
$cat_id = $_GET['id'];
$sql = "SELECT * FROM threads WHERE thread_cat_id=$cat_id";
$result = mysqli_query($conn,$sql);
$noresult = true;
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $noresult = false;
        $thread_user_id = $row['thread_user_id'];
        $sql2 = "SELECT * FROM users WHERE sno=$thread_user_id";
        $result2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
        

?>
        <div class="media shadow-sm py-1 px-2 mb-2">
            <img class="mr-3" src="images/user.png" width="54px" alt="Generic placeholder image">
            <div class="media-body">
            <p>Asked by <?php echo $row2['user_email']; ?> user at:<b><?php echo $row['created_at']; ?></b></p>
                <h5 class="mt-0"><a
                        href="thread.php?threadid=<?php echo $row['thread_id']; ?>"><?php echo $row['thread_title']; ?></a>
                </h5>
                <?php echo $row['thread_desc']; ?>
            </div>
        </div>
        <?php
    }
}
if($noresult){
    echo "
    <div class='alert alert-primary' role='alert'>
    <h1 class='alert-heading'>No threads found</h1>
    <p class='lead'>
    <b>Be the first person to ask a question.</b>
    </p>
    </div>
    ";
}
    ?>

    </div>


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

</body>

</html>