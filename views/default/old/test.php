
<style type="text/css">
/*.canvas{
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;

}*/
.cube{
	width:50px;
	height:50px;
	
	float:left;
	border: 1px solid #666;
}
.red {
	background-color: #E33551;
}
.white {
	background-color: #ffffff;
}
.clear{clear:both;}
</style>
<div class="space20"></div>

<div class="canvas"></div>

<div class="space20"></div>

<script type="text/javascript">

var sides = 6;
var splitout = (sides*sides) / 4;

jQuery(document).ready(function() 
{
	
	compactCube ()
	//splitOutCube() ;
});

function compactCube () { 
	console.clear()
	$(".canvas").html('');
	for(var ix = 0; ix < sides*sides; ix++)
	{
		console.log("ix",ix);
		
		clear = (ix % sides == 0) ? "clear" : "";
		color = ( (sides*sides) % 4 == 0) ? "white" : "red";

		str = "<div class='cube cube"+ix+" "+clear+" "+color+"'></div>";

		$(".canvas").append(str);
	}
}

function splitOutCube() 
{
	console.clear()
	
	var splitToggle = 1;

	var cubeSize = Math.round( $(".canvas").width() / (splitout+2) );
	$(".canvas").html('').css({"width":cubeSize*(splitout+1)});
	

	for( var ix = 0; ix < sides*sides; ix++ )
	{
		clear = ( ix == (splitout+1) || ix == ( 3 * splitout )-1  ) ? "clear" : "";

		color = ( (sides*sides) % 4 == 0) ? "white" : "red";
		
		var pos =  "";

		console.log( $(".canvas").height() , cubeSize, " splitOutCube ix",ix,splitToggle, clear);

		if(ix > splitout && ix < (3*splitout)-1)
		{
			if(splitToggle > 0)
				pos =  "pull-left clear";
			else
				pos =  "pull-right ";

			splitToggle = -splitToggle;
			
		}	

		str = "<div class='cube cube"+ix+" "+clear+" "+color+" "+pos+"'></div>";

		$(".canvas").append(str);
		$(".cube").css({"height":cubeSize , "width":cubeSize});
	}
}

</script>