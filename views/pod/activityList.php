<?php
$arrayLabel=array(
	"name" => Yii::t("common","the name"),
	"description" => Yii::t("common","the description"),
	"type" => Yii::t("common","the type"),
	"address" => Yii::t("common","the address"),
	"address.addressCountry" => Yii::t("common","the country"),
	"allDay" => Yii::t("common", "the duration of the event to all day"),
	"startDate" => Yii::t("common", "the start"),
	"endDate" => Yii::t("common", "the end")
);
$countries= OpenData::getCountriesList();
?>
<div class="col-md-12 col-sm-12 col-xs-12">
	<?php foreach($activities as $key => $value){ 
		if($value["verb"]==ActStr::VERB_UPDATE)
			$action = Yii::t("common", "has updated");
		else if($value["verb"]==ActStr::VERB_ADD )
			$action = Yii::t("common", "has added");

	?>
			<div class='col-md-12 col-sm-12 col-xs-12 padding-10' style="border-bottom: 1px solid lightgrey;">
				<?php echo "<i class='fa fa-clock-o'></i> ".date("d/m/y H:i",$value["date"]->sec)."<br/>".
					"<a href='javascript:;' onclick='loadByHash(\'#person.detail.id.".$value["author"]["id"]."\')>".
						$value["author"]["name"].
					"</a> ".$action.
					" <span style='font-weight:bold;'>".$arrayLabel[$value["object"]["displayName"]]."</span>"." ".
					Yii::t("common","of the event").": <span style='color: #21b384;'>";
					if($value["object"]["displayName"]=="address")
						echo  $value["object"]["displayValue"]["streetAddress"].", ".$value["object"]["displayValue"]["postalCode"]." ".$value["object"]["displayValue"]["addressLocality"];
					else if($value["object"]["displayName"]=="address.addressCountry"){
						foreach($countries as $country){
							if($country["value"]==$value["object"]["displayValue"])
								echo $country["text"];
						}
					}else	
						echo $value["object"]["displayValue"];
					echo "</span>"
				?>
			</div>
	<?php	}
	?>
</div>

