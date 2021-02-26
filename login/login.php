<?php

require '../config/dbconfig.php';
session_start();

$errors = [];
$username = "";
$password = "";

if (isset($_POST['submit_login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = $connection->prepare('SELECT * FROM users WHERE username = :username');
  $query->bindValue(":username", $username);
  $query->execute();

  $user = $query->fetch();
  $userName = $user["username"] ?? null;
  $userPassword = $user["password"] ?? null;


  if (trim($username) === "" || trim($password) === "")
    $errors[] = "Fields must be filled!";
  else if (!$userName)
    $errors[] = "This user doesn't exist!";
  else if ($username === $userName && !password_verify($password, $userPassword))
    $errors[] = "Wrong password!";
  else if ($username !== $userName && !password_verify($password, $userPassword))
    $errors[] = "Wrong Credentials";
  else {
    $_SESSION['id'] = $_POST['id'];
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['email'] = $_POST['email'];
    header("Location: ../admin/index.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Login</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <form method="POST" class="box">
    <h1>Login</h1>
    <?php foreach ($errors as $error) : ?>
      <div class="alert alert-danger" role="alert">
        <h5 style="color: red; font-weight: lighter; letter-spacing: 2px"><?php echo $error; ?></h5>
      </div>
    <?php endforeach; ?>
    <input type="text" name="username" placeholder="Username" value="<?php echo $username ?>" />
    <input type="password" name="password" placeholder="Password" value="<?php echo $password ?>" />
    <input type="submit" name="submit_login" value="Login">
    <p style="margin-bottom: 5px; margin-top: 40px; color: white">
      Don't have an account?
    </p>
    <a href="register.php">Sign up now</a>
  </form>
</body>

</html>