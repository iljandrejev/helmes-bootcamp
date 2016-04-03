-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Апр 03 2016 г., 22:16
-- Версия сервера: 10.1.10-MariaDB
-- Версия PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `reservations`
--

-- --------------------------------------------------------

--
-- Структура таблицы `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `reservation_datetime` datetime NOT NULL,
  `duration` float(2,1) NOT NULL,
  `guests_number` int(50) NOT NULL,
  `reservation_way` enum('email','phone','other','') COLLATE utf8_unicode_ci NOT NULL,
  `person_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `person_phone` int(10) DEFAULT NULL,
  `details` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `reservation_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('created','modified','canceled') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'created',
  `last_modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `reservation`
--

INSERT INTO `reservation` (`id`, `restaurant_id`, `reservation_datetime`, `duration`, `guests_number`, `reservation_way`, `person_name`, `person_phone`, `details`, `reservation_added`, `status`, `last_modified`) VALUES
(19, 10, '2016-04-13 10:30:00', 0.5, 2, 'phone', 'Ilja', 55555555, 'nothing', '2016-04-01 22:20:21', 'canceled', '2016-04-02 19:27:25'),
(24, 9, '2016-04-20 13:30:00', 0.5, 1, 'phone', 'Maldfkjg', NULL, '', '2016-04-02 01:22:42', 'modified', '2016-04-02 19:53:40'),
(25, 11, '2016-04-15 23:35:00', 1.0, 4, 'phone', 'Peeter Mingi', 55565656, 'Soovib lauda akna juures', '2016-04-03 19:04:52', 'created', NULL),
(26, 10, '2016-04-15 10:30:00', 1.5, 2, 'email', 'Kristiina Lady', NULL, 'needs baby chair', '2016-04-03 19:11:36', 'created', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `restaurants`
--

CREATE TABLE `restaurants` (
  `restaurant_id` int(11) NOT NULL,
  `restaurant_name` varchar(30) DEFAULT NULL,
  `aadress` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `restaurants`
--

INSERT INTO `restaurants` (`restaurant_id`, `restaurant_name`, `aadress`) VALUES
(9, 'Tartu kohvik', 'Tartu  maantee 7'),
(10, 'Pirita kohvik', 'Pirita tee  5'),
(11, 'Mustamäe kohvik', 'Mustamäe tee 29');

-- --------------------------------------------------------

--
-- Структура таблицы `restaurant_table`
--

CREATE TABLE `restaurant_table` (
  `table_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `table_number` int(11) NOT NULL,
  `max_seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Индексы таблицы `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`restaurant_id`);

--
-- Индексы таблицы `restaurant_table`
--
ALTER TABLE `restaurant_table`
  ADD PRIMARY KEY (`table_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT для таблицы `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `restaurant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `restaurant_table`
--
ALTER TABLE `restaurant_table`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
