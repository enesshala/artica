<?php
require 'database/dbconfig.php';
include 'inc/header.php';
include 'inc/navbar.php';

$contacts = $connection->query("SELECT * FROM contacts")->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['delete_id'])) {


    $contact_id = $_POST['delete_id'] ?? null;


    if (!$contact_id) {
        header('Location: contacts.php');
        exit;
    }

    $statement = $connection->prepare('DELETE FROM contacts WHERE contact_id = :id');
    $statement->bindValue(':id', $contact_id);
    $statement->execute();

    header('Location: contacts.php');
}

?>


<div>
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users Table
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                        Add User Profile
                    </button>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive col-12">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th> ID </th>
                                <th> Username </th>
                                <th>TEL </th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>GENDER </th>
                                <th>SPORTS </th>
                                <th>PROBLEM TYPE </th>
                                <th>MESSAGE </th>
                                <th>DELETE </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th> ID </th>
                                <th>Username </th>
                                <th>TEL </th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>GENDER </th>
                                <th>SPORTS </th>
                                <th>PROBLEM TYPE </th>
                                <th>MESSAGE </th>
                                <th>DELETE </th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($contacts as $i => $contact) : ?>
                                <tr>
                                    <td><?php echo $i + 1 ?></td>
                                    <td><?php echo $contact['name']; ?></td>
                                    <td><?php echo $contact['phone']; ?></td>
                                    <td><?php echo $contact['email']; ?></td>
                                    <td><?php echo $contact['subject']; ?></td>
                                    <td><?php echo $contact['gender']; ?></td>
                                    <td><?php echo $contact['sports']; ?></td>
                                    <td><?php echo $contact['problem_type']; ?></td>
                                    <td><?php echo $contact['message']; ?></td>
                                    <td class="text-center">
                                        <form method="POST">
                                            <input type="hidden" name="delete_id" value="<?php echo $contact['contact_id']; ?>">
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
    <!-- /.container-fluid -->
</div>

<?php
include 'inc/scripts.php';
include 'inc/footer.php';
?>