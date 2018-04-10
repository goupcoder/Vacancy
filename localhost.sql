-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 22 2014 г., 14:51
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `work`
--
CREATE DATABASE `work` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `work`;

-- --------------------------------------------------------

--
-- Структура таблицы `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `lvl` smallint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Дамп данных таблицы `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `pass`, `lvl`) VALUES
(1, 'egorov', 'egorov', 1),
(7, 'dbcnx11', 'dbcnx11', 1),
(6, 'dbcnx', 'dbcnx', 0),
(8, 'dbcnx111', 'dbcnx111', 1),
(9, '1234567', '1234567', 1),
(10, '12345678', '12345678', 1),
(11, 'roshan', 'roshan', 0),
(12, 'specialnosti', 'specialnosti', 0),
(13, 'specialnosti1', 'specialnosti1', 0),
(14, 'specialnosti11', 'specialnosti11', 0),
(15, 'specialnosti111', 'specialnosti111', 0),
(16, 'specialnosti1111', 'specialnosti1111', 0),
(17, 'serega', 'serega', 0),
(18, 'sergey', 'sergey', 0),
(19, 'sergey1234', 'sergey1234', 0),
(20, 'ikya', 'ikya', 0),
(21, 'gagaga', 'gagaga', 0),
(22, 'gagagagagaga', 'gagagagagaga', 0),
(23, 'asdfg', 'asdfg', 0),
(24, 'bold', 'bold', 1),
(25, 'dota', 'dota', 0),
(26, 'dota2', 'dota2', 0),
(27, 'login', 'login', 0),
(28, 'abra', 'abra', 0),
(29, 'cadabra', 'cadabra', 0),
(30, 'loggg', 'loggg', 0),
(31, 'lkjhg', 'lkjhg', 1),
(32, 'pouuyu', 'pouuyu', 1),
(33, 'zzzzzzz', 'zzzzzzz', 1),
(34, 'zzzz', 'zzzz', 1),
(35, 'zxxcz', 'zxxcz', 0),
(36, 'fghff', 'fghff', 0),
(37, 'jhgdf', 'jhgdf', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `dolgnosti`
--

CREATE TABLE IF NOT EXISTS `dolgnosti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nm` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `dolgnosti`
--

INSERT INTO `dolgnosti` (`id`, `nm`) VALUES
(1, 'Разработчик приложений'),
(2, 'Администратор баз данных'),
(3, 'Специалист в сфере систем управления предприятием'),
(4, 'Аналитик баз данных'),
(5, 'Сетевой администратор'),
(6, 'Педагог'),
(7, 'Тренер'),
(8, 'Переводчик'),
(9, 'Педагог-организатор'),
(10, 'Специалист по лингвистике'),
(11, 'Воспитатель'),
(12, 'Экономист'),
(13, 'Бухгалтер'),
(14, 'Аналитик'),
(15, 'Менеджер'),
(16, 'Геодезист');

-- --------------------------------------------------------

--
-- Структура таблицы `inform_data`
--

CREATE TABLE IF NOT EXISTS `inform_data` (
  `id` int(11) NOT NULL,
  `fio` text NOT NULL,
  `nm` text NOT NULL,
  `otch` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='основные данные';

--
-- Дамп данных таблицы `inform_data`
--

INSERT INTO `inform_data` (`id`, `fio`, `nm`, `otch`, `email`, `phone`, `address`) VALUES
(12, 'specialnosti', 'specialnosti', '', 'specialnosti', 'телефона', 'Адрес'),
(13, 'specialnosti', 'specialnosti', '', 'specialnosti', '', ''),
(14, 'specialnosti11', 'specialnosti11', 'specialnosti11', '', '', ''),
(15, 'specialnosti11', 'specialnosti11', 'specialnosti11', '', '', ''),
(16, 'specialnosti1111', 'specialnosti1111', '', '', '', ''),
(17, 'r.', 'serega', 'g.', 'serega@serega', '', ''),
(18, 'sergey', 'sergey', '', '', '', ''),
(19, 'sergey1234', 'sergey1234', '', '', '', ''),
(20, 'ikya', 'ikya', '', '', '', ''),
(21, 'gagaga', 'gagaga', '', '', '', ''),
(22, 'gagagagagaga', 'gagagagagaga', '', '', '', ''),
(23, 'asdfg', 'asdfg', '', '', '', ''),
(24, 'egorov', 'egorov', '', '', 'фоновый', 'адрес'),
(25, 'dota', 'dota', '', '', '', ''),
(26, 'dota2', 'dota2', '', '', 'телефо', 'Адре'),
(27, 'фамилия', 'имя', '', '', '', ''),
(28, 'abra', 'abra', '', '', '', ''),
(29, 'cadabra', 'cadabra', '', '', '', ''),
(30, 'loggg', 'loggg', '', '', '', ''),
(31, 'asdfg', 'asdfg', '', '', '', ''),
(32, 'pouuyu', 'pouuyu', '', '', '', ''),
(33, 'zzzzzzz', 'zzzzzzz', 'zzzzzzz', '', '', ''),
(34, 'zzzz', 'zzzz', '', '', '', ''),
(35, 'zxxcz', 'zxxcz', '', '', '', ''),
(36, 'fghff', 'fghff', '', '', '', ''),
(37, 'jhgdf', 'jhgdf', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `specialnosti`
--

CREATE TABLE IF NOT EXISTS `specialnosti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `specialnosti`
--

INSERT INTO `specialnosti` (`id`, `name`) VALUES
(1, 'Русский язык и литература'),
(2, 'Иностранный язык'),
(3, 'Прикладная математика и информатика'),
(4, 'Физическая культура'),
(5, 'Начальное образование и информатика'),
(6, 'Экономика'),
(7, 'Государственное и муниципальное управление'),
(8, 'Управление персоналом'),
(9, 'Землеустройство и кадастры'),
(10, 'Менеджмент');

-- --------------------------------------------------------

--
-- Структура таблицы `spheres`
--

CREATE TABLE IF NOT EXISTS `spheres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nm` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `spheres`
--

INSERT INTO `spheres` (`id`, `nm`) VALUES
(1, 'Проектная и производственно-технологическая деятельность'),
(2, 'Научная и научно-исследовательская деятельность'),
(3, 'Организационно-управленческая деятельность'),
(4, 'Социально-ориентированная деятельность'),
(5, 'Педагогическая деятельность');

-- --------------------------------------------------------

--
-- Структура таблицы `student_data`
--

CREATE TABLE IF NOT EXISTS `student_data` (
  `id` int(11) NOT NULL,
  `date_rozd` date NOT NULL,
  `specialnost` int(11) NOT NULL,
  `god_okonch` varchar(4) NOT NULL,
  `inyaz` text NOT NULL,
  `navyki` text NOT NULL,
  `interesy` text NOT NULL,
  `pk` text NOT NULL,
  `sport` text NOT NULL,
  `public` int(1) NOT NULL,
  `date_publ` date NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='студент описание';

--
-- Дамп данных таблицы `student_data`
--

INSERT INTO `student_data` (`id`, `date_rozd`, `specialnost`, `god_okonch`, `inyaz`, `navyki`, `interesy`, `pk`, `sport`, `public`, `date_publ`) VALUES
(24, '2014-06-06', 1, '2014', '', '', '', '', '', 0, '0000-00-00'),
(25, '0000-00-00', 0, '', '', '', '', '', '', 0, '0000-00-00'),
(26, '2011-04-04', 2, '2003', 'Иностранны', 'Профессиональны', 'Интерес', 'Владени', 'Спортивны', 1, '2014-06-11'),
(27, '0000-00-00', 0, '', '', '', '', '', '', 0, '0000-00-00'),
(28, '0000-00-00', 0, '', '', '', '', '', '', 0, '0000-00-00'),
(29, '0000-00-00', 0, '', '', '', '', '', '', 0, '0000-00-00'),
(30, '0000-00-00', 0, '', '', '', '', '', '', 0, '0000-00-00'),
(31, '0000-00-00', 0, '', '', '', '', '', '', 0, '0000-00-00'),
(32, '0000-00-00', 0, '', '', '', '', '', '', 0, '0000-00-00'),
(33, '0000-00-00', 0, '', '', '', '', '', '', 0, '0000-00-00'),
(34, '0000-00-00', 0, '', '', '', '', '', '', 0, '0000-00-00'),
(35, '0000-00-00', 0, '', '', '', '', '', '', 0, '0000-00-00'),
(36, '0000-00-00', 0, '', '', '', '', '', '', 0, '0000-00-00'),
(37, '0000-00-00', 0, '', '', '', '', '', '', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Структура таблицы `vacancies`
--

CREATE TABLE IF NOT EXISTS `vacancies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `txt` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  `date` date NOT NULL,
  `workgiver_id` int(11) NOT NULL,
  `dolgnost_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `vacancies`
--

INSERT INTO `vacancies` (`id`, `txt`, `active`, `date`, `workgiver_id`, `dolgnost_id`) VALUES
(1, '', 1, '2013-12-25', 24, 3),
(2, 'Инженер', 1, '2013-12-24', 24, 0),
(3, 'Менеджер', 1, '2014-06-09', 24, 0),
(4, 'Техни', 1, '2014-06-09', 24, 0),
(5, 'Техни', 1, '2014-06-09', 24, 0),
(6, 'Техни', 1, '2014-06-09', 24, 0),
(7, 'Техни', 1, '2014-06-09', 24, 0),
(8, 'Техни', 1, '2014-06-09', 24, 0),
(9, 'Техни', 1, '2014-06-09', 24, 0),
(10, '', 1, '2014-06-09', 24, 0),
(11, 'алексей', 1, '2014-06-09', 11, 0),
(12, 'Техник', 1, '2014-06-09', 24, 0),
(13, 'лололо', 1, '2014-06-09', 24, 0),
(14, 'проверка', 1, '2014-06-09', 24, 0),
(15, '', 1, '2014-06-21', 24, 3),
(16, '', 1, '2014-06-21', 24, 1),
(17, '', 1, '2014-06-21', 24, 2),
(18, '', 1, '2014-06-21', 24, 12),
(19, '', 1, '2014-06-22', 24, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `workgiver_data`
--

CREATE TABLE IF NOT EXISTS `workgiver_data` (
  `id` int(11) NOT NULL,
  `nm_org` text NOT NULL,
  `sphere` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='данные о работодателе';

--
-- Дамп данных таблицы `workgiver_data`
--

INSERT INTO `workgiver_data` (`id`, `nm_org`, `sphere`) VALUES
(1, 'Илья', 2),
(2, 'ильия', 1),
(6, 'passwrd', 3),
(7, 'dbcnx1', 0),
(8, 'dbcnx11', 0),
(9, '12345', 12345),
(11, 'roshan', 0),
(24, 'наименование организации', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
