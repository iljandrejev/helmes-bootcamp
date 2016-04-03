-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Апр 03 2016 г., 17:40
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
(20, 10, '2016-04-11 10:30:00', 0.5, 4, 'phone', 'Teine inimene', NULL, 'ekrjger', '2016-04-01 22:44:22', 'canceled', '2016-04-02 12:13:03'),
(22, 10, '2016-04-21 11:30:00', 2.0, 1, 'phone', 'Name', NULL, 'laksj', '2016-04-01 22:48:58', 'created', NULL),
(24, 9, '2016-04-20 13:30:00', 0.5, 1, 'phone', 'Maldfkjg', NULL, '', '2016-04-02 01:22:42', 'modified', '2016-04-02 19:53:40');

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
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT для таблицы `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `restaurant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
