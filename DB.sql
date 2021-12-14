-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 13 2017 г., 00:45
-- Версия сервера: 5.5.47
-- Версия PHP: 5.4.45-0+deb7u2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `db1488921849`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auction`
--

CREATE TABLE IF NOT EXISTS `auction` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `timestart` int(11) NOT NULL DEFAULT '0',
  `timelast` int(11) NOT NULL DEFAULT '0',
  `bank` float DEFAULT NULL,
  `stavka` float DEFAULT NULL,
  `login` varchar(40) DEFAULT NULL,
  `timeend` int(11) DEFAULT NULL,
  `allstav` int(11) DEFAULT '1',
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `auctionstav`
--

CREATE TABLE IF NOT EXISTS `auctionstav` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) DEFAULT NULL,
  `time` int(11) NOT NULL DEFAULT '0',
  `stavka` float NOT NULL DEFAULT '0',
  `login` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`sid`),
  KEY `gid` (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `auth`
--

CREATE TABLE IF NOT EXISTS `auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` int(11) NOT NULL,
  `log` varchar(15) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `ua` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_err`
--

CREATE TABLE IF NOT EXISTS `auth_err` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` int(11) NOT NULL,
  `log` varchar(15) NOT NULL,
  `pass` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `ban`
--

CREATE TABLE IF NOT EXISTS `ban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `who` varchar(100) CHARACTER SET utf8 NOT NULL,
  `reason` varchar(250) CHARACTER SET utf8 NOT NULL,
  `date` int(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `guest`
--

CREATE TABLE IF NOT EXISTS `guest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `user` varchar(15) NOT NULL,
  `text` varchar(2500) NOT NULL,
  `answer` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `inmoney`
--

CREATE TABLE IF NOT EXISTS `inmoney` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `user` varchar(15) NOT NULL,
  `money` int(11) NOT NULL,
  `moneyigra` int(11) NOT NULL,
  `wmr` varchar(13) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to` varchar(15) NOT NULL,
  `who` varchar(15) NOT NULL,
  `date` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `tema` varchar(40) NOT NULL,
  `text` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `money_in`
--

CREATE TABLE IF NOT EXISTS `money_in` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` text,
  `time` bigint(20) DEFAULT NULL,
  `summa` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news` int(11) DEFAULT NULL,
  `date` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `text` mediumtext NOT NULL,
  `answer` varchar(15000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `online`
--

CREATE TABLE IF NOT EXISTS `online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `user` varchar(15) NOT NULL,
  `ua` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `where` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `user` varchar(15) NOT NULL,
  `money` float(11,2) NOT NULL,
  `moneyigra` float(11,2) NOT NULL,
  `number` varchar(255) NOT NULL,
  `status` enum('moder','on','lock') NOT NULL,
  `type` enum('cash','mobile') NOT NULL,
  `operator` varchar(255) NOT NULL,
  `wmr` varchar(13) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `rate`
--

CREATE TABLE IF NOT EXISTS `rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(15) NOT NULL,
  `to` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `ref`
--

CREATE TABLE IF NOT EXISTS `ref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(15) NOT NULL,
  `who` varchar(15) NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `reklama`
--

CREATE TABLE IF NOT EXISTS `reklama` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mesto` enum('1','2','3','4','5') NOT NULL,
  `user` varchar(15) NOT NULL,
  `date` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `url` varchar(35) NOT NULL,
  `color` varchar(10) NOT NULL,
  `count` int(11) NOT NULL,
  `count_all` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `name` varchar(60) NOT NULL,
  `url` varchar(50) NOT NULL,
  `value` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`name`, `url`, `value`) VALUES
('antiflud', '5', '5'),
('refpr', '15', '15'),
('mincost', '15', '15'),
('mail', 'livebookua1@gmail.com', 'livebookua1@gmail.com'),
('pages', '10', '10'),
('registration', '0', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `tree`
--

CREATE TABLE IF NOT EXISTS `tree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(15) NOT NULL,
  `id_user` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `income` int(11) NOT NULL,
  `fruit` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datereg` int(11) NOT NULL,
  `lasttime` int(11) NOT NULL,
  `login` varchar(15) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `email` varchar(35) NOT NULL,
  `admin` enum('0','1') NOT NULL,
  `ip` varchar(50) NOT NULL,
  `ua` varchar(200) NOT NULL,
  `money` decimal(11,2) NOT NULL DEFAULT '0.00',
  `contref` int(11) NOT NULL,
  `moneyigra` decimal(11,2) NOT NULL DEFAULT '0.00',
  `fruit` int(11) NOT NULL,
  `serebro` int(11) NOT NULL,
  `bonus` int(1) NOT NULL,
  `wmr` varchar(13) NOT NULL,
  `privatbank` varchar(16) NOT NULL,
  `wmid` varchar(13) NOT NULL,
  `country` int(2) NOT NULL,
  `pol` int(2) NOT NULL,
  `name` varchar(25) NOT NULL,
  `icq` varchar(13) DEFAULT NULL,
  `rate` int(11) NOT NULL,
  `smiles` enum('0','1') NOT NULL,
  `reitsbydenikoua` decimal(11,2) NOT NULL DEFAULT '0.00',
  `z1` int(11) NOT NULL,
  `z2` int(11) NOT NULL,
  `z3` int(11) NOT NULL,
  `z4` int(11) NOT NULL,
  `z1_p` int(11) NOT NULL,
  `z1_lock` int(11) NOT NULL,
  `z2_p` int(11) NOT NULL,
  `z2_lock` int(11) NOT NULL,
  `z3_p` int(11) NOT NULL,
  `z3_lock` int(11) NOT NULL,
  `z4_p` int(11) NOT NULL,
  `z4_lock` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `worldkassa`
--

CREATE TABLE IF NOT EXISTS `worldkassa` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID платежа (Внутренний ID)',
  `id_user` int(11) unsigned NOT NULL COMMENT 'ID пользователя',
  `id_bill` int(11) unsigned NOT NULL COMMENT 'ID платежа в Worldkassa',
  `time` int(11) unsigned NOT NULL COMMENT 'Время инициализации платежа',
  `time_oplata` int(11) unsigned DEFAULT '0' COMMENT 'Время оплаты',
  `summa` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT 'Сумма',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Статистика платежей через WorldKassa' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
