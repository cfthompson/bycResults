-- Run this script in mysql to:
-- Rename divisions.course to divisions.courseid

ALTER TABLE divisions CHANGE COLUMN `course` `courseid` INT(11) UNSIGNED NOT NULL;
