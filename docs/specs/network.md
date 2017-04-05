 # Doc Network

 "filter" : {
        "paramsFiltre" : {
            "conditionBlock" :"and",
            "conditionTagsInBlock" :"and"
        }, 

 par defauts si on ne mets pas de paramsFiltres , les filtres agiront ainsi : 
- les tags dans un mettre filtre agisse comme des "OU"
- Entre les filtres comme des "ET"
"conditionBlock" permet de définir comment agit les tags entre les filtres
et "conditionTagsInBlock" permet de définir comment agissent les tags dans un filtre