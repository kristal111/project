<?php

require "connect.php";

if(isset($_POST['post'])){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = date('y-m-d');
    $author = $_POST['author'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    
    move_uploaded_file($image_tmp, "../image/$image");
    
    mysql_query("insert into post(post_title, post_content, post_date, post_author) values('$title', '$content', '$date', '$author')");
    
    mysql_query("insert into image(image_name) values('$image')");
    
    
}


?>