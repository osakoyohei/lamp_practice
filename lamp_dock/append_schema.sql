-- 購入履歴画面
CREATE TABLE `orders` (
    `id` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `user_id` int NOT NULL,
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 購入明細画面
CREATE TABLE `order_details` (
    `id` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `item_name` varchar(100) NOT NULL,
    `price` int UNSIGNED NOT NULL,
    `amount` smallint UNSIGNED NOT NULL,
    `order_id` int UNSIGNED NOT NULL,
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;