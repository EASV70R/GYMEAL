<?php
require_once '../cms/require.php';
require_once '../cms/controllers/company.php';

Util::IsAdmin();

require_once '../cms/controllers/profile.php';

$profile = new Profile;
$companyData = new Company;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["updateCompany"])) {
        $error = $companyData->UpdateCompanyData($_POST);
    }
}

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
                <a class="nav-link" href="<?= (SITE_URL); ?>/admin">Admin</a>
                <a class="nav-link" href="<?= (SITE_URL); ?>/admin/invoice">Customer Invoices</a>
                <a class="nav-link active" href="<?= (SITE_URL); ?>/admin/adminsettings">Settings</a>
                <a class="nav-link" href="<?= (SITE_URL); ?>/logout">Logout</a>
            </nav>
        </aside>
        <div class="col-lg-9 col-xl-9">
            <div class="card">
                <div class="card-body">
                <?php foreach ($companyData->GetCompanyArray() as $row) : ?>
                    <h4 class="card-title text-center">Update Company Info</h4>
                    <form method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control form-control" placeholder="Title"
                                name="title" value="<?= Util::Print($row->name);?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control" placeholder="Description"
                                name="desc" value="<?= Util::Print($row->desc);?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control" placeholder="Footer Description"
                                name="smalldesc" value="<?= Util::Print($row->smalldesc);?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control" placeholder="Address"
                                name="address" value="<?= Util::Print($row->street);?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control" placeholder="Phone"
                                name="phone" value="<?= Util::Print($row->phone);?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control" placeholder="Mail"
                                name="email" value="<?= Util::Print($row->email);?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control" placeholder="Image"
                                name="image" value="<?= Util::Print($row->image);?>" required>
                        </div>
                        <button class="btn btn-outline-primary btn-block" name="updateCompany" type="submit"
                            value="submit">Update
                        </button>
                    </form>
                    <?php endforeach; ?>
                </div>
            </div>
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