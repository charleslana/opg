<?php

namespace core\classes;

class Functions
{

    public static function redirect(string $route = 'index'): void
    {
        header("Location:" . BASE_URL . "?action=$route");
    }

    public static function showGameLayout(string $route, array|string|null $data = null): void
    {
        self::renderLayout(['layout/header_html', 'components/main_header', 'components/main_content_header', $route, 'components/main_content_footer', 'components/main_footer', 'layout/footer_html'], $data);
    }

    public static function showMainLayout(string $route, array|string|null $data = null): void
    {
        self::renderLayout(['layout/header_html', $route, 'layout/footer_html'], $data);
    }

    private static function renderLayout(array $structures, array|string $data = null): void
    {
        if (!empty($data) && is_array($data)) {
            extract($data);
        }
        foreach ($structures as $structure) {
            include("../core/views/$structure.php");
        }
    }
}