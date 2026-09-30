<?php
require_once 'database.php'; require_once 'includes/functions.php';
if($_SERVER['REQUEST_METHOD']!=='POST') redirect('new_trade.php');
$symbol=trim($_POST['symbol']??''); $type=strtoupper(trim($_POST['type']??'BUY')); $price=(float)($_POST['price']??0); $quantity=(float)($_POST['quantity']??0);
if(!$symbol || !in_array($type,['BUY','SELL'],true) || $price<=0 || $quantity<=0) die('Invalid trade data. <a href="new_trade.php">Go back</a>');
$stmt=$pdo->prepare("INSERT INTO transactions (symbol,type,price,quantity,profit_loss,status) VALUES (?,?,?,?,?,?)");
$stmt->execute([$symbol,$type,$price,$quantity,0,'OPEN']);
$id=$pdo->lastInsertId(); redirect('transaction.php?id='.$id);
?>