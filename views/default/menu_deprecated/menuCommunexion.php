<style>

	#menu-bottom .btn-param-postal-code{
		border-radius: 0px;
		left: 0px;
		bottom: 0px;
		height: 40px !important;
		width: 40px !important;
		font-size: 23px;
	}

	.btn-scope{
		display: none;
		position: fixed;
		border-radius: 50%;
		z-index: 1;
		border: none;
		background-color: rgba(255, 255, 255, 0.45) !important;
		box-shadow: 0px 0px 3px 3px rgba(114, 114, 114, 0.1);
	} 
	.btn-scope.selected{
		background-color: rgb(233, 96, 118) !important;
	}
	.btn-scope:hover{
		background-color: rgb(233, 96, 118) !important;
	}
	.btn-scope-niv-2{
		bottom: 43px;
		width: 74px;
		height: 73px;
		left: 46px;
	}
	.btn-scope-niv-3{
		bottom: 29px;
		width: 105px;
		height: 104px;
		left: 31px;
	}
	.btn-scope-niv-4{
		bottom: 15px;
		width: 136px;
		height: 135px;
		left: 16px;
	}
	
	.btn-scope-niv-5{
		bottom: 0px;
		width: 167px;
		height: 166px;
		left: 0px;
		border-radius: 50% 50% 50% 0%;
		background-color: rgb(177, 194, 204) !important;
	}
	/*.btn-scope-niv-5:hover{
		background-color: rgb(109, 120, 140) !important;
	}
	.btn-scope-niv-5.selected{
		background-color: rgb(109, 120, 140) !important;
	}*/


	.btn-start-new-communexion{
	    position: absolute;
	    bottom: 62px;
	    left: 370px;
	    border-radius: 50%;
	    width: 35px;
	    height: 35px;
	    padding: 7px 3px 3px 11px;
	    box-shadow: 0px 0px 3px 1px rgba(0, 0, 0, 0.39);
	}

	.btn-start-new-communexion:hover{
		box-shadow: 0px 0px 3px 2px rgba(0, 0, 0, 0.39);
	}

	
.btn-param-postal-code{
	left: 61px;
	bottom: 57px;
	width: 45px !important;
	height: 45px !important;
	border-radius: 50%;
	z-index:2;
	color: #FFF;
	font-size: 19px;
	-moz-box-shadow: 0px 0px 5px 0px rgba(66, 66, 66, 0.79) !important;
	-webkit-box-shadow: 0px 0px 5px 0px rgba(66, 66, 66, 0.79) !important;
	-o-box-shadow: 0px 0px 5px 0px rgba(66, 66, 66, 0.79) !important;
	box-shadow: 0px 0px 5px 0px rgba(66, 66, 66, 0.79) !important;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#2BB0C6, Direction=NaN, Strength=5) !important;
}

#input-communexion{
	display:none;
	position:fixed;
	bottom:0px;
	left:0px;
	z-index: 1;
}

#searchBarPostalCode{
	position: absolute;
	left: 62px;
	bottom: 57px;
	height: 45px;
	margin-top: 10px;
	width: 350px;
	margin-left: 0px;
	font-family: "homestead";
	font-size: 22px !important;
	border-radius: 55px;
	padding-left: 69px;
	text-align: left;
}

#input-communexion .search-loader{
	position: absolute;
	left: 170px;
	bottom: 105px;
	font-weight: 600;
	font-size: 14px;
	overflow: hidden;
	max-width: 450px;
	width: 450px;
	height: 20px;
	max-height: 20px;
}

@media screen and (min-height: 100px) and (max-height: 450px) {
	button.btn-menu2{
		top:75px;
	}
	button.btn-menu3{
		top:130px;
	}
	button.btn-menu4{
		top:185px;
	}
	button.btn-menu6{
		/*top:250px;*/
	}
	button.btn-menu7{
		/*top: 210px;*/
		right: 27px;
   	}
   	button.btn-menu9{
		top: 240px;
    }
	button.btn-geoloc-auto{
		display:none;
		left: 60px !important;
		top: 14px !important;
	}
	button.btn-logout {
    	left: 10px;
		top: 15px;
	}
	.btn-param-postal-code {
    	left: 15px;
		bottom: 12px;
    }
    @media screen and (min-width: 765px){
	    #searchBarPostalCode{
		    left: 62px;
			bottom: 12px;
	    height: 40px;
	        width: 186px;
	        padding: 10px 15px !important;
	    }
    }
    button.btn-menu-add{
	    bottom: 12px;
    }
    #input-communexion .search-loader{
	    left: 70px;
		bottom: 50px;
    }
	/*.box-ajaxTools{
		width:88%;
		margin-left:12%;
	}*/
}

@media screen and (max-width: 767px) {
	.btn-scope{
		display: none;
		left:0px !important;
		width:40px !important;
		margin-bottom:40px !important;
		border-radius: 0px 40px 0px 0px !important;
		bottom:0px !important;
		position: fixed;
		z-index: 1;
		border: none;
		box-shadow: 0px 0px 3px 3px rgba(114, 114, 114, 0.1);
	} 
	.btn-scope-niv-2{
		height: 43px;
	}
	.btn-scope-niv-3{
		height: 83px;
	}
	.btn-scope-niv-4{
		height: 123px;
	}
	
	.btn-scope-niv-5{
		height: 163px;
	}
	
}


</style>

<div class="hidden">
<button class="btn-scope btn-scope-niv-5 tooltips" level="5"
		data-toggle="tooltip" data-placement="top" title="Niveau 5 : Global" alt="Niveau 5 : Global" ></button>
<button class="bg-red btn-scope btn-scope-niv-4 tooltips" level="4"
		data-toggle="tooltip" data-placement="top" title="Niveau 4 : Région" alt="Niveau 4 : Région" ></button>
<button class="bg-red btn-scope btn-scope-niv-3 tooltips" level="3"
		data-toggle="tooltip" data-placement="top" title="Niveau 3 : Déparement" alt="Niveau 3 : Département" ></button>
<button class="bg-red btn-scope btn-scope-niv-2 tooltips" level="2"
		data-toggle="tooltip" data-placement="top" title="Niveau 2 : Code postal" alt="Niveau 2 : Code postal" ></button>


<button class="menu-button menu-button-title bg-red tooltips hidden-xs btn-param-postal-code btn-scope-niv-1"
		data-toggle="tooltip" data-placement="top" title="Niveau 1 :  Commune" alt="Niveau 1 : Commune" >
	<i class="fa fa-crosshairs"></i>
</button> 
<div id="input-communexion">
	<span class="search-loader text-red">Communexion : <span style='font-weight:300;'>un code postal et c'est parti !</span></span>
	<input id="searchBarPostalCode" class="input-search text-red" type="text" placeholder="un code postal ?" style="border-radius:100px !important; padding-left:60px !important;">
	<a class="btn-start-new-communexion bg-red tooltips" href="javascript:" onclick="startNewCommunexion();"
		data-toggle="tooltip" data-placement="right" title="Lancer la recherche" alt="Lancer la recherche">
		<i class="fa fa-search"></i>
	</a>
</div>
</div>