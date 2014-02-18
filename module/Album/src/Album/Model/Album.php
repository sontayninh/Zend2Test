<?php
namespace Album\Model;
class Album
{
	public $id;
	public $artist;
	public $title;
	public function exchangeArray($data){
		$this->id =(!empty($data['id']))?$data['id']:null;
		$this->id =(!empty($data['artist']))?$data['artist']:null;
		$this->id =(!empty($data['title']))?$data['title']:null;
	}
}