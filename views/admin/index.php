<?php
require_once './cms/require.php';
require_once './cms/controllers/company.php';

Util::IsAdmin();

require_once './cms/controllers/auth.php';

Util::Header();
Util::Navbar();

?>

<main class="container mt-5">
    <div class="testcontainer">
        <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Edit User Data </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <input type="hidden" name="uid" id="uid">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Username" name="mUsername"
                                    id="mUsername" minlength="3" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" name="mPassword"
                                    id="mPassword" minlength="4">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="email" name="mEmail" id="mEmail"
                                    required>
                            </div>
                            <div class="form-group">
                                <select class="form-select" aria-label="Default select example" name="mRole">
                                    <option selected>Role Selection</option>
                                    <option value="0">Customer</option>
                                    <option value="1">Admin</option>
                                </select>
                                <!-- <input type="text" class="form-control" placeholder="role" name="mRole" id="mRole" required> -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary btn-block" name="edit" id="edit" type="edit"
                                    value="edit">
                                    Edit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Delete User Data </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <input type="hidden" name="uid" id="deleteid">

                            <h4>Are you sure about this?</h4>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <button class="btn btn-primary btn-block" name="delete" id="delete" type="delete"
                                    value="delete">
                                    Yes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 mt-3 mb-2">
                <?php if (isset($response)) : ?>
                <div class="alert alert-primary" role="alert">
                    <?= $response; ?>
                </div>
                <?php endif; ?>
            </div>
            <aside class="col-lg-3 col-xl-3">
                <nav class="nav flex-lg-column nav-pills mb-4">
                    <a class="nav-link active" href="<?= (SITE_URL); ?>/admin">Admin</a>
                    <a class="nav-link" href="<?= (SITE_URL); ?>/editinvoice">Customer Invoices</a>
                    <a class="nav-link" href="<?= (SITE_URL); ?>/admsettings">Settings</a>
                    <a class="nav-link" href="<?= (SITE_URL); ?>/editproductlist">Products</a>
                    <a class="nav-link" href="<?= (SITE_URL); ?>/logout">Logout</a>
                </nav>
            </aside>
            <div class="col-lg-9 col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Create User</h4>
                        <form method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" placeholder="Username"
                                    name="username" minlength="3" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-sm" placeholder="Password"
                                    name="password" minlength="4" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-sm"
                                    placeholder="Confirm password" name="confirmPassword" minlength="4" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" placeholder="email" name="email"
                                    required>
                            </div>
                            <button class="btn btn-outline-primary btn-block" name="register" id="submit" type="submit"
                                value="submit">
                                Create
                            </button>
                        </form>
                    </div>
                </div>
                <hr>
                <h4 class="card-title text-center">Users</h4>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($auth->GetAllUsers() as $row) : ?>
                        <tr>
                            <td scope="row"><?= $row->uid; ?></td>
                            <td><?= $row->username; ?></td>
                            <td><?= $row->email; ?></td>
                            <td><?= $auth->GetRole($row->uid); ?></td>
                            <td>
                                <button class="btn btn-primary editbtn" data-id="1" data-toggle="modal">Edit</button>
                                <button class="btn btn-danger deletebtn" data-id="2" data-toggle="modal">Delete</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php Util::Footer(); ?>

<script>
$(document).ready(function() {

    $('.editbtn').on('click', function() {

        $('#editmodal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#uid').val(data[0]);
        $('#mUsername').val(data[1]);
        $('#mEmail').val(data[2]);
        $('#mRole').val(data[3]);
    });
});

$(document).ready(function() {

    $('.deletebtn').on('click', function() {

        $('#deletemodal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#deleteid').val(data[0]);
    });
});
</script>