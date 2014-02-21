<?php
namespace Product\Model;
class ProductCategory{
	public $id;
	public $name;
	public $description;
	
	public function exchangeArray($data){
		$this->id =(!empty($data['id']))?$data['id']:null;
		$this->name =(!empty($data['name']))?$data['name']:null;
		$this->description =(!empty($data['description']))?$data['description']:null;
	}
}