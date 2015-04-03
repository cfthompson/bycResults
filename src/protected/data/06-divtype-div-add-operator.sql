-- Run this script in mysql to:
-- Add the 'operator' field to divisiontypes and divisions

ALTER TABLE divisiontypes ADD COLUMN `operator` ENUM('and', 'or') NOT NULL DEFAULT 'and';

UPDATE divisiontypes SET operator='and' WHERE
 (minphrf IS NOT NULL OR maxphrf IS NOT NULL) AND
 (minlength IS NOT NULL OR maxlength IS NOT NULL);

UPDATE divisiontypes SET operator='or' WHERE
 (minphrf IS NULL AND maxphrf IS NULL) OR
 (minlength IS NULL AND maxlength IS NULL);

ALTER TABLE divisions ADD COLUMN `operator` ENUM('and', 'or') NOT NULL DEFAULT 'and';

UPDATE divisions SET operator='and' WHERE
 (minphrf IS NOT NULL OR maxphrf IS NOT NULL) AND
 (minlength IS NOT NULL OR maxlength IS NOT NULL);

UPDATE divisions SET operator='or' WHERE
 (minphrf IS NULL AND maxphrf IS NULL) OR
 (minlength IS NULL AND maxlength IS NULL);
