<?php
require_once './cms/controllers/company.php';

$companyData = new Company;

Util::Header();
Util::Navbar();
?>
<main class="testcontainer">
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <?php foreach ($companyData->GetCompanyArray() as $row) : ?>
                <div class="col-lg-6">
                    <div class="about-img position-relative overflow-hidden p-5 pe-0">
                        <img class="img-fluid w-100" src="<?= Util::Print($row->image); ?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 mb-4"><?= Util::Print($row->name); ?></h1>
                    <p class="mb-4"><?= Util::Print($row->desc); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>
<?php Util::Footer(); ?>