<?php

namespace core\classes;

use core\enum\ResponseEnum;

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

    public static function handleResponse(string $message, ResponseEnum $status = ResponseEnum::Error): void
    {
        if ($status == ResponseEnum::Error) {
            http_response_code(400);
        }
        $response = array($status->value => $message);
        echo json_encode($response);
        die();
    }

    public static function numberAbbreviation(int $number, int $floating_points = 1): string
    {
        $a = ['', 'K', 'M', 'B', 't', 'q', 'Q', 's', 'S', 'o', 'n', 'd'];
        $i = intdiv(strlen((string)$number) - 1, 3);
        $m = $a[$i] ?? '';
        return number_format($number / (1000 ** $i), $m ? $floating_points : 0) . $m;
    }

    public static function numberFormat(int $number): string
    {
        return number_format($number, 0, '.', '.');
    }

    public static function redirect(string $route = 'index'): void
    {
        header("Location:" . BASE_URL . "?action=$route");
        die();
    }

    public static function setAbsoluteValue(string $value): int
    {
        $result = abs((int)$value);
        if (strlen($result) > 10) {
            return 0;
        }
        return $result;
    }

    public static function showGameLayout(string $route, bool $isLogged = true, array|string|null $data = null): void
    {
        $menubar = 'components/menubar_character';
        $navbar = 'components/navbar_character';
        if (!$isLogged) {
            $menubar = 'components/menubar_account';
            $navbar = 'components/navbar_account';
        }
        self::renderLayout(['layout/header_html', 'components/main_header', $menubar, $navbar, 'components/menubar_dropdown', $route, 'components/main_content_footer', 'components/main_footer', 'layout/footer_html'], $data);
    }

    public static function showMainLayout(string $route = 'home', array|string|null $data = null): void
    {
        self::renderLayout(['layout/header_html', $route, 'layout/footer_html'], $data);
    }

    public static function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function validateGetRequest(): void
    {
        if ($_SERVER['REQUEST_METHOD'] != 'GET') {
            Functions::showMainLayout();
            die();
        }
    }

    public static function validateLoggedAccount(): void
    {
        if (!isset($_SESSION['accountId'])) {
            self::redirect();
        }
    }

    public static function validateLoggedUser(): bool
    {
        return isset($_SESSION['accountId']);
    }

    public static function validateName(string $text): bool
    {
        $result = preg_match('|^[\pL\s\d]+$|u', $text);
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