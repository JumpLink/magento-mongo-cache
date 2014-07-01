<?php
class JumpLink_MongoCache_Helper_Product extends Mage_Core_Helper_Abstract {
 
  var $sql;       // MySQL Productx
  var $mongo;  // MongoDB Products Collection

  /*
  * Constructor
  *
  *
  */
  public function __construct() {
    $this->sql  = new JumpLink_API_Model_Product_Api;
  }

  public function setCollection($db) {
    $this->mongo = new MongoCollection($db, 'products');
  }

  public function getCollection() {
    return $this->mongo;
  }
 
  public function updateOrCreate($newProduct) {
    $result = $this->mongo->update(array("id" => $newProduct['id']), $newProduct, array('upsert' => true));
    var_dump($result);
    return $result;
/*    $cursor = $this->mongo->find(array("id" => $newProduct['id']));
    if ($cursor.count() >= 1) {
      $this->mongo->update(array("id" => $newProduct['id']), $newProduct, array('upsert' => true));
    }*/
  }

  public function updateOnChanges($id, $newProduct, $oldProduct) {

  }

  // exportOneToCacheByID
  public function importOneByID($productId) {
    $store = null;
    $all_stores = true;
    $attributes = null;
    $identifierType = 'id';  // id | sku
    $integrate_set = false;
    $normalize = true;

    $info = $this->sql->export($productId, $store, $all_stores, $attributes, $identifierType, $integrate_set, $normalize);
    $this->updateOrCreate($info);
  }


  // exportEachByProductList
  public function importByList($productList) {
    foreach ($productList as $key => $product) {
      print("import product by id: ".$product['id']."\n");
      $this->importOneByID($product['id']);
    }
  }

  // exportToCache
  public function import() {
    $list = $this->sql->items($filters, $store);
    //var_dump($list);
    $this->importByList($list);
  }

 
}