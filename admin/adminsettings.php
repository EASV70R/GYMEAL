<?php
require_once '../cms/require.php';

Util::IsAdmin();

require_once '../cms/controllers/profile.php';

$profile = new Profile;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["updatePassword"])) {
        $error = $profile->UpdatePassword($_POST);
    }
}

Util::Header();
Util::Navbar();
?>

</br>
</br>
<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 mt-3 mb-2">
            <?php if (isset($error)) : ?>
            <div class="alert alert-primary" role="alert">
                <?= Util::Print($error); ?>
            </div>
            <?php endif; ?>
        </div>
        <aside class="col-lg-3 col-xl-3">
        <nav class="nav flex-lg-column nav-pills mb-4">
                <a class="nav-link" href="<?= (BASE_PATH); ?>admin/index.php">Admin</a>
                <a class="nav-link" href="<?= (BASE_PATH); ?>admin/invoice.php">Customer Invoices</a>
                <a class="nav-link active" href="<?= (BASE_PATH); ?>admin/adminsettings.php">Settings</a>
                <a class="nav-link" href="<?= (BASE_PATH); ?>logout.php">Logout</a>
            </nav>
        </aside>
        <div class="col-lg-9  col-xl-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Update Password</h4>
                    <form method="POST">
                        <div class="form-group">
                            <input type="password" class="form-control form-control-sm" placeholder="Current Password"
                                name="currentPassword" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-sm" placeholder="New Password"
                                name="newPassword" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-sm" placeholder="Confirm password"
                                name="confirmPassword" required>
                        </div>
                        <button class="btn btn-outline-primary btn-block" name="updatePassword" type="submit"
                            value="submit">Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php Util::Footer(); ?>