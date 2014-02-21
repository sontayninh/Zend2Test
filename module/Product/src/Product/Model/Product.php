<?php
namespace Product\Model;
class Product
{
	public $id;
	public $category_id;
	public $name;
	public $price;
	public $description;
	public $img;
	
	public function exchangeArray($data){
		$this->id =(!empty($data['id']))?$data['id']:null;
		$this->category_id =(!empty($data['category_id']))?$data['category_id']:null;
		$this->name =(!empty($data['name']))?$data['name']:null;
		$this->price =(!empty($data['price']))?$data['price']:null;
		$this->description =(!empty($data['description']))?$data['description']:null;
		$this->img =(!empty($data['img']))?$data['img']:null;
	}
}