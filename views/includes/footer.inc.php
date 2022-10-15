<?php
$companyData = new Company;
?>

<div class="container-fluid bg-dark footer mt-5 pt-5">
    <div class="container py-5">
        <div class="row g-5">
            <?php foreach ($companyData->GetCompanyArray() as $row) : ?>
            <div class="col-lg-3 col-md-6">
                <h1 class="fw-bold text-primary mb-4">F<span class="text-secondary">I</span>T</h1>
                <p><?= Util::Print($row->footerDesc); ?></p>
                <div class="d-flex pt-2">
                    <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i
                            class="fab fa-twitter"></i></a>
                    <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i
                            class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i
                            class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">Address</h4>
                <p><i class="fa fa-map-marker-alt me-3"></i><?= Util::Print($row->address); ?></p>
                <p><i class="fa fa-phone-alt me-3"></i><?= Util::Print($row->phone); ?></p>
                <p><i class="fa fa-envelope me-3"></i><?= Util::Print($row->mail); ?></p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">Quick Links</h4>
                <a class="btn btn-link" href="">About Us</a>
                <a class="btn btn-link" href="">Contact Us</a>
            </div>
            <?php endforeach ?>
        </div>
    </div>
    <div class="container-fluid copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a href="#"><?= (SITE_NAME); ?></a>, All Right Reserved.
                </div>
            </div>
        </div>
    </div>
</div>

<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= (SITE_URL); ?>/vendor/lib/wow/wow.min.js"></script>
<script src="<?= (SITE_URL); ?>/vendor/lib/easing/easing.min.js"></script>
<script src="<?= (SITE_URL); ?>/vendor/lib/waypoints/waypoints.min.js"></script>
<script src="<?= (SITE_URL); ?>/vendor/lib/owlcarousel/owl.carousel.min.js"></script>

<script src="<?= (SITE_URL); ?>/assets/js/main.js"></script>
</body>

</html>