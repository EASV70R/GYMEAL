<?php
require_once './cms/require.php';
require_once './cms/controllers/company.php';

require_once './cms/controllers/products.php';

$product = new Products;


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET["product"])) {
        $productId = $_GET["id"];
        //var_dump($product->GetProductById($productId));
    }
}

Util::Header();
Util::Navbar();
?>
</br>
</br>
</br>
</br>
		<div class="container">
	        <div class="heading-section">
	            <h2>Product Details</h2>
	        </div>
	        <div class="row">
				<?php foreach ($product->GetProductById(Util::Print($_GET["id"])) as $row) : ?>
	        	<div class="col-md-6">
						<div class="item">
						  	<img src="<?= Util::Print($row->image); ?>" />
						</div>
					
	        	</div>
	        	<div class="col-md-6">
	        		<div class="product-dtl">
        				<div class="product-info">
		        			<div class="product-name"><?= Util::Print($row->title); ?></div>
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
		        			<div class="product-price-discount"><span>$<?= Util::Print($row->price); ?></span><!--<span class="line-through"></span>--></div>
		        		</div>
	        			<p><?= Util::Print($row->desc); ?></p>
	        			
	        			<div class="product-count">
	        				<label for="size">Quantity</label>
	        				<form action="#" class="display-flex">
							    <div class="qtyminus">-</div>
							    <input type="text" name="quantity" value="<?= Util::Print($row->quantity); ?>" class="qty">
							    <div class="qtyplus">+</div>
							</form>
							<a href="#" class="round-black-btn">Add to Cart</a>
	        			</div>
	        		</div>
	        	</div>
				<?php endforeach; ?>
	        </div>
	        <div class="product-info-tabs">
		        <ul class="nav nav-tabs" id="myTab" role="tablist">
				  	<li class="nav-item">
				    	<a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
				  	</li>
				  	
				</ul>
				<div class="tab-content" id="myTabContent">
				  	<div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
				  		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.
				  	</div>
				  	
				</div>
			</div>
		</div>
	</div>
	
<?php Util::Footer(); ?>