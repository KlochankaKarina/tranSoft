-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Чрв 30 2020 р., 19:37
-- Версія сервера: 10.3.13-MariaDB
-- Версія PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `test_shop`
--

-- --------------------------------------------------------

--
-- Структура таблиці `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `first_name` varchar(255) NOT NULL,
  `telephone` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `admin_role` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `customer`
--

INSERT INTO `customer` (`customer_id`, `last_name`, `first_name`, `telephone`, `email`, `city`, `password`, `admin_role`) VALUES
(1, 'Півкач', 'Михайло', '+380501111111', 'mykhailo.pivkach@transoftgroup.com', 'Мукачево', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(2, 'Klochanka', 'Karina', '0660879873', 'Klochankakarina@gmail.com', 'Mykachevo', '25f9e794323b453885f5181f1b624d0b', 0),
(12, 'Deket', 'Viktoria', '0660112873', 'deketviktoria@gmail.com', 'Mykachevo', '00c66aaf5f2c3f49946f15c1ad2ea0d3', 0),
(13, 'Deket', 'Viktoria', '0660112873', 'deketvika@gmail.com', 'Mykachevo', '00c66aaf5f2c3f49946f15c1ad2ea0d3', 0),
(18, 'Deket', 'Viktoria', '0660112873', 'deketviktoriart@gmail.com', 'Mykachevo', '134bf9ff8d62e1341ee3e82755f293bc', 0),
(19, 'Deket', 'Viktoria', '0660112873', 'deketvikathtyjft@gmail.com', 'Mykachevo', '2b9a56336644d8f3aa6fcf34b10038b0', 0);

-- --------------------------------------------------------

--
-- Структура таблиці `menu`
--

CREATE TABLE `menu` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `path` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` smallint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `menu`
--

INSERT INTO `menu` (`id`, `name`, `path`, `active`, `sort_order`) VALUES
(1, 'Товари', '/product/list', 1, 1),
(2, 'Клієнти', '/customer/list', 1, 2),
(3, 'Тест', '/test/test', 1, 3);

-- --------------------------------------------------------

--
-- Структура таблиці `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `sku` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `qty` decimal(12,3) NOT NULL DEFAULT 0.000,
  `description` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `price`, `qty`, `description`) VALUES
(2, 'г000021', 'telephone 50', '5000.00', '34.000', '&lt;span&gt;very good phone&lt;/span&gt;'),
(3, 'г000021', 'telephone 20', '11453.00', '34.000', '&lt;span&gt;expencive mobile phone&lt;/span&gt;'),
(116, 'ty0012', 'telephone 22', '33354.00', '6.000', '&lt;a&gt;this is a good phone&lt;/a&gt;'),
(117, 'u0043', 'telephone 20', '6664.00', '4.000', '&lt;a href=&quot;&quot;&gt;very good phone&lt;/a&gt;'),
(124, 'u0007', 'kava', '333.00', '54.000', '&lt;span&gt;exclusive telephone&lt;/span&gt;');

-- --------------------------------------------------------

--
-- Структура таблиці `sales_order`
--

CREATE TABLE `sales_order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `sales_order`
--

INSERT INTO `sales_order` (`order_id`, `customer_id`, `datetime`) VALUES
(1, 1, '2019-10-25 12:34:54'),
(2, 1, '2019-10-25 12:34:54');

-- --------------------------------------------------------

--
-- Структура таблиці `sales_orderitem`
--

CREATE TABLE `sales_orderitem` (
  `orderitem_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `qty` decimal(12,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `sales_orderitem`
--

INSERT INTO `sales_orderitem` (`orderitem_id`, `order_id`, `product_id`, `qty`) VALUES
(2, 1, 2, '1.000'),
(3, 2, 3, '1.000');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Індекси таблиці `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_ORDER_CUSTOMER` (`customer_id`);

--
-- Індекси таблиці `sales_orderitem`
--
ALTER TABLE `sales_orderitem`
  ADD PRIMARY KEY (`orderitem_id`),
  ADD KEY `FK_ORDERITEM_ORDER` (`order_id`),
  ADD KEY `FK_ORDERITEM_PRODUCT` (`product_id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблиці `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблиці `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT для таблиці `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблиці `sales_orderitem`
--
ALTER TABLE `sales_orderitem`
  MODIFY `orderitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `sales_order`
--
ALTER TABLE `sales_order`
  ADD CONSTRAINT `FK_ORDER_CUSTOMER` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `sales_orderitem`
--
ALTER TABLE `sales_orderitem`
  ADD CONSTRAINT `FK_ORDERITEM_ORDER` FOREIGN KEY (`order_id`) REFERENCES `sales_order` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_ORDERITEM_PRODUCT` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
