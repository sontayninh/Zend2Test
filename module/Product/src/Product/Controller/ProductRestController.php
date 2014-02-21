<?php

namespace Product\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\View\Helper\ViewModel;

class ProductRestController extends AbstractRestfulController {
	protected $productTable;
	protected $productCategoryTable;
	public function getList() {
		// code...
		/*$results = $this->getproductTable()->fetchAll();
// 		var_dump($results);
		$data = array();
		foreach ($results as $result){
			$data[] = $result;
		}
// 		var_dump($data);exit();
		return new JsonModel(array('category'=>$data));*/
		
		$categories=$this->getproductCategoryTable()->fetchAll();
		$category=array('categories'=>array());
		foreach ($categories as $cat){
			$id_cat = $cat->id;
			$products = $this->getproductTable()->fetchProductByCaterogy($id_cat);
			$pro = array();
			foreach ($products as $product)
			{
				$pro[]=$product;
			}
			$cat = (array)$cat;
			$cat['products'] = $pro;
			//$cat = (object)$cat;
			$category['categories'][]=$cat;
		}
		return new JsonModel($category);
		
	}
	public function get($id) {
		// code...
		$product = $this->getProductTable()->getProduct($id);
// 		var_dump($product); exit();
		
		return new JsonModel(array($product));
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
	
	public function getproductCategoryTable(){
		if(!$this->productCategoryTable){
			$sm = $this->getServiceLocator();
			$this->productCategoryTable = $sm->get('Product\Model\ProductCategoryTable');
		}
		return $this->productCategoryTable;
	}
} 