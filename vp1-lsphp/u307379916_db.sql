-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Ноя 24 2017 г., 12:46
-- Версия сервера: 10.1.25-MariaDB
-- Версия PHP: 7.0.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `u307379916_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `street` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `home` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `part` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `appt` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `floor` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `need_change` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `payment` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `callback` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `street`, `home`, `part`, `appt`, `floor`, `comment`, `need_change`, `payment`, `callback`) VALUES
(6, 22, 'Тверская', '5', '1', '123', 4, 'С упаковкой', '', 'Оплата по карте', 'Не звонить'),
(7, 22, 'Пушкинская', '3', '4', '54', 7, 'Нет комента', 'Потребуется сдача', 'Оплата по карте', 'Не звонить'),
(8, 23, 'Ленина', '4', '2', '234', 15, 'Текст комментам', 'Потребуется сдача', 'Оплата по карте', 'Не звонить'),
(9, 23, 'Ленина', '4', '2', '234', 15, '2-й раз уже заказываю', 'Потребуется сдача', 'Оплата по карте', 'Не звонить'),
(10, 23, 'Ленина', '4', '2', '234', 15, '2-й раз уже заказываю', 'Потребуется сдача', 'Оплата по карте', 'Не звонить'),
(11, 23, 'Ленина', '4', '2', '234', 15, '2-й раз уже заказываю', 'Потребуется сдача', 'Оплата по карте', 'Не звонить'),
(12, 23, 'Ленина', '4', '2', '234', 15, '2-й раз уже заказываю', 'Потребуется сдача', 'Оплата по карте', 'Не звонить'),
(13, 23, 'Ленина', '4', '2', '234', 15, '2-й раз уже заказываю', 'Потребуется сдача', 'Оплата по карте', 'Не звонить'),
(14, 23, 'Ленина', '4', '2', '234', 15, '2-й раз уже заказываю', 'Потребуется сдача', 'Оплата по карте', 'Не звонить'),
(15, 23, 'Ленина', '4', '2', '234', 15, '2-й раз уже заказываю', 'Потребуется сдача', 'Оплата по карте', 'Не звонить'),
(16, 23, 'Ленина', '4', '2', '234', 15, '2-й раз уже заказываю', 'Потребуется сдача', 'Оплата по карте', 'Не звонить'),
(17, 23, 'Ленина', '4', '2', '234', 15, '2-й раз уже заказываю', 'Потребуется сдача', 'Оплата по карте', 'Не звонить'),
(18, 23, 'Ленина', '4', '2', '234', 15, '2-й раз уже заказываю', 'Потребуется сдача', 'Оплата по карте', 'Не звонить'),
(19, 23, 'Ленина', '4', '2', '234', 15, '2-й раз уже заказываю', 'Потребуется сдача', 'Оплата по карте', 'Не звонить'),
(20, 23, 'Ленина', '4', '2', '234', 15, '2-й раз уже заказываю', 'Потребуется сдача', 'Оплата по карте', 'Не звонить'),
(21, 23, 'Ленина', '4', '2', '234', 15, '2-й раз уже заказываю', 'Потребуется сдача', 'Оплата по карте', 'Не звонить'),
(22, 24, 'Ленина', '4', '2', '234', 15, '3-й раз уже заказываю', 'Потребуется сдача', 'Оплата по карте', 'Не звонить');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`) VALUES
(22, 'Никита', 'first@mail.ru', '+7 (333) 333 33 33'),
(23, 'Василий', 'second@mail.ru', '+7 (444) 444 44 44'),
(24, 'Василий', 'second-3@mail.ru', '+7 (444) 444 44 44');

-- --------------------------------------------------------

--
-- Структура таблицы `users_dz4`
--

CREATE TABLE `users_dz4` (
  `id` int(11) NOT NULL,
  `login` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `photo` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_dz4`
--
ALTER TABLE `users_dz4`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT для таблицы `users_dz4`
--
ALTER TABLE `users_dz4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
