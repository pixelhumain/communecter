<?php 
class Organization {
	public $jsonLD= array();

	public $urls = array(
		"form" => array(
				"params" => array("type"),
			"description" =>"",
			"title" => "Organization",
			"subTitle" => "Découvrez les <b>$type</b> locales",
			"pageTitle" => "Organization"
		),
		"index" => array(),
		"view" => array(),
		"save" => array(),
		"getNames" => array(),
		"delete" => array(),
	);
}
?>