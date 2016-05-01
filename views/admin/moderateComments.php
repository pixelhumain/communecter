<?php 

$content = "";
$memberId = Yii::app()->session["userId"];
$memberType = Person::COLLECTION;
$tags = array();
$scopes = array(
	"codeInsee"=>array(),
	"postalCode"=>array(),
	"region"=>array(),
);

/* ************ NEWS ********************** */
if(isset($comments)) 
{ 
	foreach ($comments as $e) 
	{ 
		// print_r($e);
		// $content .= buildDirectoryLine($e, Comments::CONTROLLER, $e['type'], $typeParams[$e['type']]['class']::ICON, $this->module->id,$tags,$scopes,$typeParams);
	};
}


					
?>
