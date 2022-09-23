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
            $error = "Username is invalid.";
        }
        return $error ?? false;
    }

    private static function ValidatePassword(string $password): string|bool
    {
        //TODO: Add password schema
        if (empty($password)) {
            $error = "Please enter a password.";
        } elseif (strlen($password) < 4) {
            $error = "Password is too short.";
        } elseif (strlen($password) > 50) {
            $error = "Password is too long.";
        }
        return $error ?? false;
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
}