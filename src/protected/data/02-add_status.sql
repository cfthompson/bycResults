-- Run this script in mysql to:
-- Add the status column to the entries table.

ALTER TABLE `entries`
	ADD COLUMN `status` enum('DNF','DSQ') DEFAULT NULL;
