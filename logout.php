<?php

include './cms/require.php';

session_unset();
$_SESSION = array();
session_destroy();

Util::Redirect('/login.php');