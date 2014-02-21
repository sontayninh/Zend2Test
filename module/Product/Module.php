<?php

namespace Product;

use Product\Model\ProductTable;
use Zend\Db\ResultSet\ResultSet;
use Product\Model\Product;
use Zend\Db\TableGateway\TableGateway;
use Product\Model\ProductCategoryTable;
use Product\Model\ProductCategory;
class Module {
	public function getAutoloaderConfig() {
		return array (
				'Zend\Loader\ClassMapAutoloader' => array (
						__DIR__ . '/autoload_classmap.php' 
				),
				'Zend\Loader\StandardAutoloader' => array (
						'namespaces' => array (
								__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__ 
						) 
				) 
		);
	}
	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}
	
	
	public function getServiceConfig() {
		return array (
				'factories' => array (
						'Product\Model\ProductTable' => function ($sm) {
							$tableGateway = $sm->get ( 'ProductTableGateway' );
							$table = new ProductTable($tableGateway);
							return $table;
						},
						'ProductTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype(new Product());
							return new TableGateway('product', $dbAdapter, null, $resultSetPrototype);
						},
						 'Product\Model\ProductCategoryTable' =>function ($sm){
						 	$tableGateway= $sm->get ('ProductCategoryTableGateway');
						 	$table = new ProductCategoryTable($tableGateway);
						 	return $table;
						 },
						 'ProductCategoryTableGateway' =>function($sm){
						 	$dbAdapter=$sm->get ('Zend\Db\Adapter\Adapter');
						 	$resultSetPrototype= new ResultSet();
						 	$resultSetPrototype->setArrayObjectPrototype(new ProductCategory());
						 	return new TableGateway('category', $dbAdapter,null, $resultSetPrototype);
						 }
				) 
		);
	}
}