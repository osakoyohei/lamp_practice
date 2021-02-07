<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);


//プルダウンメニュー
$sorts = array(ITEM_ORDER_NEW => '新着順', ITEM_ORDER_CHEAP => '価格の安い順', ITEM_ORDER_EXPENSIVE => '価格の高い順');

//並び替え
$sort = get_get('sort');
if ($sort === ITEM_ORDER_NEW) {
  //新着順
  $items = get_new_items($db);
} else if ($sort === ITEM_ORDER_CHEAP) {
  //価格の安い順
  $items = get_cheap_items($db);
} else if ($sort === ITEM_ORDER_EXPENSIVE) {
  //価格の高い順
  $items = get_expensive_items($db);
} else {
  //通常
  $items = get_open_items($db);
}

$token = get_csrf_token();

include_once VIEW_PATH . 'index_view.php';