<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../core/database.php';
require_once __DIR__.'/../models/sql/usersql.php';

class UserModel extends Database
{
    public function GetUsers()
    {
        $this->prepare(USER);
        $this->statement->execute();
        return $this->fetchAll();
    }

    public function EditUser($uid, $username, $password, $email, $role) : string
    {
        /**/
        try
        {
            $this->connect()->beginTransaction();
            $row = $this->GetUserById($uid);

            if ($row) {
                if($password != null){
                    $this->prepare(EDITUSER);
                    $this->statement->bindParam(':password', $password);
                }else{
                    $this->prepare(EDITUSER2);
                }
                $this->statement->bindParam(':username', $username, PDO::PARAM_STR);
                $this->statement->bindParam(':email', $email, PDO::PARAM_STR);
                $this->statement->bindParam(':uid', $uid, PDO::PARAM_INT);
                $this->statement->execute();

                $this->prepare('UPDATE `userrole` SET `roleid` = :role WHERE `uid` = :uid');
                $this->statement->bindParam(':uid', $uid, PDO::PARAM_INT);
                $this->statement->bindParam(':role', $role, PDO::PARAM_BOOL);
                $this->statement->execute();

                $this->commit();
            }else{
                $this->rollBack();
                return 'User not found';
            }
        } catch (Throwable $error) {
            $this->rollBack();
            print_r("Error: " . $error->getMessage());
        } finally {
            return 'User updated successfully!';
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
        try{
            $this->connect()->beginTransaction();
            $this->prepare(DELETEUSER);
            $this->statement->bindParam(':uid', $uid, PDO::PARAM_INT);
            $this->statement->execute();
            $this->commit();
        } catch (Throwable $error) {
            $this->rollBack();
            print_r("Error: " . $error->getMessage());
            return false;
        } finally {
            return true;
        }
    }

    public function GetUserById($uid): bool|stdClass
    {
        $this->prepare(USERBYID);
        $this->statement->execute([$uid]);
        return $this->fetch();
    }

    public function GetUsername($username): bool|stdClass
    {
        $this->prepare(USERBYUSERNAME);
        $this->statement->execute([$username]);
        return $this->fetch();
    }

    public function GetEmail($email): bool|stdClass
    {
        $this->prepare(USERBYEMAIL);
        $this->statement->execute([$email]);
        return $this->fetch();
    }

    public function GetRole($userrole): bool|stdClass
    {
        $this->prepare(ROLEBYUID);
        $this->statement->execute([$userrole]);
        return $this->fetch();
    }

    public function AdditionalAdminCheck($uid): bool|stdClass
    {
        $this->prepare(ADMINCHECK);
        $this->statement->execute([$uid]);
        return $this->fetch();
    }

    public function Register($username, $hashedPassword, $email): bool
    {
        try{
            $this->connect()->beginTransaction();
            $this->prepare(REGISTER);
            $this->statement->execute([$username, $hashedPassword, $email]);
            $this->commit();
            return true;
        } catch (Exception $e) {
            $this->rollBack();
            print_r("Error: " . $e->getMessage());
            return false;
        }
    }

    public function CreateRole($uid, $roleid): bool
    {
        try{
            $this->connect()->beginTransaction();
            $this->prepare(CREATEROLE);
            $this->statement->execute([$uid, $roleid]);
            $this->commit();
            return true;
        } catch (Throwable $error) {
            $this->rollBack();
            print_r("Error: " . $error->getMessage());
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
        try{
            $this->connect()->beginTransaction();
            $row = $this->GetUsername($username);
            if ($row)
            {
                if (password_verify($currentPassword, $row->password)) {
                    $this->prepare(UPDATEPASSWORD);
                    $this->statement->execute([$hashedPassword, $username]);
                    $this->commit();
                    return 'Password changed successfully.';
                } else {
                    return 'Failed to change password.';
                }
            }
        } catch (Throwable $error) {
            $this->rollBack();
            print_r("Error: " . $error->getMessage());
        } finally {
            return 'Password changed successfully.';
        }
    }
}