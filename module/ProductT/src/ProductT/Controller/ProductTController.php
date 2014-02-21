<?php
namespace ProductT\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Config\Reader\Json;
use Zend\View\Model\JsonModel;

class ProductTController extends AbstractActionController{
	
	public function indexAction(){
		$data = $this->readJson();
		return array(
				'categories' => $data['categories'],
		);
	}
	
	public function getDataAction(){
		$id = $this->params()->fromQuery('idProduct')-1;
		$data = $this->readJson();
		$product = $data['categories'][$id]['_embedded']['products'][0];
		$result = new JsonModel(array(
				'product' => $product,
				'success' => true,
		));
		return $result;
	}
	
	private function readJson(){
		$reader = new Json();
		$data = $reader->fromFile('./json/hal_product.json');
		return $data;
	}
}