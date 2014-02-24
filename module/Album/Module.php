<?php

namespace Album;

use Zend\Db\ResultSet\ResultSet;
use Album\Model\Album;
use Zend\Db\TableGateway\TableGateway;
use Album\Model\AlbumTable;
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
						'Album\Model\AlbumTable' => function ($sm) {
							$tableGateway = $sm->get ( 'AlbumTableGateway' );
							$table = new AlbumTable( $tableGateway );
							return $table;
						},
						'AlbumTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet ();
							$resultSetPrototype->setArrayObjectPrototype ( new Album() );
							return new TableGateway ( 'album', $dbAdapter, null, $resultSetPrototype );
						} 
				) 
		);
	}
}