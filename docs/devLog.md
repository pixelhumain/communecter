
// This file helps any devlopper to update his environment in order to make it work
// according to the new development
// Add a datetime or better a commit id linked to the modification

----------------------------------------------------
----------------------------------------------------
----------------------------------------------------
----------------------------------------------------
----------------------------------------------------
----------------------------------------------------
----------------------------------------------------
https://www.google.com/url?q=https%3A%2F%2Fgit-scm.com%2Fbook%2Ffr%2Fv1%2FLes-branches-avec-Git-Les-branches-distantes&sa=D&sntz=1&usg=AFQjCNHT0E5vbg_-BUC7xIm7guTVRBzG1Q

git checkout -b granddir-V.0.1 origin/granddir-V.0.1
git push origin granddir-V.0.1
----------------------------------------------------

//SBA : 12/08/2015
New role object on Citoyen collection
1/Backup your citoyen collection
2/Launch the following code on your mongodb 
db.citoyens.find().forEach(function(citoyen){
    if(citoyen.roles == null) { 
        print(citoyen.name+" roles is null ");
        db.citoyens.update({"_id":citoyen._id}, 
                    {'$set':{'roles': { 
                        "standalonePageAccess" : true
                    }}}
        );
    }
});

//SBA : 30/04/2015
Update your config/main.php
Now all the parameters link to your environment are stored in paramsconfig.php

----------------------------------------------------

//SBA : 30/04/2015 :
How to Load cities collection
Download the ville de france file on git : https://raw.githubusercontent.com/pixelhumain/Villes-de-France/master/cities.js
Drop or rename any existing "cities" collection
Load the new collection
mongoimport --db pixelhumain --collection cities PATH_TO_MY_FILE\cities.js --jsonArray

----------------------------------------------------
//TKA : 28/04/2015  : 
execute composer update to install Captcha libs
and add the secret key to your paramsconfig.php
----------------------------------------------------
//TKA : 28/04/2015  : mettre a jour les cp dans cities

db.cities.find().forEach(function(doc){
    if(doc.insee.length == 4){ 
        print(doc.name+" cp "+doc.insee.length+": "+doc.insee);
        db.cities.update({"_id":doc._id},{'$set':{'insee':"0"+doc.insee}})
    }
});

db.cities.find().forEach(function(doc){
    if(doc.cp.length == 4){ 
        print(doc.name+" cp "+doc.cp.length+": "+doc.cp);
        db.cities.update({"_id":doc._id},{'$set':{'cp':"0"+doc.cp}})
    }
});

----------------------------------------------------
//TKA - 24/2/15
db.organizations.update({type:"entreprise"},{"$set":{type:"LocalBusiness"}},{"multi":1})
db.organizations.update({type:"association"},{"$set":{type:"NGO"}},{"multi":1})
db.organizations.update({type:"group"},{"$set":{type:"Group"}},{"multi":1})

DB lists update documents
{
    "name" : "organisationTypes",
    "list" : {
        "NGO" : "Association",
        "LocalBusiness" : "Entreprise",
        "Group" : "Group"
    }
}



