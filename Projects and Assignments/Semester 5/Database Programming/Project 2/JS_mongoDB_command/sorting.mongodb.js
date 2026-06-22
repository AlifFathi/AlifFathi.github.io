use("libraryDB");

// 1. Sort users by name in ascending order
db.users.find().sort({ name: 1 })

// 2. Sort books by published year in descending order
db.books.find().sort({ "publisher.year": -1 })


