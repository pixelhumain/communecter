COMMUNECTER : se connecter à sa commune
CITYNECTED : to connect to your city
===========

Interface de Gestion de commune et de citoyen connectés à leur commune.

is an application for connected cities or territories 

ASAP
===========
we need asap the a json-ld smaple descriptions of : 
- [person](https://github.com/pixelhumain/buildingCommons/blob/master/person.json)
- [projects]()
- [organizations (NGO, Company, Informel Group) ]()
- [discussion]()
- [event]() 
- [city]()

current Status 
===========
released : xx
url : 
implementing : Version0.1

Roadmap & Milestones
===========
V.01
	re write all person, Organization entities into conform JSON-LD
	register person
	login 
	create Organization
	local search Organization
V.011
	Search Engine
		search by scope : city scope or region scope
	Tagging Module
		add tags on person & Organization
		search by tags
V0.12
	Event
		create Event by Anyones
		show event lsit by scope 
		visualisations
			list
			calendar
V0.13
	Data Organizer
		in a linked list, drag , order and hierachize data under family groups
		groups 
			My Friends
			My NGOs
			My Companies
			My Places
	try representing in a mixit up interface
Sitemap 
===========
- Entry point 
	- The platform's content information is fully open 
	- loging in give access to 
		- notifications
		- creating an Organization
		- participating
		- and much more
- Dashboard
	- Organization of type Association (NGOs)
		- List of associations
		- add an association
	- Organization of type Company
		- List of companies
		- Add a company 
	- Périscolaire
	- Information
- Person
	- can register 
	- can login
	- searched by tag
- Organizations
	- can be created by a registered person
		- can contain people 
		- can contain organisations 
	- be joined by a person
	- searched by tag
	- can be public or private
- Events
	- can be created by a person or an Organization
	- can be viewed in a calendar
	- searchable by location, by tags
- City 
	- exists when simply one person is in a postalCode
	- contains People, Organizations
	- has Events

Think Tank & wishlist
===========
Proxicity : a value calculating the capacity of a territory in creating links based on a social plateforms activity

