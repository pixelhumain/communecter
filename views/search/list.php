<?php 

$res = array();

foreach ($result as $id => $v) 
{
	if( @$v["typeSig"] && !@$res[ $v["typeSig"] ] )
		$res[ $v["typeSig"] ] = array();

	$res[ $v["typeSig"] ][ $id ] = $v;
}

Rest::json(array( "list"=>$res));

?>
