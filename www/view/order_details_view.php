<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>商品購入履歴</title>
  <link rel="stylesheet" href="<?php print h(STYLESHEET_PATH . 'admin.css'); ?>">
</head>
<body>

<?php include VIEW_PATH . 'templates/header_logined.php'; ?>
<h1>購入履歴</h1>

<div class="container">

<?php include VIEW_PATH . 'templates/messages.php'; ?>

<?php if(count($history_orders) > 0){ ?>
  <table class="table table-bordered">
    <thead class="thead-light">
      <tr>
        <th>注文番号</th>
        <th>購入日時</th>
        <th>該当の注文の合計金額</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($history_orders as $history_order){ ?>
      <tr>
        <td><?php print h($history_order['id']); ?></td>
        <td><?php print h($history_order['created_at']); ?></td>
        <td><?php print h(number_format($history_order['total'])); ?>円</td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
<?php } else { ?>
　　<p>購入履歴がありません。</p>
<?php } ?> 
</div>

<h1>購入明細</h1>

<div class="container">

<?php if(count($details) > 0){ ?>
　　<table class="table table-bordered">
    <thead class="thead-light">
        <tr>
          <th>商品名</th>
          <th>購入時の商品価格</th>
          <th>購入数</th>
          <th>小計</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($details as $detail){ ?> 
        <tr>
          <td><?php print h($detail['item_name']); ?></td>
          <td><?php print h($detail['price']); ?></td>
          <td><?php print h($detail['amount']); ?></td>
          <td><?php print h(number_format($detail['subtotal'])); ?>円</td>
        </tr>
        <?php } ?>
    </tbody>
　　</table>
　<?php } else { ?>
    <p>購入情報がありません。</p>
　<?php } ?> 
</div>
</body>
</html>