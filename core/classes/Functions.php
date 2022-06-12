<?php

namespace core\classes;

use JetBrains\PhpStorm\NoReturn;

class Functions
{

    public static function encodePassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function generateToken(int $charactersQuantity = 12): string
    {
        $characters = '0123456789#abcdefghilkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($characters), 0, $charactersQuantity);
    }

    #[NoReturn] public static function handleErrors(string $message): void
    {
        $error = array('error' => $message);
        echo json_encode($error);
        die();
    }

    public static function redirect(string $route = 'index'): void
    {
        header("Location:" . BASE_URL . "?action=$route");
    }

    public static function showGameLayout(string $route, array|string|null $data = null): void
    {
        self::renderLayout(['layout/header_html', 'components/main_header', 'components/main_content_header', $route, 'components/main_content_footer', 'components/main_footer', 'layout/footer_html'], $data);
    }

    public static function showMainLayout(string $route = 'home', array|string|null $data = null): void
    {
        self::renderLayout(['layout/header_html', $route, 'layout/footer_html'], $data);
    }

    public static function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function validateLoggedUser(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function validateOnlyLettersAndSpace(string $text): bool
    {
        $result = preg_match('|^[\pL\s]+$|u', $text);
        if ($result) {
            return true;
        }
        return false;
    }

    public static function validatePostRequest(): void
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Functions::showMainLayout();
            die();
        }
    }

    private static function renderLayout(array $structures, array|string $data = null): void
    {
        if (!empty($data) && is_array($data)) {
            extract($data);
        }
        foreach ($structures as $structure) {
            if (file_exists("../core/views/$structure.php")) {
                include("../core/views/$structure.php");
            }
        }
    }
}