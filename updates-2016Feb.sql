ALTER TABLE `status` CHANGE `DurationPeriod` `DurationPeriod` ENUM( 'None', 'Days', 'Weeks', 'Months', 'Years' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;
ALTER TABLE `applicant_status` CHANGE `DurationPeriod` `DurationPeriod` ENUM( 'None', 'Days', 'Weeks', 'Months', 'Years' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ;
