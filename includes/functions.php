<?php
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
function money($value) {
    return '$' . number_format((float)$value, 2);
}
function qty($value) {
    return number_format((float)$value, 8);
}
function redirect($url) {
    header('Location: ' . $url);
    exit;
}
function current_page() {
    return basename($_SERVER['PHP_SELF']);
}
function nav_active($page) {
    return current_page() === $page ? 'active' : '';
}
?>