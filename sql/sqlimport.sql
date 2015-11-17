-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Värd: blu-ray.student.bth.se
-- Tid vid skapande: 17 nov 2015 kl 11:59
-- Serverversion: 5.5.44-0+deb8u1-log
-- PHP-version: 5.6.14-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `*****`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `corgi_comment`
--

CREATE TABLE IF NOT EXISTS `corgi_comment` (
`id` int(11) NOT NULL,
  `title` text,
  `content` text,
  `timestamp` datetime DEFAULT NULL,
  `user` varchar(80) DEFAULT NULL,
  `points` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `corgi_comment2category`
--

CREATE TABLE IF NOT EXISTS `corgi_comment2category` (
  `idComment` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `corgi_commentanswer`
--

CREATE TABLE IF NOT EXISTS `corgi_commentanswer` (
`id` int(11) NOT NULL,
  `content` text,
  `timestamp` datetime DEFAULT NULL,
  `user` varchar(80) DEFAULT NULL,
  `answerto` int(11) DEFAULT NULL,
  `accepted` timestamp NULL DEFAULT NULL,
  `points` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `corgi_commentcategory`
--

CREATE TABLE IF NOT EXISTS `corgi_commentcategory` (
`id` int(11) NOT NULL,
  `category` varchar(80) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `corgi_commentcategory`
--

INSERT INTO `corgi_commentcategory` (`id`, `category`, `description`) VALUES
(1, 'Generellt', 'Allmänt om Corgis och allt som har med hundarna att göra.'),
(2, 'Tassar', 'Allt som har med tassarna på Corgis att göra.'),
(3, 'Svansar', 'Allt som har med svansarna på Corgis att göra.'),
(4, 'Hundmat', 'Allt du har att säga om hundarnas matvanor och kanske vad du gillar att laga till dom.'),
(5, 'Hundkostymer', 'Om du gillar att klä upp din Corgi i varierande kostymer så är det här den kategori du ska använda.'),
(6, 'Minidjur', 'Diskussion om andra djur som kanske har någon koppling till Corgis.'),
(7, 'Hjälp', 'Diskussioner om hjälp med varierande teman som rör Corgis.'),
(8, 'Hundsport', 'Racing med Corgis. Hundkapplöpning och allt som har med tävlingsintresset att göra.'),
(9, 'Hundlekar', 'Vad för sorts hundlekar är det som är aktuellt att prata om nu? Är det verkligen bara ''jaga pinnen'' som är på tal eller finns det fler roliga saker?'),
(10, 'Hundfilosofi', 'Allt som rör hundarnas plats i vår filosofiska tillvaro. Är det kanske hundarna som sitter i grottan och stirrar på reflektionen?'),
(11, 'Ärkefiender', 'Allt som rör katter och vad vi gör för att hålla oss borta från dom. För kritiska diskussioner om rivalerna.'),
(12, 'Fritid', 'För din och hundarnas fritid och allt som kan diskuteras om skog och natur. Alternativt vad som finns att göra i stan.'),
(13, 'Offtopic', 'För allt annat som rör icke Corgi relaterade diskussioner.');

-- --------------------------------------------------------

--
-- Tabellstruktur `corgi_commentreply`
--

CREATE TABLE IF NOT EXISTS `corgi_commentreply` (
`id` int(11) NOT NULL,
  `content` text,
  `timestamp` datetime DEFAULT NULL,
  `user` varchar(80) DEFAULT NULL,
  `answerto` int(11) DEFAULT NULL,
  `replytype` varchar(80) DEFAULT NULL,
  `points` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `corgi_user`
--

CREATE TABLE IF NOT EXISTS `corgi_user` (
`id` int(11) NOT NULL,
  `acronym` varchar(20) NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `information` text,
  `password` varchar(255) DEFAULT NULL,
  `gravatar` varchar(90) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `active` datetime DEFAULT NULL,
  `fame` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Ersättningsstruktur för vy `corgi_vanswers`
--
CREATE TABLE IF NOT EXISTS `corgi_vanswers` (
`id` int(11)
,`answertitle` text
,`content` text
,`points` int(11)
,`timestamp` datetime
,`accepted` timestamp
,`gravatar` varchar(90)
,`user` varchar(80)
,`userid` int(11)
,`answerto` int(11)
);
-- --------------------------------------------------------

--
-- Ersättningsstruktur för vy `corgi_vcategories`
--
CREATE TABLE IF NOT EXISTS `corgi_vcategories` (
`id` int(11)
,`category` varchar(80)
,`description` text
,`timesused` bigint(21)
);
-- --------------------------------------------------------

--
-- Ersättningsstruktur för vy `corgi_vcomments`
--
CREATE TABLE IF NOT EXISTS `corgi_vcomments` (
`id` int(11)
,`answers` bigint(21)
,`title` text
,`content` text
,`points` int(11)
,`timestamp` datetime
,`gravatar` varchar(90)
,`user` varchar(80)
,`userid` int(11)
,`category` text
,`categoryid` text
);
-- --------------------------------------------------------

--
-- Tabellstruktur `corgi_voting`
--

CREATE TABLE IF NOT EXISTS `corgi_voting` (
`id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL DEFAULT '0',
  `idComment` int(11) NOT NULL DEFAULT '0',
  `idAnswer` int(11) NOT NULL DEFAULT '0',
  `idReply` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Ersättningsstruktur för vy `corgi_vreply`
--
CREATE TABLE IF NOT EXISTS `corgi_vreply` (
`id` int(11)
,`content` text
,`timestamp` datetime
,`user` varchar(80)
,`answerto` int(11)
,`replytype` varchar(80)
,`points` int(11)
,`userId` int(11)
);
-- --------------------------------------------------------

--
-- Ersättningsstruktur för vy `corgi_vuser`
--
CREATE TABLE IF NOT EXISTS `corgi_vuser` (
`id` int(11)
,`fame` int(11)
,`user` varchar(20)
,`name` varchar(80)
,`information` text
,`email` varchar(80)
,`gravatar` varchar(90)
,`upvoted` bigint(21)
,`answers` bigint(21)
,`comments` bigint(21)
,`replies` bigint(21)
,`answerPoints` decimal(32,0)
,`commentPoints` decimal(32,0)
,`replyPoints` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Struktur för vy `corgi_vanswers`
--
DROP TABLE IF EXISTS `corgi_vanswers`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `corgi_vanswers` AS select `ca`.`id` AS `id`,`c`.`title` AS `answertitle`,`ca`.`content` AS `content`,`ca`.`points` AS `points`,`ca`.`timestamp` AS `timestamp`,`ca`.`accepted` AS `accepted`,`u`.`gravatar` AS `gravatar`,`ca`.`user` AS `user`,`u`.`id` AS `userid`,`ca`.`answerto` AS `answerto` from ((`corgi_commentanswer` `ca` left join `corgi_comment` `c` on((`ca`.`answerto` = `c`.`id`))) left join `corgi_user` `u` on((`ca`.`user` = `u`.`acronym`))) group by `ca`.`id`;

-- --------------------------------------------------------

--
-- Struktur för vy `corgi_vcategories`
--
DROP TABLE IF EXISTS `corgi_vcategories`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `corgi_vcategories` AS select `c`.`id` AS `id`,`c`.`category` AS `category`,`c`.`description` AS `description`,(select count(0) from `corgi_comment2category` where (`corgi_comment2category`.`idCategory` = `c`.`id`)) AS `timesused` from `corgi_commentcategory` `c` group by `c`.`id`;

-- --------------------------------------------------------

--
-- Struktur för vy `corgi_vcomments`
--
DROP TABLE IF EXISTS `corgi_vcomments`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `corgi_vcomments` AS select `c`.`id` AS `id`,(select count(0) from `corgi_commentanswer` where (`corgi_commentanswer`.`answerto` = `c`.`id`)) AS `answers`,`c`.`title` AS `title`,`c`.`content` AS `content`,`c`.`points` AS `points`,`c`.`timestamp` AS `timestamp`,`u`.`gravatar` AS `gravatar`,`c`.`user` AS `user`,`u`.`id` AS `userid`,group_concat(`cc`.`category` separator ',') AS `category`,group_concat(`cc`.`id` separator ',') AS `categoryid` from (((`corgi_comment` `c` left join `corgi_comment2category` `c2c` on((`c`.`id` = `c2c`.`idComment`))) left join `corgi_commentcategory` `cc` on((`c2c`.`idCategory` = `cc`.`id`))) left join `corgi_user` `u` on((`c`.`user` = `u`.`acronym`))) group by `c`.`id`;

-- --------------------------------------------------------

--
-- Struktur för vy `corgi_vreply`
--
DROP TABLE IF EXISTS `corgi_vreply`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `corgi_vreply` AS select `cr`.`id` AS `id`,`cr`.`content` AS `content`,`cr`.`timestamp` AS `timestamp`,`cr`.`user` AS `user`,`cr`.`answerto` AS `answerto`,`cr`.`replytype` AS `replytype`,`cr`.`points` AS `points`,`u`.`id` AS `userId` from (`corgi_commentreply` `cr` left join `corgi_user` `u` on((`cr`.`user` = `u`.`acronym`))) group by `cr`.`id`;

-- --------------------------------------------------------

--
-- Struktur för vy `corgi_vuser`
--
DROP TABLE IF EXISTS `corgi_vuser`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `corgi_vuser` AS select `U`.`id` AS `id`,`U`.`fame` AS `fame`,`U`.`acronym` AS `user`,`U`.`name` AS `name`,`U`.`information` AS `information`,`U`.`email` AS `email`,`U`.`gravatar` AS `gravatar`,(select count(0) from `corgi_voting` where (`corgi_voting`.`idUser` = `U`.`id`)) AS `upvoted`,(select count(0) from `corgi_commentanswer` where (`corgi_commentanswer`.`user` = `U`.`acronym`)) AS `answers`,(select count(0) from `corgi_comment` where (`corgi_comment`.`user` = `U`.`acronym`)) AS `comments`,(select count(0) from `corgi_commentreply` where (`corgi_commentreply`.`user` = `U`.`acronym`)) AS `replies`,(select sum(`corgi_commentanswer`.`points`) from `corgi_commentanswer` where (`corgi_commentanswer`.`user` = `U`.`acronym`)) AS `answerPoints`,(select sum(`corgi_comment`.`points`) from `corgi_comment` where (`corgi_comment`.`user` = `U`.`acronym`)) AS `commentPoints`,(select sum(`corgi_commentreply`.`points`) from `corgi_commentreply` where (`corgi_commentreply`.`user` = `U`.`acronym`)) AS `replyPoints` from `corgi_user` `U` group by `U`.`id`;

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `corgi_comment`
--
ALTER TABLE `corgi_comment`
 ADD PRIMARY KEY (`id`);

--
-- Index för tabell `corgi_comment2category`
--
ALTER TABLE `corgi_comment2category`
 ADD PRIMARY KEY (`idComment`,`idCategory`), ADD KEY `idCategory` (`idCategory`);

--
-- Index för tabell `corgi_commentanswer`
--
ALTER TABLE `corgi_commentanswer`
 ADD PRIMARY KEY (`id`);

--
-- Index för tabell `corgi_commentcategory`
--
ALTER TABLE `corgi_commentcategory`
 ADD PRIMARY KEY (`id`);

--
-- Index för tabell `corgi_commentreply`
--
ALTER TABLE `corgi_commentreply`
 ADD PRIMARY KEY (`id`);

--
-- Index för tabell `corgi_user`
--
ALTER TABLE `corgi_user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `acronym` (`acronym`);

--
-- Index för tabell `corgi_voting`
--
ALTER TABLE `corgi_voting`
 ADD PRIMARY KEY (`idUser`,`idComment`,`idAnswer`,`idReply`), ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `corgi_comment`
--
ALTER TABLE `corgi_comment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT för tabell `corgi_commentanswer`
--
ALTER TABLE `corgi_commentanswer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT för tabell `corgi_commentcategory`
--
ALTER TABLE `corgi_commentcategory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT för tabell `corgi_commentreply`
--
ALTER TABLE `corgi_commentreply`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT för tabell `corgi_user`
--
ALTER TABLE `corgi_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT för tabell `corgi_voting`
--
ALTER TABLE `corgi_voting`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `corgi_comment2category`
--
ALTER TABLE `corgi_comment2category`
ADD CONSTRAINT `corgi_comment2category_ibfk_1` FOREIGN KEY (`idComment`) REFERENCES `corgi_comment` (`id`),
ADD CONSTRAINT `corgi_comment2category_ibfk_2` FOREIGN KEY (`idCategory`) REFERENCES `corgi_commentcategory` (`id`);

--
-- Restriktioner för tabell `corgi_voting`
--
ALTER TABLE `corgi_voting`
ADD CONSTRAINT `corgi_voting_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `corgi_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
