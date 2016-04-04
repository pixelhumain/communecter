<style>
ol.slats li {
	margin: 0 0 10px 0;
	padding: 0 0 10px 0;
	border-bottom: 1px solid #eee;
	}
ol.slats li:last-child {
	margin: 0;
	padding: 0;
	border-bottom: none;
	}
ol.slats li h3 {
	font-size: 18px;
	font-weight: bold;
	line-height: 1.1;
	}
ol.slats li h3 a img {
	float: left;
	margin: 0 10px 0 0;
	padding: 4px;
	border: 1px solid #eee;
	}
ol.slats li h3 a:hover img {
	background: #eee;
	}
ol.slats li p {
	margin: 0 0 0 76px;
	font-size: 14px;
	line-height: 1.4;
	}
ol.slats li p span.meta {
	display: block;
	font-size: 12px;
	color: #999;
	}		
	h2 {
	font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}	
.main-col-search{	padding:0px !important; }
.explainTitle{cursor:pointer; background-color:#595959; padding: 10px; text-align: center; color: #fff;margin:0px;border-top: 1px solid #666;}
.explainTitle.blue{background-color: #32454E}
.explainTitle:hover{opacity: 0.8}
.explainDesc{ padding: 10px; background-color: white; }
.caretExplain{position: relative;top: 0px;background-color: white;color:#595959;}
.caretExplain.blue{background-color: white; color:#32454E}
</style>
<div class="home_page" style="margin-top:50px">

    	<h1 class="homestead explainTitle"></i> Open Data Locale : Les sources de données libres</h1>
		<center class="caretExplain"><i class="fa fa-caret-down"></i><br/></center>

        <p>Toute les données qui permettent de faire tourner le PH sont ouverte est disponible a l'utilisation publique.<br/>
        Mais surtout elles sont crowd sourcer (rempli par les citoyens)
        </p>
        
        <ol class="slats">
        	<li class="group"><h3> ODB : Open DataBase : what is it ?</h3></li>
        	<li class="group"><h3> Restfull and API driven ?</h3></li>
        	<li class="group"><h3> Semantic Data ?</h3></li>
        	<li class="group"><h3> Is all this interoperable ?</h3></li>
        	<li class="group"><h3> Can I host my own ODB ?</h3></li>
        	<li class="group"><h3> Can I host a NotODB ?</h3></li>
        	<li class="group"><h3> Semantic Translators ?</h3></li>
        	<li class="group"><h3><a href="<?php echo Yii::app()->createUrl('/communecter/data/get/type/citoyens/id/520931e2f6b95c5cd3003d6c/format/schema')?>">Structure Standard Json for a Person</a></h3></li>
        	<li class="group"><h3><a href="<?php echo Yii::app()->createUrl('/communecter/data/get/type/organization/id/520931e2f6b95c5cd3003d6c/format/schema')?>">Structure Standard Json for an Organization</a></h3></li>
        	<li class="group"><h3><a href="<?php echo Yii::app()->createUrl('/communecter/data/get/type/citoyens/id/520931e2f6b95c5cd3003d6c/format/schema')?>">Structure Standard Json for a Event</a></h3></li>
        	<li class="group"><h3><a href="<?php echo Yii::app()->createUrl('/communecter/data/get/type/citoyens/id/520931e2f6b95c5cd3003d6c/format/schema')?>">Structure Standard Json for a Project</a></h3></li>
        	<li class="group"><h3><a href="<?php echo Yii::app()->createUrl('/communecter/data/get/type/citoyens/id/520931e2f6b95c5cd3003d6c/format/schema')?>">Structure Standard Json for a City</a></h3></li>
        </ol>	
    
</div>	
	
<script type="text/javascript">
jQuery(document).ready(function() {
	$(".moduleLabel").html('<i class="fa fa-folder-open-o"></i> <?php echo Yii::t("common","Open Data") ?>');
});
</script>