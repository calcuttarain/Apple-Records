<?php

class Utils
{
   public static function sanitize(array $data): array
    {
        $sanitized = [];
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $sanitized[$key] = htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
            } else {
                $sanitized[$key] = $value;
            }
        }
        return $sanitized;
    }

    public static function hasEmptyFields(array $fields): bool
    {
        foreach ($fields as $field) {
            if (empty($field)) {
                return true;
            }
        }
        return false;
    }

    public static function emailExists($email, $userModel)
    {
        $user = $userModel->select_first(['email' => $email]);
        return $user !== null;
    }

    public static function isPasswordStrong($password)
    {
        if (strlen($password) < 8) {
            return false;
        }

        if (!preg_match('/[A-Z]/', $password)) {
            return false;
        }

        if (!preg_match('/\d/', $password)) {
            return false;
        }

        return true;
    }

   public static function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }

   public static function verifyPassword(string $password, string $hashedPassword): bool
    {
        return password_verify($password, $hashedPassword);
    }
}

