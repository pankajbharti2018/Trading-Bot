<?php
require_once __DIR__ . '/functions.php';
if (!isset($page_title)) $page_title = 'Dashboard';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($page_title) ?> | Trading Bot</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="app-shell">
<aside class="sidebar" id="sidebar">
    <div class="brand">
        <div class="brand-mark">TB</div>
        <div>
            <strong>Trading Bot</strong>
            <span>Paper Trading</span>
        </div>
    </div>

    <div class="menu-label">MAIN MENU</div>
    <nav class="nav">
        <a class="<?= nav_active('index.php') ?>" href="index.php"><span class="nav-icon">▦</span> Dashboard</a>
        <a class="<?= nav_active('new_trade.php') ?>" href="new_trade.php"><span class="nav-icon">＋</span> New Trade</a>
        <a class="<?= nav_active('bot.php') ?>" href="bot.php"><span class="nav-icon">◉</span> Run Bot <small>AUTO</small></a>
        <a class="<?= in_array(current_page(), ['market.php','market_detail.php']) ? 'active' : '' ?>" href="market.php"><span class="nav-icon">⌁</span> Market Watch</a>
        <a class="<?= in_array(current_page(), ['transactions.php','transaction.php']) ? 'active' : '' ?>" href="transactions.php"><span class="nav-icon">⇄</span> Transactions</a>
        <a class="<?= nav_active('analytics.php') ?>" href="analytics.php"><span class="nav-icon">▥</span> Charts</a>
        <a class="<?= nav_active('settings.php') ?>" href="settings.php"><span class="nav-icon">⚙</span> Settings</a>
    </nav>

    <div class="sidebar-bottom">
        <div class="status-dot"><i></i> System Online</div>
        <div class="user-mini">
            <div class="avatar">S</div>
            <div><strong>Trader</strong><span>Administrator</span></div>
        </div>
    </div>
</aside>

<div class="page">
<header class="topbar">
    <button class="hamburger" onclick="toggleSidebar()">☰</button>
    <div>
        <div class="top-title"><?= e($page_title) ?></div>
        <div class="top-subtitle">Manage your paper trading account</div>
    </div>
    <div class="top-actions">
        <a class="icon-btn" href="settings.php" title="Settings">⚙</a>
        <div class="top-avatar">S</div>
    </div>
</header>
<main class="content">
