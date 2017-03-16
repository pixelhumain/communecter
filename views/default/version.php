<div class="infoVersion">
	<a href="javascript:loadByHash('#default.view.page.index.dir.docs')" class="homestead text-red"><i class="fa fa-book fa-2x "></i> DOCUMENTATIONS</a>
	
	<br/>
	update <?php echo $this->versionDate ?>
	<br/>
	<span class="homestead" style="font-size: 1.5em">version <a href="javascript:;" data-id="explainBeta" class="explainLink text-red">Béta</a></span>
	<br/><span >Tests et améliorations continu</span>
	<br/>
	<?php 
		$lang = 'fr';
		$msglang = '';
		if( Yii::app()->language == 'fr' ){
			$lang = 'en';  
			$msglang = '( 70% translated )';
		}
	?>
	lang : <a class="homestead text-red" href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/default/switch/lang/'.$lang) ?>" title="switch to <?php echo strtoupper($lang) ?>"><?php echo strtoupper($lang) ?></a> <?php echo $msglang ?>
	<?php if (isset(Yii::app() -> session["userId"])){ ?>
		<br/><span class="removeExplanationCont"><input type="checkbox" class="removeExplanation" style="vertical-align: bottom" onclick="removeExplainations();"/> <?php echo Yii::t("common","Hide info panels") ?></span>
	<?php } ?>
</div>