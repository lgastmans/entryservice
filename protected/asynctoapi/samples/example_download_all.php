<pre>
<?php
// Include all asyncto****.class.php files
foreach (glob(dirname(__FILE__)."/../*.class.php") as $filename)
{
	include_once($filename);
}

// Create asynctoconnection instance
// Note: Lookup::item('asyncto','ITEM_NAME') extract stored settings from database
// Alternate code:
/*
$u = "cn=USERNAME,ou=ldapuser,dc=asyncto,dc=auroville,dc=org,dc=in"
$p = "PASSWORD"
$o = array(
	"url" => "asyncto.auroville.org.in",
	"port" => 389,
	"usetls" => 0,
	"reqcert" => "never",
	"error_reporting_level" => E_ALL & ~E_NOTICE,
);
*/
// Username
$u = Lookup::item('asyncto','username');
// Password
$p = Lookup::item('asyncto','password');
// Connection options
$o = array(
	"url" => Lookup::item('asyncto','host'),
	"port" => Lookup::item('asyncto','port'),
	"usetls" => 0,
	"reqcert" => "never",
	"error_reporting_level" => E_ALL & ~E_NOTICE,
);

// Instantiate AsynctoConnection object
$a = new asynctoconnection($u, $p, $o);

// Download all records from ou=people,dc=asyncto,dc=auroville,dc=org,dc=in
$arrPeople = $a->getPeople(10);
var_dump($arrPeople);

// Download all records from ou=virtualentities,dc=asyncto,dc=auroville,dc=org,dc=in
$arrVirtualentities = $a->getVirtualentities(10);
var_dump($arrVirtualentities);


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

/*
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
) ENGINE=InnoDB AUTO_INCREMENT=2800 DEFAULT CHARSET=utf8
*/

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
mysqli_close($con);




// Show asyncto connection error messages
print($a);


?>
</pre>