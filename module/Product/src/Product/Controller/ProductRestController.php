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
		$this2= new ProductCategoryRestController();
		$results2 = $this2->getproductCategoryTable()->fetchAll();
		$data = array();
		foreach ($results as $result){
			$data[] = $result;
		}
		foreach ($results2 as $result2){
			$data2[] = $result2;
		}
		var_dump($data2);
		exit();
		
// 		$category = array(
// 				"id"=> $data[]->category_id,
// 				"name"=> , 
// 		);
// 		var_dump(new JsonModel($dataFinal));
// 		exit();
// 		var_dump($data);exit();
		return new JsonModel($dataFinal);
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