//SBAR - 25/02/15
Idea : history log
- Add an history object to keep track of change on every objects (person, organization, event...)
	- CreatedBy : userId
	- CreatedDate : DateTime
	- logbook :
		- id : MongoId
		- updateDate : DateTime
		- updateBy : userId
	- EveryUpdate a hook keep track of the modification and add an entry in the logbook of the object

Organization or Person
- Add ContactPoints : http://schema.org/ContactPoint

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

//SBAR - 25/02/15
Some bugs/features to fix/add :
- No error message when email (person) already exist in the database
- No Mail send when forgot your password ("NetworkError: 404 Not Found - http://127.0.0.1:8888/ph/communecter/api/sendemailpwd")
- Mail send to validate email account when new person

