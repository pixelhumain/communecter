<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.touch-punch.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/nvd3/lib/d3.v3.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.shapeshift.min.js' , CClientScript::POS_END);
?>
<style>
h2 {
	font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}
.grid a{
display:block;
font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
}
.grid {
      border: 1px dashed #CCC;
      position: relative;
    }

    .grid > div {
      background: #AAA;
      position: absolute;
      height: 100px;
      width: 100px;
    }

    .grid > div[data-ss-colspan="2"] { width: 210px; }
    .grid > div[data-ss-colspan="3"] { width: 320px; }

    .grid > .ss-placeholder-child {
      background: transparent;
      border: 1px dashed blue;
    }	
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <h2> project <?php echo $project["name"]?></h2>
     <div class="col-md-12 padding-20 pull-right">
		<a href="#newContributors" class="new-contributor btn btn-xs btn-light-blue tooltips pull-right" data-placement="top" data-id="<?php echo (string)$project["_id"]; ?>" data-original-title="Invite someone to this event"><i class="fa fa-plus"></i> Invite contributor</a>
	</div>
    <p> Descritpion et Valorisation des associations locales, des leurs actions et objectifs </p>
 	<div class="grid">
        <div></div>
        <div  data-ss-colspan="2"><a href="<?php echo Yii::app()->createUrl('index.php/project/people/id/'.$project["_id"].'/type/team')?>">Team</a></div>
        <div  data-ss-colspan="2"><a href="<//?php echo Yii::app()->createUrl('index.php/project/organigrid/id/'.$project["_id"].'/type/'.$project["organigram"])?>">Organigram</a></div>
        <div><a href="<?php echo Yii::app()->createUrl('index.php/project/people/id/'.$project["_id"].'/type/recrutement')?>">Recrutement</a></div>
        <div data-ss-colspan="2"></div>
        <div data-ss-colspan="2"><a href="#"   target="_blank" role="button" data-toggle="modal"><i class="icon-plus"></i> Action</a></div>
        <div data-ss-colspan="3"><a href="#"   target="_blank" role="button" data-toggle="modal">Statistic </a></div>
        <div></div>
        <div data-ss-colspan="3"><a href="#"   target="_blank" role="button" data-toggle="modal">Évènement </a></div>
        <div></div>
   </div>
</div></div>
<script type="text/javascript"		>
	initT['animInit'] = function(){
		$(".grid").shapeshift({
		    minColumns: 3
		  });
	        (function ani(){
	        	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},1);
	        })();
	};
	<?php $contextMap = array("project"=>$project, "citoyens"=>$citoyens, "organizations"=>$organizations); ?>
 	var contextMap = <?php echo json_encode($contextMap)?>;
 	var type = "project";
</script>			