<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.touch-punch.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.shapeshift.min.js' , CClientScript::POS_END);
?>
<style>
h2,h3,h4 {
	/*font-family: "Homestead";*/
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}
.graph a {
color:#000;
}
.grid a{
display:block;
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
}
.grid {
  visibility:hidden;
  border: 1px dashed #CCC;
  position: relative;
}
<?php if($design != "s"){?>
    .grid > div {
      padding:8px;
      background-color:#F5E424;
      position: absolute;
      min-height: 270px;
      width: 100px;
    }
<?php } else {?>
    .grid > div {
      padding:8px;
      background-color:#F5E424;
      position: absolute;
      min-height: 150px;
      width: 100px;
    }
    .people img {
      width: 60px;
      float:left;
      border-radius: 50%;
    }
<?php }?>
.txt {font-size:small;color:black;line-height:18px;font-weight:bold;}
.grid > div[data-ss-colspan="2"] { width: 210px; }
.grid > div[data-ss-colspan="3"] { width: 320px; }

.grid > .ss-placeholder-child {
  background: transparent;
  border: 1px dashed blue;
}	

.graph div{border:1px solid #666;text-align:center}
.menu{paading:5px;}
a.tags{font-size:large;line-height:20px;}
</style>
<?php if(!isset($isModule)){?>
<div class="container graph">
    <div class="hero-unit">
    <h2> Organi Grid <?php echo $projet['name']?></h2>
    <?php }?>
    
 	<div class="grid">
 		<?php 
 		$colors = array("yellow","blue","#df354c","grey1","grey2");
 		$ctColors = 0;
        foreach(explode(",", $typePeople) as $t){
            $bg = $colors[$ctColors];
            foreach($projet[$t] as $id){
                $line = Yii::app()->mongodb->citoyens->findOne(array("_id"=>new MongoId($id['id'])));
        ?>
        <div data-ss-colspan="2" class="people <?php echo $t?> <?php echo str_replace(",", " ",str_replace(" ", "", $id['tags']))?>">
        <?php $img = Yii::app()->createUrl('images/PHOTO_ANONYMOUS.png');
            if(isset($line['img']))
                $img = Yii::app()->createUrl($line['img']);
            else if(isset($id['img']))
                $img = Yii::app()->createUrl($id['img']);
            $classMe = "";
            if($line["_id"] == Yii::app()->session["userId"])
                $classMe = "class='citizenThumb'";
            	?>
            	
        	<img <?php echo $classMe?> src="<?php echo $img?>" />
        	<h4><?php echo $line['name']?></h4>
        	<span class="txt"><?php echo $id['text']?></span>
        	<?php foreach(explode(",",$id['tags']) as $tag) {?>	
                 <a href="javascript:;" class="tags " onclick="filterType('<?php echo str_replace(" ", "", $tag)?>','#DFE1E8')"><?php echo $tag?> </a>
             <?php }?>
        </div>
       <?php } 
           $ctColors++;
            }?>
   </div>
   
   <div class="menu">
        <a href="javascript:;" class="tags badge blueDarkbg yellow" onclick="filterType('people','#F5E424')">Tous</a>&nbsp;
        
        <?php
        $filters = array(); 
        $tags = array();
        foreach(explode(",", $typePeople) as $t){
            array_push($filters, $t);
        ?>
        <a href="javascript:;" class="tags badge blueDarkbg yellow" onclick="filterType('<?php echo $t?>','#DFE1E8')"><?php echo $t?> (<?php echo count($projet[$t])?>) </a>&nbsp;
         <?php 
         foreach($projet[$t] as $id)
         {
         foreach(explode(",",$id['tags']) as $tag)
             {
                 if(!in_array($tag, $tags)){
                     array_push($tags, $tag);
                 ?>	
                 <a href="javascript:;" class="tags badge blueDarkbg yellow" onclick="filterType('<?php echo str_replace(" ", "", $tag)?>','#DFE1E8')"><?php echo $tag?> </a>&nbsp;
             <?php }
             }
         }?>
        <?php } ?>
    </div> 
    <div class="clear"></div>
   
   <?php if(!isset($isModule)){?>
</div></div>
<?php }?>

<script type="text/javascript">
function filterType(type,color){
	$(".people ").hide();
	$("."+type).show();
	/*TweenLite.to(".people ", 1, { display: 'none', scale: 0 });
	TweenLite.to("."+type, 1, { display: 'block', scale: 1, backgroundColor: color });*/
	$(".grid").trigger("ss-rearrange");
}
initT['animInit'] = function(){
	/*TweenMax.set(".people ", {display:"block",scale:1});*/
	$(".grid").shapeshift({
	    minColumns: 3
	  });
	$(".grid").css("visibility","visible");
   /* (function ani(){
    	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},1);
    })();*/
};
</script>	