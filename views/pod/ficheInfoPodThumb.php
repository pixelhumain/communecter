<?php 
	$nbEl = 0;
?>
<li>
	<div class="link">
		<i class="fa fa-<?php echo $icon; ?>"></i><?php echo $title; ?> <small>(<?php echo @$list ? count($list) : "0"; ?>)</small>
		<i class="fa fa-chevron-down"></i>
	</div>
	<ul class="submenu">	
		<li class="photosgurdeep text-right">
			
			<?php if(@$list) 
					foreach($list as $key=>$el){ 
						if($nbEl < 12){ $nbEl++;
			 				$thumbAuthor = Element::getImgProfil($el, "profilThumbImageUrl", $this->module->assetsUrl); 
			?>
							<?php if(@$thumbOnly==true){ ?> 
				    			<a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" 
				    				title="<?php echo @$el["username"]&&$el["username"]!="" ? $el["username"] : @$el["name"]; ?>">
				    				<img class="img-responsive img- img-thumb" alt="" src="<?php echo $thumbAuthor; ?>">
				    			</a>
				    		<?php }else{ ?>
				    			<a href="#" class="tooltips" data-toggle="tooltip" data-placement="top">
				    				<?php echo @$el["username"]; ?>
				    			</a>
				    		<?php } ?> 
			<?php 		}else{ break; }
					} 
			?>
			<?php if($nbEl>0){ ?>      
			    <br>
				<button class="btn btn-default letter-blue open-directory margin-top-5">
			    	<b>afficher tout</b> <i class="fa fa-chevron-right"></i>
				</button>
			<?php }else{ ?>
				<label>Aucun élément</label>
			<?php }?>	

		</li>
	</ul>
</li>
