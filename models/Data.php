<?php 
class Data {

	/**
	 * get Entries from a collection and converts ID and applies a dummyData field for easy export and remove
	 * @param type $type 
	 * @param type $where 
	 * @return type
	 */
	public static function getByAttributeForExport($type,$where){
        $list = PHDB::find($type,$where);
        if($list){
          $res = array();
          foreach ( $list as $key => $value) {
            $value["_id"] = array('$oid'=>(string)$value["_id"]);
            $value["dummyData"] = "myData.".Yii::app()->session["userId"];
            unset( $value["_id"]['$id'] );
            array_push($res, $value);
          }
          return $res;
        }

      }
}
?>