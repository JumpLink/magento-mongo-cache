<?php
class JumpLink_MongoCache_Helper_Data extends Mage_Core_Helper_Abstract {
 
	var $text;
 
	/*
	* Constructor
	*
	*
	*/
	public function __construct() {
		$this->text = Mage::getStoreConfig('mongocache/optionsswitchglobalconfig/text',Mage::app()->getStore());
	}
 
	/*
	* Gibt String zurück
	*
	* @return string
	*/
	public function getMessage() {
		return "Mein Text ".$this->text;
	}
 
}