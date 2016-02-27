ALTER TABLE `status` CHANGE `DurationPeriod` `DurationPeriod` ENUM( 'None', 'Days', 'Weeks', 'Months', 'Years' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;
ALTER TABLE `applicant_status` CHANGE `DurationPeriod` `DurationPeriod` ENUM( 'None', 'Days', 'Weeks', 'Months', 'Years' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ;

===

ALTER TABLE `applicant` CHANGE `MaritalStatus` `MaritalStatus` ENUM( 'Single', 'Partner', 'Married', 'Couple' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ;

===

ALTER TABLE `children` ADD INDEX ( `SchoolID` ) ;
ALTER TABLE `children` ADD FOREIGN KEY ( `SchoolID` ) REFERENCES `entryservice`.`school` (
`ID`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;
ALTER TABLE `children` ADD `Sex` ENUM( 'M', 'F' ) NOT NULL ;
ALTER TABLE `children` ADD `NationalityID` INT NULL ,
ADD INDEX ( `NationalityID` ) ;
ALTER TABLE `children` ADD FOREIGN KEY ( `NationalityID` ) REFERENCES `entryservice`.`nationality` (
`ID`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;
ALTER TABLE `children` ADD `ResServiceNum` INT NULL ;
ALTER TABLE `applicant` ADD `IsArchived` BOOLEAN NULL DEFAULT FALSE ;
ALTER TABLE `applicant` ADD `AVName` VARCHAR( 64 ) NULL AFTER `Surname` ,
ADD INDEX ( `AVName` ) ;

===

