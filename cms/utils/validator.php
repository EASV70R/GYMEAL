<?php

class Validator
{
    private static function ValidateUsername(string $username): string|bool
    {
        $usernameSchema = "/^[a-zA-Z0-9]*$/";
        if (empty($username)) {
            $error = "Please enter a username.";
        } elseif (strlen($username) < 3) {
            $error = "Username is too short.";
        } elseif (strlen($username) > 14) {
            $error = "Username is too long.";
        } elseif (!preg_match($usernameSchema, $username)) {
            $error = "Username must contain only letters and numbers.";
        }
        return $error ?? false;
    }

    private static function ValidatePassword(string $password): string|bool
    {
        // https://stackoverflow.com/a/8141210
        // NOTE: Use only for live server.
        $passwordSchema = "/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/";
        if (empty($password)) {
            $error = "Please enter a password.";
        } elseif (strlen($password) < 4) {
            $error = "Password is too short.";
        } elseif (strlen($password) > 50) {
            $error = "Password is too long.";
        } elseif (!preg_match($passwordSchema, $password)) {
            $error = "Password must contain at least 8 letter long, one uppercase letter, one lowercase letter, one number, and one special character.";
        }
        return $error ?? false;
    }

    private static function ValidateEmail(string $email): string|bool
    {
        $emailSchema = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
        if (empty($email)) {
            $error = "Please enter your Email.";
        } elseif (strlen($email) < 3) {
            $error = "null.";
        } elseif (strlen($email) > 30) {
            $error = "Email is too long.";
        } elseif (!preg_match($emailSchema, $email)) {
            $error = "Please enter a valid Email.";
        }
        return $error ?? false;
    }

    private static function ValidatePhone(string $phone): string|bool
    {
        $phoneSchema = "/^\+?([0-9]{2})-?([0-9]{6,8})$/";
        if (empty($phone)) {
            $error = "Please enter your Phone Number.";
        } elseif (strlen($phone) < 1) {
            $error = "null.";
        } elseif (strlen($phone) > 15) {
            $error = "Phone Number is too long.";
        } elseif (!preg_match($phoneSchema, $phone)) {
            $error = "Please enter a valid Phone Number.";
        }
        return $error ?? false;
    }

    private static function ValidateCompanyInfo(string $title,
    string $desc,
    string $footerDesc,
    string $address
    ): string|bool
    {
        $titleSchema = "/^[a-zA-Z0-9 ,.\/\\-_()!?]*$/";

        if (empty($title) || empty($desc) || empty($footerDesc)) {
            $error = "Please enter a title or description.";
        } elseif (strlen($title) < 3 || strlen($desc) < 3 || strlen($footerDesc) < 3) {
            $error = "Title or description is too short.";
        } elseif (strlen($title) > 100 || strlen($desc) > 255 || strlen($footerDesc) > 255) {
            $error = "Title or description is too long.";
        } elseif (!preg_match($titleSchema, $title) || !preg_match($titleSchema, $desc) || !preg_match($titleSchema, $footerDesc)) {
            $error = "Title or description must contain only letters and numbers.";
        } elseif (empty($address)) {
            $error = "Please enter your address.";
        } elseif (strlen($address) < 3) {
            $error = "Address is too short.";
        } elseif (strlen($address) > 100) {
            $error = "Address is too long.";
        } elseif (!preg_match($titleSchema, $address)) {
            $error = "Address must contain only letters and numbers.";
        }

        return $error ?? false;
    }

    public static function CompanyInfoForm(
        string $title,
        string $desc,
        string $footerDesc,
        string $address,
        string $phone,
        string $mail,
        string $image
    ): string|bool {
        $validateTitle = self::ValidateCompanyInfo($title, $desc, $footerDesc, $address);
        if ($validateTitle) {
            return (string) $validateTitle;
        }

        $validatePhone = self::ValidatePhone($phone);
        if ($validatePhone) {
            return (string) $validatePhone;
        }

        $validateMail = self::ValidateEmail($mail);
        if ($validateMail) {
            return (string) $validateMail;
        }

        return false;
    }

    public static function RegisterForm(
        string $username,
        string $password,
        string $confirmPassword,
        string $email,
    ): string|bool{
    
        $validateUsername = self::ValidateUsername($username);
        if ($validateUsername) {
            return (string) $validateUsername;
        }

        $validatePassword = self::ValidatePassword($password);
        if ($validatePassword) {
            return (string) $validatePassword;
        }

        $validateEmail = self::ValidateEmail($email);
        if ($validateEmail) {
            return (string) $validateEmail;
        }

        if (empty($confirmPassword) && $password != $confirmPassword) {
            return "Passwords do not match, please try again.";
        }

        return false;
    }

    public static function EditUserForm(
        string $username,
        string $email,
    ): string|bool{
    
        $validateUsername = self::ValidateUsername($username);
        if ($validateUsername) {
            return (string) $validateUsername;
        }

        $validateEmail = self::ValidateEmail($email);
        if ($validateEmail) {
            return (string) $validateEmail;
        }

        return false;
    }

    public static function LoginForm(string $username, string $password): string|bool
    {
        $validateUsername = self::ValidateUsername($username);
        if ($validateUsername) {
            return (string) $validateUsername;
        }

        $validatePassword = self::ValidatePassword($password);
        if ($validatePassword) {
            return (string) $validatePassword;
        }

        return false;
    }

    public static function UpdatePasswordForm(
        string $currentPassword,
        string $newPassword,
        string $confirmPassword
    ): string|bool {
        $validatePassword = self::ValidatePassword($currentPassword);
        if ($validatePassword) {
            return (string) $validatePassword;
        }
        
        $validateMewPassword = self::ValidatePassword($newPassword);
        if ($validateMewPassword) {
            return (string) $validateMewPassword;
        }

        if (empty($confirmPassword) || $newPassword !== $confirmPassword) {
            return "Passwords do not match, please try again.";
        }

        return false;
    }
}