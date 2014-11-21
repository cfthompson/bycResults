-- Execute this script in mysql to:
-- Add the registrations table

CREATE TABLE `registrations` (
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
  `certificate` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;