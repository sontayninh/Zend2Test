<?php

namespace Product\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\View\Helper\ViewModel;

class ProductCategoryRestController extends AbstractRestfulController {
	protected $productCategoryTable;
	public function getList() {
		// code...
		$results = $this->getproductCategoryTable()->fetchAll();
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
		$productCategory = $this->getproductCategoryTable()->getProductCategory($id);
// 		var_dump($product); exit();
		return new JsonModel(array('data'=>$productCategory));
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
	public function getproductCategoryTable(){
		if(!$this->productCategoryTable){
			$sm = $this->getServiceLocator();
			$this->productCategoryTable = $sm->get('Product\Model\ProductCategoryTable');
		}
		return $this->productCategoryTable;
	}
} 