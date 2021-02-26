<?php
require 'config/dbconfig.php';
session_start();

$post = $connection->query("SELECT * FROM posts p inner join users u on p.user_id = u.id WHERE post_id =  '" . $_GET['post'] . "'")->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    // Navbar
    include "inc/navbar.php";
    ?>

    <div class="container center">
        <a href="blog.php" class="btn dark-button"><i class="fas fa-arrow-left"></i> Back to blog</a>
    </div>


    <div class="self_post_card">
        <div class="img-avatar">
            <img src="admin/img/profiles/<?php echo $post["profile_pic"];
                                            ?>" alt="">
        </div>
        <div class="self_post_card-text">
            <div class="portada">
                <img src="admin/<?php echo $post['image']; ?>" alt="">
            </div>
            <div class="title-total">
                <div class="title">
                    <h3>By: <?php echo $post['username']; ?></h3>
                </div>
                <h2><?php echo $post['title']; ?></h2>

                <div class="desc">
                    <p><?php echo $post['body']; ?></p>
                </div>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>

</html>