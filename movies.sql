-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 22 2018 г., 16:40
-- Версия сервера: 5.6.38
-- Версия PHP: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `movies`
--

-- --------------------------------------------------------

--
-- Структура таблицы `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `url` varchar(200) NOT NULL COMMENT 'URL',
  `title_ru` varchar(500) NOT NULL COMMENT 'Заголовок рус',
  `title_en` varchar(500) NOT NULL COMMENT 'Заголовок анг',
  `text_ru` text NOT NULL COMMENT 'Текст рус',
  `text_en` text NOT NULL COMMENT 'Текст анг'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `info`
--

INSERT INTO `info` (`id`, `url`, `title_ru`, `title_en`, `text_ru`, `text_en`) VALUES
(1, 'about_us', 'О нас', 'About us', 'Обо мне Обо мне Обо мне Обо мне Обо мне Обо мне Обо мне Обо мне Обо мне Обо мне Обо мне Обо мне Обо мне Обо мне Обо мне Обо мне Обо мне Обо мне Обо мне Обо мне Обо мне Обо мне Обо мне Обо мне ', 'About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us About us '),
(2, 'error_404', 'Страница не найдена! Ошибка 404', 'Page not found! Error 404', 'Ошибка 404', 'Error 404');

-- --------------------------------------------------------

--
-- Структура таблицы `relationship`
--

CREATE TABLE `relationship` (
  `id` int(11) NOT NULL,
  `u_from` int(11) NOT NULL COMMENT 'Первый юзер',
  `u_to` int(11) NOT NULL COMMENT 'Второй юзер'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `relationship`
--

INSERT INTO `relationship` (`id`, `u_from`, `u_to`) VALUES
(1, 2, 1),
(4, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL COMMENT 'ID',
  `nick` varchar(30) NOT NULL COMMENT 'Никнейм',
  `pass` varchar(50) NOT NULL COMMENT 'Пароль',
  `email` varchar(150) NOT NULL COMMENT 'Почта',
  `web_page` varchar(150) NOT NULL COMMENT 'Ссылка на сайт',
  `photo` varchar(150) NOT NULL DEFAULT 'empty.png' COMMENT 'Аватар',
  `full_name` varchar(200) NOT NULL COMMENT 'ФИО',
  `reg_time` date NOT NULL COMMENT 'Дата рег.',
  `sex` varchar(10) NOT NULL DEFAULT 'genderless' COMMENT 'Пол',
  `rights` int(11) NOT NULL DEFAULT '0' COMMENT 'Права (тип)',
  `bg` varchar(10) NOT NULL DEFAULT 'bg0.png' COMMENT 'Задний фон'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`uid`, `nick`, `pass`, `email`, `web_page`, `photo`, `full_name`, `reg_time`, `sex`, `rights`, `bg`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'madiyar.bolatov97@gmail.com', 'https://nomadao.github.io', '1.png', 'Мадияр Болатов', '2018-06-01', 'mars', 1, 'bg5.png'),
(2, 'Decim', '950cd139eef3c8562cafb4bdc4d30a45', '', '', 'empty.png', '', '2018-07-10', 'genderless', 0, 'bg0.png');

-- --------------------------------------------------------

--
-- Структура таблицы `user_list`
--

CREATE TABLE `user_list` (
  `id` int(11) NOT NULL,
  `title_id` int(11) NOT NULL COMMENT 'ID фильма',
  `media_type` int(11) NOT NULL DEFAULT '1' COMMENT 'Фильм/сериал',
  `user_id` int(11) NOT NULL COMMENT 'ID юзера',
  `state` varchar(50) NOT NULL DEFAULT 'planned' COMMENT 'Состояние',
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_list`
--

INSERT INTO `user_list` (`id`, `title_id`, `media_type`, `user_id`, `state`, `date`) VALUES
(1, 2190, 2, 1, 'watching', '2018-08-09 11:27:00'),
(2, 269149, 1, 1, 'completed', '2018-08-09 04:25:22'),
(3, 399174, 1, 1, 'planned', '2018-08-12 22:18:26'),
(4, 246, 2, 1, 'completed', '2018-08-13 20:48:08'),
(5, 260513, 1, 1, 'planned', '2018-08-17 00:04:59'),
(6, 354912, 1, 1, 'completed', '2018-08-17 00:28:11'),
(7, 109445, 1, 1, 'completed', '2018-08-17 00:30:03'),
(8, 8392, 1, 1, 'completed', '2018-08-17 00:32:42'),
(9, 38757, 1, 1, 'completed', '2018-08-17 00:37:33');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `relationship`
--
ALTER TABLE `relationship`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- Индексы таблицы `user_list`
--
ALTER TABLE `user_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `relationship`
--
ALTER TABLE `relationship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user_list`
--
ALTER TABLE `user_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
