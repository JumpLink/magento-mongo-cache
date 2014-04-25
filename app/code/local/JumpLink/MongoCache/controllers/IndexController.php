<?php
class JumpLink_MongoCache_IndexController extends Mage_Core_Controller_Front_Action {
 
	/*
	* URL: <domain>/mongocache/index/debug
	*
	* @return null
	*/
	function debugAction() {
		echo Mage::helper('jumplink_mongocache')->getServerString(); //ruft eine Funktion im Helper auf
    Mage::helper('jumplink_mongocache')->testConnection();
	}
 
}