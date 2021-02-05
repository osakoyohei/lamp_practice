<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

//全ユーザーの購入履歴
function get_history_all($db){
    $sql = "
      SELECT
        orders.id,
        orders.created_at,
        SUM(order_details.price * order_details.amount) AS total
      FROM
        orders
      JOIN
        order_details
      ON
        orders.id = order_details.order_id
      GROUP BY
        orders.id
      ORDER BY
        orders.created_at desc
  ";
      return fetch_all_query($db, $sql);
  }

  //ユーザー毎の購入履歴
function get_history($db, $user_id){
  $sql = "
    SELECT
      orders.id,
      orders.created_at,
      SUM(order_details.price * order_details.amount) AS total
    FROM
      orders
    JOIN
      order_details
    ON
      orders.id = order_details.order_id
    WHERE
      orders.user_id = ?
    GROUP BY
      orders.id
    ORDER BY
      orders.created_at desc
";
    return fetch_all_query($db, $sql, [$user_id]);
}