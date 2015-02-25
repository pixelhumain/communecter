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