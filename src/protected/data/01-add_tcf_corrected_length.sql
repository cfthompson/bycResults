-- Run this script in mysql to:
-- add length to boats table
-- add tcf, corrected to entries table

ALTER TABLE `boats` 
	ADD COLUMN `length` INT(11) NOT NULL;

ALTER TABLE `entries`
	ADD COLUMN `tcf` FLOAT DEFAULT NULL,
	ADD COLUMN `corrected` TIME DEFAULT NULL;

