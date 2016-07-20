<?php
abstract class asynctoapi
{
	// List of log messages
	protected $arrLogMessages;
	// Print log messages to screen as they arrive ?
	protected $bPrintLogMessages = false;
	// Print only messages >= to this level
	protected $bPrintLogMessagesThreshold = asynctologmessage::NOTICE;

	// Add item to log
	// Print log if settings say so
	protected function addLog($asynctoLogMessage)
	{
		$this->arrLogMessages[] = $asynctoLogMessage;
		if($this->bPrintLogMessages && $asynctoLogMessage->getLevel() >= $this->bPrintLogMessagesThreshold)
			print($asynctoLogMessage."\n");
	}

	// Enable printing of incoming log messages
	public function printLogMessages($bPrintLogMessages = false)
	{
		$this->bPrintLogMessages = $bPrintLogMessages;
	}

	// Set printing threshold
	public function setLogMessagesThreshold($iThreshold = asynctologmessage::NOTICE)
	{
		$this->bPrintLogMessageThreshold = $iThreshold;
	}

	// Delete all log items
	public function flushLog($bConfirm = false)
	{
		if($bConfirm === true)
			$this->arrLogMessages = array(new asynctologmessage(asynctologmessage::WARNING, "Flushed log messages", "000", __METHOD__));
	}

	// Generic __toString function for all asyncto descendents
	public function __toString()
	{
  	$r = "Object \"".get_class($this)."\"\n";
  	$r .= "Log of events:\n";
		foreach($this->arrLogMessages as $m)
		{
			$r .= $m."\n";
		}
		return $r;
	}

	// Prepare log for display on screen
  public function compileLog($bFlush = false)
  {
  	$r = "";
	  foreach($this->arrLogMessages as $l => $v)
	  {
		  $r.= $l." ".$v."\n";
	  }
	  if($bFlush)
	  	$this->arrLogMessages = array();
	  return $r;
  }

  protected function cleanLDAPArray($arrLDAP)
  {
		if(is_array($arrLDAP) && count($arrLDAP) > 0)
		{
			// Check if array of LDAP values, or array of arrays of LDAP values
			// If there are only int indexes in array => array of arrays
			// If there are int & str indexes => LDAP array
			$bKeepIntKeys = true;
		  foreach($arrLDAP as $k => $v)
			{
				if(is_string($k) && $k == "count")
					continue;
				elseif(is_int($k))
					$bKeepIntKeys = $bKeepIntKeys && true;
				else
					$bKeepIntKeys = $bKeepIntKeys && false;
			}

		  foreach($arrLDAP as $k => $v)
		  {
				if(is_int($k) && !is_array($v) && ! $bKeepIntKeys)
				{
					$this->addLog(new asynctologmessage(asynctologmessage::DEBUG, "Removing item #".$k."=".$v, "001", __METHOD__));
					unset($arrLDAP[$k]);
					continue;
				}
				// PHP-LDAP displays count in the LDAP Array
				// Remove it
				elseif(is_string($k) && $k == "count")
				{
					$this->addLog(new asynctologmessage(asynctologmessage::DEBUG, "Removing PHP-LDAP '".$k."=".$v."'", "002", __METHOD__));
					unset($arrLDAP[$k]);
					continue;
				}
				elseif(is_array($v))
				{
					$arrLDAP[$k] = $this->cleanLDAPArray($v);
				}
		  }
		  return $arrLDAP;
		}
		else
		{
			return null;
		}
  }

  /**
   * Creates a UUID-v4 (asyncto-compatible) new asyncto ID
   *
   * @return  string  asyncto ID (32 characters)
   */
	public function generate_asynctoid()
	{
    $strID = sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),
        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,
        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,
        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
    return str_replace('-', '', $strID);
	}
}
?>