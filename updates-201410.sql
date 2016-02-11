ALTER TABLE `contact` CHANGE `CountryID` `CountryID` INT( 11 ) NULL ;
ALTER TABLE `contact` CHANGE `Email` `Email` VARCHAR( 64 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ;
ALTER TABLE `contact` ADD `Cell` VARCHAR( 64 ) NULL ;
ALTER TABLE `applicant` ADD `HomeAddress` TEXT NULL AFTER `Notes` ;
ALTER TABLE `applicant_status` ADD `IsCompleted` BOOLEAN NOT NULL DEFAULT FALSE AFTER `StartedOn` ;


