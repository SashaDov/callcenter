-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Авг 28 2017 г., 04:07
-- Версия сервера: 10.1.25-MariaDB
-- Версия PHP: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `call`
--

-- --------------------------------------------------------

--
-- Структура таблицы `calls`
--

CREATE TABLE `calls` (
  `id` int(11) NOT NULL,
  `phone_outgoing_id` int(11) DEFAULT NULL,
  `phone_incoming_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `full_name` varchar(500) NOT NULL,
  `phone_id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customer`
--

INSERT INTO `customer` (`id`, `full_name`, `phone_id`, `email`) VALUES
(1, 'Сергеев Петр Фомич', 1, 'peter@mail.ru'),
(2, 'Максим Петрович Федоров', 2, 'max@bk.ru'),
(3, 'Олег Иванович Толстой', 3, 'oleg-iv@yandex.com'),
(4, 'Павел Владимирович Плотников', 7, 'pavel@ya.ru'),
(5, 'Игорь Савельевич Петров', 8, 'igor@ya.ru'),
(6, 'Сергей Иванович Астафьев', 9, 'sers@bk.ru'),
(7, 'Дарья Степановна Кострыкина', 10, 'dasha@bk.ru'),
(8, 'Ярослав Михайлович Степанов', 11, 'yarik@mail.ru'),
(9, 'Татьяна Сергеевна Борисова', 12, 'tanya@kl.ru'),
(10, 'Петр Анатольевич Фомин', 13, 'petr@bk.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `full_name` varchar(500) NOT NULL,
  `phone_id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `login` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `employee`
--

INSERT INTO `employee` (`id`, `full_name`, `phone_id`, `email`, `login`) VALUES
(1, 'Марина Олеговна Смирнова', 4, 'admin@call.com', 'admin'),
(2, 'Наталья Даниловна Щеглова', 5, 'natasha@call.com', 'natasha'),
(3, 'Александр Дмитриевич Костров', 6, 'sasha@call.com', 'sasha');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `status` set('Забронирован','Оплачен','Сформирован','Отправлен','Получен') NOT NULL DEFAULT 'Забронирован',
  `amount` int(4) NOT NULL DEFAULT '1',
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `status`, `amount`, `customer_id`) VALUES
(1, 'Сформирован', 1, 6),
(2, 'Забронирован', 1, 7),
(3, 'Отправлен', 1, 6),
(4, 'Получен', 1, 6),
(5, 'Отправлен', 1, 6),
(6, 'Получен', 1, 6),
(7, 'Отправлен', 1, 7),
(8, 'Забронирован', 1, 8),
(9, 'Забронирован', 1, 9),
(10, 'Забронирован', 1, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `phone`
--

CREATE TABLE `phone` (
  `id` int(11) NOT NULL,
  `number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `phone`
--

INSERT INTO `phone` (`id`, `number`) VALUES
(1, '79167348723'),
(2, '79892345488'),
(3, '319175432211'),
(4, '79134455267'),
(5, '791457824578'),
(6, '79147771467'),
(7, '4647647654'),
(8, '78993453488'),
(9, '1234324325'),
(10, '789230980923'),
(11, '73452345345234'),
(12, '7934562562345'),
(13, '739405093');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `calls`
--
ALTER TABLE `calls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone_outgoing_id` (`phone_outgoing_id`),
  ADD KEY `phone_incoming_id` (`phone_incoming_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Индексы таблицы `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `phone_id` (`phone_id`);

--
-- Индексы таблицы `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emaillogin` (`email`,`login`) USING HASH,
  ADD KEY `phone_id` (`phone_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Индексы таблицы `phone`
--
ALTER TABLE `phone`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `calls`
--
ALTER TABLE `calls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `phone`
--
ALTER TABLE `phone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `calls`
--
ALTER TABLE `calls`
  ADD CONSTRAINT `calls_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `calls_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phone_incoming_id` FOREIGN KEY (`phone_incoming_id`) REFERENCES `phone` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phone_outgoing_id` FOREIGN KEY (`phone_outgoing_id`) REFERENCES `phone` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`phone_id`) REFERENCES `phone` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`phone_id`) REFERENCES `phone` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
