<?php
$num_items_in_cart = isset($_SESSION['cart_item']) ? count($_SESSION['cart_item']) : 0;
?>
<div id="spinner"
    class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" role="status"></div>
</div>

<div class="container-fluid fixed-top px-0">
    <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5">
        <a href="<?= (SITE_URL); ?>/home" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="fw-bold text-primary m-0">GYMEAL</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="<?= (SITE_URL); ?>/home" class="nav-item nav-link">Home</a>
                <a href="<?= (SITE_URL); ?>/products" class="nav-item nav-link">Products</a>
                <a href="<?= (SITE_URL); ?>/about" class="nav-item nav-link">About Us</a>
                <a href="<?= (SITE_URL); ?>/contactus" class="nav-item nav-link">Contact Us</a>
                <a href="<?= (SITE_URL); ?>/cart" class="nav-item nav-link"><small
                        class="fa fa-shopping-cart text-body"><?php if ($num_items_in_cart > 0) : ?><span>
                            <?php echo $num_items_in_cart ?></span>
                        <?php endif; ?>
                        </small></a>
                <div class="nav-item dropdown">
                    <!-- 
                        btn-sm-square bg-white rounded-circle ms-3
                    -->
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><small
                            class="fa fa-user text-body"></small></a>
                    <div class="dropdown-menu dropdown-menu-left">
                        <?php if (Session::Get('login')) : ?>
                        <p class="dropdown-item"><?= Util::Print(Session::Get('username'));?></p>
                        <?php if (Session::Get('admin')) : ?>
                        <a href="<?= (SITE_URL); ?>/admin" class="dropdown-item">Admin</a>
                        <?php else : ?>
                        <a href="<?= (SITE_URL); ?>/profile" class="dropdown-item">Profile</a>
                        <?php endif; ?>
                        <a href="<?= (SITE_URL); ?>/logout" class="dropdown-item">Logout</a>
                        <?php else : ?>
                        <a href="<?= (SITE_URL); ?>/login" class="dropdown-item">Login</a>
                        <a href="<?= (SITE_URL); ?>/register" class="dropdown-item">Register</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>