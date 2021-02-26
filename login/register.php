<?php
require '../config/dbconfig.php';


$errors = [];
$registerSuccessMessage = "";
$username = "";
$email = "";
$password = "";
$cpassword = "";

if (isset($_POST['submit_registration'])) {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        $query = $connection->prepare('SELECT * FROM users WHERE username = :username OR email = :email');
        $query->bindValue(":username", $username);
        $query->bindValue(":email", $email);
        $query->execute();

        $user = $query->fetch();
        $userName = $user["username"] ?? null;
        $userEmail = $user["email"] ?? null;

        if (!$username || trim($username) === "") {
                $errors[] = "Username is required!";
        } else if (!$email || trim($username) === "") {
                $errors[] = "Email is required!";
        } else if (!$password || trim($username) === "") {
                $errors[] = "Password is required!";
        } else if (!$cpassword || trim($username) === "") {
                $errors[] = "Confirm password is required!";
        } else if ($password !== $cpassword) {
                $errors[] = "Confirm password should be the same!";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format";
        } else if ($userName === $username) {
                $errors[] = "Username already exists!";
        } else if ($userEmail === $email) {
                $errors[] = "Email already exists!";
        }

        if (empty($errors)) {
                $query = $connection->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
                $query->bindValue(":username", $username);
                $query->bindValue(":email", $email);
                $query->bindValue(":password", password_hash($password, PASSWORD_DEFAULT));

                $query->execute();
                $registerSuccessMessage = "You have been successfully registered. please <strong>sign in</strong> now!";

                $errors = [];
                $username = "";
                $email = "";
                $password = "";
                $cpassword = "";
        }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
        <title>Register</title>
</head>

<body>
        <?php foreach ($errors as $error) : ?>
                <div class="alert alert-danger" role="alert">
                        <h5><?php echo $error; ?></h5>
                </div>
        <?php endforeach; ?>

        <?php if (isset($_POST['submit_registration']) && empty($errors)) : ?>
                <div class="alert alert-success" role="alert">
                        <h5><?php echo $registerSuccessMessage ?></h5>
                </div>
        <?php endif; ?>
        <form class="box" method="post">
                <h1>Sign Up</h1>
                <input type="text" name="username" placeholder="Username">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <input type="password" name="cpassword" placeholder="Confirm Password">
                <input type="submit" name="submit_registration" value="Create">
                <p style="color: white;">Already have an account?</p><a href="login.php">Login here!</a>
        </form>
</body>

</html>