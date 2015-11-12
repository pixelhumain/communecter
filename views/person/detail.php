<?php
$cssAnsScriptFilesModule = array(
	//Data helper
	'/js/communecter.js'
	);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>
<style>

.thumbnail {
    border: 0px;
}
.user-left{
	padding-left: 20px;
	padding-bottom: 25px;
}

.panel-tools{
	filter: alpha(opacity=1);
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=1)";
	-moz-opacity: 1;
	-khtml-opacity: 1;
	opacity: 1;
}

#btnTools{
	padding-right: 20px;
	padding-top: 10px;
}
</style>
<?php 
Menu::person($person);
$this->renderPartial('../default/panels/toolbar'); 
?>
<div class="row">
	<div class="col-xs-12">
		<?php $this->renderPartial('dashboard/profil', array("person" => $person, 
															 "tags" => $tags, 
															 "countries" => $countries, 
															 "imagesD" => $images )); ?>
	</div>
</div>


<script>

jQuery(document).ready(function() {
	bindBtnFollow();
	var images = <?php echo json_encode($images) ?>;
	$(".changePasswordBtn").off().on("click",function () {
		openChangePasswordSV();
	});
	$(".moduleLabel").html("<i class='fa fa-user'></i> PERSON : <?php echo $person["name"] ?>  <a href='javascript:showMap()' id='btn-center-city'><i class='fa fa-map-marker'></i></a>");

});

function bindBtnFollow() {
	$(".followBtn").off().on("click", function() {
		console.log($(this).data("id"));
		connectPerson($(this).data("id"), function(user) {
			console.log(user);
			if( isNotSV )
				loadByHash(location.hash);
		});
	});

	$(".unfollowBtn").off().on("click", function() {
		var id = $(this).data("id");
		var type = $(this).data("type");
		var name = $(this).data("name");
		console.log(id, type, name);
		disconnectPerson(id,type,name, function(id, type, name) {
			if( isNotSV )
				loadByHash(location.hash);
		});
	});
}


</script>
