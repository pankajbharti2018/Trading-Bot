<?php
require_once 'database.php'; require_once 'includes/functions.php';
$page_title='Run Bot'; $message='';
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['run_bot'])){
    $stmt=$pdo->prepare("INSERT INTO transactions (symbol,type,price,quantity,profit_loss,status) VALUES (?,?,?,?,?,?)");
    $stmt->execute(['BTCUSDT','BUY',65000,0.001,0,'OPEN']);
    $message='Demo bot trade created successfully.';
}
require 'includes/header.php'; ?>
<div class="page-head"><div><h1>Run Bot</h1><p>Execute a paper-trading bot cycle.</p></div></div>
<div class="two-col"><div class="card"><div class="card-head"><h2>Bot Control</h2></div><div class="card-body">
<?php if($message): ?><div class="notice"><?= e($message) ?></div><?php endif; ?>
<div class="detail-grid"><div class="detail-item"><span>Status</span><strong class="positive">Ready</strong></div><div class="detail-item"><span>Mode</span><strong>Paper Trading</strong></div><div class="detail-item"><span>Strategy</span><strong>Demo Momentum</strong></div><div class="detail-item"><span>Symbol</span><strong>BTCUSDT</strong></div></div>
<form method="post" style="margin-top:15px"><button class="btn btn-primary" name="run_bot" value="1">▶ Run Bot Cycle</button></form>
</div></div><div class="card"><div class="card-head"><h2>How It Works</h2></div><div class="card-body"><div class="notice">The demo bot inserts one paper BUY transaction. Replace this logic later with your own strategy/API integration.</div></div></div></div>
<?php require 'includes/footer.php'; ?>