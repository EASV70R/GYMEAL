<?php
require_once './cms/controllers/company.php';

$companyData = new Company;

Util::Header();
Util::Navbar();
?>

<section class="fronthead">
    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="<?= (SITE_URL); ?>/assets/img/s-well-CJdZ800-Fbs-unsplash.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-lg-7">
                                    <h1 class="display-2 mb-5 animated slideInDown">Quality protein meal for you,
                                        after heavy training</h1>
                                    <a href="" class="btn btn-primary rounded-pill py-sm-3 px-sm-5">Products</a>
                                    <a href="" class="btn btn-secondary rounded-pill py-sm-3 px-sm-5 ms-3">Services</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="<?= (SITE_URL); ?>/assets/img/ella-olsson-P4jRJYN33wE-unsplash.jpg"
                        alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-lg-7">
                                    <h1 class="display-2 mb-5 animated slideInDown">Quick meal to go after training</h1>
                                    <a href="" class="btn btn-primary rounded-pill py-sm-3 px-sm-5">Products</a>
                                    <a href="" class="btn btn-secondary rounded-pill py-sm-3 px-sm-5 ms-3">Services</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>

<div class="container-fluid bg-light bg-icon my-5 py-6">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s"
            style="max-width: 500px;">
            <h1 class="display-5 mb-3">Latest meals</h1>
            <p>Look for you next tasty meal!</p>
        </div>
        <div class="text-center my-3">
            <div class="products">
                <div class="row mx-auto my-auto justify-content-center">
                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="img-wrapper"><img src="<?= (SITE_URL); ?>/assets/img/s-well-CJdZ800-Fbs-unsplash.jpg"
                                                class="img-wrapper" alt="..."> </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Card title 1</h5>
                                            <p class="card-text">Some quick example text to build on the card title and
                                                make
                                                up
                                                the bulk of the
                                                card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="img-wrapper"><img src="<?= (SITE_URL); ?>/assets/img/ella-olsson-P4jRJYN33wE-unsplash.jpg"
                                                class="img-wrapper" alt="..."> </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Card title 1</h5>
                                            <p class="card-text">Some quick example text to build on the card title and
                                                make
                                                up
                                                the bulk of the
                                                card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="img-wrapper"><img src="//via.placeholder.com/500x400/e66?text=1"
                                                class="img-wrapper" alt="..."> </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Card title 1</h5>
                                            <p class="card-text">Some quick example text to build on the card title and
                                                make
                                                up
                                                the bulk of the
                                                card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="img-wrapper"><img src="//via.placeholder.com/500x400/e66?text=1"
                                                class="img-wrapper" alt="..."> </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Card title 1</h5>
                                            <p class="card-text">Some quick example text to build on the card title and
                                                make
                                                up
                                                the bulk of the
                                                card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="img-wrapper"><img src="//via.placeholder.com/500x400/e66?text=1"
                                                class="img-wrapper" alt="..."> </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Card title 1</h5>
                                            <p class="card-text">Some quick example text to build on the card title and
                                                make
                                                up
                                                the bulk of the
                                                card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="img-wrapper"><img src="//via.placeholder.com/500x400/e66?text=1"
                                                class="img-wrapper" alt="..."> </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Card title 1</h5>
                                            <p class="card-text">Some quick example text to build on the card title and
                                                make
                                                up
                                                the bulk of the
                                                card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev bg-transparent w-aut" href="#productCarousel" role="button"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </a>
                        <a class="carousel-control-next bg-transparent w-aut" href="#productCarousel" role="button"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <?php foreach ($companyData->GetCompanyArray() as $row) : ?>
            <div class="col-lg-6">
                <div class="about-img position-relative overflow-hidden p-5 pe-0">
                    <img class="img-fluid w-100" src="<?= (SITE_URL); ?>/assets/img/<?= Util::Print($row->image); ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 mb-4"><?= Util::Print($row->title); ?></h1>
                <p class="mb-4"><?= Util::Print($row->desc); ?></p>
                <p><i class="fa fa-check text-primary me-3"></i>Tempor erat elitr rebum at clita
                </p>
                <p><i class="fa fa-check text-primary me-3"></i>Aliqu diam amet diam et eos</p>
                <p><i class="fa fa-check text-primary me-3"></i>Clita duo justo magna dolore
                    erat amet</p>
                <a class="btn btn-primary rounded-pill py-3 px-5 mt-3" href="">Read More</a>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<?php Util::Footer(); ?>