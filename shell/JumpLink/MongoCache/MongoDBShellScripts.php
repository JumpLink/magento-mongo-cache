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


class MongoDBShellScripts extends Mage_Shell_Abstract {

  protected $mongo;
  protected $products;

  public function __construct () {
    parent::__construct();
    $this->mongo = Mage::helper('jumplink_mongocache')
    $this->products = Mage::helper('jumplink_mongocache/product');
  }

  public function info() {
    print ("Start MongoDB ProductCache import..");
  }

  public function run() {
    echo $this->mongo->getServerString(); //ruft eine Funktion im Helper auf
    $this->products->testConnection();
  }
}
$scripts = new MongoDBShellScripts();
$scripts->run();
print("\nDone!\n");