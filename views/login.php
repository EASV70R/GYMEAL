<?php
require_once './cms/controllers/company.php';

Util::IsLoggedIn();

require_once './cms/controllers/auth.php';

Util::Header();
Util::Navbar();
?>

<main class="container mt-2">
    <div class="customform">
        <div class="row justify-content-center">
            <div class="col-12 mt-3 mb-2">
                <?php if (isset($response)) : ?>
                <div class="alert alert-primary" role="alert">
                    <?= Util::Print($response); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-5 col-sm-7 col-xs-12 my-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Login</h4>
                        <form method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" placeholder="Username"
                                    name="username" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-sm" placeholder="Password"
                                    name="password" required>
                            </div>
                            <button class="btn btn-outline-primary btn-block" name="login" id="submit" type="submit"
                                value="submit">
                                Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php Util::Footer(); ?>