<?php

class Tags {

	/**
	 * From an array of tags (String), the new tags will be saved 
	 * Filter the array and return all the valid tags
	 * @param array of tags (String)
	 * @return all the valid tags 
	 */
	public static function filterAndSaveNewTags($tags) {

	    $res = array();
	    $existingTags = Tags::getActiveTags();

	    if(!empty($tags)){
	      foreach($tags as $tag) {
	        if(!in_array($tag, $existingTags))
	          PHDB::update( PHType::TYPE_LISTS,array("name"=>"tags"), array('$push' => array("list"=>$tag)));
	      }
	      //TODO : Add here how to define if a tag is valid or not
	      array_push($res, $tag);
	    }

	    return $res;
	}

  /**
   * Retrieve the active tags list
   * @return array of tags (String)
   */
  public static function getActiveTags() {

  	$res = array();
  	//The tags are found in the list collection, key tags
  	$tagsList = PHDB::findOne( PHType::TYPE_LISTS,array("name"=>"tags"), array('list'));
  	
  	if (!empty($tagsList['list']))
  		$res = $tagsList['list'];

  	return $res;
  }

}
?>