<?php

if (!function_exists('is_user_logged_in')) {
    function is_user_logged_in() {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }
}

if (!function_exists('redirect')) {
    function redirect($location) {
        header("Location: $location");
        exit;
    }
}

if (!function_exists('setActiveclass')) {
    function setActiveclass($pageName) {
        $current_page = basename($_SERVER['PHP_SELF']);
        return ($current_page === $pageName) ? "active" : "";
    }
}

if (!function_exists('getPageClass')) {
    function getPageClass() {
        return basename($_SERVER['PHP_SELF'], '.php');
    }
}
if(!function_exists('full_month_date')) {
function full_month_date($date) {
    return date("F j", strtotime($date));}
}
?>
