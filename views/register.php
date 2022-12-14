<?php
require_once './cms/controllers/company.php';

Util::IsLoggedIn();

require_once './cms/controllers/auth.php';

Util::Header();
Util::Navbar();
?>

<main class="container mt-2">
    <div class="testcontainer">
        <div class="row justify-content-center">
            <div class="col-12 mt-3 mb-2">
                <?php if (isset($response)) : ?>
                <div class="alert alert-primary" role="alert">
                    <?= $response; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-5 col-sm-7 col-xs-12 my-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Register</h4>
                        <form method="POST" action="<?= Util::SafePrint($_SERVER['REQUEST_URI']); ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" placeholder="Username"
                                    name="username" minlength="3" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-sm" placeholder="Password"
                                    name="password" minlength="4" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-sm"
                                    placeholder="Confirm password" name="confirmPassword" minlength="4" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" placeholder="email" name="email"
                                    required>
                            </div>
                            <button class="btn btn-outline-primary btn-block" name="register" id="submit" type="submit"
                                value="submit">
                                Register
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php Util::Footer(); ?>