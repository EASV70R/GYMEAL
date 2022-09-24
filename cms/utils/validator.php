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
        //$passwordSchema = "/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/";
        if (empty($password)) {
            $error = "Please enter a password.";
        } elseif (strlen($password) < 4) {
            $error = "Password is too short.";
        } elseif (strlen($password) > 50) {
            $error = "Password is too long.";
        }
        /*} elseif (!preg_match($passwordSchema, $password)) {
            $error = "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
        }*/
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
        } elseif (strlen($phone) > 12) {
            $error = "Phone Number is too long.";
        } elseif (!preg_match($phoneSchema, $phone)) {
            $error = "Please enter a valid Phone Number.";
        }
        return $error ?? false;
    }

    public static function RegisterForm(
        string $username,
        string $password,
        string $confirmPassword,
        string $email,
        string $firstName, 
        string $lastName, 
        string $phone
    ): string|bool{
        $validateName = self::ValidateUsername($firstName) && self::ValidateUsername($lastName);
        if ($validateName) {
            return (string) $validateName;
        }

        $validateUsername = self::ValidateUsername($username);
        if ($validateUsername) {
            return (string) $validateUsername;
        }

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

        $validatePhone = self::ValidatePhone($phone);
        if ($validatePhone) {
            return (string) $validatePhone;
        }

        if (empty($confirmPassword) && $password != $confirmPassword) {
            return "Passwords do not match, please try again.";
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