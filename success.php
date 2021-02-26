<?php
require_once 'config/dbconfig.php';

if (isset($_POST["submit_contact"])) {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $gender = $_POST["gender"] ?? null;
  if (!empty($_POST["sport"])) {
    $sports = implode(", ", ($_POST["sport"]));
  } else {
    $sports = null;
  }
  $issues = $_POST["issues"] ?? null;
  $subject = $_POST["subject"];
  $message = $_POST["message"];

  $errCounter = 0;
  if (
    trim($name) === "" || trim($email) === "" ||
    trim($phone) === "" || trim($gender) === "" ||
    trim($sports) === "" || trim($issues) === "" ||
    trim($subject) === "" || trim($subject) === "" ||
    trim($message) === ""
  )
    $errCounter++;
  else if (hasNumbers($name) || strlen($name) < 3) $errCounter++;
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errCounter++;
  else if (!phoneNumberRegex($phone)) $errCounter++;

  if ($errCounter === 0) {
    $query = $connection->prepare("INSERT INTO contacts (name, phone, email, subject, gender, sports, 	problem_type, message) VALUES (:c_name, :c_phone, :c_email, :c_subject,  :c_gender, :c_sports, :c_problemType,:c_message) ");
    $query->bindValue(":c_name", $name);
    $query->bindValue(":c_phone", $phone);
    $query->bindValue(":c_email", $email);
    $query->bindValue(":c_subject", $subject);
    $query->bindValue(":c_gender", $gender);
    $query->bindValue(":c_sports", $sports);
    $query->bindValue(":c_problemType", $issues);
    $query->bindValue(":c_message", $message);



    $query->execute();

    header("Location: index.php");
  }
}

function phoneNumberRegex($phone)
{
  return preg_match("/^(\d{2}\-)?\d{3}\-\d{3}$/", $phone);
}


function hasNumbers($str)
{
  return preg_match('~[0-9]+~', $str);
}
?>

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Submitted</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      height: 100vh;
      background: #7f90a5;
    }

    h1 {
      color: #222c40;
      text-align: center;
    }

    a {
      display: block;
      width: 150px;
      margin: 0 auto;
      padding: 20px;
      text-align: center;
      color: #222;
      text-decoration: none;
      border: 1px solid #222;
      transition: all 0.2s ease-in-out;
    }

    a:hover {
      background-color: #222;
      color: #fff;
    }
  </style>
</head>

<body>
  <h1>Your form was submitted successfully!</h1>
  <div>
    <a href="index.php">GO HOME</a>
  </div>
</body>

</html>