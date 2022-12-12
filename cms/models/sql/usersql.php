<?php
defined('BASE_PATH') or exit('No direct script access allowed');

define('USER', 'SELECT * FROM `user`');
define('EDITUSER', 'UPDATE `user` SET `username` = :username, `password` = :password, `email` = :email WHERE `uid` = :uid');
define('EDITUSER2', 'UPDATE `user` SET `username` = :username, `email` = :email WHERE `uid` = :uid');
define('DELETEUSER', 'DELETE FROM `user` WHERE `uid` = :uid');
define('USERBYID', 'SELECT * FROM `user` WHERE `uid` = ? LIMIT 1');
define('USERBYUSERNAME', 'SELECT * FROM `user` WHERE `username` = ? LIMIT 1');
define('USERBYEMAIL', 'SELECT * FROM `user` WHERE `email` = ? LIMIT 1');
define('ROLEBYUID', 'SELECT roleid FROM `userrole` WHERE `uid` = ?');
define('ADMINCHECK', 'SELECT * FROM `userrole` WHERE `uid` = ? AND `roleid` = 1');
define('REGISTER', 'INSERT INTO `user` (`username`, `password`, `email`) VALUES (?, ?, ?)');
define('CREATEROLE', 'INSERT INTO `userrole` (`uid`, `roleid`) VALUES (?, ?)');
define('UPDATEPASSWORD', 'UPDATE `user` SET `password` = ? WHERE `username` = ?');