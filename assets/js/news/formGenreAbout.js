
	var listGenre = { 	 "free_msg" 		 : { "color" : "white", 	"name" : "Message libre" },
						  "idea" 	 		 : { "color" : "yellow", 	"name" : "Idée" },
						  "help" 	 		 : { "color" : "red", 		"name" : "Demande d'aide" },
						  "rumor"	 		 : { "color" : "orange", 	"name" : "Rumeur" }, 
						  "true_information" : { "color" : "green", 	"name" : "Information vérifiée" },
						  "question"		 : { "color" : "purple", 	"name" : "Question" }, 
						};
	
	var genreHover = "free_msg";
	function showTooltipGenre(genre){
		var genreName = listGenre[genre]["name"];
		$("#tooltip_genre_name").html(genreName);
		
		var left = 	$("#itemSelectGenre" + genre).position().left - 
					($("#tooltip_genre_name").width()/2+20) +
					($("#itemSelectGenre" + genre).width()/2+4);
					;
		
		$("#tooltip_genre_name").css({"left": left + "px"});
				
		var classRemove = listGenre[genreHover]["color"];
		var classAdd = listGenre[genre]["color"];
		//alert(classRemove);
		$("#tooltip_genre_name").removeClass(classRemove).addClass(classAdd);
		
		genreHover = genre;
		
	}
	
	var genreSelected = "free_msg";
	function selectGenre(genre){
		var genreName = listGenre[genre]["name"];
		
		var classRemove = listGenre[genreSelected]["color"];
		var classAdd = listGenre[genre]["color"];
	
		//alert(classRemove);
		$("#header_new_post").removeClass(classRemove).addClass(classAdd);
		$("#lbl_genre_name_selected").html(genreName);
		
		var imgName = genre;
		if(genre == "question") imgName = "question_white";
		if(genreSelected == "question") genreSelected = "question_white";
		
		var src = $("#imgGenreSelected").attr("src").replace(genreSelected, imgName);
        //$(this).attr("src", src);
		$("#imgGenreSelected").attr("src" , src);
		
		genreSelected = genre;
	}
	
	var genreSelectedNewsstream = new Array("free_msg");
	function selectGenreNewsstream(genre){
		var found = false;
	$.each(genreSelectedNewsstream, function(index){ //alert(this + " - " + genre);
			if(this == genre) { 
				genreSelectedNewsstream.splice(index, 1);	
				$("#itemSelectGenre"+genre).removeClass("selected");
				found = true;
			}
			
		});
		if(found == false){ //alert(found + "   #itemSelectGenre"+genre); 
				$("#itemSelectGenre"+genre).addClass("selected");
				genreSelectedNewsstream.push(genre);
		}
		
	}
	
	var aboutList = new Array();
	function checkChkAbout(i){
		var pos = aboutList.indexOf(i);
			
		if(pos == -1){
			$("#about_"+i).removeClass("alert-info").addClass("alert-success");
			aboutList.push(i);
		} else { 
			$("#about_"+i).removeClass("alert-success").addClass("alert-info");
			//aboutList.remove(i);
			aboutList.splice(pos, 1);
		}
	}