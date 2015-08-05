<div class='panel panel-white' id="<?php echo $name_id; ?>_panel">
	<div class="panel-heading border-light">
		
		<span id="<?php echo $name_id; ?>_titleGraph" class="text-large"> Statistique Population </span>
		<ul class="panel-heading-tabs border-light ulline">
			<li>
				<label class = "label_dropdown">Département : <?php echo $nbCitiesDepartement; ?> communes </label>
			</li>
			<li>
				<label class = "label_dropdown">Région : <?php echo $nbCitiesRegion; ?> communes </label>
			</li>
			<li>
				<label class = "label_dropdown" for="typeGraph">Voir : </label>
				<div class="btn-group">
					<a class="btn btn-transparent-grey dropdown-toggle" data-toggle="dropdown"  aria-expanded="true">
						<span id="label-type"> Population </span><span class="caret"></span>
					</a>
					<ul role="menu" class="dropdown-menu" id="typeGraph">
						<!--<li>
							<a  class="btn-drop typeBtn" data-name="population">Population</a>
						</li>
						<li>
							<a  class="btn-drop typeBtn" data-name="entreprise">Entreprise</a>
						</li>-->
						<?php
							$where = array("insee"=>$_GET['insee']);
     						$fields = array();
     						$option = City::getWhereData($where, $fields);
     						$chaine = "" ;
     						foreach ($option as $key => $value) 
     						{
     							foreach ($value as $k => $v) 
     							{
     								if($k != "_id" && $k != "insee")
	     							$chaine = $chaine.'<li>
										<a  class="btn-drop typeBtn" data-name="'.$k.'">'.$k.'</a>
									</li>';	
	     						}

     						}
     						echo $chaine ;
						?>
						
					</ul>
				</div>
			</li>
			<li>
				<label class = "label_dropdown" for="label-option">Option : </label>
				<div class="btn-group">
					<a class="btn btn-transparent-grey dropdown-toggle" data-toggle="dropdown"  aria-expanded="true">
						<span id="label-option"> Total </span><span class="caret"></span>
					</a>

					<ul role="menu" class="dropdown-menu pull-right" id="filterGraph">
						<?php
							$where = array("insee"=>$_GET['insee'], $typeData => array( '$exists' => 1 ));
     						$fields = array($typeData);
     						$option = City::getWhereData($where, $fields);
     						$chaine = "" ;
     						foreach ($option as $key => $value) 
     						{
     							foreach ($value as $k => $v) 
     							{
	     							if($k == $typeData)
	     							{
	     								if(isset($optionData))
	     								{
	     									$chaine = CityOpenData::listOptionWithOptionChecked($v, $chaine, $name_id, $optionData);
	     								}	
	     								else
	     									$chaine = CityOpenData::listOption($v, $chaine, true, $name_id);
	     							}	
	     						}
     						}
     						echo $chaine ;
						?>

					</ul>
				</div>
			</li>			
		</ul>
	</div>
	<div class="panel-heading border-light divline">
		<ul  class="panel-heading-tabs border-light ulline">
			<li>
				<label class = "label_dropdown" for="typeGraph">Type graph : </label>
				<div class="btn-group">
					<a class="btn btn-transparent-grey dropdown-toggle" data-toggle="dropdown"  aria-expanded="true">
						<span id="label-graph">Multi-Bar</span><span class="caret"></span>
					</a>
					<ul role="menu" class="dropdown-menu" id="typeGraph" >
						<li>
							<a class="btn-drop graphBtn" data-name="multibart">Multi-Bar</a>
						</li>
						<li>
							<a  class="btn-drop graphBtn" data-name="piechart">PieChart</a>
						</li>
					</ul>
				</div>
			</li>
			<li>
				<label class = "label_dropdown" for="zoneGraph">Filtrer par : </label>
				<div class="btn-group">
					<a class="btn btn-transparent-grey dropdown-toggle" data-toggle="dropdown"  aria-expanded="true">
						<span id="label-zone"> Commune </span><span class="caret"></span>
					</a>
					<ul role="menu" class="dropdown-menu pull-right" id="zoneGraph" >
						<li>
							<a class="btn-drop locBtn">Commune</a>
						</li>
						<li>
							<a  class="btn-drop locBtn" data-name="departement">Departement</a>
						</li>
						<li>
							<a  class="btn-drop locBtn" data-name="region">Region</a>
						</li>
					</ul>
				</div>
			</li>
			<li id="filtreByCommune">
				<div class="btn-group col-xs-4">
					<select id="listCommune" class="js-example-basic-multiple" multiple="multiple">  	
					</select>
				</div>
			</li>
		</ul>
	</div>
	<div class="space20"></div>	
</div>