<?php 
namespace Product\Model;

use Zend\Db\TableGateway\TableGateway;

class ProductCategoryTable {
	protected $tableGateway;
	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway = $tableGateway;
	}
	public function fetchAll() {
		$resultSet = $this->tableGateway->select ();
		return $resultSet;
	}
	public function getProductCategory($id) {
		// code here
		$id = (int) $id;
		$rowset = $this->tableGateway->select(array('id'=>$id));
		$row = $rowset->current();
		if(!$row){
			throw new \Exception("Could not find row");
		}
		return $row;
	}
	public function saveProductCategory(ProductCategory $productCategory) {
		// code here
	}
	public function deleteProductCategory($id) {
		// code here
	}
}