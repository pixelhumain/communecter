function startSearch(indexMin, indexMax, callBack){
    mylog.log("startSearch2", typeof callBack, callBack);
    if(loadingData) return;
    loadingData = true;
    
    //mylog.log("loadingData true");
    indexStep = indexStepInit;

    mylog.log("startSearch", indexMin, indexMax, indexStep);

    var name = ($('#searchBarText').length>0) ? $('#searchBarText').val() : "";
    
    if(name == "" && searchType.indexOf("cities") > -1) return;  

    if(typeof indexMin == "undefined") indexMin = 0;
    if(typeof indexMax == "undefined") indexMax = indexStep;

    currentIndexMin = indexMin;
    currentIndexMax = indexMax;

    if(indexMin == 0 && indexMax == indexStep) {
      totalData = 0;
      mapElements = new Array(); 
    }
    else{ if(scrollEnd) return; }
    
    if(name.length>=3 || name.length == 0)
    {
      var locality = "";
      if( communexionActivated )
      {
        if(typeof(cityInseeCommunexion) != "undefined")
        {
          if(levelCommunexion == 1) locality = cpCommunexion;
          if(levelCommunexion == 2) locality = inseeCommunexion;
        }else{
          if(levelCommunexion == 1) locality = inseeCommunexion;
          if(levelCommunexion == 2) locality = cpCommunexion;
        }
        //if(levelCommunexion == 3) locality = cpCommunexion.substr(0, 2);
        if(levelCommunexion == 3) locality = inseeCommunexion;
        if(levelCommunexion == 4) locality = inseeCommunexion;
        if(levelCommunexion == 5) locality = "";
      }
      autoCompleteSearch(name, locality, indexMin, indexMax, callBack);
    }  
}