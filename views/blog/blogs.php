<?php
require_once './cms/require.php';
require_once './cms/controllers/company.php';

require_once './cms/controllers/blog.php';

$blog = new Blog;
$blogs = $blog->GetBlogArray();
Util::Header();
Util::Navbar();
?>
<div class="container-xxl py-6">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s"
            style="max-width: 500px;">
            <h1 class="display-5 mb-3">Latest Blog</h1>
            <p>Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
        </div>
        <div class="row g-4">
            <?php foreach ($blogs as $row) : ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <img class="img-fluid" src="//via.placeholder.com/500x400/e66?text=1" alt="">
                <div class="bg-light p-4">
                    <a class="d-block h5 lh-base mb-4" href=""><?= $row->title; ?></a>
                    <div class="text-muted border-top pt-4">
                        <small class="me-3"><i class="fa fa-user text-primary me-2"></i><?= $row->content; ?></small>
                        <small class="me-3"><i class="fa fa-calendar text-primary me-2"></i><?= $row->createdAt; ?></small>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php Util::Footer(); ?>