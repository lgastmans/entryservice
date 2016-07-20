<?php
abstract class asynctoitem extends asynctoapi{

	protected $title ="parent";

	protected $ldapid;

	protected $creatorsname;
	protected $createtimestamp;
	protected $modifiersname;
	protected $modifytimestamp;

	protected $gettableProperties;

	abstract public function populateFromPHPArray($arrPHP);

	abstract public function convertToPHPArray();

	abstract public function populateFromLDAPArray($arrLDAP);

	abstract public function convertToLDAPArray();

	public static function getLDAPAttributeList()
	{
		return array(
			'dn',
			'createtimestamp',
			'creatorsname',
			'modifiersname',
			'modifytimestamp',
		);
	}

	public function __construct()
	{
		$this->gettableProperties = array(
			'ldapid'=>true,
			'creatorsname'=>true,
			'createtimestamp'=>true,
			'modifiersname'=>true,
			'modifytimestamp'=>true
		);
	}

	public function __toString()
	{
		return $ldapid;
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

	public function getCreatetimestamp()
	{
		if($this->createtimestamp)
			return $this->createtimestamp->format('Y-m-d H:i:s');
	}

	public function getModifytimestamp()
	{
		if($this->modifytimestamp)
			return $this->modifytimestamp->format('Y-m-d H:i:s');
	}
}
?>