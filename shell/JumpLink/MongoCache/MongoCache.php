#!/usr/bin/php
<?php
/*
 *
 */

if (file_exists($shell = __DIR__.'/../../../../../../../shell/abstract.php')) {
    require_once $shell;
} else {
  print ('Error: File not found: "'.$shell.'"'.PHP_EOL);
}

if (file_exists($autoload = __DIR__.'/../../../../../../../vendor/autoload.php')) {
    require_once $autoload;
} else {
  print ('Error: File not found: "'.$autoload.'", you need to run composer install first.'.PHP_EOL);
}


class MongoDBImport extends Mage_Shell_Abstract {

  protected $product_export;
  protected $mongodb_writer;
  protected $collection;

  public function __construct () {
    parent::__construct();
    $this->product_export = new Mage_ImportExport_Model_Export_Entity_Product;
    $this->mongodb_writer = new JumpLink_ImportExport_Model_Export_Adapter_MongoDB;
    // automatische Verbindung mit localhost:27017
    $mongo = new Mongo();
    // $blog ist ein MongoDB-Objekt (vergleichbar mit MySQL-Datenbank, wird automatisch angelegt)
    $magento_mongo = $mongo->magento;
    // $posts ist eine MongoCollection (vergleichbar mit SQL-Tabelle, wird automatisch angelegt)
    $this->collection = $magento_mongo->productcache;
    $this->mongodb_writer->setCollection($this->collection);
    $this->product_export->setWriter($this->mongodb_writer);
  }

  public function info() {
    print ("Start MongoDB ProductCache import..");
  }

  public function remove() {
    $this->collection->remove(array()); // mongodb remove all data from collection
  }


  public function run() {
    $this->remove();
    $this->info();
    $this->product_export->export();
  }
}
$mongodb = new MongoDBImport();
$mongodb->run();
print("\nDone!\n");