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
	public function getServerString() {
		return "mongodb://".$this->username.":".$this->password."@".$this->host.":".$this->port."/".$this->database;
	}

	public function connect() {
		try {
			// open connection to MongoDB server
			return new MongoClient($this->getServerString());
		} catch (MongoConnectionException $e) {
			die('Error connecting to MongoDB server: ' . $e->getMessage());
		} catch (MongoException $e) {
			die('Error: ' . $e->getMessage());
		}
	}

	public function getDB($conn) {
		try {
			// access database
			return $conn->selectDB($this->database);
		} catch (MongoException $e) {
			die('Error: ' . $e->getMessage());
		}
	}

	/*
	* Gibt String zurück
	*
	* @return string
	*/
	public function testConnection() {
		try {
			// open connection to MongoDB server
			$conn = $this->connect();
			var_dump($conn);

			// access database
			$db = $this->getDB($conn);
			var_dump($db);

			// access collection
			$products = Mage::helper('jumplink_mongocache/product')->getCollection($db);
			var_dump($product);

			// execute query
			// retrieve all documents
			$cursor = $products->find();

			// iterate through the result set
			// print each document
			echo $cursor->count() . ' document(s) found. <br/>';  
			foreach ($cursor as $obj) {
				echo 'Name: ' . $obj['name'] . '<br/>';
				echo 'Price: ' . $obj['price'] . '<br/>';
				echo '<br/>';
			}


			// disconnect from server
			$conn->close();
		} catch (MongoConnectionException $e) {
			die('Error connecting to MongoDB server: ' . $e->getMessage());
		} catch (MongoException $e) {
			die('Error: ' . $e->getMessage());
		}
	}


}