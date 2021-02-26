<?php

require 'database/dbconfig.php';
session_start();

$errors = [];
$errors2 = [];
$username = "";
$email = "";
$password = "";
$cpassword = "";

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
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    header("Location: index.php");
  }
}

if (isset($_POST['submit_signup'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cpassword = $_POST['confirmpassword'];

  $query = $connection->prepare("SELECT * FROM users WHERE email=:email");
  $query->bindValue(":email", $email);
  $query->execute();
  $userExist = $query->fetch(PDO::FETCH_ASSOC);

  if (!$username) {
    $errors2[] = "Username is required!";
  } else if (!$email) {
    $errors2[] = "Email is required!";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors2[] = "Invalid email format!";
  } else if (!$password) {
    $errors2[] = "Password is required!";
  } else if (!$cpassword) {
    $errors2[] = "Confirm password is required!";
  } else if ($password !== $cpassword) {
    $errors2[] = "Confirm password should be the same!";
  }

  if ($userExist) {
    $errors2[] = "This user exist!";
  }
  if (empty($errors2)) {
    $query = $connection->prepare('INSERT INTO users (username, email, password) VALUES(:username, :email, :password)');
    $query->bindValue(":username", $username);
    $query->bindValue(":email", $email);
    $query->bindValue(":password", password_hash($password, PASSWORD_DEFAULT));

    $query->execute();
    header('Location: login.php');
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="form-structor <?php foreach ($errors as $error) : echo "error-border";
                            endforeach; ?>">
    <form action="" method="POST">
      <div class="signup">
        <h2 class="form-title" id="signup"><span>or</span>Log in</h2>
        <div class="form-holder">

          <?php foreach ($errors as $error) : ?>
            <div class="errors" role="alert">
              <p><?php echo $error; ?></p>
            </div>
          <?php endforeach; ?>

          <input type="text" class="input" name="username" placeholder="Username" value="<?php echo $username ?>" />
          <input type="password" class="input" name="password" placeholder="Password" value="<?php echo $password ?>" />
        </div>
        <button type="Submit" name="submit_login" class="submit-btn">Log in</button>
      </div>
    </form>

    <form action="" method="POST">
      <div class="login slide-up">
        <div class="center">
          <h2 class="form-title" id="login"><span>or</span>Sign up</h2>
          <div class="form-holder">
            <?php foreach ($errors2 as $error) : ?>
              <div class="errors" role="alert">
                <p><?php echo $error; ?></p>
              </div>
            <?php endforeach; ?>
            <input type="text" class="input" name="username" placeholder="Username" />
            <input type="email" class="input" name="email" placeholder="Email" />
            <input type="password" class="input" name="password" placeholder="Password" />
            <input type="password" class="input" name="confirmpassword" placeholder="ConfirmPassword" />
          </div>
          <button type="submit" name="submit_signup" class="submit-btn">Sign up</button>

        </div>
      </div>
    </form>

  </div>
  <div class="animation-area">
    <ul class="box-area">
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
    </ul>
  </div>

  <script src="js/script.js"></script>
</body>

</html>