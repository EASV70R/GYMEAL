<?php
require_once './cms/controllers/company.php';

Util::IsLoggedIn();

Util::Header();
Util::Navbar();

?>

<main class="container mt-5">
    <div class="testcontainer">
        <div class="row justify-content-center">
            <aside class="col-lg-3 col-xl-3">
                <nav class="nav flex-lg-column nav-pills mb-4">
                    <a class="nav-link active" href="#">Account</a>
                    <a class="nav-link" href="<?= (SITE_URL); ?>/profilesettings">Settings</a>
                    <a class="nav-link" href="<?= (SITE_URL); ?>/logout">Logout</a>
                </nav>
            </aside>
            <div class="col-lg-9 col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Profile</h4>
                        <figcaption class="info">
                            <h6 class="title"><?= Util::Print(Session::Get('username'));?></h6>
                            <p>Email: <?= Util::Print(Session::Get('email'));?>
                                <a href="#" class="px-2"><i class="fa fa-pen"></i></a>
                            </p>
                        </figcaption>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php Util::Footer(); ?>