-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.2
-- Время создания: Мар 07 2025 г., 23:04
-- Версия сервера: 8.2.0
-- Версия PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `library`
--

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

CREATE TABLE `author` (
  `id_author` int NOT NULL,
  `surname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patr` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`id_author`, `surname`, `name`, `patr`, `birth`) VALUES
(1, 'Толстой ', 'Лев', 'Николаевич', '1828-09-09'),
(2, 'Достоевский', 'Федор', 'Михайлович', '1821-11-11'),
(13, 'Толстой', 'Лев', 'Николаевич', '1828-09-09'),
(14, 'Достоевский', 'Фёдор', 'Михайлович', '1821-11-11'),
(15, 'Пушкин', 'Александр', 'Сергеевич', '1799-06-06'),
(16, 'Гоголь', 'Николай', 'Васильевич', '1809-03-31'),
(17, 'Чехов', 'Антон', 'Павлович', '1860-01-29'),
(18, 'Булгаков', 'Михаил', 'Афанасьевич', '1891-05-15'),
(19, 'Шекспир', 'Уильям', '', '1564-04-26'),
(20, 'Оруэлл', 'Джордж', '', '1903-06-25'),
(21, 'Хемингуэй', 'Эрнест', '', '1899-07-21'),
(22, 'Роулинг', 'Джоан', '', '1965-07-31'),
(23, 'Пушкин', 'Александр', 'Сергеевич', '1799-06-06'),
(24, 'Гоголь', 'Николай', 'Васильевич', '1809-03-31'),
(25, 'Чехов', 'Антон', 'Павлович', '1860-01-29'),
(26, 'Булгаков', 'Михаил', 'Афанасьевич', '1891-05-15'),
(27, 'Шекспир', 'Уильям', NULL, '1564-04-26'),
(28, 'Оруэлл', 'Джордж', NULL, '1903-06-25'),
(29, 'Хемингуэй', 'Эрнест', NULL, '1899-07-21'),
(30, 'Роулинг', 'Джоан', NULL, '1965-07-31');

-- --------------------------------------------------------

--
-- Структура таблицы `book`
--

CREATE TABLE `book` (
  `id` int NOT NULL,
  `title` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `written` int NOT NULL,
  `id_genre` int NOT NULL,
  `id_author` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `book`
--

INSERT INTO `book` (`id`, `title`, `written`, `id_genre`, `id_author`) VALUES
(85, 'Анна Каренина', 1877, 1, 1),
(86, 'Евгений Онегин', 1833, 2, 15),
(87, 'Мёртвые души', 1842, 1, 16),
(88, 'Вишнёвый сад', 1903, 5, 17),
(89, 'Старик и море', 1952, 1, 21),
(90, 'Гамлет', 1603, 5, 19),
(91, 'Ревизор', 1836, 5, 16),
(92, 'Собачье сердце', 1925, 3, 18),
(93, 'Ромео и Джульетта', 1597, 5, 19),
(94, 'Скотный двор', 1945, 3, 20),
(95, 'Игрок', 1866, 1, 2),
(96, 'Записки из подполья', 1864, 1, 2),
(97, 'Руслан и Людмила', 1820, 2, 15),
(98, 'Медный всадник', 1833, 2, 15),
(99, 'Шинель', 1842, 1, 16),
(100, 'Тарас Бульба', 1835, 6, 16),
(101, 'Дама с собачкой', 1899, 1, 17),
(102, 'Палата №6', 1892, 1, 17),
(103, 'Дни Турбиных', 1926, 5, 18),
(104, 'Отелло', 1604, 5, 19),
(105, 'Фауст', 1808, 5, 19),
(106, 'Повелитель мух', 1954, 6, 20),
(107, 'По ком звонит колокол', 1940, 1, 21),
(108, 'Гарри Поттер: Тайная комната', 1998, 8, 22),
(109, 'Улисс', 1922, 1, 19);

-- --------------------------------------------------------

--
-- Структура таблицы `genre`
--

CREATE TABLE `genre` (
  `id_genre` int NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `genre`
--

INSERT INTO `genre` (`id_genre`, `name`) VALUES
(1, 'Роман'),
(2, 'Поэзия'),
(3, 'Фантастика'),
(4, 'Детектив'),
(5, 'Драма'),
(6, 'Приключения'),
(7, 'Ужасы'),
(8, 'Фэнтези'),
(9, 'Проза'),
(10, 'Биография'),
(11, 'Исторический'),
(12, 'Научная');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(5, 'qwerty', '$2y$10$0yrWqp4qGS2WSWVS98JVFO2anhqD7YjUvjBZ9kQglMbcy1abgcjMq');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id_author`);

--
-- Индексы таблицы `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_author` (`id_author`),
  ADD KEY `id_genre` (`id_genre`);

--
-- Индексы таблицы `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id_genre`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `author`
--
ALTER TABLE `author`
  MODIFY `id_author` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `book`
--
ALTER TABLE `book`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT для таблицы `genre`
--
ALTER TABLE `genre`
  MODIFY `id_genre` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`id_author`) REFERENCES `author` (`id_author`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
