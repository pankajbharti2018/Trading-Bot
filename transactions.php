<?php
require_once 'database.php'; require_once 'includes/functions.php';
$page_title='Transactions'; $q=trim($_GET['q']??'');
$sql="SELECT * FROM transactions"; $params=[];
if($q!==''){ $sql.=" WHERE symbol LIKE ? OR type LIKE ? OR status LIKE ?"; $like="%$q%"; $params=[$like,$like,$like]; }
$sql.=" ORDER BY created_at DESC,id DESC"; $stmt=$pdo->prepare($sql); $stmt->execute($params); $rows=$stmt->fetchAll();
require 'includes/header.php'; ?>
<div class="page-head"><div><h1>Transactions</h1><p>All trades stored in your database.</p></div><a class="btn btn-primary" href="new_trade.php">＋ New Trade</a></div>
<div class="card transactions-card"><div class="card-head"><h2>Trade History</h2><form style="display:flex;gap:7px" method="get"><input class="form-control" style="height:32px;width:180px" name="q" placeholder="Search symbol..." value="<?= e($q) ?>"><button class="btn btn-light" style="padding:7px 11px">Search</button></form></div>
<div class="table-wrap"><table class="data-table"><thead><tr><th>ID</th><th>Symbol</th><th>Type</th><th>Price</th><th>Quantity</th><th>P/L</th><th>Status</th><th>Created</th><th></th></tr></thead><tbody>
<?php if(!$rows): ?><tr><td colspan="9" class="empty">No matching transactions.</td></tr><?php else: foreach($rows as $r): ?><tr><td>#<?= (int)$r['id'] ?></td><td><strong><?= e($r['symbol']) ?></strong></td><td class="<?= strtoupper($r['type'])==='BUY'?'type-buy':'type-sell' ?>"><?= e($r['type']) ?></td><td><?= money($r['price']) ?></td><td><?= qty($r['quantity']) ?></td><td class="<?= $r['profit_loss']>=0?'positive':'negative' ?>"><?= money($r['profit_loss']) ?></td><td><span class="badge <?= strtoupper($r['status'])==='OPEN'?'badge-open':'badge-closed' ?>"><?= e($r['status']) ?></span></td><td><?= e($r['created_at']) ?></td><td><a class="btn btn-light" style="padding:6px 9px" href="transaction.php?id=<?= (int)$r['id'] ?>">View</a></td></tr><?php endforeach; endif; ?>
</tbody></table></div></div>
<?php require 'includes/footer.php'; ?>