<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'order.php';
require_once MODEL_PATH . 'order_details.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

$order_id = get_get('id');

//購入履歴
if(is_admin($user)) {
    $history_orders = get_all_history_order($db, $order_id);
} else {
    $history_orders = get_history_order($db, $order_id, $user['user_id']);
}

//購入明細
if ($history_orders === array()){
    $details = array();
} else {
    $details = get_detail($db, $order_id);  
}

include_once VIEW_PATH . 'order_details_view.php';