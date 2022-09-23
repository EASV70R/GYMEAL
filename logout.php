<?php

include './cms/require.php';

session_unset();
$_SESSION = array();
session_destroy();

header("location: ${BASE_PATH}login.php");
exit;