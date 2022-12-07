<?php
require_once './cms/require.php';
require_once './cms/controllers/company.php';

Util::IsAdmin();

require_once './cms/controllers/profile.php';
require_once './cms/controllers/img.php';
$imgresize = new Image();

$profile = new Profile;
$companyData = new Company;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["updateCompany"]))
    {
        if($_FILES['file']['size'] == 0)
        {
            $error = $companyData->UpdateCompanyData($_POST);
        }
        else
        {
            if ((($_FILES['file']['type']=="image/gif") ||
        ($_FILES['file']['type']=="image/jpeg") ||
        ($_FILES['file']['type']=="image/png") ||
        ($_FILES['file']['type']=="image/pjpeg"))&&
        ($_FILES['file']['size']<10000000))
        {
        if($_FILES['file']['error']>0)
        {
            $error = "Return Code: " . $_FILES['file']['error'];
        }else{
            /*echo "Uploaded: ". $_FILES['file']['name']. "<br>";
            echo "Type: ". $_FILES['file']['type']. "<br>";
            echo "Size: ". $_FILES['file']['size']. "<br>";
            echo "Temp file: ".$_FILES['file']['tmp_name']. "<br>";
            echo "Uploaded: ". $_FILES['file']['name']. "<br>";*/
            if (file_exists("assets/img/".$_FILES['file']['name'])){
                $error = $_FILES['file']['name']. " already exists. ";
            }else{
                $imgresize->ResizeImage($_FILES['file']['tmp_name'], 100, 100, "assets/img/".$_FILES['file']['name']);
                $_POST['image'] = "assets/img/".$_FILES['file']['name'];
                $error = $companyData->UpdateCompanyData($_POST);
            }
        }
        }else{ 
            $error = "Invalid file";
        }   
        }
    }
    else if (isset($_POST["updatePassword"])) {
        $error = $profile->UpdatePassword($_POST);
    }
}

Util::Header();
Util::Navbar();
?>

<main class="container mt-5">
    <div class="testcontainer">
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
                    <a class="nav-link" href="<?= (SITE_URL); ?>/editinvoice">Customer Invoices</a>
                    <a class="nav-link active" href="<?= (SITE_URL); ?>/admsettings">Settings</a>
                    <a class="nav-link" href="<?= (SITE_URL); ?>/editproductlist">Products</a>
                    <a class="nav-link" href="<?= (SITE_URL); ?>/logout">Logout</a>
                </nav>
            </aside>
            <div class="col-lg-9 col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <?php foreach ($companyData->GetCompanyArray() as $row) : ?>
                        <h4 class="card-title text-center">Update Company Info</h4>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" class="form-control form-control" placeholder="Title" name="title"
                                    value="<?= Util::Print($row->name);?>" required>
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
                                <input type="text" class="form-control form-control" placeholder="Phone" name="phone"
                                    value="<?= Util::Print($row->phone);?>" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control" placeholder="Mail" name="email"
                                    value="<?= Util::Print($row->email);?>" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control" placeholder="Image" name="image"
                                    value="<?= Util::Print($row->image);?>" required>
                            </div>
                            <div class="form-group">
                                <label for="image_uploads">Choose images to upload (PNG, JPG)</label>
                                <input type="file" id="file" name="file" onchange="preview()" accept=".jpg, .jpeg, .png"
                                    multiple />
                            </div>
                            <img id="frame" src="<?= Util::Print($row->image);?>" class="img-fluid h-25 w-25" />
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
                                <input type="password" class="form-control form-control-sm"
                                    placeholder="Current Password" name="currentPassword" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-sm" placeholder="New Password"
                                    name="newPassword" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-sm"
                                    placeholder="Confirm password" name="confirmPassword" required>
                            </div>
                            <button class="btn btn-outline-primary btn-block" name="updatePassword" type="submit"
                                value="submit">Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php Util::Footer(); ?>

<script>
function preview() {
    frame.src = URL.createObjectURL(event.target.files[0]);
}

function clearImage() {
    document.getElementById('formFile').value = null;
    frame.src = "";
}
</script>