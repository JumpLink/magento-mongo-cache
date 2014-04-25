<?php
class JumpLink_MongoCache_Helper_Data extends Mage_Core_Helper_Abstract {
 
	var $username;
	var $password;
  var $host;
  var $port;
  var $database;
	/*
	* Constructor
	*
	*
	*/
	public function __construct() {
		$this->username = Mage::getStoreConfig('mongocache/mongocacheglobalconfig/username',Mage::app()->getStore());
		$this->password = Mage::getStoreConfig('mongocache/mongocacheglobalconfig/password',Mage::app()->getStore());
		$this->host = Mage::getStoreConfig('mongocache/mongocacheglobalconfig/host',Mage::app()->getStore());
		$this->port = Mage::getStoreConfig('mongocache/mongocacheglobalconfig/port',Mage::app()->getStore());
		$this->database = Mage::getStoreConfig('mongocache/mongocacheglobalconfig/database',Mage::app()->getStore());
	}
 
	/*
	* Gibt String zurück
	*
	* @return string
	*/
	public function getConfig() {
		return "username ".$this->username."<br>"."password ".$this->password."<br>"."host ".$this->host."<br>"."port ".$this->port."<br>"."database ".$this->database."<br>";
	}
 
}