<?php
class asynctorecorditem extends asynctoitem{
	// Temp fields
	// protected $ldapid;
	private $masterlistid;
	private $fsid;
	private $tsid;

	// ID
	private $asynctoid;

	// Data fields
	private $aurovillename;
	private $name;
	private $surname;
	private $address;
	private $telephone;
	private $email;
	private $presence;
	private $status;
	private $contactperson;
	private $deleteflag;

	protected $title = "child";

	public function __construct()
	{
//		parent::__construct();
		$this->gettableProperties = array_merge($this->gettableProperties, array(
			'masterlistid' => true,
			'fsid' => true,
			'tsid' => true,
			'asynctoid' => true,
			'aurovillename' => true,
			'name' => true,
			'surname' => true,
			'address' => true,
			'telephone' => true,
			'email' => true,
			'presence' => true,
			'status' => true,
			'contactperson' => true,
		));
	}

	public function populateFromPHPArray($arrPHP)
	{
		if(is_array($arrPHP) && count($arrPHP) > 0)
		{
			$this->addLog(new asynctologmessage(asynctologmessage::DEBUG, 0, "Creating Asynctorecord", __METHOD__));

			foreach($arrPHP as $k => $v)
			{
				switch($k)
				{
					case "ldapid":
						if($this->validatePHP($v, "ldapid"))
							$this->ldapid = $v;
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "creatorsname":
						if($this->validatePHP($v, "creatorsname"))
							$this->creatorsname = $v;
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "createtimestamp":
						if($this->validatePHP($v, "createtimestamp"))
							$this->createtimestamp = $v;
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "modifiersname":
						if($this->validatePHP($v, "modifiersname"))
							$this->modifiersname = $v;
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "modifytimestamp":
						if($this->validatePHP($v, "modifytimestamp"))
							$this->modifytimestamp = $v;
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "masterlistid":
						if($this->validatePHP($v, "masterlistid"))
							$this->masterlistid = $v;
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "fsid":
						if($this->validatePHP($v, "fsid"))
							$this->fsid = $v;
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "tsid":
						if($this->validatePHP($v, "tsid"))
							$this->tsid = $v;
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Invalid value ".$k."=".$v, "004", __METHOD__));
					break;

/*
asynctoid doesn't exist as a field...
					case "asynctoid":
						if($this->validatePHP($v, "asynctoid"))
							$this->asynctoid = $v;
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
*/

					case "aurovillename":
						if($this->validatePHP($v, "aurovillename"))
							$this->aurovillename = $v;
					break;
					case "name":
						if($this->validatePHP($v, "name"))
							$this->name = $v;
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "surname":
						if($this->validatePHP($v, "surname"))
							$this->surname = $v;
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "address":
						if($this->validatePHP($v, "address"))
							$this->address = $v;
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "telephone":
						if($this->validatePHP($v, "telephone"))
							$this->telephone = $v;
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "email":
						if($this->validatePHP($v, "email"))
							$this->email = $v;
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "presence":
						if($this->validatePHP($v, "presence"))
							$this->presence = $v;
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "status":
						if($this->validatePHP($v, "status"))
							$this->status = $v;
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "contactperson":
						if($this->validatePHP($v, "contactperson"))
							$this->contactperson = $v;
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "deleteflag":
						if($this->validatePHP($v, "deleteflag"))
							$this->deleteflag = $v;
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Invalid value ".$k."=".$v, "004", __METHOD__));
					break;

					default:
						$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Dropping unknown field ".$k, "002", __METHOD__));
					break;
				}
			}
		}
		else
		{
			$this->addLog(new asynctologmessage(asynctologmessage::WARNING, "Invalid input format", "001", __METHOD__));
		}
	}



	// Assumes sanitized input via asynctoapi::cleanLDAPArray()
	public function populateFromLDAPArray($arrLDAP)
	{
		if(is_array($arrLDAP) && count($arrLDAP) > 0)
		{
			foreach($arrLDAP as $k => $v)
			{
				switch($k)
				{
					case "dn":
						if($this->validateLDAP($v, "dn"))
						{
							$this->ldapid = $v;
							$this->asynctoid = substr($v,4,32);
						}
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "[".$arrLDAP['dn']."] Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "createtimestamp":
						if($this->validateLDAP($v, "createtimestamp"))
							$this->createtimestamp = $this->convertLDAPTimeToPHP($v[0]);
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "[".$arrLDAP['dn']."] Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "creatorsname":
						if($this->validateLDAP($v, "creatorsname"))
							$this->creatorsname = $v[0];
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "[".$arrLDAP['dn']."] Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "modifiersname":
						if($this->validateLDAP($v, "modifiersname"))
							$this->modifiersname = $v[0];
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "[".$arrLDAP['dn']."] Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "modifytimestamp":
						if($this->validateLDAP($v, "modifytimestamp"))
							$this->modifytimestamp = $this->convertLDAPTimeToPHP($v[0]);
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "[".$arrLDAP['dn']."] Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "postalcode":
						if($this->validateLDAP($v, "postalcode"))
							$this->masterlistid = $v[0];
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "[".$arrLDAP['dn']."] Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "facsimiletelephonenumber":
						if($this->validateLDAP($v, "facsimiletelephonenumber"))
							$this->fsid = $v[0];
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "[".$arrLDAP['dn']."] Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "pager":
						if($this->validateLDAP($v, "pager"))
							$this->tsid = $v[0];
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "[".$arrLDAP['dn']."] Invalid value ".$k."=".$v, "004", __METHOD__));
					break;

					case "uid":
						if($this->validateLDAP($v, "uid"))
							$this->fsid = $v[0];
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "[".$arrLDAP['dn']."] Invalid value ".$k."=".$v, "004", __METHOD__));
					break;

					case "cn":
						if($this->validateLDAP($v, "cn"))
							$this->aurovillename = $v[0];
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "[".$arrLDAP['dn']."] Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "givenname":
						if($this->validateLDAP($v, "givenname"))
							$this->name = $v[0];
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "[".$arrLDAP['dn']."] Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "sn":
						if($this->validateLDAP($v, "sn"))
							$this->surname = $v[0];
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "[".$arrLDAP['dn']."] Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "street":
						if($this->validateLDAP($v, "street"))
							$this->address = $v[0];
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "[".$arrLDAP['dn']."] Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "telephonenumber":
						if($this->validateLDAP($v, "telephonenumber"))
							$this->telephone = $v;
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "[".$arrLDAP['dn']."] Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "mail":
						if($this->validateLDAP($v, "mail"))
							$this->email = $v;
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "[".$arrLDAP['dn']."] Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "departmentnumber":
						if($this->validateLDAP($v, "departmentnumber"))
							$this->presence = $v[0];
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "[".$arrLDAP['dn']."] Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "employeetype":
						if($this->validateLDAP($v, "employeetype"))
							$this->status = $v[0];
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "[".$arrLDAP['dn']."] Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "manager":
						if($this->validateLDAP($v, "manager"))
							$this->contactperson = $v[0];
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "[".$arrLDAP['dn']."] Invalid value ".$k."=".$v, "004", __METHOD__));
					break;
					case "title":
						if($this->validateLDAP($v, "title"))
							$this->deleteflag = $v[0];
						else
							$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "[".$arrLDAP['dn']."] Invalid value ".$k."=".$v, "004", __METHOD__));
					break;

					// Common fields to ignore
					case "objectclass":
					case "userpassword":
						$this->addLog(new asynctologmessage(asynctologmessage::DEBUG, "[".$arrLDAP['dn']."] Ignoring field ".$k, "003", __METHOD__));
					break;

					// Unknown field
					default:
						$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "[".$arrLDAP['dn']."] Dropping unknown field ".$k, "002", __METHOD__));
					break;
				}
			}
		}
		// Invalid format
		else
		{
			$this->addLog(new asynctologmessage(asynctologmessage::WARNING, "Invalid input format", "001", __METHOD__));
		}
	}


	// Coarse validation - needs to be improved
	protected function validatePHP($value, $fieldName)
	{
		if(($fieldName == "telephone" || $fieldName == "email"))
			if(is_array($value))
				return true;
			else
				return false;
		else
			if(is_string($value))
				return true;
			else
				return false;
	}

	// Coarse validation - needs to be improved
	protected function validateLDAP($value, $fieldName)
	{
		if($fieldName == "dn")
		{
			if(is_string($value))
				return true;
			else
				return false;
		}
		elseif(($fieldName == "telephonenumber" || $fieldName == "mail" || $fieldName == "objectclass"))
			if(is_array($value))
				return true;
			else
				return false;
		else
			if(is_array($value) && count($value) == 1)
				return true;
			else
				return false;
	}

	private function convertLDAPTimeToPHP($strLDAPTime)
	{
		if( ! strlen($strLDAPTime) == 15)
		{
			$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, "Invalid time format ".$strLDAPTime, "101", __METHOD__));
			return null;
		}

		return new DateTime(
			substr($strLDAPTime, 0,4)."-".substr($strLDAPTime, 4,2)."-".substr($strLDAPTime, 6,2)." ".substr($strLDAPTime, 8,2).":".substr($strLDAPTime, 10,2).":".substr($strLDAPTime, 12,2)." GMT"
			);
	}

	public function convertToPHPArray()
	{
		$r = array();

		$r['ldapid'] = $this->ldapid;
		$r['createTimestamp'] = $this->createTimestamp;
		$r['creatorsName'] = $this->creatorsName;
		$r['modifiersName'] = $this->modifiersName;
		$r['modifyTimestamp'] = $this->modifyTimestamp;

		$r['masterlistid'] = $this->masterlistid;
		$r['fsid'] = $this->fsid;
		$r['tsid'] = $this->tsid;

		$r['populateFromLDAPArray'] = $this->asynctoid;

		$r['aurovillename'] = $this->aurovillename;
		$r['name'] = $this->name;
		$r['surname'] = $this->surname;
		$r['address'] = $this->address;
		$r['telephone'] = $this->telephone;
		$r['email'] = $this->email;
		$r['presence'] = $this->presence;
		$r['status'] = $this->status;
		$r['contactperson'] = $this->contactperson;
		$r['deleteflag'] = $this->deleteflag;

		return $r;
	}

	public static function getLDAPAttributeList()
	{
		return array_merge(parent::getLDAPAttributeList(), array(
						'postalcode',
						'facsimiletelephonenumber',
						'pager',

						'asynctoid',

						'cn',
						'givenname',
						'sn',
						'street',
						'telephonenumber',
						'mail',
						'departmentnumber',
						'employeetype',
						'manager',
						'title',
					));
	}

	public function convertToLDAPArray()
	{
		$l = array();
		if($this->ldapid && is_string($this->ldapid))
			$l['dn'][0] = $this->ldapid;
		if($this->createTimestamp && is_string($this->createTimestamp))
			$l['createTimestamp'][0] = $this->createTimestamp;
		if($this->creatorsName && is_string($this->creatorsName))
			$l['creatorsName'][0] = $this->creatorsName;
		if($this->modifiersName && is_string($this->modifiersName))
			$l['modifiersName'][0] = $this->modifiersName;
		if($this->modifyTimestamp && is_string($this->modifyTimestamp))
			$l['modifyTimestamp'][0] = $this->modifyTimestamp;

		if($this->masterlistid && is_string($this->masterlistid))
			$l['postalcode'][0] = $this->masterlistid;
		if($this->fsid && is_string($this->fsid))
			$l['facsimiletelephonenumber'][0] = $this->fsid;
		if($this->tsid && is_string($this->tsid))
			$l['pager'][0] = $this->tsid;

		if($this->asynctoid && is_string($this->asynctoid))
			$l['asynctoid'][0] = $this->asynctoid;

		if($this->aurovillename && is_string($this->aurovillename))
			$l['cn'][0] = $this->aurovillename;
		if($this->name && is_string($this->name))
			$l['givenname'][0] = $this->name;
		if($this->surname && is_string($this->surname))
			$l['sn'][0] = $this->surname;
		if($this->address && is_string($this->address))
			$l['street'][0] = $this->address;
		// Array/multi-value
		if($this->telephone && is_array($this->telephone))
			$l['telephonenumber'] = $this->telephone;
		// Array/multi-value
		if($this->email && is_array($this->email))
			$l['mail'] = $this->email;
		if($this->presence && is_string($this->presence))
			$l['departmentnumber'][0] = $this->presence;
		if($this->status && is_string($this->status))
			$l['employeetype'][0] = $this->status;
		if($this->contactperson && is_string($this->contactperson))
			$l['manager'][0] = $this->contactperson;
		if($this->deleteflag && is_string($this->deleteflag))
			$l['title'][0] = $this->deleteflag;

		return $l;
	}

	public function createLDAPSearchArray($strBooleanOperator = "or", $strStrictSearch = false)
	{
		$r = $this->convertToLDAPArray();

		if($strStrictSearch)
			$strWildcard = "";
		else
			$strWildcard = "*";

		$search = array();
		foreach($r as $k => $v)
		{
			if(is_array($v) && count($v) > 0)
				foreach($v as $sv)
					$search[] = $k."=".$sv.$strWildcard;
		}

		print_r($r);
		print_r($search);
		return $search;
	}

	public function __toString()
	{
		return "[".$this->ldapid."] => ".$this->aurovillename." [".$this->name." ".$this->surname."]";
	}

	public function __get($name)
	{
		if(property_exists(__CLASS__, $name) && array_key_exists($name, $this->gettableProperties))
		{
			if(is_a($this->{$name}, "DateTime"))
				return $this->{$name}->format('Y-m-d H:i:s');
			if(is_array($this->{$name}) && count($this->{$name}) > 0)
				return implode(",", $this->{$name});
			else
				return $this->{$name};
		}
	}
}
?>