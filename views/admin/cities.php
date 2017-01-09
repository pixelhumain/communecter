<?php
echo CHtml::scriptFile(Yii::app()->request->baseUrl. '/plugins/DataTables/media/js/jquery.dataTables.min.1.10.4.js');
echo CHtml::cssFile(Yii::app()->request->baseUrl. '/plugins/DataTables/media/css/DT_bootstrap.css');
echo CHtml::scriptFile(Yii::app()->request->baseUrl. '/plugins/DataTables/media/js/DT_bootstrap.js');
/*
TKA : doesn't work , produces empty /ph urls causing issues

$cssAnsScriptFilesModule = array(
	'/plugins/DataTables/media/css/DT_bootstrap.css',
	'/plugins/DataTables/media/js/jquery.dataTables.min.1.10.4.js',
	'/plugins/DataTables/media/js/DT_bootstrap.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);*/
?>

<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><i class="fa fa-globe fa-2x text-green"></i> 
			<a href="javascript:;" onclick="applyStateFilter('goods')" class="filtergood btn btn-xs btn-default"> Goods <span class="badge badge-warning"> <?php echo count(@$goods) ?></span></a>

			<a href="javascript:;" onclick="applyStateFilter('errors')" class="filtererror btn btn-xs btn-default"> Errors <span class="badge badge-warning"> <?php echo count(@$errors) ?></span></a>

			<a href="javascript:;" onclick="clearAllFilters('')" class="btn btn-xs btn-default"> All</a></h4>
	</div>
	<div class="panel-tools">
		<a href="javascript:;" onclick="openSubView('Add an city', '/'+moduleId+'/organization/addorganizationform',null)" class="btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="Add an city"><i class="fa fa-plus"></i> <i class="fa fa-group"></i> </a>
	</div>
	<div class="panel-body">
		<div>	
			<?php //var_dump($projects) ?>
			<table class="table table-striped table-bordered table-hover  directoryTable">
				<thead>
					<tr>
						<th>Name</th>
						<th>Département</th>
						<th>Région</th>
						<th>Pays</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody class="directoryLines">
					<?php 
					$memberId = Yii::app()->session["userId"];
					$memberType = Person::COLLECTION;
					$tags = array();
					$scopes = array(
						"codeInsee"=>array(),
						"codePostal"=>array(),
						"region"=>array(),
					);
					
					/* ************ ORGANIZATIONS ********************** */
					if(isset($goods)) 
					{ 
						foreach ($goods as $e) 
						{ 
							buildDirectoryLine($e, City::COLLECTION, City::CONTROLLER, City::ICON, $this->module->id,$tags,$scopes);
						};
					}

					/* ********** PEOPLE ****************** */
					if(isset($people)) 
					{ 
						foreach ($people as $e) 
						{ 
							buildDirectoryLine($e, City::COLLECTION, City::CONTROLLER, City::ICON, $this->module->id,$tags,$scopes);
						}
					}

					

					function buildDirectoryLine( $e, $collection, $type, $icon, $moduleId, &$tags, &$scopes ){
							
							if(!isset( $e['_id'] ) || !isset( $e["name"]) || $e["name"] == "" )
								return;
							$actions = "";
							$classes = "";
							$id = @$e['_id'];

							/* **************************************
							* ADMIN STUFF
							***************************************** */
							if( Yii::app()->session["userIsAdmin"] )
							{
								if($type == Person::CONTROLLER){
									//Activated
									if( @$e["roles"]["tobeactivated"] )
									{
										$classes .= "tobeactivated";
										$actions .= '<li><a href="javascript:;" data-id="'.$id.'" data-type="'.$type.'" class="margin-right-5 validateThisBtn"><span class="fa-stack"><i class="fa fa-user fa-stack-1x"></i><i class="fa fa-check fa-stack-1x stack-right-bottom text-danger"></i></span> Validate </a></li>';
									}
									//Beta Test
									if (@Yii::app()->params['betaTest']) {
										if( @$e["roles"]["betaTester"] ) {
											$classes .= "betaTester";
											$actions .= '<li><a href="javascript:;" data-id="'.$id.'" data-type="'.$type.'" class="margin-right-5 revokeBetaTesterBtn"><span class="fa-stack"><i class="fa fa-user fa-stack-1x"></i><i class="fa fa-check fa-stack-1x stack-right-bottom text-danger"></i></span> Revoke this beta tester </a></li>';
										} else {
											$actions .= '<li><a href="javascript:;" data-id="'.$id.'" data-type="'.$type.'" class="margin-right-5 addBetaTesterBtn"><span class="fa-stack"><i class="fa fa-user fa-stack-1x"></i><i class="fa fa-check fa-stack-1x stack-right-bottom text-danger"></i></span> Add this beta tester </a></li>';
										}
									}
									//Super Admin
									if( @$e["roles"]["superAdmin"] ) {
										$classes .= "superAdmin";
										$actions .= '<li><a href="javascript:;" data-id="'.$id.'" data-type="'.$type.'" class="margin-right-5 revokeSuperAdminBtn"><span class="fa-stack"><i class="fa fa-user fa-stack-1x"></i><i class="fa fa-check fa-stack-1x stack-right-bottom text-danger"></i></span> Revoke this super admin </a></li>';
									} else {
										$actions .= '<li><a href="javascript:;" data-id="'.$id.'" data-type="'.$type.'" class="margin-right-5 addSuperAdminBtn"><span class="fa-stack"><i class="fa fa-user fa-stack-1x"></i><i class="fa fa-check fa-stack-1x stack-right-bottom text-danger"></i></span> Add this super admin </a></li>';
									}

									$actions .= '<li><a href="javascript:;" data-id="'.$id.'" class="margin-right-5 switch2UserThisBtn"><span class="fa-stack"><i class="fa fa-user fa-stack-1x"></i><i class="fa fa-eye fa-stack-1x stack-right-bottom text-danger"></i></span> Switch to this user</a> </li>';

									$actions .= '<li><a href="javascript:;" data-id="'.$id.'" data-type="'.$type.'" class="margin-right-5 deleteThisBtn"><i class="fa fa-times text-red"></i>Delete</a> </li>';
									//TODO
									$actions .= '<li><a href="javascript:;" data-id="'.$id.'" data-type="'.$type.'" class="margin-right-5 banThisBtn"><i class="fa fa-times text-red"></i> TODO : Ban</a> </li>';
									
								}
							}

							/* **************************************
							* TYPE + ICON
							***************************************** */
						$strHTML = '<tr id="'.(string)$id.'">' ;
							
							/* **************************************
							* NAME
							***************************************** */
							$strHTML .= '<td><a href="'.Yii::app()->createUrl('/'.$moduleId.'/'.$type.'/dashboard/id/'.$id).'">'.((isset($e["name"]))? $e["name"]:"").'</a></td>';
							
							/* **************************************
							* EMAIL for admin use only
							***************************************** */
							$strHTML .= '<td>'.((isset($e["dep"]))? $e["depName"]:"").'/td>';
							$strHTML .= '<td>'.((isset($e["regionName"]))? $e["regionName"]:"").'/td>';
							$strHTML .= '<td>'.((isset($e["country"]))? $e["country"]:"").'</td>';

							/* **************************************
							* ACTIONS
							***************************************** */
							$strHTML .= '<td class="center">';
							if( !empty($actions) && Yii::app()->session["userIsAdmin"] ){
								$strHTML .= '<div class="btn-group">'.
											'<a href="#" data-toggle="dropdown" class="btn btn-red dropdown-toggle btn-sm"><i class="fa fa-cog"></i> <span class="caret"></span></a>'.
											'<ul class="dropdown-menu pull-right dropdown-dark" role="menu">'.
												$actions.
											'</ul></div>';
							
							}
							$strHTML .= '</td>';
						$strHTML .= '</tr>';
						echo $strHTML ;
					}
					?>

				</tbody>
			</table>


			<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 0px; display: none;"><div class="ps-scrollbar-x" style="left: -10px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 230px; display: inherit;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div>

		</div>
	</div>
</div>