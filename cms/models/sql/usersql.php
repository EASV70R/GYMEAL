<?php
defined('BASE_PATH') or exit('No direct script access allowed');

define('getuser', 'SELECT * FROM `user`');
define('edituser', 'UPDATE `user` SET `username` = :username, `password` = :password, `email` = :email WHERE `uid` = :uid');
define('edituser2', 'UPDATE `user` SET `username` = :username, `email` = :email WHERE `uid` = :uid');
define('deleteuser', 'DELETE FROM `user` WHERE `uid` = :uid');
define('getuserbyid', 'SELECT * FROM `user` WHERE `uid` = ? LIMIT 1');
define('getuserbyusername', 'SELECT * FROM `user` WHERE `username` = ? LIMIT 1');
define('getuserbyemail', 'SELECT * FROM `user` WHERE `email` = ? LIMIT 1');
define('getrolebyuid', 'SELECT roleid FROM `userrole` WHERE `uid` = ?');
define('additionaladminchecksql', 'SELECT * FROM `userrole` WHERE `uid` = ? AND `roleid` = 1');
define('register', 'INSERT INTO `user` (`username`, `password`, `email`) VALUES (?, ?, ?)');
define('createrole', 'INSERT INTO `userrole` (`uid`, `roleid`) VALUES (?, ?)');
define('updatepassword', 'UPDATE `user` SET `password` = ? WHERE `username` = ?');