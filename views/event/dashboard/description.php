<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><span><i class="fa fa-info fa-2x text-blue"></i>   Informations</span></h4>
	</div>
	<div class="panel-body no-padding">
		<div class="row center">
			<div class="col-md-6 col-md-offset-3">
				<?php 
				$this->renderPartial('../pod/fileupload', array("itemId" => $itemId,
																		  "type" => $type,
																		  "contentId" =>"profil",
																		  "editMode" => true)); ?>
			</div>
		</div>
		<table class="table table-condensed table-hover" >
			<tbody>
				<tr>
					<td>Intitulé</td>
					<td><a href="#"><?php if(isset($event["name"]))echo $event["name"];?></a></td>
				</tr>
				<tr>
					<td>Début</td>
					<td><?php if(isset($event["startDate"]))echo $event["startDate"]; ?></td>
				</tr>
				<tr>
					<td>Fin</td>
					<td><?php if(isset($event["endDate"]))echo $event["endDate"]; ?></td>
				</tr>
				<tr>
					<td>Type</td>
					<td><?php if(isset($event["type"])) echo $event["type"]; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
