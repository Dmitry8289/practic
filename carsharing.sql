-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 12 2023 г., 09:12
-- Версия сервера: 10.8.4-MariaDB
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `carsharing`
--

-- --------------------------------------------------------

--
-- Структура таблицы `car`
--

CREATE TABLE `car` (
  `id` int(11) NOT NULL,
  `brand` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int(4) NOT NULL,
  `plate_number` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vin` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `owner_id` int(11) NOT NULL,
  `engine_litre` float NOT NULL,
  `oil_type` int(11) NOT NULL,
  `horse_power` int(4) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `image` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `car`
--

INSERT INTO `car` (`id`, `brand`, `model`, `year`, `plate_number`, `vin`, `user_id`, `owner_id`, `engine_litre`, `oil_type`, `horse_power`, `status`, `image`) VALUES
(1, 'Toyota', 'RAV-4', 2022, 'А513РО45', 'V7865DEF4D3211UIK', NULL, 2, 3.1, 1, 156, 1, 'toyota-rav-4.jpeg'),
(2, 'Tesla', 'Model S', 2021, 'Н900ХТ199', 'I999UI45R5T5IMB78', NULL, 2, 0, 5, 362, 1, 'tesla-model-x.jpg'),
(3, 'Toyota', 'Corolla', 2019, 'К916ХТ96', 'UI8912EO09112WE56', NULL, 2, 2.1, 7, 165, 1, NULL),
(4, 'Toyota', 'Avensis', 2006, 'К440АА199', 'OM9245Y6UIN7844RT', NULL, 1, 2.1, 1, 150, 1, 'pictures_toyota_avensis_2006_7.jpg'),
(5, 'Mitsubishi', 'Lancer', 2007, 'С515ЕЕ72', 'PIIN657TR4556CCIM', NULL, 2, 2.4, 1, 135, 1, NULL),
(6, 'Mitsubishi', 'Lancer', 2010, 'Н004ВА96', 'JIIM45211WERK517', NULL, 2, 2.4, 7, 145, 1, NULL),
(11, 'BMW', 'X3', 2019, 'К199ВА72', 'IKL3510ICP07YI345', 3, 2, 3, 1, 219, 0, 'e1f7b8061194027a2d62c616307164e8.jpeg'),
(12, 'Geely', 'Monjaro', 2022, 'Т627ЕУ199', 'R57890IUJE34A&88K', 2, 3, 2, 1, 238, 0, '1200x900n.jpeg'),
(13, 'Geely', 'Emgrand', 2023, 'В612АР49', 'TUJ784H09LJ34D674', NULL, 3, 1, 1, 122, 1, 'geely_emgrand.jpeg');

-- --------------------------------------------------------

--
-- Структура таблицы `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`) VALUES
(1, 'Дмитрий', 'dmpredein@yandex.ru', 'Хай'),
(2, 'Дмитрий', 'dmpredein@yandex.ru', 'Привет'),
(3, 'Дмитрий', 'dmpredein@yandex.ru', 'Моё сообщение.Моё сообщение.Моё сообщение.Моё сообщение.');

-- --------------------------------------------------------

--
-- Структура таблицы `oil`
--

CREATE TABLE `oil` (
  `id` int(11) NOT NULL,
  `type` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `oil`
--

INSERT INTO `oil` (`id`, `type`) VALUES
(1, 'Бензин'),
(2, 'Дизель'),
(3, 'Гибрид (бензин-дизель)'),
(4, 'Гибрид (бензин-электро)'),
(5, 'Электро'),
(6, 'Водород'),
(7, 'Гибрид (бензин-газ)'),
(8, 'Газ');

-- --------------------------------------------------------

--
-- Структура таблицы `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `car_id` int(11) NOT NULL,
  `start_date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `reservation`
--

INSERT INTO `reservation` (`id`, `user_id`, `car_id`, `start_date`, `end_date`) VALUES
(8, 3, 11, '02.12.2023', '03.12.2023'),
(9, 2, 12, '15.12.2023', '18.12.2023');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patronymic` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport_number` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `surname`, `patronymic`, `email`, `phone`, `passport_number`, `role`) VALUES
(1, 'admin', 'admin11', 'admin', 'admin', NULL, 'admin@email.com', '+79999999999', '00 00 000000', 1),
(2, 'alexDmitr', 'user2.11', 'Алексей', 'Дмитров', 'Васильевич', 'alexdmvas33@mail.ru', '+7 (919) 555-34-12', '35 24 112334', 0),
(3, 'super.user', 'user3.11', 'Super', 'Super', 'Super', 'super.email@email.com', '+7 (938) 292-02-12', '23 09 134567', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oil_type` (`oil_type`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Индексы таблицы `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `oil`
--
ALTER TABLE `oil`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `car`
--
ALTER TABLE `car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `oil`
--
ALTER TABLE `oil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`oil_type`) REFERENCES `oil` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `car_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `car_ibfk_3` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
