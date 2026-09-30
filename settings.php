<?php require_once 'includes/functions.php'; $page_title='Settings'; require 'includes/header.php'; ?>
<div class="page-head"><div><h1>Settings</h1><p>Configure your paper-trading dashboard.</p></div></div>
<div class="two-col"><div class="card"><div class="card-head"><h2>General</h2></div><div class="card-body">
<div class="setting-row"><div><strong>Paper Trading</strong><span>Keep all orders simulated.</span></div><div class="switch on"></div></div>
<div class="setting-row"><div><strong>Market Updates</strong><span>Show market watch values.</span></div><div class="switch on"></div></div>
<div class="setting-row"><div><strong>Notifications</strong><span>Dashboard notifications.</span></div><div class="switch"></div></div>
</div></div><div class="card"><div class="card-head"><h2>Database</h2></div><div class="card-body"><div class="notice">Database: <strong>trading_bot</strong><br>Table: <strong>transactions</strong><br>Connection: MySQL / XAMPP</div><a class="btn btn-primary" href="transactions.php">Open Transactions</a></div></div></div>
<?php require 'includes/footer.php'; ?>