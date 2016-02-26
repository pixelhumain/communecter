<style type="text/css">
	.btnSpacer{ margin-right:40px; }
	@media screen and (max-width: 768px) {
   		.btnSpacer{ margin-right:10px; }
   	}
</style>
<?php 
if(!isset($toolbarStyle)) $toolbarStyle = "";//width:90%";
if(!isset($toolbarFloat)) $toolbarFloat = "";//"pull-right";
 ?>
<div class="<?php echo $toolbarFloat ?> center box-ajaxTools" style="<?php echo $toolbarStyle ?>">
	<?php 
    
    $colLeft = "<div class='col-md-7 col-sm-7 col-xs-7 text-left no-padding pull-left'>";
    $colRight = "<div class='col-md-5 col-sm-5 col-xs-5 text-right no-padding pull-right'>";
		
    if(isset($this->toolbarMBZ)){
			foreach ($this->toolbarMBZ as $value) {
        $position = ( isset( $value["position"] ) ) ? $value["position"] : "left";
             if($position == "left") { $colLeft  .= buildToolBarEntry($value); }
        else if($position == "right"){ $colRight .= buildToolBarEntry($value); }
			}
		} 
		
    $colLeft .= "</div>";
    $colRight .= "</div>";
    
    echo $colLeft . $colRight;
    
		function buildToolBarEntry($item)
    {
      $onclick = (isset($item["onclick"])) ? 'onclick="'.$item["onclick"].'"' :  "" ;

      $href = ( isset( $item["href"] ) ) ? $item["href"]  : "" ;
      $iconSize = (isset($item["iconSize"])) ? 'class="'.$item["iconSize"].'"' : "";//"fa-2x";
      $icon = (isset($item["iconClass"])) ? '<i class="'.$item["iconClass"].' '.$iconSize.'"></i>' : '';
      $badge = ( isset( $item["badge"] ) ) ? $item["badge"] : "";
      $label = ( isset( $item["label"] ) ) ? $item["label"] : "";
      $tooltip = ( isset( $item["tooltip"] ) ) ? " data-placement='bottom' data-original-title='".$item["tooltip"]."'" : "";
      //par defaut, si un item n'a pas de position, on le met à gauche
      $item["position"] = isset( $item["position"] ) ? $item["position"] : "left";
      $class =  $item["position"] == "right" ? "hidden-sm hidden-md hidden-xs" : "hidden-xs";
      //$position = ( isset( $value["position"] ) ) ? $value["position"] : "left";
      $html = $href.$tooltip.">".$badge.$icon.' <span class="'.$class.'">'.$label.'</span></a>';

      if( isset( $item["parent"] ) && isset( $item["parentId"] ) ) {
      	$html = '<'.$item["parent"].' id="'.$item["parentId"].'">'.$html.'</'.$item["parent"].'>';
      }
      return $html."<span class='btnSpacer'></span>";
    }

	?>

</div>
<!-- <div class="space20"></div> -->
<script type="text/javascript">
jQuery(document).ready(function() 
{
	if($(".tooltips").length) {
   		$('.tooltips').tooltip();
   	}
});


</script>