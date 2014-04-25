<?php
class JumpLink_MongoCache_Helper_Product extends Mage_Core_Helper_Abstract {
 
  /*
  * Constructor
  *
  *
  */
  public function __construct() {

  }

  public function getCollection($db) {
    return $db->selectCollection('productcache');
  }
 
  /*
  * Gibt String zurück
  *
  * @return string
  */
  public function updateOrCreate($newProduct) {

  }

  public function updateOnChanges($id, $newProduct, $oldProduct) {

  }

  // exportOneToCacheByID
  public function importOneByID($id) {

  }

  // getProductList
  public function getList() {

  }

  // exportToCache
  public function import() {

  }

  // exportEachByProductList
  public function importByList($productList) {

  }

 
}