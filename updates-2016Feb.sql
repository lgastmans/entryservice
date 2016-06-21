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

ALTER TABLE `applicant` CHANGE `NationalityID` `NationalityID` INT( 11 ) NULL ;

===

ALTER TABLE `visa` CHANGE `VisaType` `VisaType` ENUM( 'Visa', 'Bussiness', 'Tourist', 'PIO', 'OCI', 'Student', 'Entry', 'RP', 'Other' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ;

===

ALTER TABLE `applicant` CHANGE `BirthDate` `BirthDate` DATE NULL DEFAULT NULL ;
ALTER TABLE `passport` CHANGE `IssuedDate` `IssuedDate` DATE NULL DEFAULT NULL ;
ALTER TABLE `passport` CHANGE `ValidTill` `ValidTill` DATE NULL DEFAULT NULL ;
ALTER TABLE `visa` CHANGE `IssuedDate` `IssuedDate` DATE NULL DEFAULT NULL ;
ALTER TABLE `visa` CHANGE `ValidTill` `ValidTill` DATE NULL DEFAULT NULL ;
ALTER TABLE `indianID` CHANGE `IssuedDate` `IssuedDate` DATE NULL DEFAULT NULL ;
ALTER TABLE `indianID` CHANGE `ValidTill` `ValidTill` DATE NULL DEFAULT NULL ;

===

ALTER TABLE `visa` CHANGE `VisaType` `VisaType` ENUM( 'Visa', 'Bussiness', 'Tourist', 'PIO', 'OCI', 'Student', 'Entry', 'RP', 'Other', 'Stay Visa' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ;
ALTER TABLE `applicant_status` CHANGE `StartedOn` `StartedOn` DATE NULL DEFAULT NULL ;
ALTER TABLE `extension` CHANGE `ExtendedOn` `ExtendedOn` DATE NULL DEFAULT NULL ;
ALTER TABLE `absence` CHANGE `AbsentTill` `AbsentTill` DATE NULL DEFAULT NULL ;
ALTER TABLE `absence` CHANGE `AbsentOn` `AbsentOn` DATE NULL DEFAULT NULL ;
ALTER TABLE `contact` CHANGE `CountryID` `CountryID` INT( 11 ) NULL DEFAULT NULL ;