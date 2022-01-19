-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 19 2022 г., 10:12
-- Версия сервера: 10.5.11-MariaDB-log
-- Версия PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `api`
--

-- --------------------------------------------------------

--
-- Структура таблицы `application`
--

CREATE TABLE `application` (
  `id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `id_Expert` int(11) NOT NULL,
  `isAccepted` tinyint(1) DEFAULT NULL,
  `id_Moderator` int(11) NOT NULL,
  `applicationcol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `application`
--

INSERT INTO `application` (`id`, `type`, `id_Expert`, `isAccepted`, `id_Moderator`, `applicationcol`) VALUES
(1, 'qdwqw', 1, 1, 1, 'wdqwdq');

-- --------------------------------------------------------

--
-- Структура таблицы `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `entity` varchar(45) NOT NULL,
  `inn` varchar(45) NOT NULL,
  `link` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `region` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL,
  `year_Foundation` varchar(45) DEFAULT NULL,
  `number_Employees` int(11) NOT NULL,
  `sales` int(11) NOT NULL,
  `image_URL` varchar(45) DEFAULT NULL,
  `id_Product` int(11) NOT NULL,
  `id_Decision_card` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `company`
--

INSERT INTO `company` (`id`, `entity`, `inn`, `link`, `email`, `tel`, `region`, `address`, `category`, `year_Foundation`, `number_Employees`, `sales`, `image_URL`, `id_Product`, `id_Decision_card`) VALUES
(1, 'erggre', 'egrgre', 'gregre', 'rgerge', 'rgergegre', 'errgegre', 'grerge', 'rgegrerge', 'ergrge', 3242, 23423, 'fwewefewf', 32532, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `decision_card`
--

CREATE TABLE `decision_card` (
  `id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL,
  `themes` varchar(45) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `efficiency` varchar(45) DEFAULT NULL,
  `image_URL` varchar(45) DEFAULT NULL,
  `id_Moderator` int(11) NOT NULL,
  `id_Expert` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `decision_card`
--

INSERT INTO `decision_card` (`id`, `type`, `title`, `themes`, `description`, `efficiency`, `image_URL`, `id_Moderator`, `id_Expert`, `created_at`) VALUES
(1, '1', 'wrfqwf', NULL, NULL, NULL, NULL, 1, 1, NULL),
(2, '2', 'fqwfw', NULL, NULL, NULL, NULL, 1, 1, NULL),
(3, '3', 'wqffwq', NULL, NULL, NULL, NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `estimations`
--

CREATE TABLE `estimations` (
  `id` int(11) NOT NULL,
  `id_Expert` int(11) NOT NULL,
  `id_Decision_card` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `estimations`
--

INSERT INTO `estimations` (`id`, `id_Expert`, `id_Decision_card`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `expert`
--

CREATE TABLE `expert` (
  `id` int(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `middle_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `birthday` int(11) DEFAULT NULL,
  `work_Experience` varchar(45) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` varchar(45) DEFAULT NULL,
  `login` varchar(45) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `about` varchar(200) DEFAULT NULL,
  `activ` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `expert`
--

INSERT INTO `expert` (`id`, `first_name`, `last_name`, `middle_name`, `email`, `birthday`, `work_Experience`, `age`, `sex`, `login`, `pass`, `about`, `activ`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1242', '2134', NULL, 0),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1234', '234', NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `id_Moderator` int(11) DEFAULT NULL,
  `id_Expert` int(11) DEFAULT NULL,
  `id_Decision_card` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `file_URL` varchar(100) DEFAULT NULL,
  `about` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`id`, `id_Moderator`, `id_Expert`, `id_Decision_card`, `type`, `file_URL`, `about`) VALUES
(1, 12, 123, 123, 1, 'wqf', 'wqffwq'),
(2, 1, 1, 1, 1, 'wqf', 'qwf'),
(3, 1, 1, 1, 2, 'fwq', 'fweq'),
(4, 1, 1, 1, 3, 'wqffwq', 'fqwfqw'),
(5, NULL, NULL, 1, 3, 'uploads/~$c6e5c92a0b0b99.docx', NULL),
(6, NULL, NULL, 1, 3, 'uploads/7ec6e5c92a0b0b99.docx', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `moderator`
--

CREATE TABLE `moderator` (
  `id` int(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `middle_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `birthday` int(11) DEFAULT NULL,
  `work_Experience` varchar(45) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` varchar(45) DEFAULT NULL,
  `login` varchar(45) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `about` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `moderator`
--

INSERT INTO `moderator` (`id`, `first_name`, `last_name`, `middle_name`, `email`, `birthday`, `work_Experience`, `age`, `sex`, `login`, `pass`, `about`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', 'admin', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `criterion1` int(11) DEFAULT NULL,
  `criterion2` int(11) DEFAULT NULL,
  `criterion3` int(11) DEFAULT NULL,
  `criterion4` int(11) DEFAULT NULL,
  `id_Decision_card` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `rating`
--

INSERT INTO `rating` (`id`, `criterion1`, `criterion2`, `criterion3`, `criterion4`, `id_Decision_card`) VALUES
(1, 32, 23, 234, 234, 1),
(2, 4, 4, 4, 4, 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_Moderator` (`id_Moderator`),
  ADD KEY `id_Expert` (`id_Expert`);

--
-- Индексы таблицы `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_Decision_card` (`id_Decision_card`);

--
-- Индексы таблицы `decision_card`
--
ALTER TABLE `decision_card`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_Moderator` (`id_Moderator`),
  ADD KEY `id_Expert` (`id_Expert`);

--
-- Индексы таблицы `estimations`
--
ALTER TABLE `estimations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_Expert` (`id_Expert`),
  ADD KEY `id_Decision_card` (`id_Decision_card`);

--
-- Индексы таблицы `expert`
--
ALTER TABLE `expert`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `moderator`
--
ALTER TABLE `moderator`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`,`pass`),
  ADD UNIQUE KEY `login_2` (`login`,`pass`),
  ADD UNIQUE KEY `login_3` (`login`,`pass`),
  ADD UNIQUE KEY `login_4` (`login`,`pass`);

--
-- Индексы таблицы `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_Decision_card` (`id_Decision_card`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `application`
--
ALTER TABLE `application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `decision_card`
--
ALTER TABLE `decision_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `estimations`
--
ALTER TABLE `estimations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `expert`
--
ALTER TABLE `expert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `moderator`
--
ALTER TABLE `moderator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`id_Moderator`) REFERENCES `moderator` (`id`),
  ADD CONSTRAINT `application_ibfk_2` FOREIGN KEY (`id_Expert`) REFERENCES `expert` (`id`);

--
-- Ограничения внешнего ключа таблицы `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`id_Decision_card`) REFERENCES `decision_card` (`id`);

--
-- Ограничения внешнего ключа таблицы `decision_card`
--
ALTER TABLE `decision_card`
  ADD CONSTRAINT `decision_card_ibfk_1` FOREIGN KEY (`id_Moderator`) REFERENCES `moderator` (`id`),
  ADD CONSTRAINT `decision_card_ibfk_2` FOREIGN KEY (`id_Expert`) REFERENCES `expert` (`id`);

--
-- Ограничения внешнего ключа таблицы `estimations`
--
ALTER TABLE `estimations`
  ADD CONSTRAINT `estimations_ibfk_1` FOREIGN KEY (`id_Expert`) REFERENCES `expert` (`id`),
  ADD CONSTRAINT `estimations_ibfk_2` FOREIGN KEY (`id_Decision_card`) REFERENCES `decision_card` (`id`);

--
-- Ограничения внешнего ключа таблицы `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`id_Decision_card`) REFERENCES `decision_card` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
