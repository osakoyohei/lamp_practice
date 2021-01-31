<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

$carts = get_user_carts($db, $user['user_id']);

$token = get_post('csrf_token');
if (is_valid_csrf_token($token) === false) {
  print '不正なリクエストです';
  exit;
}

$db->beginTransaction();
if(purchase_history($db, $carts) === false){
  set_error('商品が購入できませんでした。');
}
if(purchase_carts($db, $carts) === false){
  set_error('商品が購入できませんでした。');  
}
if(has_error()){
  $db->rollback();
  redirect_to(CART_URL);
}
$db->commit();

$total_price = sum_carts($carts);

include_once '../view/finish_view.php';