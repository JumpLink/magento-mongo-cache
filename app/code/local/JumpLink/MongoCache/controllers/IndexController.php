<?php
class JumpLink_MongoCache_IndexController extends Mage_Core_Controller_Front_Action {
 
	/*
	* Return Attribut ID after Ajax
	*
	* @return null
	*/
	function getMessageAction() {
		echo Mage::helper('jumplink_mongocache')->getMessage(); //ruft eine Funktion im Helper auf
	}	
 
}