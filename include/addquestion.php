<?php
include '../partials/_dbconnect.php';

if(isset($_POST['add-question'])){
    $category_id = $_GET['id'];
    $title = $_POST['title'];
    $title = str_replace("<","&lt;",$title);
    $title = str_replace(">","&gt;",$title);
    $desc = $_POST['desc'];
    $desc = str_replace("<","&lt;",$desc);
    $desc = str_replace(">","&gt;",$desc);
    $snoformsession = $_POST['sno'];
    $query = "INSERT INTO threads(thread_title,thread_desc,thread_cat_id,thread_user_id) VALUES ('$title','$desc',$category_id,$snoformsession)";
    $result = mysqli_query($conn,$query);
    if($result){
         header("location: ../threadlist.php?id=$category_id");
    }else{
        echo "don't add ";
    }
}
if(isset($_POST['add-comment'])){
    $thread_id = $_GET['threadid'];
//for no error when user give code we replace it.
    $content = $_POST['content'];
    $content = str_replace("<","&lt;",$content);
    $content = str_replace(">","&gt;",$content);

    $snoformsession = $_POST['sno'];
    $query = "INSERT INTO comments(comment_content,thread_id,comment_by) VALUES ('$content',$thread_id,$snoformsession)";
    $result = mysqli_query($conn,$query);
    if($result){
     header("location: ../thread.php?threadid=$thread_id");
    }else{
        echo "don't add ";
    
}
}


?>