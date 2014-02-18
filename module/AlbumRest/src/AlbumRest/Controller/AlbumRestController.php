<?php

namespace AlbumRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Album\Model\Album;
use Album\Form\AlbumForm;
use Album\Model\AlbumTable;
use Zend\View\Model\JsonModel;
use Zend\View\Helper\ViewModel;

class AlbumRestController extends AbstractRestfulController {
	public function getListAction() {
		// code...
		$adapter = new Zend\Db\Adapter\Adapter ( array (
				'driver' => 'Mysqli',
				'database' => 'zend2test',
				'username' => 'root',
				'password' => ''
		) );
		$adapter->query('SELECT * FROM "product" WHERE "id" = 1', array(5));
		var_dump($adapter);
	}
	public function get($id) {
		// code...
	}
	public function create($data) {
		// code...
	}
	public function update($id, $data) {
		// code...
	}
	public function delete($id) {
		// code...
	}
	public function indexAction(){
		return new ViewModel();
	}
} 