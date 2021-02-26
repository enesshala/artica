<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Artica - Enes Shala</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body onload="onLoad()">
  <div id="loader"><img src="img/welcome.gif" alt="" /></div>

  <div id="all">
    <?php
    // Navbar
    include "inc/navbar.php";
    // Header
    include "inc/header.php";
    // Our Services --//-- Quotes
    include "inc/services.php";
    // Portfolio
    include "inc/portfolio.php";
    // About Us
    include "inc/about.php";
    // Carousel
    include "inc/carousel.php";
    // Awards
    include "inc/awards.php";
    // Blog
    include "inc/blog.php";
    // Costumer
    include "inc/costumer.php";
    // Testimonials
    include "inc/testimonials.php";
    // Contact Us
    include "inc/contact.php";
    // Footer
    include "inc/footer.php";
    ?>



    <script src="https://kit.fontawesome.com/2c7fc28a2f.js"></script>
    <script src="./js/script.js"></script>
</body>

</html>