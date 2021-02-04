<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

//全ユーザーの購入履歴
function get_all_history_order($db, $order_id){
    $sql = "
      SELECT
        orders.id,
        orders.created_at,
        orders.user_id,
        SUM(order_details.price * order_details.amount) AS total
      FROM
        orders
      JOIN
        order_details
      ON
        orders.id = order_details.order_id
      WHERE
        order_details.order_id = ?
      GROUP BY
        orders.id
  ";
      return fetch_all_query($db, $sql, [$order_id]);
}

//ユーザー毎の購入履歴
function get_history_order($db, $order_id, $user_id){
    $sql = "
      SELECT
        orders.id,
        orders.created_at,
        orders.user_id,
        SUM(order_details.price * order_details.amount) AS total
      FROM
        orders
      JOIN
        order_details
      ON
        orders.id = order_details.order_id
      WHERE
        order_details.order_id = ?
      AND
        orders.user_id = ?
      GROUP BY
        orders.id
  ";
      return fetch_all_query($db, $sql, [$order_id, $user_id]);
}

// ユーザ毎の購入明細
function get_detail($db, $order_id){
    $sql = "
      SELECT
        order_details.price,
        order_details.amount,
        order_details.created_at,
        SUM(order_details.price * order_details.amount) AS subtotal,
        order_details.item_name
      FROM
        order_details
      WHERE
        order_id = ?
      GROUP BY
        order_details.price, order_details.amount, order_details.created_at, order_details.item_name
    ";
    return fetch_all_query($db, $sql, [$order_id]);
}