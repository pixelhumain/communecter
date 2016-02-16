<div class="dropdown dropdown-scope tooltips" data-toggle="tooltip" data-placement="left" title="Sélectionner une commune" alt="Sélectionner une commune">
  <button class="btn btn-default dropdown-toggle " type="button" id="dropdownMenu1" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="true">
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <!-- <li><a href="#">Action</a></li> -->
    <?php 
		if(isset( Yii::app()->request->cookies['cityName'] )){
			echo '<li>'.
					'<a href="javascript:" class="btn-scope-list text-red homestead" val="'.Yii::app()->request->cookies['cityName'].'">'.
					//'<i class="fa fa-angle-right"></i> '.
					Yii::app()->request->cookies['cityName'].'</a>'.
				 '</li>';
		}
		if(isset( Yii::app()->request->cookies['postalCode'] )){
			echo '<li>'.
					'<a href="javascript:" class="btn-scope-list text-red homestead" val="'.Yii::app()->request->cookies['postalCode'].'">'.
					//'<i class="fa fa-angle-right"></i> '.
					Yii::app()->request->cookies['postalCode'].'</a>'.
				 '</li>';
		}
	?>
  </ul>
</div>