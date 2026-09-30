<?php
require_once 'database.php'; require_once 'includes/functions.php';
$id=(int)($_GET['id']??0); $stmt=$pdo->prepare("SELECT * FROM transactions WHERE id=?"); $stmt->execute([$id]); $tx=$stmt->fetch();
if(!$tx) die('Transaction not found. <a href="transactions.php">Back</a>');
$page_title='Transaction #'.$id; require 'includes/header.php'; ?>
<div class="page-head"><div><h1>Transaction #<?= $id ?></h1><p>Detailed order information.</p></div><a class="btn btn-light" href="transactions.php">← Back</a></div>
<div class="two-col"><div class="card"><div class="card-head"><h2>Trade Details</h2></div><div class="card-body"><div class="detail-grid">
<div class="detail-item"><span>Symbol</span><strong><?= e($tx['symbol']) ?></strong></div><div class="detail-item"><span>Type</span><strong class="<?= strtoupper($tx['type'])==='BUY'?'type-buy':'type-sell' ?>"><?= e($tx['type']) ?></strong></div>
<div class="detail-item"><span>Price</span><strong><?= money($tx['price']) ?></strong></div><div class="detail-item"><span>Quantity</span><strong><?= qty($tx['quantity']) ?></strong></div>
<div class="detail-item"><span>Profit / Loss</span><strong class="<?= $tx['profit_loss']>=0?'positive':'negative' ?>"><?= money($tx['profit_loss']) ?></strong></div><div class="detail-item"><span>Status</span><strong><?= e($tx['status']) ?></strong></div>
<div class="detail-item"><span>Created</span><strong><?= e($tx['created_at']) ?></strong></div><div class="detail-item"><span>Transaction ID</span><strong>#<?= (int)$tx['id'] ?></strong></div>
</div></div></div>
<div class="card"><div class="card-head"><h2>Actions</h2></div><div class="card-body"><div class="notice">This is a paper-trading record. No live exchange order is placed.</div><a class="btn btn-primary" href="new_trade.php?symbol=<?= urlencode($tx['symbol']) ?>&type=<?= urlencode($tx['type']) ?>">Create Similar Trade</a></div></div></div>
<?php require 'includes/footer.php'; ?>