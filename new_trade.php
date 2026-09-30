<?php
require_once 'database.php'; require_once 'includes/functions.php';
$page_title='New Trade';
$symbol=$_GET['symbol']??'BTCUSDT'; $type=$_GET['type']??'BUY';
require 'includes/header.php'; ?>
<div class="page-head"><div><h1>New Trade</h1><p>Create a paper BUY or SELL order.</p></div><a class="btn btn-light" href="transactions.php">Transaction History</a></div>
<div class="two-col">
<div class="card"><div class="card-head"><h2>Trade Order</h2></div><div class="card-body">
<form action="trade.php" method="post">
<div class="trade-tabs"><button type="button" class="trade-tab <?= $type==='BUY'?'selected':'' ?>" id="tab-BUY" onclick="setTradeType('BUY')">BUY</button><button type="button" class="trade-tab <?= $type==='SELL'?'selected':'' ?>" id="tab-SELL" onclick="setTradeType('SELL')">SELL</button></div>
<input type="hidden" name="type" id="trade-type" value="<?= e($type) ?>">
<div class="form-row"><label>Symbol</label><select class="form-control" name="symbol"><?php foreach(['BTCUSDT','ETHUSDT','BNBUSDT','SOLUSDT','ADAUSDT'] as $s): ?><option <?= $symbol===$s?'selected':'' ?>><?= $s ?></option><?php endforeach; ?></select></div>
<div class="form-row"><label>Price</label><input class="form-control" name="price" type="number" step="0.00000001" value="<?= $symbol==='BTCUSDT'?'65000':'100' ?>" required></div>
<div class="form-row"><label>Quantity</label><input class="form-control" name="quantity" type="number" step="0.00000001" value="0.001" required></div>
<button class="btn btn-primary trade-submit <?= $type==='SELL'?'sell-button':'' ?>" id="submit-trade"><?= $type==='BUY'?'Place Buy Order':'Place Sell Order' ?></button>
</form></div></div>
<div class="card"><div class="card-head"><h2>Order Information</h2></div><div class="card-body">
<div class="notice">This project uses paper trading. Orders are saved to your existing <strong>transactions</strong> table.</div>
<div class="detail-grid"><div class="detail-item"><span>Order Type</span><strong>Market</strong></div><div class="detail-item"><span>Execution</span><strong>Instant</strong></div><div class="detail-item"><span>Account</span><strong>Paper</strong></div><div class="detail-item"><span>Risk</span><strong>No real funds</strong></div></div>
</div></div></div>
<?php require 'includes/footer.php'; ?>