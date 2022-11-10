<?php
require_once '../cms/require.php';
require_once '../cms/controllers/company.php';

Util::IsAdmin();

require_once '../cms/controllers/blog.php';

$blog = new Blog;
$blogs = $blog->GetBlogArray();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["createPost"])) {
        $error = $blog->CreateBlogPost($_POST);
    }
}

Util::Header();
Util::Navbar();
?>

</br>
</br>
<main class="container mt-5">
    <div class="col-12 mt-3 mb-2">
        <?php if (isset($error)) : ?>
        <div class="alert alert-primary" role="alert">
            <?= Util::Print($error); ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="row justify-content-center">
        <aside class="col-lg-3 col-xl-3">
            <nav class="nav flex-lg-column nav-pills mb-4">
                <a class="nav-link" href="<?= (SITE_URL); ?>/admin/index">Admin</a>
                <a class="nav-link" href="<?= (SITE_URL); ?>/admin/invoice">Customer Invoices</a>
                <a class="nav-link" href="<?= (SITE_URL); ?>/admin/settings">Settings</a>
                <a class="nav-link active" href="<?= (SITE_URL); ?>/admin/blog">Blog</a>
                <a class="nav-link" href="<?= (SITE_URL); ?>/logout">Logout</a>
            </nav>
        </aside>
        <div class="col-lg-9 col-xl-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Create Post</h4>
                    <form method="POST">
                        <input type="text" placeholder="Blog Title" class="form-control my-3" name="title">
                        <textarea name="content" placeholder="Blog Content" class="form-control my-3" cols="30"
                            rows="10"></textarea>
                        <input type="text" placeholder="Blog Image" class="form-control my-3" name="image">
                        <button class="btn btn-outline-primary btn-block" name="createPost">Add Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php Util::Footer(); ?>