-- Run this script in mysql to:
-- Change the type of divisiontypes.defaultstarttime from int to time

ALTER TABLE divisiontypes MODIFY COLUMN `defaultstarttime` TIME NOT NULL;

UPDATE divisiontypes SET defaultstarttime='13:00:00' WHERE
 minphrf IS NULL AND
 maxphrf IS NULL AND
 minlength IS NULL AND
 maxlength IS NULL;

UPDATE divisiontypes SET defaultstarttime='18:35:00' WHERE
 minphrf IS NOT NULL AND
 maxphrf IS NULL AND
 minlength IS NULL AND
 maxlength IS NOT NULL;

UPDATE divisiontypes SET defaultstarttime='18:45:00' WHERE
 minphrf IS NULL AND
 maxphrf IS NOT NULL AND
 minlength IS NULL AND
 maxlength IS NOT NULL;

UPDATE divisiontypes SET defaultstarttime='18:55:00' WHERE
 minphrf IS NULL AND
 maxphrf IS NOT NULL AND
 minlength IS NOT NULL AND
 maxlength IS NULL;


