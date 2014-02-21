<?php

namespace Product\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
class ProductTable {
	protected $tableGateway;
	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway = $tableGateway;
	}
	public function fetchAll() {
		$resultSet = $this->tableGateway->select ();
		return $resultSet;
	}
	public function fetchProductByCaterogy($id_cat){
		$id_category=(int)$id_cat;
		$resultSet=$this->tableGateway->select(array('category_id'=>$id_category));
		return $resultSet;
	}
	public function getProduct($id) {
		// code here
		$id = (int) $id;
		$rowset = $this->tableGateway->select(array('id'=>$id));
		$row = $rowset->current();
		if(!$row){
			throw new \Exception("Could not find row");
		}
		return $row;
	}
	public function saveProductCategory(Product $product) {
		// code here
	}
	public function deleteProductCategory($id) {
		// code here
	}
	
}