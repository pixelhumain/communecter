<?php /* ?>
<a href="javascript:;" onclick="gotToPrevNav()" class="pull-left"><i class="fa fa-arrow-circle-left fa-2x"> </i></a>
<a href="javascript:;" onclick="$('.box-ajax').hide()" class="pull-right text-red btn-close-panel"><i class="fa fa-times "> </i></a>
<?php /* ?><div class="pull-right center text-bold text-extra-large box-ajaxTitle" style="width:90%"> </div> */?>

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
<div class="bg-box-ajaxTools">
	<?php 
    
    $colLeft = "<div class='col-md-8 col-sm-8 col-xs-8 text-left no-padding pull-left'>";
    $colRight = "<div class='col-md-4 col-sm-4 col-xs-4 text-right no-padding pull-right'>";
		
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
            $class = (isset($item["class"])) ? 'class="'.$item["class"].'"' : "";
            $iconSize = (isset($item["iconSize"])) ? 'class="'.$item["iconSize"].'"' : "";//"fa-2x";
            $icon = (isset($item["iconClass"])) ? '<i class="'.$item["iconClass"].' '.$iconSize.'"></i>' : '';
            $badge = ( isset( $item["badge"] ) ) ? $item["badge"] : "";
            $label = ( isset( $item["label"] ) ) ? $item["label"] : "";
            $tooltip = ( isset( $item["tooltip"] ) ) ? " data-placement='bottom' data-original-title='".$item["tooltip"]."'" : "";
            //$position = ( isset( $value["position"] ) ) ? $value["position"] : "left";
            $html = $href.$tooltip.">".$badge.$icon.' '.$label.'</a>';

            if( isset( $item["parent"] ) && isset( $item["parentId"] ) ) {
            	$html = '<'.$item["parent"].' id="'.$item["parentId"].'">'.$html.'</'.$item["parent"].'>';
            }
            return $html."<span class='btnSpacer'></span>";
          }

		?>

</div>
</div>
<div class="space20"></div>
<script type="text/javascript">
jQuery(document).ready(function() 
{
	if($(".tooltips").length) {
   		$('.tooltips').tooltip();
   	}
});


</script>