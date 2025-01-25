-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 21 2025 г., 03:01
-- Версия сервера: 5.6.41-log
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ams_software`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auto_body`
--

CREATE TABLE `auto_body` (
  `id` int(11) NOT NULL,
  `body` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `auto_body`
--

INSERT INTO `auto_body` (`id`, `body`) VALUES
(10, 'Внедорожник'),
(7, 'Кабриолет'),
(4, 'Купе'),
(11, 'Лимузин'),
(6, 'Микроавтобус'),
(5, 'Минивэн'),
(8, 'Пикап'),
(12, 'Самосвал'),
(2, 'Седан'),
(13, 'Тент'),
(1, 'Универсал'),
(9, 'Фургон'),
(3, 'Хэтчбэк');

-- --------------------------------------------------------

--
-- Структура таблицы `auto_brand`
--

CREATE TABLE `auto_brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Марки авто';

--
-- Дамп данных таблицы `auto_brand`
--

INSERT INTO `auto_brand` (`id`, `brand`) VALUES
(1, 'Aurus'),
(9, 'Shkoda'),
(5, 'ВАЗ'),
(7, 'ГАЗ'),
(3, 'ЗИЛ'),
(4, 'КАМАЗ');

-- --------------------------------------------------------

--
-- Структура таблицы `auto_cash_unit`
--

CREATE TABLE `auto_cash_unit` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `auto_cash_unit`
--

INSERT INTO `auto_cash_unit` (`id`, `unit_name`) VALUES
(2, '$'),
(1, 'руб');

-- --------------------------------------------------------

--
-- Структура таблицы `auto_model`
--

CREATE TABLE `auto_model` (
  `id` int(11) NOT NULL,
  `model` varchar(100) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `production_start` date DEFAULT NULL,
  `production_end` date DEFAULT NULL,
  `body_id` int(11) DEFAULT NULL,
  `image_path` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Модели авто';

--
-- Дамп данных таблицы `auto_model`
--

INSERT INTO `auto_model` (`id`, `model`, `brand_id`, `production_start`, `production_end`, `body_id`, `image_path`) VALUES
(1, '41231', 1, '2022-01-01', NULL, 11, '\\eimages\\Aurus-41231.jpg'),
(2, '4125', 1, '2022-01-01', NULL, 6, '\\images\\Aurus-4125.jpg'),
(3, '4331', 3, '1987-01-01', '2017-01-01', 12, '\\images\\ZIL-4331.jpg'),
(4, '432930', 3, '2003-01-01', NULL, 13, '\\images\\ZIL-432930.jpg'),
(5, '585', 3, '1957-01-01', '1966-01-01', 12, '\\images\\ZIL-585.jpg'),
(6, '24', 7, '1967-01-01', '1985-01-01', 2, '\\images\\GAZ-24.jpg'),
(7, '3102', 7, '1981-01-01', '2009-01-01', 2, '\\images\\GAZ-3102-sedan.jpg'),
(9, '3102', 7, '1981-01-01', '2009-01-01', 1, '\\images\\GAZ-3102-universal.jpg'),
(10, 'LADA Priora', 5, '2007-01-01', '2018-01-01', 2, '\\images\\VAZ-priora-sedan.jpg'),
(11, 'LADA XRAY', 5, '2015-12-15', '2022-01-01', 10, '\\images\\VAZ-XRAY.jpg'),
(12, 'LADA Granta', 5, '2011-11-29', NULL, 2, '\\images\\VAZ-Granta-sedan.jpg'),
(13, 'LADA Granta', 5, '2011-11-29', NULL, 3, '\\images\\VAZ-Granta-hetchback.jpg'),
(14, 'LADA Vesta', 5, '2015-09-25', NULL, 1, '\\images\\VAZ-Vesta-universal.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `auto_service`
--

CREATE TABLE `auto_service` (
  `id` int(11) NOT NULL,
  `service_name` varchar(500) NOT NULL,
  `period` float NOT NULL,
  `price` float NOT NULL,
  `unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Авто работы';

--
-- Дамп данных таблицы `auto_service`
--

INSERT INTO `auto_service` (`id`, `service_name`, `period`, `price`, `unit_id`) VALUES
(1, 'Замена масла', 0, 200, 1),
(2, 'Проверка ходовой', 1, 5000, 1),
(3, 'Ремонт двигателя', 2, 7800, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auto_body`
--
ALTER TABLE `auto_body`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UQ_AUTO_BODY_body` (`body`);

--
-- Индексы таблицы `auto_brand`
--
ALTER TABLE `auto_brand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UQ_AUTO_BRAND_brand` (`brand`);

--
-- Индексы таблицы `auto_cash_unit`
--
ALTER TABLE `auto_cash_unit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UQ_AUTO_CASH_UNIT_unit_name` (`unit_name`) USING BTREE;

--
-- Индексы таблицы `auto_model`
--
ALTER TABLE `auto_model`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_AUTO_MODEL_brand_id` (`brand_id`),
  ADD KEY `FK_AUTO_MODEL_body_id` (`body_id`);

--
-- Индексы таблицы `auto_service`
--
ALTER TABLE `auto_service`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UQ_AUTO_SERVICE_service_name` (`service_name`(255)) USING BTREE,
  ADD KEY `FK_AUTO_SERVICE_unit_id` (`unit_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `auto_body`
--
ALTER TABLE `auto_body`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `auto_brand`
--
ALTER TABLE `auto_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `auto_cash_unit`
--
ALTER TABLE `auto_cash_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `auto_model`
--
ALTER TABLE `auto_model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `auto_service`
--
ALTER TABLE `auto_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auto_model`
--
ALTER TABLE `auto_model`
  ADD CONSTRAINT `FK_AUTO_MODEL_body_id` FOREIGN KEY (`body_id`) REFERENCES `auto_body` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_AUTO_MODEL_brand_id` FOREIGN KEY (`brand_id`) REFERENCES `auto_brand` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auto_service`
--
ALTER TABLE `auto_service`
  ADD CONSTRAINT `FK_AUTO_SERVICE_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `auto_cash_unit` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
