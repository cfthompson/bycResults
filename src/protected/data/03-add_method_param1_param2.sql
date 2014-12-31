-- Run this script in mysql to:
-- Add column defaultMethod, defaultParam1, defaultParam2 to the seriestypes and series tables
-- Add column method, param1, param2 to the races table

ALTER TABLE `seriestypes`
	ADD COLUMN `defaultMethod` ENUM('TOT','TOD') NOT NULL DEFAULT 'TOT',
	ADD COLUMN `defaultParam1` FLOAT DEFAULT NULL,
	ADD COLUMN `defaultParam2` FLOAT DEFAULT NULL;

ALTER TABLE `series`
	ADD COLUMN `defaultMethod` ENUM('TOT','TOD') NOT NULL DEFAULT 'TOT',
	ADD COLUMN `defaultParam1` FLOAT DEFAULT NULL,
	ADD COLUMN `defaultParam2` FLOAT DEFAULT NULL;

ALTER TABLE `races`
	ADD COLUMN `method` ENUM('TOT','TOD') NOT NULL DEFAULT 'TOT',
	ADD COLUMN `param1` FLOAT DEFAULT NULL,
	ADD COLUMN `param2` FLOAT DEFAULT NULL;

UPDATE `seriestypes`
	SET `defaultMethod`='TOT',
	`defaultParam1`=800,
	`defaultParam2`=550
 WHERE name LIKE 'Sunday%';

UPDATE `seriestypes`
	SET `defaultMethod`='TOD'
 WHERE name LIKE 'Friday%';

UPDATE `series`
	SET `defaultMethod`='TOT',
	`defaultParam1`=800,
	`defaultParam2`=550
 WHERE name LIKE 'Sunday%';

UPDATE `series`
	SET `defaultMethod`='TOD'
 WHERE name LIKE 'Friday%';

UPDATE `races`
 JOIN `series` ON `races`.`seriesid`=`series`.`id`
	SET `method`='TOT',
	`param1`=800,
	`param2`=550
 WHERE `series`.`name` LIKE 'Sunday%';

UPDATE `races`
 JOIN `series` ON `races`.`seriesid`=`series`.`id`
	SET `method`='TOD'
 WHERE `series`.`name` LIKE 'Friday%';
