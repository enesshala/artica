<?php
require 'config/dbconfig.php';
session_start();

// $username = $_SESSION['username'];
// $query = $connection->prepare("SELECT * FROM posts");
// $query->execute();
// $posts = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $connection->prepare("SELECT * FROM posts p inner join users u on p.user_id = u.id WHERE p.user_id = u.id ORDER BY p.created_at DESC");
$query->execute();
$posts = $query->fetchAll(PDO::FETCH_ASSOC);



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

    <hr>
    <div class="blog-posts">
        <?php foreach ($posts as $i => $post) : ?>
            <div id="login-container">
                <div class="profile-img"><img src="admin/img/profiles/<?php echo $post["profile_pic"]; ?>" alt=""></div>
                <div class="top-img">
                    <img src="admin/<?php echo $post['image']; ?>" alt="">
                </div>
                <h1>
                    <?php echo $post['title']; ?>
                </h1>
                <div class="description">
                    <?php echo substr($post['body'], 0, 100); ?>....
                </div>
                <a href="single_post.php?post=<?php echo $post['post_id']; ?>">Read More</a>
                <footer>
                    <div class="likes">
                        <p><i class='fa fa-heart'></i></p>
                        <p>1.5K Likes</p>
                    </div>
                    <div class="projects">
                        <p>By: <?php echo $post['username']; ?></p>
                        <p>154</p>
                    </div>
                </footer>
            </div>
        <?php endforeach; ?>

    </div>


    <script src="js/script.js"></script>
</body>

</html>