# ASyncTo API #

### Introduction ###
ASyncTo is a system to synchronize Services' databases.
This API is designed to allow PHP programmers to quickly add asyncto to their databases.

### Functionality overview ###
ASyncTo is based on an LDAP server used as an exchange platform. Access to Asyncto can be live - the program retrieves the information when needed - or cached - the program buffers the information in it's database for retrieval at any time, regardless of connection status.
This API follows the cached approach and is designed remove the burden of learning LDAP commands

### Getting Started ###
You will need credentials to use asyncto. You can request these at asyncto@



# Example - Basics #

###Installation###
create a directory for the API files in your dev directory

```sh
mkdir asynctoapi
cd asynctoapi
```

Initialize git and download latest version of asynctoapi

```sh
git init
git pull ssh://git@bitbucket.org:coriolanweihrauch/asynctoapi.git
```

### Usage ###
You can find this example in the example folder<br />
Create a new file - `asynctotest.php` - in the asynctoapi directory and enter the following:

```php
<?php
// Include all asyncto****.class.php files
foreach (glob(dirname(__FILE__)."/*.class.php") as $filename)
{
	include_once($filename);
}

// Create asynctoconnection instance 
$u = "<YOUR_USERNAME>"
$p = "<YOUR_PASSWORD>"
$o = array(
	"url" => "asyncto.auroville.org.in",
	"port" => 389,
	"usetls" => 0,
	"reqcert" => "never",
	"error_reporting_level" => E_ALL & ~E_NOTICE,
);

// Instantiate asynctoconnection object
$a = new asynctoconnection($u, $p, $o);

// Download People
// This will download the first 10 people from the people records in ou=people,dc=asyncto,dc=auroville,dc=org,dc=in:
$arrPeople = $a->getPeople(10);
// To download all records, call getPeople() without parameter:
// $arrPeople = $a->getPeople();
var_dump($arrPeople);


// Download Virtual Entities
// This will download the first 10 Virtual Entities from the VE records in ou=virtualentities,dc=asyncto,dc=auroville,dc=org,dc=in:
$arrPeople = $a->getVirtualentities(10);
// To download all records, call getVirtualentities() without parameter:
// $arrVirtualentities = $a->getVirtualentities();
var_dump($arrVirtualentities);
?>
```



# Example - Using a Database #

First the required asyncto records - typically all - are downloaded raw to the `asyncto_buffer` table.

ASyncTo has single-entry fields and multi-entry fields. Single-entry fields are transferred to a `person` table while multi-entry fields (telephone numbers and emails) are stored in a `contactdetail` table.


### Create the Tables ###
#### asyncto_buffer ####

```mysql
CREATE TABLE `asyncto_buffer` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `asynctoId` varchar(32) NOT NULL,
 `ldapid` varchar(128) NOT NULL DEFAULT '',
 `masterlistid` varchar(8) DEFAULT NULL,
 `aurovillename` varchar(128) DEFAULT NULL,
 `name` varchar(128) DEFAULT NULL,
 `surname` varchar(128) DEFAULT NULL,
 `address` varchar(128) DEFAULT NULL,
 `telephone` varchar(128) DEFAULT NULL,
 `email` varchar(128) DEFAULT NULL,
 `status` varchar(32) DEFAULT NULL,
 `presence` varchar(32) DEFAULT NULL,
 `contactperson` varchar(128) DEFAULT NULL,
 `creatorsName` varchar(255) DEFAULT NULL,
 `createTimestamp` datetime DEFAULT NULL,
 `modifiersName` varchar(255) DEFAULT NULL,
 `modifyTimestamp` datetime DEFAULT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `asynctoid` (`ldapid`),
 KEY `asynctoid_2` (`ldapid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
```

#### person
You can also use your own person table with your own set of fields.
Note that this table uses IDs for references instead of plain-text values for `status`, `presence` and `community`
```mysql
CREATE TABLE `person` (
 `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `asynctoId` varchar(36) DEFAULT NULL,
 `masterlistId` varchar(6) DEFAULT NULL,
 `aurovillename` varchar(64) DEFAULT NULL,
 `name` varchar(96) DEFAULT NULL,
 `surname` varchar(32) DEFAULT NULL,
 `status_id` int(11) unsigned DEFAULT NULL,
 `presence_id` int(11) unsigned DEFAULT NULL,
 `community_id` int(11) unsigned DEFAULT NULL,
 PRIMARY KEY (`id`),
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
```

#### contact detail
Note that `contactdetail`'s `person_id` references the `person`'s `id`. Make sure to adapt this to your table structure
```mysql
CREATE TABLE `contactdetail` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `person_id` int(11) unsigned DEFAULT NULL,
 `contactType_id` int(11) unsigned DEFAULT NULL,
 `bAsynctoDelete` tinyint(1) DEFAULT NULL,
 `contact` varchar(128) DEFAULT NULL,
 PRIMARY KEY (`id`),
 CONSTRAINT `contactdetail_person` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
```

### Optional: lookup
Depending on your database structure, you may use plain-text fields or reference fields to lookups. This example assumes you use lookups.
```mysql
CREATE TABLE IF NOT EXISTS `lookup` (
  `section` varchar(32) NOT NULL DEFAULT '',
  `code` varchar(64) NOT NULL DEFAULT '',
  `description` varchar(128) DEFAULT NULL
 PRIMARY KEY (`section`,`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `lookup` (`section`, `code`, `description`) VALUES
('community', '1', 'Abri'),
('community', '2', 'Abri-forest'),
# insert more here
('person_presence', '1', 'Present'),
('person_presence', '2', 'TOS'),
('person_presence', '3', 'Left'),
('person_presence', '4', 'Left body'),
('person_status', '1', 'Aurovilian'),
('person_status', '2', 'New comer'),
('person_status', '3', 'To be new comer'),
('person_status', '4', 'Volunteer'),
('person_status', '5', 'Youth'),
('person_status', '6', 'Aurovilian Child'),
('person_status', '7', 'Friend of Auroville'),
('person_status', '8', 'New comer child'),
('person_status', '9', 'To be new comer child')
```

## Save downloaded information in database ##
Continue editing in `asynctoexample.php`

```php
<?php
// Prepare people insert query
$strQueryP = "INSERT INTO `asyncto_buffer` (`asynctoid`, `ldapid`, `masterlistid`, `aurovillename`, `name`, `surname`, `address`, `telephone`, `email`, `status`, `presence`, `contactperson`,  `creatorsName`, `createTimestamp`, `modifiersName`, `modifyTimestamp`) VALUES\n";
// Add values
$arrValues = array();
foreach($arrPeople as $person)
{
	$arrV = array($person->asynctoid, $person->ldapid, $person->masterlistid, $person->aurovillename, $person->name, $person->surname, $person->address, $person->telephone, $person->email, $person->status, $person->presence, $person->contactperson, $person->creatorsname, $person->getCreatetimestamp(), $person->modifiersname, $person->getModifytimestamp());
	foreach($arrV as $i => $v)
	{
		$arrV[$i] = addslashes(trim($v));
	}
	$arrValues[] = "('".implode("', '", $arrV)."')";
}
if(count($arrValues) > 0)
{
	$strQueryP .= implode(",\n", $arrValues);
}


// Prepare virtualentities insert query
$strQueryVE = "INSERT INTO `asyncto_buffer` (`asynctoid`, `ldapid`, `masterlistid`, `aurovillename`, `name`, `surname`, `address`, `telephone`, `email`, `status`, `presence`, `contactperson`,  `creatorsName`, `createTimestamp`, `modifiersName`, `modifyTimestamp`) VALUES\n";
// Add values
$arrValues = array();
foreach($arrVirtualentities as $virtualentity)
{
	$arrV = array($virtualentity->asynctoid, $virtualentity->ldapid, $virtualentity->masterlistid, $virtualentity->aurovillename, $virtualentity->name, $virtualentity->surname, $virtualentity->address, $virtualentity->telephone, $virtualentity->email, $virtualentity->status, $virtualentity->presence, $virtualentity->contactperson, $virtualentity->creatorsname, $virtualentity->getCreatetimestamp(), $virtualentity->modifiersname, $virtualentity->getModifytimestamp());
	foreach($arrV as $i => $v)
	{
		$arrV[$i] = addslashes(trim($v));
	}
	$arrValues[] = "('".implode("', '", $arrV)."')";
}
if(count($arrValues) > 0)
{
	$strQueryVE .= implode(",\n", $arrValues);
}


// Execute queries
$con=mysqli_connect("mysql.host","username","password","database");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
// Empty asyncto buffer table
mysqli_query($con, "TRUNCATE TABLE asyncto_buffer");
// Insert people records
mysqli_query($con, $strQueryP);
// Insert virtualentities records
mysqli_query($con, $strQueryVE);
// Close connection
mysqli_close($con);

// Show asyncto connection error messages
print($a);
?>
```

## Updating the `people` and `contactdetail` tables ##

*This example assumes you use lookups as described above.*

#### MySQL Procedure ####
This example uses a MySQL procedure to simplfy the update process.

```mysql
# copy asyncto_buffer to people
# Go through asyncto_buffer rows and send each row's telephone & email to person_contact using procedure asyncto_insert_contact
DROP PROCEDURE IF EXISTS `asyncto_update_contact`;
# Doesn't work via yii cdbcommand
#delimiter ;;
CREATE PROCEDURE asyncto_update_contact() BEGIN
 # Variables
  DECLARE done BOOLEAN DEFAULT FALSE;
  DECLARE _personid BIGINT UNSIGNED;
  DECLARE _asynctoid VARCHAR(32);
  DECLARE _telephone VARCHAR(128);
  DECLARE _email VARCHAR(128);
  # Query to get the data from asyncto_buffer
  DECLARE cur CURSOR FOR SELECT person.id,asyncto_buffer.asynctoid,asyncto_buffer.telephone,asyncto_buffer.email FROM asyncto_buffer LEFT JOIN person on person.asynctoid = asyncto_buffer.asynctoid;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done := TRUE;


# ======================= #
# Update existing entries #
# ======================= #
  SET @sql := "update person
left join asyncto_buffer on asyncto_buffer.asynctoid = person.asynctoid
left join lookup presence on presence.description = asyncto_buffer.presence and presence.section = 'person_presence'
left join lookup status on status.description = asyncto_buffer.status and status.section = 'person_status'
left join lookup community on community.description = asyncto_buffer.address and community.section = 'community'
SET
person.masterlistid = asyncto_buffer.masterlistid,
person.aurovillename = asyncto_buffer.aurovillename,
person.name = asyncto_buffer.name,
person.surname = asyncto_buffer.surname,
person.status_id = status.code,
person.presence_id = presence.code,
person.community_id = community.code,
person.status_date = CASE
  WHEN person.status_id != status.code THEN asyncto_buffer.modifyTimestamp
  WHEN asyncto_buffer.status IS NOT NULL AND person.status_date IS NULL THEN asyncto_buffer.modifyTimestamp
  ELSE person.status_date
END,
person.presence_date = CASE
  WHEN person.presence_id != presence.code THEN asyncto_buffer.modifyTimestamp
  WHEN asyncto_buffer.presence IS NOT NULL AND person.presence_date IS NULL THEN asyncto_buffer.modifyTimestamp
  ELSE person.presence_date
END,
person.modifiedBy_id = '0',
person.modificationDate = CURDATE()";
  PREPARE stmt FROM @sql;
  EXECUTE stmt;
  DEALLOCATE PREPARE stmt;


# ================== #
# insert new entries #
# ================== #
  SET @sql := "insert into person (asynctoid, masterlistid, aurovillename, name, surname, status_id, presence_id, community_id, createdBy_id, creationDate)
SELECT  asyncto_buffer.asynctoid, asyncto_buffer.masterlistid, asyncto_buffer.aurovillename, asyncto_buffer.name, asyncto_buffer.surname, status.code, presence.code, community.code, '0', CURDATE()
FROM    asyncto_buffer
left join lookup presence on presence.description = asyncto_buffer.presence and presence.section = 'person_presence'
left join lookup status on status.description = asyncto_buffer.status and status.section = 'person_status'
left join lookup community on community.description = asyncto_buffer.address and community.section = 'community'
WHERE   asyncto_buffer.asynctoid NOT IN (SELECT asynctoid FROM person)";
  PREPARE stmt FROM @sql;
  EXECUTE stmt;
  DEALLOCATE PREPARE stmt;


# ========================== #
# set status & presence date #
# ========================== #
  SET @sql := "update person
left join asyncto_buffer on asyncto_buffer.asynctoid = person.asynctoid
left join lookup presence on presence.description = asyncto_buffer.presence and presence.section = 'person_presence'
left join lookup status on status.description = asyncto_buffer.status and status.section = 'person_status'
SET
person.status_date = CASE WHEN asyncto_buffer.status IS NOT NULL AND person.status_date IS NULL THEN asyncto_buffer.modifyTimestamp ELSE person.status_date END,
person.presence_date = CASE WHEN asyncto_buffer.presence IS NOT NULL AND person.presence_date IS NULL THEN asyncto_buffer.modifyTimestamp ELSE person.presence_date END,
person.modifiedBy_id = 0,
person.modificationDate = CURDATE()";
  PREPARE stmt FROM @sql;
  EXECUTE stmt;
  DEALLOCATE PREPARE stmt;


# ================== #
# set person_contact #
# ================== #
  OPEN cur;
  testLoop: LOOP
  # Get next row
  FETCH NEXT FROM cur INTO _personid, _asynctoid, _telephone, _email;
    # Exit after last row
    IF done THEN
      LEAVE testLoop;
    END IF;
    # Call procedure asyncto_insert_contact
    CALL asyncto_insert_contact(_personid, _asynctoid, _telephone, _email);
  END LOOP testLoop;

  CLOSE cur;
END;
# Doesn't work via yii cdbcommand
# ;;
#delimiter ;




# Loop for inserting each row from asyncto_buffer
DROP PROCEDURE IF EXISTS `asyncto_insert_contact`;
# Doesn't work via yii cdbcommand
#delimiter ;;
CREATE PROCEDURE `asyncto_insert_contact`(IN personid INT, IN asynctoid VARCHAR(32), IN telephone VARCHAR(128), IN email VARCHAR(128)) BEGIN

# Split up the comma-separated phone numbers
IF telephone <> '' THEN
SET @sep = CONCAT("', '1', '1', '", personid, "'");
SET @tels := CONCAT("('", REPLACE(telephone, ",", CONCAT(@sep,"),('")), CONCAT(@sep,")"));
END IF;
# Split up the comma-separated emails
IF email <> '' THEN
SET @sep = CONCAT("', '2', '1', '", personid, "'");
SET @mails := CONCAT("('", REPLACE(email, ",", CONCAT(@sep,"),('")), CONCAT(@sep,")"));
END IF;

#if telephone <> '' THEN select concat(asynctoid,'has email',email) as bla; end if;
# Debug
select @tels as Tel, @mails as Mail;

# Insert telephone numbers
IF @tels IS NOT NULL THEN SET @sql := CONCAT('REPLACE INTO contactdetail(contact, contactType_id, bAsynctoDelete, person_id) VALUES ',@tels);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
END IF;

# Insert emails
IF @tels IS NOT NULL THEN SET @sql := CONCAT('REPLACE INTO contactdetail(contact, contactType_id, bAsynctoDelete, person_id) VALUES ',@mails);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
END IF;

END;
# ;;
#delimiter ;

```

#### Call the procedure from mysql

You can manually call this procedure in mysql by running this command:
```mysql
# Call procedure
CALL asyncto_update_contact();
```

#### Programming the procedure call
You can save **all** the above (*including* `CALL asyncto_update_contact();`) in a file `asyncto_update.sql`.

##### Running the file manually
```sh
mysql -u <USERNAME> -p <DATABASE> < asyncto_update.sql
```

##### Running the file from PHP

```php
<?php
$path = dirname(__FILE__)."/asyncto_update.sql";
if(file_exists($path))
{
    $strQuery = file_get_contents($path);
    $con=mysqli_connect("mysql.host","username","password","database");
    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $con->multi_query($strQuery);
}
?>
```