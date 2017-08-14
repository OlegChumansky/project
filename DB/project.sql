-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Авг 14 2017 г., 11:44
-- Версия сервера: 10.1.21-MariaDB
-- Версия PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `day` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `user_school` int(11) NOT NULL,
  `user_class` varchar(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lessons`
--

INSERT INTO `lessons` (`id`, `name`, `day`, `number`, `user_school`, `user_class`, `date`) VALUES
(14, 'цкпкупукур', 0, 0, 23, '9-а', '2017-08-14 07:26:44'),
(15, 'trhrthte', 0, 1, 23, '9-а', '2017-08-14 07:28:08'),
(16, 'rthrthre', 0, 2, 23, '9-а', '2017-08-14 07:28:10'),
(17, 'rthrehtre', 0, 3, 23, '9-а', '2017-08-14 07:28:11'),
(18, 'керруокуо', 0, 0, 20, '8-а', '2017-08-14 07:29:05'),
(19, 'кеоукоуко', 0, 1, 20, '8-а', '2017-08-14 07:29:07'),
(20, 'кокуокууко', 0, 2, 20, '8-а', '2017-08-14 07:29:09'),
(21, 'укоуеукоукуео', 0, 3, 20, '8-а', '2017-08-14 07:29:12'),
(22, 'енулнуелуел', 0, 4, 20, '8-а', '2017-08-14 07:29:53'),
(23, 'енулеунл', 0, 5, 20, '8-а', '2017-08-14 07:29:54');

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `day` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `user_school` int(11) NOT NULL,
  `user_class` varchar(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`id`, `name`, `day`, `number`, `user_school`, `user_class`, `date`) VALUES
(4, 'неа', 0, 0, 20, '10-a', '2017-08-14 08:13:29'),
(5, 'rthrther', 0, 0, 23, '9-а', '2017-08-14 08:28:12'),
(6, 'rtherherh', 0, 1, 23, '9-а', '2017-08-14 08:28:14'),
(7, 'rehrtrte', 0, 2, 23, '9-а', '2017-08-14 08:28:15'),
(8, 'rthrehrehrt', 0, 3, 23, '9-а', '2017-08-14 08:28:16'),
(10, 'нглглн', 0, 1, 20, '8-а', '2017-08-14 08:29:46'),
(11, 'нелнеуленлуенул', 0, 2, 20, '8-а', '2017-08-14 08:29:48'),
(12, 'енулуенлунел', 0, 3, 20, '8-а', '2017-08-14 08:29:50'),
(13, 'енулнуелунел', 0, 4, 20, '8-а', '2017-08-14 08:29:51'),
(14, 'енлеулуенлнуелуенл', 0, 5, 20, '8-а', '2017-08-14 08:29:56'),
(15, 'егллгн', 0, 0, 20, '8-а', '2017-08-14 08:35:15');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `user_family` varchar(256) NOT NULL,
  `user_school` int(5) NOT NULL,
  `user_class` text NOT NULL,
  `user_password` text NOT NULL,
  `user_date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `user_name`, `user_family`, `user_school`, `user_class`, `user_password`, `user_date_add`) VALUES
(1, 'hwehwerh', 'erg', 'reghrehwer', 20, '10-а', '1aabac6d068eef6a7bad3fdf50a05cc8', '2017-08-14 08:24:44'),
(2, 'укпкупукп', 'кпук', 'пкупукп', 23, '9-а', '1aabac6d068eef6a7bad3fdf50a05cc8', '2017-08-14 08:26:39'),
(3, 'trhrh', 'thtw', 'htwtrh', 20, '8-а', '633de4b0c14ca52ea2432a3c8a5c4c31', '2017-08-14 08:29:02');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
