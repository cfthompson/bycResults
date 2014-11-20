# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.30)
# Database: sailresults
# Generation Time: 2014-11-20 02:48:30 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table boats
# ------------------------------------------------------------

DROP TABLE IF EXISTS `boats`;

CREATE TABLE `boats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sail` varchar(40) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `model` varchar(50) DEFAULT NULL,
  `phrf` int(11) NOT NULL,
  `length` int(11) NOT NULL,
  `FridayNightClass` int(11) DEFAULT NULL,
  `rollerFurling` tinyint(1) NOT NULL DEFAULT '0',
  `skipper` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table courses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `courses`;

CREATE TABLE `courses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `distance` float NOT NULL,
  `roundings` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table divisions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `divisions`;

CREATE TABLE `divisions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `raceid` int(11) unsigned NOT NULL,
  `typeid` int(11) unsigned NOT NULL,
  `starttime` time NOT NULL,
  `course` int(11) DEFAULT NULL,
  `distance` float DEFAULT NULL,
  `name` varchar(20) DEFAULT '',
  `minphrf` int(11) DEFAULT NULL,
  `maxphrf` int(11) DEFAULT NULL,
  `minlength` int(11) DEFAULT NULL,
  `maxlength` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `raceid` (`raceid`),
  KEY `typeid` (`typeid`),
  CONSTRAINT `divisions_ibfk_2` FOREIGN KEY (`typeid`) REFERENCES `divisiontypes` (`id`),
  CONSTRAINT `divisions_ibfk_1` FOREIGN KEY (`raceid`) REFERENCES `races` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table divisiontypes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `divisiontypes`;

CREATE TABLE `divisiontypes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `seriestypeid` int(11) unsigned NOT NULL,
  `defaultstarttime` time NOT NULL,
  `name` varchar(20) NOT NULL DEFAULT '',
  `minphrf` int(11) DEFAULT NULL,
  `maxphrf` int(11) DEFAULT NULL,
  `minlength` int(11) DEFAULT NULL,
  `maxlength` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table entries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `entries`;

CREATE TABLE `entries` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `raceid` int(10) unsigned NOT NULL,
  `boatid` int(10) unsigned NOT NULL,
  `divisionid` int(11) unsigned NOT NULL,
  `phrf` int(11) NOT NULL,
  `finish` time DEFAULT NULL,
  `spinnaker` tinyint(1) DEFAULT NULL,
  `rollerFurling` tinyint(1) DEFAULT NULL,
  `tcf` float DEFAULT NULL,
  `corrected` time DEFAULT NULL,
  `status` enum('DNF','DSQ') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `raceid` (`raceid`),
  KEY `boatid` (`boatid`),
  CONSTRAINT `entries_ibfk_1` FOREIGN KEY (`raceid`) REFERENCES `races` (`id`),
  CONSTRAINT `entries_ibfk_2` FOREIGN KEY (`boatid`) REFERENCES `boats` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table races
# ------------------------------------------------------------

DROP TABLE IF EXISTS `races`;

CREATE TABLE `races` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `seriesid` int(11) unsigned NOT NULL,
  `racedate` date NOT NULL,
  `rcboat` varchar(30) DEFAULT NULL,
  `rcskipper` varchar(30) DEFAULT NULL,
  `preparer` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seriesid` (`seriesid`),
  CONSTRAINT `races_ibfk_1` FOREIGN KEY (`seriesid`) REFERENCES `series` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table series
# ------------------------------------------------------------

DROP TABLE IF EXISTS `series`;

CREATE TABLE `series` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `typeid` int(10) unsigned NOT NULL,
  `name` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `typeid` (`typeid`),
  CONSTRAINT `series_ibfk_1` FOREIGN KEY (`typeid`) REFERENCES `seriestypes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table seriestypes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `seriestypes`;

CREATE TABLE `seriestypes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(20) NOT NULL DEFAULT '',
  `fname` varchar(40) DEFAULT NULL,
  `lname` varchar(40) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `tstamp` datetime DEFAULT NULL,
  `passwd` char(41) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
