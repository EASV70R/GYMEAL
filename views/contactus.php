<?php
require_once './cms/controllers/company.php';
require_once './cms/controllers/mail.php';

$sendmail = new Mail();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["sendMail"])) {
        $url = "https://www.google.com/recaptcha/api/siteverify";
		$data = [
			'secret' => "6LcTbSwjAAAAAOQ9Fj6jkXfwxxbXfLboqHNhBwnv",
			'response' => $_POST['token'],
			// 'remoteip' => $_SERVER['REMOTE_ADDR']
		];
        $options = array(
		    'http' => array(
		      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		      'method'  => 'POST',
		      'content' => http_build_query($data)
		    )
		  );

		$context  = stream_context_create($options);
  		$response = file_get_contents($url, false, $context);

		$res = json_decode($response, true);
        if($res['success'] == true){
            $error = $sendmail->SendMail($_POST);
        }else{
            $error = "Please verify that you are not a robot.";
            print_r($res);
        }
       // $error = $sendmail->SendMail($_POST);
    }
}

$companyData = new Company;

Util::Header();
Util::Navbar();
?>
<script src="https://www.google.com/recaptcha/api.js?render=6LcTbSwjAAAAAJXudVwwKCWV2rmGkSCFegN7wcOH"></script>
<main class="testcontainer">
    <div class="container-xxl">
        <div class="col-12 mt-3 mb-2">
            <?php if (isset($error)) : ?>
            <div class="alert alert-primary" role="alert">
                <?= $error; ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s"
                style="max-width: 500px;">
                <h1 class="display-5 mb-3">Contact Us</h1>
                <p>Get in contact with us.</p>
            </div>
            <div class="row g-5 justify-content-center">
                <?php foreach ($companyData->GetCompanyArray() as $row) : ?>
                <div class="col-lg-5 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-primary text-white d-flex flex-column justify-content-center h-100 p-5">
                        <h5 class="text-white">Call Us</h5>
                        <p class="mb-5"><i class="fa fa-phone-alt me-3"></i><?= $row->phone; ?></p>
                        <h5 class="text-white">Email Us</h5>
                        <p class="mb-5"><i class="fa fa-envelope me-3"></i><?= $row->email; ?></p>
                        <h5 class="text-white">Office Address</h5>
                        <p class="mb-5"><i class="fa fa-map-marker-alt me-3"></i><?= $row->street; ?></p>
                        <h5 class="text-white">Follow Us</h5>
                        <div class="d-flex pt-2">
                            <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i
                                    class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
                <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <form method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" placeholder="Your Name">
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" placeholder="Your Email">
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject">
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" name="message"
                                        style="height: 200px"></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary rounded-pill py-3 px-5" name="sendMail"
                                    type="submit">Send
                                    Message</button>
                            </div>
                            <input type="hidden" id="token" name="token">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="container-xxl px-0 wow fadeIn" data-wow-delay="0.1s" style="margin-bottom: -6px;">
        <iframe class="w-100" style="height: 450px;"
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9042.254949458598!2d8.4469108!3d55.4877012!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf131cc5b28fe1f27!2sErhvervsakademi%20SydVest!5e0!3m2!1sda!2sdk!4v1666192277427!5m2!1sda!2sdk"
            frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
</main>

<?php Util::Footer(); ?>

<script>
function onClick(e) {
    e.preventDefault();
    grecaptcha.ready(function() {
        grecaptcha.execute('6LcTbSwjAAAAAJXudVwwKCWV2rmGkSCFegN7wcOH', {
            action: 'homepage'
        }).then(function(token) {
            document.getElementById('token').value = token;
        });
    });
}
</script>