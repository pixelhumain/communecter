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
----------------------------------------------------
----------------------------------------------------
----------------------------------------------------
----------------------------------------------------
----------------------------------------------------
---------------------------------------------------
2016/03/18

Mettre en cron les statistiques
communecter/stat/createglobalstat

----------------------------------------------------


2016/03/01
@Raphael
Add "'isOpendata': true" for all projects which have sourceKey == "patapouf"

db.organizations.find().forEach(function(doc){ 
    if(doc.source != null) { 
        if(doc.source.key == "patapouf"){ 
            print(doc.name); 
            db.organizations.update({"_id":doc._id},{
                '$set':{'isOpendata': true}
            }) 
        } 
    }
});



----------------------------------------------------
set up indexes 
db.cities.createIndex({"geoPosition.coordinates": "2dsphere"})

----------------------------------------------------
benchmarkin mongo 

var timeStart = new Date();
for(var i = 0 ; i < 70000 ; i++){
    //db.test.insert({name:"test"+i}); //prend 30s > 
    db.test.insert({name:"test"+i,email:"test"+i,toto:"test"+i,coco:"test"+i});//prend 33s  > 7Mb
    db.test.insert({name:"test"+i,email:"test"+i,toto:"test"+i,coco:"test"+i,namex:"test"+i,emailx:"test"+i,totox:"test"+i,cocox:"test"+i});   // 36s > 13Mb
    //pour 200K entré : 108s et 38Mb
}
var timeEnd = new Date();
print(timeEnd-timeStart);
----------------------------------------------------
//adding countries to cities
db.cities.find().forEach(function(doc)
{
  if(typeof doc.insee != "undefined"){
    if(doc.insee.indexOf("971")>=0 )
        db.cities.update({"_id":doc._id},{'$set':{'country':'GP'}});
    else if(doc.insee.indexOf("972")==0 )
        db.cities.update({"_id":doc._id},{'$set':{'country':'MQ'}});
    else if(doc.insee.indexOf("973")==0 )
        db.cities.update({"_id":doc._id},{'$set':{'country':'GF'}});
    else if(doc.insee.indexOf("974")==0 )
        db.cities.update({"_id":doc._id},{'$set':{'country':'RE'}});
    else if(doc.insee.indexOf("975")==0 )
        db.cities.update({"_id":doc._id},{'$set':{'country':'PM'}});
    else if(doc.insee.indexOf("976")==0 )
        db.cities.update({"_id":doc._id},{'$set':{'country':'YT'}});
    else if(doc.insee.indexOf("988")==0 )
        db.cities.update({"_id":doc._id},{'$set':{'country':'NC'}});
    else
        db.cities.update({"_id":doc._id},{'$set':{'country':'FR'}});
  }
});
----------------------------------------------------
//adding regionName to cities Nouvelle-Caledonie
db.cities.find().forEach(function(doc)
{
    if(typeof doc.insee != "undefined"){
        if(doc.insee.indexOf("988")==0 )
            db.cities.update({"_id":doc._id},{'$set':{'regionName':'Nouvelle-Calédonie'}});
    }
});
----------------------------------------------------
Update username on citizen collection.
To launch with mongodb

db.citoyens.find().forEach(function(doc){
    if(doc.username == null) { 
        var username = doc.email.substr(0, doc.email.indexOf('@'));
        print(doc.name+" :  "+doc.email+": "+username);
        db.citoyens.update({"_id":doc._id},{'$set':{'username':username}})
    }
});

----------------------------------------------------
Init scripts

#import lists 
cd communecter/data
mongoimport --db pixelhumain --collection lists lists.json --jsonArray;

----------------------------------------------------
https://www.google.com/url?q=https%3A%2F%2Fgit-scm.com%2Fbook%2Ffr%2Fv1%2FLes-branches-avec-Git-Les-branches-distantes&sa=D&sntz=1&usg=AFQjCNHT0E5vbg_-BUC7xIm7guTVRBzG1Q

//1. Créer une branche locale
git branch granddir-V.0.1
//2. Pusher la branche sur le serveur distant
git push origin granddir-V.0.1
//3. Si besoin checkout d'une branche distante sur une branche en local 
//3.1 Récupérer les branches distantes nouvellement créée
git fetch origin
//3.2 récupérer le contenu d'une branche distante
git checkout -b granddir-V.0.1 origin/granddir-V.0.1


//Azot live branch
git checkout -b azot-live-0.1 origin/azot-live-0.1


git remote show origin
If the remote branch you want to checkout is under "New remote branches" and not "Tracked remote branches" then you need to fetch them first:
git remote update
git fetch
Now it should work:
git checkout -b local-name origin/remote-name
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
#TKA : 28/04/2015  : mettre a jour les cp dans cities

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

----------------------------------------------------

#update cities geo format

Etape 1 : Ouvrir son fichier php_error.log, afin de suivre l'évolution du processus (l'opération peut durer une dixaine de minute)

Etape 2 : Se préparer un thé ou un café allongé, et s'installer confortablement devant son écran.

Etape 3 : Sur la page "login", cliquer sur le bouton "Mettre à jour la bdd" dans le coin en haut à droite de l'écran

Etape 4 : Boire son thé ou son café en scrollant bêtement sur Facebook

Etape 5 : (10 minutes plus tard) Chouette la mise à jour est terminée !

=> Executer la commande suivante dans un terminal Mongo (robotmongo pour ceux qui ont)

=> db.cities.createIndex({"geoPosition.coordinates": "2dsphere"})

Etape 5bis : (10 minutes plus tard) Vous schtroumfez une erreur bisarre ! Mais qu'est-ce qui s'est fichtrement passé ?
==> https://github.com/pixelhumain/communecter/issues/438

Etape 6 : Applaudir à deux main : vous avez une base de données toute propre !

Etape 7 : https://github.com/pixelhumain/communecter/issues/438

---------------------------------------------------

Modifier un mail
db.organizations.find().forEach(function(doc){ 
    if(doc.email == "vanespen.amaury@gmail.com"){ 
        print(doc.name+" :: " + doc.email); 
        db.organizations.update({"_id":doc._id},{
            '$set':{'email':""}
        }) 
    } 
});

