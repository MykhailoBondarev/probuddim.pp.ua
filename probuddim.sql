-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Гру 19 2018 р., 17:26
-- Версія сервера: 5.7.20
-- Версія PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `probuddim`
--

-- --------------------------------------------------------

--
-- Структура таблиці `email_settings`
--

CREATE TABLE `email_settings` (
  `id` int(11) NOT NULL,
  `template_name` varchar(128) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `use_smtp` int(2) NOT NULL DEFAULT '0',
  `use_smtp_auth` int(11) NOT NULL DEFAULT '0',
  `host` varchar(128) NOT NULL,
  `port` int(11) NOT NULL,
  `server_login` varchar(64) NOT NULL,
  `server_password` varchar(64) NOT NULL,
  `encryption` varchar(8) NOT NULL,
  `active` int(2) DEFAULT '0',
  `sender_email` varchar(64) NOT NULL,
  `sender_displayname` varchar(64) NOT NULL,
  `smtp_mode` int(11) NOT NULL DEFAULT '0',
  `ishtml` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `email_settings`
--

-- --------------------------------------------------------

--
-- Структура таблиці `maillog`
--

CREATE TABLE `maillog` (
  `id` int(11) NOT NULL,
  `sent_date` datetime NOT NULL,
  `sent_data` text NOT NULL,
  `mailserver_respond` varchar(1024) NOT NULL,
  `client_name` varchar(128) NOT NULL,
  `client_phone` bigint(16) NOT NULL,
  `client_email` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `maillog`
--

-- --------------------------------------------------------

--
-- Структура таблиці `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Адмін'),
(2, 'Модератор'),
(3, 'Учасник');

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `avatar_url` varchar(512) DEFAULT NULL,
  `last_login` datetime NOT NULL,
  `last_ip` varchar(24) DEFAULT NULL,
  `last_session_id` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `users`
--

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Індекси таблиці `maillog`
--
ALTER TABLE `maillog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Індекси таблиці `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблиці `maillog`
--
ALTER TABLE `maillog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблиці `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
