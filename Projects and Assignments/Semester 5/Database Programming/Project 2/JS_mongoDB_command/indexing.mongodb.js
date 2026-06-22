use("libraryDB");

// 1. Single Field Index (name)
// Creates an index on the name field in the users collection
db.users.createIndex({ name: 1 })

// 2. Compound Index (userId and payment.status)
// Creates a compound index on userId and payment.status fields in the fines collection
db.fines.createIndex({ userId: 1, "payment.status": 1 })


