<?php
class asynctoconnection extends asynctoapi{

/*
  Copy the server certificates to sys:/php5/cert directory. This location is configurable in php.ini file.
  on mac:
  /usr/lib/php/cert
  (create the cert directory)

  Note: you can get the certificate by using thunderbird.
  Or it's the file on the server in /etc/ldap/certs/ldapscert.pem
*/

/*
 Raw database access
 http://asyncto.bluelightav.org:8282/phpldapadmin/index.php
*/

// Username
protected $username;
// Password
protected $password;
// Server URL
protected $url = "asyncto.auroville.org.in";
// Port to connect to on the Asyncto server. 389 = plain-text (ldap), 636 = ssl-encrypted (ldaps)
protected $port = 389;
// Use TLS on port 389
protected $usetls = true;
// Require certificate for validating encryption
protected $reqcert = "never";
// Certificate path - dirname($_SERVER['SCRIPT_FILENAME'])."/certs/ldapscert.pem"
protected $certpath;

// Version of LDAP to use
protected $protocolversion = 3;
// Variable holding the TCP connection
protected $connection;
// Variable hodling the authentication "connection"
protected $bind;
// Base DN - Root of the LDAP tree
protected $basedn               = "dc=asyncto,dc=auroville,dc=org,dc=in";
// Array of log entries. Structure is array(id => array ('level'=>'message'))
protected $listsBase            = "ou=lists,dc=asyncto,dc=auroville,dc=org,dc=in";
protected $peopleBase           = "ou=people,dc=asyncto,dc=auroville,dc=org,dc=in";
protected $peoplePendingBase    = "ou=pending,ou=people,dc=asyncto,dc=auroville,dc=org,dc=in";
protected $peopleArchiveBase    = "ou=archive,ou=people,dc=asyncto,dc=auroville,dc=org,dc=in";
protected $virtualentitiesBase  = "ou=virtualentities,dc=asyncto,dc=auroville,dc=org,dc=in";

// Level of error reporting as per PHP http://www.php.net//manual/en/function.error-reporting.php
protected $php_error_reporting_level = 0;
// Follow LDAP referals
protected $ldap_referrals = 1;

// Array to map from LDAP to Asyncto
protected $map_ldap_asyncto = array(
	"uid" => "asynctoid",
	"cn" => "aurovillename",
	"givenname" => "name",
	"sn" => "surname",
	"street" => "address",
	"telephonenumber" => "telephone",
	"mail" => "email",
	"departmentnumber" => "presence",
	"employeetype" => "status",
	"manager" => "contactperson",
	"title" => "deleteflag",
	"dn" => "ldapid",
	"postalcode" => "masterlistid",
	"facsimiletelephonenumber" => "fsid",
	"pager" => "tsid",
);

// Array to map from Asyncto to LDAP
protected $map_asyncto_ldap = array(
	"asynctoid" => "uid",
	"aurovillename" => "cn",
	"name" => "givenname",
	"surname" => "sn",
	"address" => "street",
	"telephone" => "telephonenumber",
	"email" => "mail",
	"presence" => "departmentnumber",
	"status" => "employeetype",
	"contactperson" => "manager",
	"deleteflag" => "title",
	"ldapid" => "dn",

	"masterlistid" => "postalcode",
	"fsid" => "facsimiletelephonenumber",
	"tsid" => "pager",
);

	public function __construct($username, $password, $options = array())
  {
		foreach($options as $k => $v)
		{
			switch($k)
			{
				// Enable logging first !
				case "asyncto_error_reporting_print":
					$this->bPrintLogMessages = $v === true ? true : false;
					$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Set asyncto_error_reporting_print=".$this->bPrintLogMessages, "012", __METHOD__));
				break;

				// Set logging level second !
				case "asyncto_error_reporting_level":
					$this->bPrintLogMessagesThreshold = $v;
					$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Set asyncto_error_reporting_level=".$v, "011", __METHOD__));
				break;

				case "php_error_reporting_level":
					$this->php_error_reporting_level = $v;
					$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Set php_error_reporting_level=".$v, "010", __METHOD__));
				break;

				case "url":
					$this->url = $v;
					$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Set url=".$v, "003", __METHOD__));
				break;

				case "port":
					$this->port = $v;
					$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Set port=".$v, "004", __METHOD__));
				break;

				case "usetls":
					$this->usetls = $v;
					$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Set usetls=".$v, "005", __METHOD__));
				break;

				case "reqcert":
					$this->reqcert = $v;
					$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Set reqcert=".$v, "006", __METHOD__));
				break;

				case "certpath":
					$this->certpath = $v;
					$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Set certpath=".$v, "007", __METHOD__));
				break;

				case "protocolversion":
					$this->protocolversion = $v;
					$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Set protocolversion=".$v, "008", __METHOD__));
				break;

				case "basedn":
					$this->basedn = $v;
					$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Set basedn=".$v, "009", __METHOD__));
				break;



				case "ldap_referrals":
					$this->ldap_referrals = $v;
					$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Set ldap_referrals=".$v, "013", __METHOD__));
				break;

				default:
					$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Unknown field '".$k."' with value ".$v, "101", __METHOD__));
				break;
			}
		}

		if( ! extension_loaded('ldap'))
		{
			$this->addLog(new asynctologmessage(asynctologmessage::CRITICAL, "LDAP Extension not installed", "991", __METHOD__));
			throw new Exception('LDAP Extension not installed');
		}

		$this->username = $username;
		$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Set username=".$username, "001", __METHOD__));
		$this->password = $password;
		$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Set password=***hidden***", "002", __METHOD__));

	  error_reporting($this->php_error_reporting_level);
		$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Applying PHP error reporting to ".$this->php_error_reporting_level, "012", __METHOD__));
	}



  /**
   * Function to connect to LDAP. This function should be called by any function requirying a connection
   *
   * @return bool 1 on success, 0 on failure. Check log for error description
   */
	private function connect()
	{
    // Already bound, do not reconnect
    if($this->bind)
    {
			$this->addLog(new asynctologmessage(asynctologmessage::DEBUG, "Already connected", "200", __METHOD__));
      return 0;
    }
    // Try to connect
    else
    {
    	// Starting connection
			$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Init", "000", __METHOD__));
      $this->connection = @ldap_connect($this->url, $this->port)
      or $this->addLog(new asynctologmessage(asynctologmessage::ERROR, "\"".ldap_errno($this->connection)."\" while binding: \"".ldap_error($this->connection)."\"", "100", __METHOD__));

      if(!$this->connection)
      {
				$this->addLog(new asynctologmessage(asynctologmessage::ERROR, "\"".ldap_errno($this->connection)."\" while binding: \"".ldap_error($this->connection)."\"", "101", __METHOD__));
        return 100;
      }

      // Use specific version for LDAP transactions
			$this->addLog(new asynctologmessage(asynctologmessage::DEBUG, "Enabling LDAP Protocol version ".$this->protocolversion, "001", __METHOD__));
      ldap_set_option($this->connection, LDAP_OPT_PROTOCOL_VERSION, $this->protocolversion);

      // Follow LDAP referrals
			$this->addLog(new asynctologmessage(asynctologmessage::DEBUG, "Enabling referrals", "002", __METHOD__));
      ldap_set_option($this->connection, LDAP_OPT_REFERRALS, $this->ldap_referrals);

      // TLS
      if($this->port == 389 && $this->usetls === TRUE)
      {
				$this->addLog(new asynctologmessage(asynctologmessage::DEBUG, "Enabling TLS", "003", __METHOD__));
        ldap_start_tls($this->connection);
      }

			// Connection ok
      if ($this->connection)
      {
      	// Connection ok
				$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "successfully connected. ".$this->connection, "004", __METHOD__));
        $this->bind = @ldap_bind($this->connection, $this->username, $this->password);
				// Failed to bind
        if(!$this->bind)
        {
					$this->addLog(new asynctologmessage(asynctologmessage::ERROR, "\"".ldap_errno($this->connection)."\" while binding: \"".ldap_error($this->connection)."\"", "102", __METHOD__));
          return 102;
        }
        // Bound ok
        else
        {
					$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "asyncto_connect: successfully bound to basedn \"".$this->basedn."\"", "005", __METHOD__));
          return 0;
        }
      }
      // Failed to connect
      else
      {
				$this->addLog(new asynctologmessage(asynctologmessage::ERROR, "\"".ldap_errno($this->connection)."\" while connecting: \"".ldap_error($this->connection)."\"", "101", __METHOD__));
        return 101;
      }
    }
	}


  public function search($asynctoRecord)
  {
		$sa = $asynctoRecord->createLDAPSearchArray();
		$r = $this->search($this->searcharray_combine($sa));
		$r = $this->cleanLDAPArray($r);
		$arrResult = array();
		if(is_array($r) && count($r) > 0)
		{
			foreach($r as $v)
			{
				$tmp = new asynctorecord();
				$tmp->populateFromLDAPArray($v);
				$arrResult[] = $tmp;
/* var_dump($v); */
/* print_r($v); */
/* print_r($tmp); */
			}
		}
/* 		print_r($arrResult); */
		return $arrResult;
  }

	public function getLists()
	{
		$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Init", "000", __METHOD__));

		if( ! $this->listsBase)
		{
			$this->addLog(new asynctologmessage(asynctologmessage::ERROR, "Invalid lists base", "101", __METHOD__));
			return null;
		}

		$this->connect();
		if( ! $this->connection)
		{
			$this->addLog(new asynctologmessage(asynctologmessage::CRITICAL, "Connection broken", "102", __METHOD__));
			return null;
		}

    // Get the list of lists in LDAP format
		$sr = ldap_list($this->connection, $this->listsBase, "objectclass=*");
		$arrListsBase = $this->cleanLDAPArray(ldap_get_entries($this->connection, $sr));
		$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Found ".count($arrListsBase)." different lists", "001", __METHOD__));

		if( ! is_array($arrListsBase) || ! count($arrListsBase))
		{
			$this->addLog(new asynctologmessage(asynctologmessage::ERROR, "No lists found", "103", __METHOD__));
			return null;
		}

		$arrListDNs = array();
		foreach($arrListsBase as $l)
		{
			$arrListDNs[$l['ou'][0]] = $l['dn'];
		}

		if( ! is_array($arrListDNs) || ! count($arrListDNs))
		{
			$this->addLog(new asynctologmessage(asynctologmessage::WARNING, "Invalid lists", "104", __METHOD__));
			return null;
		}

//print_r($arrListDNs);

		if( ! $this->connection || ! is_array($arrListDNs) || ! count($arrListDNs))
		{
			$this->addLog(new asynctologmessage(asynctologmessage::CRITICAL, "Connection broken", "105", __METHOD__));
			return null;
		}

//print_r($this->connection);

    // Get the lists in LDAP format
		$arrListsLDAP = array();
		foreach($arrListDNs as $k => $base)
		{
			$sr = ldap_list($this->connection, $base, "objectclass=*");
			$arrListsLDAP[$k] = $this->cleanLDAPArray(ldap_get_entries($this->connection, $sr));
		}

		$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Downloaded ".count($arrListsLDAP)." Lists", "010", __METHOD__));

		// Convert to asynctolistitem
		$arrLists = array();
		foreach($arrListsLDAP as $k => $m)
			foreach($m as $i => $l)
			{
				$li = new asynctolistitem();
				$li->populateFromLDAPArray($l);

				$arrLists[$k][] = $li;
			}

/*
		foreach($arrLists as $i => $l)
		{
			print("<h3>List ".$i."</h3>");
			print("<ul>");
			foreach($l as $li)
				print("<li>".$li."</li>");
			print("</ul>");
		}
*/
		$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Returning ".count($arrVirtualentities)." Lists", "011", __METHOD__));
		return $arrLists;
	}

	public function getPeople($iLimit = false)
	{
		$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Init", "000", __METHOD__));
		return $this->getAtbase($iLimit, $this->peopleBase);
	}

	public function getVirtualentities($iLimit = false)
	{
		$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Init", "000", __METHOD__));
		return $this->getAtbase($iLimit, $this->virtualentitiesBase);
	}

	public function getPeoplePending($iLimit = false)
	{
		$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Init", "000", __METHOD__));
		return $this->getAtbase($iLimit, $this->peoplePendingBase);
	}

	public function getPeopleArchive($iLimit = false)
	{
		$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Init", "000", __METHOD__));
		return $this->getAtbase($iLimit, $this->peopleArchiveBase);
	}

	public function getAtbase($iLimit = false, $strBase)
	{
		if($iLimit)
			$this->addLog(new asynctologmessage(asynctologmessage::DEBUG, "Download limit set to ".$iLimit, "001", __METHOD__));

		if( ! $strBase)
		{
			$this->addLog(new asynctologmessage(asynctologmessage::ERROR, "Invalid base", "101", __METHOD__));
			return null;
		}

		$e = $this->connect();
		if($e)
		{
			$this->addLog(new asynctologmessage(asynctologmessage::CRITICAL, "Unable to connect", "102", __METHOD__));
			return null;
		}
		if( ! $this->connection)
		{
			$this->addLog(new asynctologmessage(asynctologmessage::CRITICAL, "Connection broken", "103", __METHOD__));
			return null;
		}

		if($iLimit && is_int($iLimit))
			$sr = @ldap_list($this->connection, $strBase, "objectclass=inetOrgPerson", asynctorecorditem::getLDAPAttributeList(), 0, $iLimit);
		else
			$sr = @ldap_list($this->connection, $strBase, "objectclass=inetOrgPerson", asynctorecorditem::getLDAPAttributeList());

		if( ! $sr)
		{
			$this->addLog(new asynctologmessage(asynctologmessage::ERROR, "No entries found", "104", __METHOD__));
			return null;
		}

		$arrResultLDAP = $this->cleanLDAPArray(ldap_get_entries($this->connection, $sr));
		$this->addLog(new asynctologmessage(asynctologmessage::DEBUG, "Downloaded ".count($arrResultLDAP)." Entries", "010", __METHOD__));
/* print_r($arrPeopleLDAP); */

		// Convert to asynctorecorditem
		$arrResult = array();
		foreach($arrResultLDAP as $i => $p)
		{
			$pi = new asynctorecorditem();
			$pi->populateFromLDAPArray($p);
			$arrResult[] = $pi;
		}

//print_r($arrPeople);
		$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Returning ".count($arrResult)." Entries", "011", __METHOD__));
		return $arrResult;
	}

}