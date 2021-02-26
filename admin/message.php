<?php
require 'database/dbconfig.php';

include 'inc/header.php';
include 'inc/navbar.php';

$contact = $connection->query("SELECT * FROM contacts WHERE contact_id =  '" . $_GET['id'] . "'")->fetch(PDO::FETCH_ASSOC);
?>

<div class="card bg-gray-300 border-left-success col-8 mr-auto ml-auto mt-5 p-3">
    <h1 class="text-center">Message</h1>

    <p class="mb-0">Name</p>
    <h4 class="bg-light p-1 mb-3"><?php echo $contact['name']; ?></h4>
    <p class="mb-0">Email</p>
    <h4 class="bg-light p-1 mb-3"><?php echo $contact['email']; ?></h4>
    <p class="mb-0">Subject</p>
    <h4 class="bg-light p-1 mb-3"><?php echo $contact['subject']; ?></h4>
    <p class="mb-0">Message</p>
    <h4 class="bg-light p-1"><?php echo $contact['message']; ?></h4>


</div>

<?php
include 'inc/scripts.php';
include 'inc/footer.php';
?>