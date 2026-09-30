<?php
require_once 'database.php';
require_once 'includes/functions.php';
$page_title = 'Dashboard';

$total = (int)$pdo->query("SELECT COUNT(*) FROM transactions")->fetchColumn();
$open = (int)$pdo->query("SELECT COUNT(*) FROM transactions WHERE status='OPEN'")->fetchColumn();
$profit = (float)$pdo->query("SELECT COALESCE(SUM(profit_loss),0) FROM transactions")->fetchColumn();
$recent = $pdo->query("SELECT * FROM transactions ORDER BY created_at DESC, id DESC LIMIT 6")->fetchAll();
require 'includes/header.php';
?>
<div class="page-head">
  <div><h1>Dashboard</h1><p>Overview of your trading activity and market.</p></div>
  <a class="btn btn-primary" href="new_trade.php">＋ New Trade</a>
</div>

<section class="stats">
  <div class="stat-card"><div class="stat-top">Total Balance <span class="stat-icon ic-blue">◈</span></div><div class="stat-value">$25,000.00</div><div class="stat-meta">Paper account balance</div></div>
  <div class="stat-card"><div class="stat-top">Open Trades <span class="stat-icon ic-green">↗</span></div><div class="stat-value"><?= $open ?></div><div class="stat-meta">Currently active positions</div></div>
  <div class="stat-card"><div class="stat-top">Total Profit / Loss <span class="stat-icon ic-orange">↕</span></div><div class="stat-value <?= $profit >= 0 ? 'positive':'negative' ?>"><?= money($profit) ?></div><div class="stat-meta">Realized paper P/L</div></div>
  <div class="stat-card"><div class="stat-top">Total Transactions <span class="stat-icon ic-purple">⇄</span></div><div class="stat-value"><?= $total ?></div><div class="stat-meta">All recorded trades</div></div>
</section>

<section class="grid-main">
  <div class="card">
    <div class="card-head"><h2>Manual Trade</h2><a href="new_trade.php">Full Form →</a></div>
    <div class="card-body">
      <div class="trade-tabs"><button class="trade-tab selected" id="tab-BUY" onclick="setTradeType('BUY')">BUY</button><button class="trade-tab" id="tab-SELL" onclick="setTradeType('SELL')">SELL</button></div>
      <form action="trade.php" method="post">
        <input type="hidden" name="type" id="trade-type" value="BUY">
        <div class="form-row"><label>Symbol</label><select class="form-control" name="symbol"><option>BTCUSDT</option><option>ETHUSDT</option><option>BNBUSDT</option><option>SOLUSDT</option><option>ADAUSDT</option></select></div>
        <div class="form-row"><label>Price</label><input class="form-control" name="price" type="number" step="0.00000001" value="65000" required></div>
        <div class="form-row"><label>Quantity</label><input class="form-control" name="quantity" type="number" step="0.00000001" value="0.001" required></div>
        <button class="btn btn-primary trade-submit" id="submit-trade">Place Buy Order</button>
      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-head"><h2>Market Watch</h2><a href="market.php">View Market →</a></div>
    <div class="card-body market-list">
      <?php
      $coins = [
        ['BTCUSDT','$65,240.20','+2.41%','positive'],
        ['ETHUSDT','$3,482.15','+1.76%','positive'],
        ['BNBUSDT','$592.30','-0.62%','negative'],
        ['SOLUSDT','$148.62','+3.18%','positive'],
        ['ADAUSDT','$0.8124','-0.35%','negative']
      ];
      foreach($coins as $c): ?>
      <div class="market-row">
        <div><span class="symbol"><?= e($c[0]) ?></span><span class="pair">Crypto / USDT</span></div>
        <div><div class="price"><?= e($c[1]) ?></div><div class="change <?= $c[3] ?>"><?= e($c[2]) ?></div></div>
        <div class="mini-actions"><a class="mini-btn buy" href="new_trade.php?symbol=<?= e($c[0]) ?>&type=BUY">BUY</a><a class="mini-btn sell" href="new_trade.php?symbol=<?= e($c[0]) ?>&type=SELL">SELL</a></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="card chart-card">
    <div class="card-head"><h2>Price Chart</h2><a href="analytics.php">Open Charts →</a></div>
    <div class="card-body">
      <div class="chart-wrap"><div class="chart-title">BTC / USDT</div><div class="chart-value">$65,240.20</div><canvas class="chart-canvas" id="miniChart"></canvas></div>
      <div class="chart-footer"><span>1H</span><span>4H</span><span>1D</span><span>1W</span><span style="margin-left:auto">LIVE</span></div>
    </div>
  </div>
</section>

<div class="card transactions-card">
  <div class="card-head"><h2>Recent Transactions</h2><a href="transactions.php">View All →</a></div>
  <div class="table-wrap">
    <table class="data-table"><thead><tr><th>Symbol</th><th>Type</th><th>Price</th><th>Quantity</th><th>P/L</th><th>Status</th><th>Date</th><th></th></tr></thead>
    <tbody>
    <?php if(!$recent): ?><tr><td colspan="8" class="empty">No transactions yet. Create your first trade.</td></tr>
    <?php else: foreach($recent as $r): ?>
      <tr>
        <td><strong><?= e($r['symbol']) ?></strong></td>
        <td class="<?= strtoupper($r['type'])==='BUY'?'type-buy':'type-sell' ?>"><?= e(strtoupper($r['type'])) ?></td>
        <td><?= money($r['price']) ?></td><td><?= qty($r['quantity']) ?></td>
        <td class="<?= $r['profit_loss'] >= 0 ? 'positive':'negative' ?>"><?= money($r['profit_loss']) ?></td>
        <td><span class="badge <?= strtoupper($r['status'])==='OPEN'?'badge-open':'badge-closed' ?>"><?= e($r['status']) ?></span></td>
        <td><?= e(date('M d, Y H:i', strtotime($r['created_at']))) ?></td>
        <td><a class="btn btn-light" style="padding:6px 9px" href="transaction.php?id=<?= (int)$r['id'] ?>">View</a></td>
      </tr>
    <?php endforeach; endif; ?>
    </tbody></table>
  </div>
</div>
<script>
(function(){
const c=document.getElementById('miniChart'); if(!c)return; const x=c.getContext('2d');
function draw(){const d=devicePixelRatio||1,w=c.clientWidth,h=c.clientHeight;c.width=w*d;c.height=h*d;x.scale(d,d);x.clearRect(0,0,w,h);
x.strokeStyle='#18334f';x.lineWidth=1;for(let i=0;i<6;i++){let yy=30+i*(h-45)/5;x.beginPath();x.moveTo(0,yy);x.lineTo(w,yy);x.stroke()}
let vals=[80,94,87,103,98,111,106,119,110,128,122,138,130,145,137,154,147,161,152,169];let min=70,max=175;
vals.forEach((v,i)=>{let xx=12+i*(w-28)/(vals.length-1),yy=20+(max-v)*(h-45)/(max-min);x.strokeStyle=i%3===0?'#36bf82':'#e05260';x.beginPath();x.moveTo(xx,yy-7);x.lineTo(xx,yy+7);x.stroke();x.fillStyle=i%3===0?'#36bf82':'#e05260';x.fillRect(xx-3,yy-5,6,10)});}
draw();window.addEventListener('resize',draw);
})();
</script>
<?php require 'includes/footer.php'; ?>