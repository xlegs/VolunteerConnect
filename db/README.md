Couchbase directory structure
=======

Couchbase is a NoSQL database system based on JSON files. This makes Couchbase very flexible, allowing us to change the requirements of our database system very easily. Each file can easily be referenced by its file name.

The following describes the directory structure for the proposed database.

DATABASE ROOT
 + users
   - username.json
      -> stores information about each user
 + organizations
   - organization_name.json
      -> stores information about each organization
 + events
   - unique_event_id.json
      -> stores information about each event. Can be filtered by organization.
 + login
   - user_or_organization_login.json
      -> stores the hashed values of every user's password



the directory structure has been replicated here, and templates have been provided as a sample for the contents of each file.

More information about Couchbase can be found in the following links:
-