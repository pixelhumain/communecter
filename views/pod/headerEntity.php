<style>
	/*.headerEntity{
		margin-top:-10px;

		background-image: url("<?php echo $this->module->assetsUrl; ?>/images/bg/wavegrid.png");
		background-repeat: repeat;
		
		moz-box-shadow: 0px 2px 4px -1px #656565;
		-webkit-box-shadow: 0px 2px 4px -1px #656565;
		-o-box-shadow: 0px 2px 4px -1px #656565;
		box-shadow: 0px 2px 4px -1px #656565;
		filter: progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=4);
	}*/

	.headerEntity{
		/*margin: 0px;*/
		/*background-image: url("/ph/assets/9d42b974/images/people.jpg");
		background-repeat: repeat;*/
		background-position: left bottom -40px;
		moz-box-shadow: 0px 2px 4px -1px #656565;
		-webkit-box-shadow: 0px 2px 4px -1px #656565;
		-o-box-shadow: 0px 2px 4px -1px #656565;
		box-shadow: 0px 0px 4px -1px #656565;
		filter: progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=4);
		border-radius: 0px;
		margin-top:-10px;
	}

	.headerEntity .thumbnail{
		margin-bottom:0px;
		max-height:150px;
		display:inline;
	}
	.headerEntity .lbl-entity-name{
		font-size:24px;
	}
	.headerEntity .lbl-entity-locality{
		font-size:14px;
	}
	.headerEntity hr{
		border-top: 1px solid rgba(186, 186, 186, 0.5);
		margin-top:7px;
		margin-bottom:7px;

	}
	.headerEntity .label.tag{
		margin-top:3px;
		margin-left:3px;

	}
	.box-ajaxTools{
		margin-top:0px;
	}
	.box-ajaxTools .btn.tooltips, 
	.box-ajaxTools .btn.tooltips.active{
		margin-right:10px;
		margin-top:15px;
		border-radius: 10px !important;
	}



	@media screen and (max-width: 1024px) {
		.headerEntity .lbl-entity-name{
			font-size:20px;
		}
		.headerEntity .lbl-entity-locality{
			font-size:13px;
		}
	}

</style>

<div class="row headerEntity bg-light">
	<?php   //var_dump($entity);	
			$profilThumbImageUrl = 
			Person::getImgProfil(@$entity, "profilImageUrl", 
          						 $this->module->assetsUrl);
	?>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 padding-10 center">
		<img class="img-responsive thumbnail" src="<?php echo $profilThumbImageUrl; ?>">
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">

		<div class="col-lg-12 col-md-12 col-sm-12 no-padding">
			<div class="col-md-12 no-padding margin-top-15">
				<span class="lbl-entity-name">
					<i class="fa fa-user"></i> <?php echo @$entity["name"]; ?>
				</span>
			</div>
			<div class="col-md-12 no-padding no-padding margin-bottom-10">
				<span class="lbl-entity-locality text-red">
					<i class="fa fa-globe"></i> 
					<?php echo @$entity["address"]["addressLocality"].", ".
								@$entity["address"]["postalCode"].", ".
								@$entity["address"]["addressCountry"]; ?>
				</span>
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding hidden-xs">
			<?php echo @$entity["shortDescription"]; ?>
		</div>


	</div>
	<?php 
		$colXS = "3";
		if(!isset($entity["tags"]) && !isset($entity["gamification"])) $colXS = "3 hidden";
		if(!isset($entity["tags"]) && isset($entity["gamification"])) $colXS = "3";
		if(isset($entity["tags"])) {
			if(count($entity["tags"]) <= 6) {
				$colXS = "3";
			}else{
				$colXS = "12";
			}
		}
	?>
	<div class="col-lg-3 col-md-3 col-sm-<?php echo $colXS; ?> col-xs-12 pull-right padding-10">
			<?php if(isset($entity["tags"]) || isset($entity["gamification"])){ ?>
			<div class="col-lg-12 col-md-12 col-sm-12 no-padding">
				<span class="tag label label-warning pull-right">
					<?php echo  @$entity["gamification"]['total'] ? 
								@$entity["gamification"]['total'] :
								"0"; 
					?> pts
				</span>
				<?php if(isset($entity["tags"])){ ?>
					<?php foreach($entity["tags"] as $tag){ ?>
					<div class="tag label label-danger pull-right">
						<i class="fa fa-tag"></i> <?php echo  $tag; ?>
					</div>
					<?php } ?>
				<?php } ?>
			</div>
			<?php } ?>
		</div>
</div>