<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.touch-punch.min.js' , CClientScript::POS_END);
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
      height: 50px;
      line-height:22px;
      width: 100px;
      padding:5px;
    }

    .grid > div[data-ss-colspan="2"] { width: 210px; }
    .grid > div[data-ss-colspan="3"] { width: 320px; }

    .grid > .ss-placeholder-child {
      background: transparent;
      border: 1px dashed blue;
    }	
    .graph div.block{border:1px solid #666;text-align:center}
    
</style>

<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <h2> Évenement <?php echo $event["name"].", ".$event["date"].", ".OpenData::$commune["974"][$event["cp"]]?></h2>
    <p> 
    Type : <?php if(isset($event["eventType"]))echo $event["eventType"]?><br/>
    Where : <?php if(isset($event["country"]))echo OpenData::$commune["974"][$event["cp"]].", ".$event["country"]?><br/>
    Description : <?php if(isset($event["description"]))echo $event["description"]?>
    
    </p>
 	<div class="grid">
        <div></div>
        <div  data-ss-colspan="2"><a href="<?php echo Yii::app()->createUrl('index.php/projet/list/ownerId/'.$event["_id"])?>">Projet(s)</a></div>
        <div></div>
        <div data-ss-colspan="2"><a href="<?php echo Yii::app()->createUrl('index.php/tools/import/group/'.$event["_id"].'/type/members')?>"><i class="icon-plus"></i> Membres</a></div>
        <div data-ss-colspan="2"><a href="<?php echo Yii::app()->createUrl('index.php/discuter/brainstormForm')?>" ><i class="icon-plus"></i> Brainstorm</a></div>
        <div data-ss-colspan="2"><a href="#" role="button" data-toggle="modal"><i class="icon-plus"></i> Bureau</a></div>
        <div data-ss-colspan="3"><a href="#" role="button" data-toggle="modal">Statistic </a></div>
        <div></div>
        <div data-ss-colspan="3"><a href="#" role="button" data-toggle="modal">Évènement </a></div>
        <div><a href="#" role="button" data-toggle="modal">NEWS Feed</a></div>
        <div></div>
        <div></div>
   </div>
</div></div>

<div class="container graph">
<div class="hero-unit">
	<div class="row-fluid">
		
		<div class="span4 block">
			<h2>PARTICIPANT, STANDS</h2>
			<br/>
		</div>
		
		<div class=" actu span4 block">
			<h2>Thématique</h2>
			
			<br/>
		</div>
		
		<div class="span4 block">
			<h2>Programme </h2>
			
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span8 block">
		<h2>------</h2>
		
        
		</div>
		<div class="span4 block">
		<h2>-------- </h2>
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span4  block">
		<h2>---------</h2>
		</div>
		<div class="span4 block">
		<h2>-----------</h2>
		</div>
		<div class="span4 block">
		<h2>------------</h2>
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span6 block">
		<h2>-----------</h2>
		</div>
		<div class="span6 block ">
		<h2>------------</h2>
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span4 block">
		<h2>------------</h2>
		</div>
		
		<div class="span4 block">
		<h2>------------------</h2>
		</div>
		
		<div class="span4 block">
		<h2>----------------</h2>
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span6 block">
		<h2>---------------------</h2>
		</div>
		
		<div class="span6 block">
		<h2>---------------------</h2>
		</div>
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
</script>			