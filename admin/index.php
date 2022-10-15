<?php
require_once '../cms/require.php';
require_once '../cms/controllers/company.php';

Util::IsAdmin();

Util::Header();
Util::Navbar();

?>

</br>
</br>
<main class="container mt-5">
    <div class="row justify-content-center">
        <aside class="col-lg-3 col-xl-3">
            <nav class="nav flex-lg-column nav-pills mb-4">
                <a class="nav-link active" href="#">Admin</a>
                <a class="nav-link" href="<?= (SITE_URL); ?>/admin/invoice">Customer Invoices</a>
                <a class="nav-link" href="<?= (SITE_URL); ?>/admin/adminsettings">Settings</a>
                <a class="nav-link" href="<?= (SITE_URL); ?>/logout">Logout</a>
            </nav>
        </aside>
    </div>
</main>

<?php Util::Footer(); ?>