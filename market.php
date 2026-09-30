<?php require_once 'includes/functions.php'; $page_title='Market Watch'; require 'includes/header.php'; ?>
<div class="page-head"><div><h1>Market Watch</h1><p>Track supported paper-trading symbols.</p></div></div>
<div class="card"><div class="card-head"><h2>Markets</h2></div><div class="card-body market-list">
<?php foreach([['BTCUSDT','$65,240.20','+2.41%'],['ETHUSDT','$3,482.15','+1.76%'],['BNBUSDT','$592.30','-0.62%'],['SOLUSDT','$148.62','+3.18%'],['ADAUSDT','$0.8124','-0.35%']] as $c): $positive=$c[0]!=='BNBUSDT'&&$c[0]!=='ADAUSDT'; ?>
<div class="market-row"><div><span class="symbol"><?= $c[0] ?></span><span class="pair">Crypto / USDT</span></div><div><div class="price"><?= $c[1] ?></div><div class="change <?= $positive?'positive':'negative' ?>"><?= $c[2] ?></div></div><div class="mini-actions"><a class="mini-btn buy" href="new_trade.php?symbol=<?= $c[0] ?>&type=BUY">BUY</a><a class="mini-btn sell" href="new_trade.php?symbol=<?= $c[0] ?>&type=SELL">SELL</a><a class="btn btn-light" style="padding:6px 8px;font-size:9px" href="market_detail.php?symbol=<?= $c[0] ?>">Details</a></div></div>
<?php endforeach; ?></div></div>
<?php require 'includes/footer.php'; ?>