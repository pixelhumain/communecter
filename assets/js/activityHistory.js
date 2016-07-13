var loadActivity = true;	
function getHistoryOfActivities(id,type){
	$("#contentGeneralInfos").hide();
	$("#activityContent").removeClass("hide");
	$("#getHistoryOfActivities").html("<i class='fa fa-arrow-left'></i> <span class='hidden-xs'>Revenir aux détails</span>").attr("onclick","getBackDetails('"+id+"','"+type+"')");
	//if($("#activityContent").html()=='<h2 class="homestead text-dark" style="padding:40px;"><i class="fa fa-spin fa-refresh"></i> Chargement des activités ...</h2>')
	if(loadActivity==true){
		getAjax('#activityContent',baseUrl+'/'+moduleId+"/pod/activitylist/type/"+type+"/id/"+id,function(){ 
	},"html");
	}
	
}
function getBackDetails(id,type){
	$("#contentGeneralInfos").show();
	$("#activityContent").addClass("hide");
	$("#getHistoryOfActivities").html("<i class='fa fa-history'></i> <span class='hidden-xs'>Historique</span>").attr("onclick","getHistoryOfActivities('"+id+"','"+type+"')");
	loadActivity=false;
}
