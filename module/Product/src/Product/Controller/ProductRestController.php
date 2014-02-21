<?php

namespace Product\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\View\Helper\ViewModel;

class ProductRestController extends AbstractRestfulController {
	protected $productTable;
	public function getList() {
		// code...
		$results = $this->getproductTable()->fetchAll();
// 		var_dump($results);
		$data = array();
		foreach ($results as $result){
			$data[] = $result;
		}
// 		var_dump($data);exit();
		return new JsonModel($data);
	}
	public function get($id) {
		// code...
		$product = $this->getProductTable()->getProduct($id);
// 		var_dump($product); exit();
		return new JsonModel(array('data'=>$product));
	}
	public function create($data) {
		// code...
	}
	public function update($id, $data) {
		// code...
	}
	public function delete($id) {
		// code...
		$this->tableGateway->delete(array('id' => (int) $id));
	}
	public function getproductTable(){
		if(!$this->productTable){
			$sm = $this->getServiceLocator();
			$this->productTable = $sm->get('Product\Model\ProductTable');
		}
		return $this->productTable;
	}
} 