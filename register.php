<?php
include './cms/require.php';
include './cms/controllers/auth.php';

Util::IsLoggedIn();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $response = (new Auth())->Register($_POST);
}

Util::Header();
Util::Navbar();

?>

<main class="container mt-2">
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
                    <h4 class="card-title text-center">Register</h4>
                    <form method="POST" action="<?= Util::Print($_SERVER['PHP_SELF']); ?>">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-sm" placeholder="First Name"
                                name="firstName" minlength="3" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-sm" placeholder="Last Name"
                                name="lastName" minlength="3" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-sm" placeholder="Username"
                                name="username" minlength="3" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-sm" placeholder="Password"
                                name="password" minlength="4" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-sm" placeholder="Confirm password"
                                name="confirmPassword" minlength="4" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-sm" placeholder="email" name="email"
                                required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-sm" placeholder="Phone number"
                                name="phone" minlength="12" value="+45" required>
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
</main>

<?php Util::Footer(); ?>