<?php
namespace ProductT\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Config\Reader\Json;

class ProductTController extends AbstractActionController{
	
	public function indexAction(){
		$data = $this->readJson();
		return array(
				'category' => $data['category'],
		);
	} 
	
	private function readJson(){
		$reader = new Json();
		$data = $reader->fromFile('./json/product.json');
		return $data;
	}
}