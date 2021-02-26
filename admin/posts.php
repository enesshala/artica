<?php
require 'database/dbconfig.php';
include 'inc/header.php';
include 'inc/navbar.php';

$username = $_SESSION['username'];

$query = $connection->prepare("SELECT status FROM users WHERE username = :username");
$query->bindValue(":username", $username);
$query->execute();
$currentUser = $query->fetch(PDO::FETCH_ASSOC);

if ($currentUser['status'] === 'admin') {
    $query = $connection->prepare("SELECT posts.*, users.username 
                               FROM posts LEFT JOIN users ON 
                               posts.user_id = users.id 
                               ORDER BY posts.created_at DESC");
    $query->execute();
} else {
    $query = $connection->prepare("SELECT posts.*, users.username 
                               FROM posts LEFT JOIN users ON 
                               posts.user_id = users.id 
                               WHERE posts.user_id = 
                               (SELECT users.id FROM users WHERE users.username = :username) 
                               ORDER BY posts.created_at  DESC");
    $query->bindValue(":username", $username);
    $query->execute();
}
$posts = $query->fetchAll(PDO::FETCH_ASSOC);

// echo '<pre>';
// var_dump($posts);
// echo '</pre>';
// exit;
?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Post Table
                <a href="add_post.php" class="btn btn-primary">
                    Add New Post
                </a>
            </h6>
        </div>
        <div class=" card-body">
            <div class="table-responsive col-12">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> Image </th>
                            <th>Title </th>
                            <th>Body</th>
                            <th>Created_at</th>
                            <th>EDIT </th>
                            <th>DELETE </th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th> ID </th>
                            <th> Image </th>
                            <th>Title </th>
                            <th>Body</th>
                            <th>Created_at</th>
                            <th>EDIT </th>
                            <th>DELETE </th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($posts as $i => $post) : ?>
                            <tr>
                                <td><?php echo $i + 1 ?></td>
                                <td>
                                    <img src="<?php echo $post['image']; ?>" class="post_img" alt="post alternative title">
                                </td>
                                <td><strong><?php echo $post['title']; ?></strong></td>
                                <td><?php echo substr($post['body'], 0, 150); ?>...</td>
                                <td><?php echo $post['created_at']; ?></td>
                                <td class="text-center">
                                    <a href="update_post.php?id=<?php echo $post['post_id'] ?>" class="btn btn-sm btn-circle btn-primary"><i class="fas fa-edit"></i></a>
                                </td>
                                <td class="text-center">
                                    <form action="delete_post.php" method="POST">
                                        <input type="hidden" name="delete_id" value="<?php echo $post['post_id']; ?>">
                                        <button type="submit" name="delete_btn" class="btn btn-sm btn-circle btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php
include 'inc/scripts.php';
include 'inc/footer.php';
?>