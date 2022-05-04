

CREATE DATABASE IF NOT EXISTS `pdo_var0` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pdo_var0`;

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
--  таблица `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(1, 'Таненбаум Э.'),
(2, 'Ying Bai'),
(3, 'А. Чиртик'),
(4, 'В. Борисок'),
(6, 'Ю. Корвель');

-- --------------------------------------------------------

--
--  таблица `book_authors`
--

CREATE TABLE `book_authors` (
  `fid_book` int(11) NOT NULL,
  `fid_authors` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- таблица `book_authors`
--

INSERT INTO `book_authors` (`fid_book`, `fid_authors`) VALUES
(1, 1),
(4, 2),
(7, 3),
(7, 4),
(7, 6);

-- --------------------------------------------------------

--
--  таблица `literature`
--

CREATE TABLE `literature` (
  `id_book` int(11) NOT NULL,
  `name` text NOT NULL,
  `publication_date` date NOT NULL,
  `publisher` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `journal number` int(11) DEFAULT NULL,
  `type` enum('Book','Journal','Newspaper','') NOT NULL,
  `fid_resourse` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- таблица `literature`
--

INSERT INTO `literature` (`id_book`, `name`, `publication_date`, `publisher`, `quantity`, `ISBN`, `journal number`, `type`, `fid_resourse`) VALUES
(1, 'Современные операционные системы (4е изд.)', '2015-01-01', 'Питер', 5, '978-5-888-15497-6', 0, 'Book', NULL),
(2, 'Вести Дергачевщины', '2020-09-01', 'Дергачевское издание', 20, '', 0, 'Newspaper', NULL),
(3, 'Человек паук герои и злодеи', '2014-10-14', 'Disney', 2, '654-5-888-15497-6', 17, 'Journal', 1),
(4, 'Practical Database Programming with Java', '2011-02-03', 'Institute of Electrical and Electronics Engineers, Inc.', 3, '978-0-470-88940-4', NULL, 'Book', NULL),
(5, 'Eva', '2016-07-05', 'Eva Incorporation', 1, '978-5-496-01395-7', 32, 'Journal', 3),
(6, 'Симон', '2021-03-07', 'Харьков', 50, '978-5-496-01382-3', NULL, 'Newspaper', NULL),
(7, 'Delphi. Трюки и эффекты (+CD)', '2007-05-18', 'Питер', 1, '978-5-91180-219-6', NULL, 'Book', 2);

-- --------------------------------------------------------

--
-- таблица `resourse`
--

CREATE TABLE `resourse` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
--таблица `resourse`
--

INSERT INTO `resourse` (`id`, `title`) VALUES
(1, 'карточки'),
(2, 'Compact Disk'),
(3, 'Пробный маленький флакончик духов');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `book_authors`
--
ALTER TABLE `book_authors`
  ADD PRIMARY KEY (`fid_book`,`fid_authors`),
  ADD KEY `fid_authors` (`fid_authors`);

--
-- Индексы таблицы `literature`
--
ALTER TABLE `literature`
  ADD PRIMARY KEY (`id_book`),
  ADD UNIQUE KEY `fid_resourse` (`fid_resourse`);

--
-- Индексы таблицы `resourse`
--
ALTER TABLE `resourse`
  ADD PRIMARY KEY (`id`);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `book_authors`
--
ALTER TABLE `book_authors`
  ADD CONSTRAINT `book_authors_ibfk_1` FOREIGN KEY (`fid_authors`) REFERENCES `authors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_authors_ibfk_2` FOREIGN KEY (`fid_book`) REFERENCES `literature` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `literature`
--
ALTER TABLE `literature`
  ADD CONSTRAINT `literature_ibfk_1` FOREIGN KEY (`fid_resourse`) REFERENCES `resourse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
