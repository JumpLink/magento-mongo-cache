<?php
class Entwickler_Optionswitcher_IndexController extends Mage_Core_Controller_Front_Action {
 
	/*
	* Return Attribut ID after Ajax
	*
	* @return null
	*/
	function getMessageAction() {
		echo Mage::helper('entwickler_optionswitcher')->getMessage(); //ruft eine Funktion im Helper auf
	}	
 
}