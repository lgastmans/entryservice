<?php
class asynctolistitem extends asynctoitem{

	// Value
	private $value;
	protected $gettableProperties;

	public function __construct()
	{
		parent::__construct();
		$this->gettableProperties = array_merge($this->gettableProperties, array('value'=>true));
	}

	public function populateFromPHPArray($arrPHP)
	{
		$this->addLog(new asynctologmessage(asynctologmessage::ERROR, "Not implemented", "101", __METHOD__));
	}

	// Assumes sanitized input via asynctoapi::cleanLDAPArray()
	public function populateFromLDAPArray($arrLDAP)
	{
		if(is_array($arrLDAP) && count($arrLDAP) > 0)
		{
			$this->addLog(new asynctologmessage(asynctologmessage::NOTICE, 0, "Creating asynctolistitem", __METHOD__));

			if(array_key_exists("o", $arrLDAP))
			{
				$this->ldapid = $arrLDAP['dn'];
				$this->value = $arrLDAP['o'][0];
			}
			elseif(array_key_exists("cn", $arrLDAP))
			{
				$this->ldapid = $arrLDAP['dn'];
				$this->value = $arrLDAP['cn'][0];
			}
			else
				$this->addLog(new asynctologmessage(asynctologmessage::WARNING, "Unknown key for list ".$k, "100", __METHOD__));
		}
		// Invalid format
		else
		{
			$this->addLog(new asynctologmessage(asynctologmessage::WARNING, "Invalid input format", "101", __METHOD__));
		}
	}

	public function convertToPHPArray()
	{
		$r = array();

		$r['ldapid'] = $this->ldapid;
		$r['value'] = $this->value;

		return $r;
	}

	public function convertToLDAPArray()
	{
		$this->addLog(new asynctologmessage(asynctologmessage::ERROR, "Not implemented", "101", __METHOD__));
	}

	public function __toString()
	{
		return "[".$this->ldapid."] => ".$this->value;
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