<?php
require_once './cms/require.php';
require_once './cms/controllers/company.php';

Util::IsAdmin();

require_once './cms/controllers/products.php';
require_once './cms/controllers/img.php';

$product = new products;
$products = $product->GetProductArray();

$imgresize = new Image();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["cuItem"])) {
        if($_FILES['file']['size'] == 0)
        {
            //var_dump($_POST);
            $_POST['itemImage'] = $_POST['itemImage'];
            $error = $product->CreateProduct($_POST);
            Util::Redirect('/editproductlist');
        }
        else
        {
            if ((($_FILES['file']['type']=="image/gif") ||
        ($_FILES['file']['type']=="image/jpeg") ||
        ($_FILES['file']['type']=="image/png") ||
        ($_FILES['file']['type']=="image/pjpeg"))&&
        ($_FILES['file']['size']<2000000))
        {
        if($_FILES['file']['error']>0)
        {
            $error = "Return Code: " . $_FILES['file']['error'];
        }else{
            if (file_exists("assets/img/".$_FILES['file']['name'])){
                $_POST['itemImage'] = "assets/img/product_".$_FILES['file']['name'];
            }else{
                $imgresize->UploadImg($_FILES['file']['tmp_name'], 500, 650, "assets/img/product_".$_FILES['file']['name']);
                $_POST['itemImage'] = "/assets/img/product_".$_FILES['file']['name'];
                $imgresize->UploadImg($_FILES['file']['tmp_name'], 300, 200, "assets/img/product_thumbnail_".$_FILES['file']['name']);
                
                $error = $product->CreateProduct($_POST);
                Util::Redirect('/editproductlist');
            }
        }
        }else{ 
            $error = "Invalid file";
        }   
        }
    }
}

// invoice.php?cancel=&invoiceId=4&userId=2
Util::Header();
Util::Navbar();
?>

<main class="container mt-5">
    <div class="testcontainer">
        <div class="row justify-content-center">
            <div class="col-12 mt-3 mb-2">
                <?php if (isset($error)) : ?>
                <div class="alert alert-primary" role="alert">
                    <?= $error; ?>
                </div>
                <?php endif; ?>
            </div>
            <aside class="col-lg-3 col-xl-3">
                <nav class="nav flex-lg-column nav-pills mb-4">
                    <a class="nav-link" href="<?= (SITE_URL); ?>/admin">Admin</a>
                    <a class="nav-link" href="<?= (SITE_URL); ?>/editinvoice">Customer Invoices</a>
                    <a class="nav-link" href="<?= (SITE_URL); ?>/admsettings">Settings</a>
                    <a class="nav-link active" href="<?= (SITE_URL); ?>/editproductlist">Products</a>
                    <a class="nav-link" href="<?= (SITE_URL); ?>/logout">Logout</a>
                </nav>
            </aside>
            <div class="col-lg-9 col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center">Create Product</h4>
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm" placeholder="Item Name"
                                            name="itemName" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="itemCode" class="form-control form-control-sm"
                                            placeholder="Item Code" name="itemCode" required>
                                    </div>
                                    <div class="form-group">
                                        <textarea type="itemDesc" class="form-control form-control-sm"
                                            placeholder="Item Description" name="itemDesc" required rows="4"
                                            cols="50"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control form-control-sm" placeholder="Quantity"
                                            name="itemQuantity" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control form-control-sm" placeholder="Price"
                                            name="itemPrice" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control form-control-sm" placeholder="Filter"
                                            name="filterId" min="1" max="3" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm" placeholder="Item Image"
                                            name="itemImage">
                                    </div>
                                    <div class="form-group">
                                        <label for="image_uploads">Choose images to upload (PNG, JPG)</label>
                                        <input type="file" id="file" name="file" accept=".jpg, .jpeg, .png" multiple />
                                    </div>
                                    <button class="btn btn-outline-primary btn-block" name="cuItem" type="submit"
                                        value="submit">Create
                                    </button>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <h4 class="card-title text-center">Products</h4>
                        <?php foreach ($products as $row) : ?>
                        <article class="card border-primary mb-4">
                            <div class="card-body">
                                <header class="d-lg-flex">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0"><?= $row->title ?><i class="dot"></i>
                                            <?php if ($row->quantity == 0) : ?>
                                            <span
                                                class="text-danger"><?= $product->GetProductStatus($row->productId)->quantity; ?></span>
                                            <?php else : ?>
                                            <span
                                                class="text-success"><?= $product->GetProductStatus($row->productId)->quantity; ?></span>
                                            <?php endif; ?>
                                        </h6>

                                    </div>
                                    <div>
                                        <a href="<?= (SITE_URL); ?>/editproduct/edit/<?= $row->productId; ?>"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <a href="<?= (SITE_URL); ?>/editproductlist/delete/<?= $row->productId; ?>"
                                            class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                </header>
                                <hr>
                                <ul class="row">
                                    <li class="col-xl-4  col-lg-6">
                                        <figure class="itemside mb-3">
                                            <div class="aside">
                                                <img width="72" height="72" src="<?= $row->image; ?>" alt="test"
                                                    class="img-sm rounded border">
                                            </div>
                                            <figcaption class="info">
                                                <p class="title"><?= substr($row->desc, 0, 35); ?>...</p>
                                                <strong> $<?= $row->price; ?> </strong>
                                            </figcaption>
                                        </figure>
                                    </li>
                                </ul>
                            </div>
                        </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php Util::Footer(); ?>