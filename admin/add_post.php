<?php
require 'database/dbconfig.php';
include 'inc/header.php';
include 'inc/navbar.php';

$userid = $_SESSION['id'] ?? null;

$query = $connection->prepare("SELECT * FROM users WHERE id = :id");
$query->bindValue(":id", $userid);
$query->execute();
$currentUser = $query->fetch(PDO::FETCH_ASSOC);

$errors = [];

$title = "";
$description = "";

if (isset($_POST['submit_post'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $image = $_FILES['image'] ?? null;

    if (!is_dir('img/posts/' . $currentUser['username'])) {
        mkdir('img/posts/' . $currentUser['username']);
    }

    $imagePath = '';
    if ($image && file_exists($_FILES['image']['tmp_name'])) {
        $imagePath = 'img/posts/' . $currentUser["username"] . "/" . randomString(8) . strrchr($image['name'], ".");
        if (!is_dir(dirname($imagePath)))
            mkdir(dirname($imagePath));
        move_uploaded_file($image['tmp_name'], $imagePath);
    }

    if (!$title) {
        $errors[] = 'Post title is required';
    }

    if (!$description) {
        $errors[] = 'Post Description is required';
    }

    if (empty($errors)) {
        $statement = $connection->prepare("INSERT INTO posts (user_id, title, image, body)
                VALUES (:user_id, :title, :image, :description)");
        $statement->bindValue(':user_id', $userid);
        $statement->bindValue(':title', $title);
        if ($image) {
            $statement->bindValue(':image', $imagePath);
        }
        $statement->bindValue(':description', $description);

        $statement->execute();
        header('Location: posts.php');
    }
}

function randomString($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }

    return $str;
}

?>
<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error) : ?>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<div class="card border-left-success col-8 mr-auto ml-auto mt-5 p-3">
    <h1 class="text-center">NEW POST</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" cols="30" rows="10" style="resize: none"></textarea>
        </div>
        <button type="submit" name="submit_post" class="btn btn-primary">POST</button>
    </form>

</div>

<?php
include 'inc/scripts.php';
include 'inc/footer.php';
?>