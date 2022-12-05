<?php
Util::IsLoggedIn();

require_once './cms/controllers/auth.php';

(new Auth())->Logout();
Util::Redirect('/login');