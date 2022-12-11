<?php
require_once './cms/require.php';
require_once './cms/controllers/company.php';

require_once './cms/controllers/products.php';
require_once './cms/controllers/img.php';

$product = new Products;

$imgresize = new Image();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET["edit"])) {
        $productId = $id;
        var_dump($product->GetProductById($productId));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["updateProduct"]))
    {
        if($_FILES['file']['size'] == 0)
        {
            var_dump($_POST);
            $_GET["id"] = $id;
            $error = $product->UpdateProduct($_POST);
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
                $_POST['itemImage'] = "assets/img/product_".$_FILES['file']['name'];
                //$error = $_FILES['file']['name']. " already exists. ";
            }else{
                $imgresize->UploadImg($_FILES['file']['tmp_name'], 500, 650, "assets/img/product_".$_FILES['file']['name']);
                $_POST['itemImage'] = "assets/img/product_".$_FILES['file']['name'];
                $imgresize->UploadImg($_FILES['file']['tmp_name'], 300, 200, "assets/img/product_thumbnail_".$_FILES['file']['name']);
                //$_POST['itemImage'] = "assets/img/product_".$_FILES['file']['name'];
                $_GET["id"] = $id;
                $error = $product->UpdateProduct($_POST);
            }
        }
        }else{ 
            $error = "Invalid file";
        }   
        }
    }
}

Util::Header();
Util::Navbar();
?>

<div class="container">
    <div class="col-12 mt-3 mb-2">
        <?php if (isset($error)) : ?>
        <div class="alert alert-primary" role="alert">
            <?= $error; ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="heading-section">
        <h2>Product Details</h2>
    </div>
    <div class="row">
        <?php foreach ($product->GetProductById($id) as $row) : ?>
        <form method="POST" enctype="multipart/form-data" class="display-flex">
            <div class="col-md-6">
                <div class="item">
                    <img style="height:650px;max-width:500px;" src="/<?= $row->image; ?>" />
                    <div class="form-group">
                        <label for="image_uploads">Choose images to upload (PNG, JPG)</label>
                        <input type="file" id="file" name="file" accept=".jpg, .jpeg, .png"
                            multiple />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-dtl">
                    <div class="product-info">
                        <div class="product-name">
                            <input type="text" placeholder="Title"
                                class="form-control my-3 bg-dark text-white text-center" name="itemName"
                                value="<?= $row->title; ?>">
                        </div>
                        <div class="product-code">
                            <input type="text" placeholder="Title"
                                class="form-control my-3 bg-dark text-white text-center" name="itemCode"
                                value="<?= $row->code; ?>">
                        </div>
                        <label for="category">Category:</label>
                        <select id="filterId" name="filterId">
                            <option value="1">Meals</option>
                            <option value="2">Drinks</option>
                            <option value="3">Other</option>
                        </select>
                        <div class="reviews-counter">
                            <div class="rate">
                                <input type="radio" id="star5" name="rate" value="5" checked />
                                <label for="star5" title="text">5 stars</label>
                                <input type="radio" id="star4" name="rate" value="4" checked />
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" name="rate" value="3" checked />
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" name="rate" value="2" />
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" name="rate" value="1" />
                                <label for="star1" title="text">1 star</label>
                            </div>
                            <span>3 Reviews</span>
                        </div>
                        <div class="product-price-discount"><span><input type="number" placeholder="Price"
                                    class="form-control my-3 bg-dark text-white text-center" name="itemPrice"
                                    value="<?= $row->price; ?>"></span>
                            <!--<span class="line-through"></span>-->
                        </div>
                    </div>
                    <p><input type="text" placeholder="Description"
                            class="form-control my-3 bg-dark text-white text-center" name="itemDesc"
                            value="<?= $row->desc; ?>"></p>
                    <button class="btn btn-outline-primary btn-block" name="updateProduct" type="submit"
                        value="submit">Update
                    </button>
                    <div class="product-count">
                        <label for="size">Quantity</label>
                        <form action="#" class="display-flex">
                            <div class="qtyminus">-</div>
                            <input type="text" name="itemQuantity" value="<?= $row->quantity; ?>"
                                class="qty">
                            <div class="qtyplus">+</div>
                        </form>
                    </div>
                </div>
            </div>
        </form>
        <?php endforeach; ?>
    </div>
    <div class="product-info-tabs">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab"
                    aria-controls="description" aria-selected="true">Description</a>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                accusantium doloremque laudantium, totam rem aperiam.
            </div>

        </div>
    </div>
</div>
</div>

<?php Util::Footer(); ?>