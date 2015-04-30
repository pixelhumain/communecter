
// This file helps any devlopper to update his environment in order to make it work
// according to the new development
// Add a datetime or better a commit id linked to the modification

//XXX - 01/01/01 - commitId fb11716e5a92340ef4f47c58c241716a3575a623
bla bla
----------------------------------------------------
----------------------------------------------------
----------------------------------------------------
----------------------------------------------------
----------------------------------------------------
----------------------------------------------------
----------------------------------------------------
----------------------------------------------------
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
and add the secret key to you main
----------------------------------------------------
//TKA : 28/04/2015  : mettre a jour les cp dans cities

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



