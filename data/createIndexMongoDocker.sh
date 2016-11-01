#!/bin/bash

#delete index mongo
mongo mongo/pixelhumain <<EOF
db.citoyens.dropIndexes();
db.cities.dropIndexes();
db.events.dropIndexes();
db.organizations.dropIndexes();
db.projects.dropIndexes();
EOF

#create index mongo
mongo mongo/pixelhumain <<EOF
db.citoyens.createIndex({"email": 1} , { unique: true });
db.cities.createIndex({"geoPosition": "2dsphere"});
db.cities.createIndex({"postalCodes.geoPosition": "2dsphere"});
db.cities.createIndex({"geoShape" : "2dsphere" });
db.cities.createIndex({"insee" : 1});
db.cities.createIndex({"region" : 1});
db.cities.createIndex({"dep" : 1});
db.cities.createIndex({"cp" : 1});
db.cities.createIndex({"country" : 1});
db.cities.createIndex({"postalCodes.name" : 1});
db.cities.createIndex({"postalCodes.postalCode" : 1});
db.events.createIndex({"geoPosition" : "2dsphere" });
db.events.createIndex({"parentId" : 1});
db.events.createIndex({"name" : 1});
db.organizations.createIndex({"geoPosition" : "2dsphere" });
db.projects.createIndex({"geoPosition" : "2dsphere" });
db.citoyens.createIndex({"geoPosition" : "2dsphere" });
EOF
