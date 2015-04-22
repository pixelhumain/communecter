<?php
class DataList {
	const COLLECTION = "lists";

	public static function getListByName($name){
		$res = array();
		//The tags are found in the list collection, key tags
		$list = PHDB::findOne( DataList::COLLECTION,array("name"=>$name), array('list'));

		if (!empty($list['list']))
			$res = $list['list'];
		else 
			throw new CommunecterException("Impossible to find the list name ".$name);

		return $res;
  	}
}
?>