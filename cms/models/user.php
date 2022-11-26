<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../core/database.php';

class UserModel extends Database
{
    public function GetUsers()
    {
        $this->prepare('SELECT * FROM `user`');
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function EditUser($uid, $username, $password, $email) : string
    {
        $row = $this->GetUserById($uid);

        if ($row) {
            if($password != null){
                $this->prepare('UPDATE `user` SET `username` = :username, `password` = :password, `email` = :email WHERE `uid` = :uid');
                $this->statement->bindParam(':password', $password);
            }else{
                $this->prepare('UPDATE `user` SET `username` = :username, `email` = :email WHERE `uid` = :uid');
            }
            $this->statement->bindParam(':username', $username);
            $this->statement->bindParam(':email', $email);
            $this->statement->bindParam(':uid', $uid);
            $this->statement->execute();
            return 'User updated successfully!';
        } else {
            return 'User does not exist!';
        }
    }

    public function DeleteUser($uid) : bool
    /*{
        $row = $this->GetUserById($uid);

        if ($row) {
            $this->prepare('DELETE FROM `user` WHERE `uid` = :uid');
            $this->statement->bindParam(':uid', $uid);
            $this->statement->execute();
            return 'User deleted successfully!';
        } else {
            return 'User does not exist!';
        }
    }*/
    {
        $this->prepare('DELETE FROM `user` WHERE `uid` = :uid');
        $this->statement->bindParam(':uid', $uid);
        if ($this->statement->execute())
        {
            return true;
        } else {
            return false;
        }
    }

    public function GetUserById($uid): bool|stdClass
    {
        $this->prepare('SELECT * FROM `user` WHERE `uid` = ? LIMIT 1');
        $this->statement->execute([$uid]);
        return $this->statement->fetch();
    }

    public function GetUsername($username): bool|stdClass
    {
        $this->prepare('SELECT * FROM `user` WHERE `username` = ? LIMIT 1');
        $this->statement->execute([$username]);
        return $this->statement->fetch();
    }

    public function GetEmail($email): bool|stdClass
    {
        $this->prepare('SELECT * FROM `user` WHERE `email` = ? LIMIT 1');
        $this->statement->execute([$email]);
        return $this->statement->fetch();
    }

    public function GetRole($userrole): bool|stdClass
    {
        $this->prepare('SELECT roleid FROM `userrole` WHERE `uid` = ?');
        $this->statement->execute([$userrole]);
        return $this->statement->fetch();
    }

    public function AdditionalAdminCheck($uid): bool|stdClass
    {
        $this->prepare('SELECT * FROM `userrole` WHERE `uid` = ? AND `roleid` = 1');
        $this->statement->execute([$uid]);
        return $this->statement->fetch();
    }

    public function Register($username, $hashedPassword, $email): bool
    {
        $this->prepare('INSERT INTO `user` (`username`, `password`, `email`) VALUES (?, ?, ?)');
     
        if ($this->statement->execute([$username, $hashedPassword, $email]))
        {
            return true;
        } else {
            return false;
        }
        /*try{
            $this->connect()->beginTransaction();
            $this->prepare('INSERT INTO `user` (`username`, `password`, `email`) VALUES (?, ?, ?)');
            $this->statement->execute([$username, $hashedPassword, $email]);

            $this->prepare('SELECT uid FROM `user` WHERE `username` = ?');
            $this->statement->execute([$username]);
            $uid = $this->statement->fetch();

            $this->prepare('INSERT INTO `userrole` (`uid`, `roleid`) VALUES (?, ?)');
            $this->statement->execute([$uid, 0]);

            $this->connect()->commit();
            //$this->connect()->commit();
        } catch (Throwable $error) {
            $this->connect()->rollBack();
            return false;
        } finally {
            return true;
        }*/
    }

    public function CreateRole($uid, $roleid): bool
    {
        $this->prepare('INSERT INTO `userrole` (`uid`, `roleid`) VALUES (?, ?)');
        if ($this->statement->execute([$uid, $roleid]))
        {
            return true;
        } else {
            return false;
        }
    }

    public function Login($username, $password): bool|object
    {
        $row = $this->GetUsername($username);
        return $row && password_verify($password, $row->password) ? $row : false;
    }

    public function UpdatePassword($currentPassword, $hashedPassword, $username): string
    {
        $row = $this->GetUsername($username);

        if (password_verify($currentPassword, $row->password)) {
            $this->prepare('UPDATE `user` SET `password` = ? WHERE `username` = ?');
            $this->statement->execute([$hashedPassword, $username]);
            return 'Password changed successfully.';
        } else {
            return 'Failed to change password.';
        }
    }
}