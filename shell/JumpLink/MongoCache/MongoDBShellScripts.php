#!/usr/bin/php
<?php
/*
 *
 */
print ($argv[0]."\n");

if (file_exists($shell = './../../../../../../shell/abstract.php')) {
    require_once $shell;
} else {
  print ('Error: File not found: "'.$shell.'"'.PHP_EOL);
}

if (file_exists($autoload = './../../../../../../vendor/autoload.php')) {
    require_once $autoload;
} else {
  print ('Error: File not found: "'.$autoload.'", you need to run composer install first.'.PHP_EOL);
}


class MongoDBShellScripts extends Mage_Shell_Abstract {

  protected $mongo;
  protected $products;

  public function __construct () {
    parent::__construct();
    $this->mongo = Mage::helper('jumplink_mongocache');
    $db = $this->mongo->getDB();
    $this->products = Mage::helper('jumplink_mongocache/product');
    $this->products->init($db);
  }

  public function info() {
    print ("Start MongoDB ProductCache import..");
  }

  public function run() {
    ini_set('memory_limit', '-1');
    $this->mongo->testConnection();

    $this->products->setCollection($this->mongo->db);
    $this->products->import();
  }
}
$scripts = new MongoDBShellScripts();
$scripts->run();
print("\nDone!\n");
