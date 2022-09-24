<?php
include './cms/require.php';
include './cms/controllers/auth.php';

Util::IsLoggedIn();
(new Auth())->Logout();
Util::Redirect('/login.php');