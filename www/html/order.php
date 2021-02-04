<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'order.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

if(is_admin($user)) {
    //全てのユーザーの購入履歴
    $orders = get_history_all($db);
} else {
    //ユーザ毎の購入履歴
    $orders = get_history($db, $user['user_id']);
}

include_once VIEW_PATH . 'order_view.php';