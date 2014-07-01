<?php
class JumpLink_MongoCache_Helper_Product extends Mage_Core_Helper_Abstract {
 
  var $api;

  /*
  * Constructor
  *
  *
  */
  public function __construct() {
    $this->api  = new JumpLink_API_Model_Product_Api;
  }

  public function getCollection($db) {
    //return $db->selectCollection('products');
    //return $db->products;
    return new MongoCollection($db, 'products');
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
    $productId = null;
    $store = null;
    $all_stores = true;
    $attributes = null;
    $identifierType = 'id';  // id | sku
    $integrate_set = false;
    $normalize = true;
    $filters = null;

    //$result = $this->api->export($productId, $store, $all_stores, $attributes, $identifierType, $integrate_set, $normalize);
    $result = $this->api->items($filters, $store);

    return $result;
  }

  // exportToCache
  public function import() {
    $list = $this->getList();
    var_dump($list);
  }

  // exportEachByProductList
  public function importByList($productList) {

  }

 
}