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
 
  // public function replace($newProduct) {
  //   $result = $this->mongo->save(array("id" => $newProduct['id']), array('$set' => $newProduct), array('upsert' => true));
  //   var_dump($result);
  //   return $result;
  // }

  public function updateOrCreate($newProduct) {
    $result = $this->mongo->save($newProduct);
    //$result = $this->mongo->update(array("id" => $newProduct['id']), array('$set' => $newProduct), array('upsert' => true));
    var_dump($result);
    return $result;
  }

  public function updateOnChanges($newProduct) {
    $oldProduct = $this->mongo->findOne(array("id" => $newProduct['id']));
    $newProduct["_id"] = $oldProduct["_id"];
    if($oldProduct != $newProduct) {
      print("Product ".$newProduct['id']." HAS changes.\n");
      print("old Product:\n");
      var_dump($oldProduct);
      print("new Product:\n");
      var_dump($newProduct);
      return $this->updateOrCreate($newProduct);
    } else {
      print("Product ".$newProduct['id']." has NO changes.");
      return null;
    }

  }

  // exportOneToCacheByID
  public function importOneByID($productId) {
    $store = null;
    $all_stores = true;
    $attributes = null;
    $identifierType = 'id';  // id | sku
    $integrate_set = true;
    $normalize = true;
    $integrate_media = true;

    $info = $this->sql->export($productId, $store, $all_stores, $attributes, $identifierType, $integrate_set, $normalize, $integrate_media);
    $this->updateOnChanges($info);
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
